<?php

function vsCodeGetTranslationsFromFile(Symfony\Component\Finder\SplFileInfo $file, $path, $namespace)
{
    if ($file->getExtension() !== 'php') {
        return null;
    }

    $filePath = $file->getRealPath();

    $relativePath = trim(str_replace($path, '', $file->getPath()), DIRECTORY_SEPARATOR);
    $lang = explode(DIRECTORY_SEPARATOR, $relativePath)[0] ?? null;

    if (!$lang) {
        return null;
    }

    $keyPath = str_replace($path . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR, '', $filePath);
    $keyWithSlashes = str_replace('.php', '', $keyPath);
    $baseKey = str_replace(DIRECTORY_SEPARATOR, '.', $keyWithSlashes);

    if ($namespace) {
        $baseKey = "{$namespace}::{$baseKey}";
    }

    try {
        $translations = require $filePath;
    } catch (Throwable $e) {
        return null;
    }

    if (!is_array($translations)) {
        return null;
    }

    $fileLines = Illuminate\Support\Facades\File::lines($filePath);
    $lines = [];
    $inComment = false;

    foreach ($fileLines as $index => $line) {
        $trimmed = trim($line);
        if (str_starts_with($trimmed, '/*')) {
            $inComment = true;
        }
        if ($inComment) {
            if (str_ends_with($trimmed, '*/')) {
                $inComment = false;
            }
            continue;
        }
        if (str_starts_with($trimmed, '//')) {
            continue;
        }
        $lines[] = [$index + 1, $trimmed];
    }

    return [
        'k' => $baseKey,
        'la' => $lang,
        'vs' => collect(Illuminate\Support\Arr::dot($translations))
        ->map(
            fn ($value, $dotKey) => vsCodeTranslationValue(
                $dotKey,
                $value,
                str_replace(base_path(DIRECTORY_SEPARATOR), '', $filePath),
                $lines
            )
        )
            ->filter(),
    ];
}

function vsCodeTranslationValue($key, $value, $file, $lines): ?array
{
    if (is_array($value)) {
        return null;
    }

    $lineNumber = 1;
    $keys = explode('.', $key);
    $currentKey = array_shift($keys);

    foreach ($lines as $line) {
        if (
            strpos($line[1], '"' . $currentKey . '"') !== false ||
            strpos($line[1], "'" . $currentKey . "'") !== false
        ) {
            $lineNumber = $line[0];
            $currentKey = array_shift($keys);
        }

        if ($currentKey === null) {
            break;
        }
    }

    return [
        'v' => $value,
        'p' => $file,
        'li' => $lineNumber,
        'pa' => preg_match_all("/\:([A-Za-z0-9_]+)/", $value, $matches)
            ? $matches[1]
            : [],
    ];
}

function vscodeCollectTranslations(string $path, ?string $namespace = null)
{
    $realPath = realpath($path);

    if (!is_dir($realPath)) {
        return collect();
    }

    return collect(Illuminate\Support\Facades\File::allFiles($realPath))
        ->map(fn ($file) => vsCodeGetTranslationsFromFile($file, $path, $namespace))
        ->filter();
}

$loader = app('translator')->getLoader();
$namespaces = $loader->namespaces();

$reflection = new ReflectionClass($loader);
$property = $reflection->hasProperty('paths')
    ? $reflection->getProperty('paths')
    : $reflection->getProperty('path');
$property->setAccessible(true);

$paths = Illuminate\Support\Arr::wrap($property->getValue($loader));

$default = collect($paths)->flatMap(
    fn ($path) => vscodeCollectTranslations($path)
);

$namespaced = collect($namespaces)->flatMap(
    fn ($path, $namespace) => vscodeCollectTranslations($path, $namespace)
);

$final = [];

foreach ($default->merge($namespaced) as $value) {
    if (!isset($value['vs']) || !is_iterable($value['vs'])) {
        continue;
    }

    foreach ($value['vs'] as $key => $v) {
        $dotKey = "{$value['k']}.{$key}";

        if (!isset($final[$dotKey])) {
            $final[$dotKey] = [];
        }

        $final[$dotKey][$value['la']] = $v;

        if ($value['la'] === Illuminate\Support\Facades\App::currentLocale()) {
            $final[$dotKey]['default'] = $v;
        }
    }
}

return collect($final);

<?php

$local = collect(glob(config_path('/*.php')))
    ->merge(glob(config_path('**/*.php')))
    ->map(fn ($path) => [
        (string) Illuminate\Support\Str::of($path)
            ->replace([config_path('/'), '.php'], '')
            ->replace('/', '.'),
        $path,
    ]);

$vendor = collect(glob(base_path('vendor/**/**/config/*.php')))->map(fn (
    $path
) => [
    (string) Illuminate\Support\Str::of($path)
        ->afterLast('/config/')
        ->replace('.php', '')
        ->replace('/', '.'),
    $path,
]);

$configPaths = $local
    ->merge($vendor)
    ->groupBy(0)
    ->map(fn ($items) => $items->pluck(1));

$cachedContents = [];
$cachedParsed = [];

function vsCodeGetConfigValue($value, $key, $configPaths)
{
    $parts = explode('.', $key);
    $toFind = $key;
    $found = null;

    while (count($parts) > 0) {
        array_pop($parts);
        $toFind = implode('.', $parts);

        if ($configPaths->has($toFind)) {
            $found = $toFind;
            break;
        }
    }

    if ($found === null) {
        return null;
    }

    $file = null;
    $line = null;

    if ($found === $key) {
        $file = $configPaths->get($found)[0];
    } else {
        foreach ($configPaths->get($found) as $path) {
            $cachedContents[$path] ??= file_get_contents($path);
            $cachedParsed[$path] ??= token_get_all($cachedContents[$path]);

            $keysToFind = Illuminate\Support\Str::of($key)
                ->replaceFirst($found, '')
                ->ltrim('.')
                ->explode('.');

            if (is_numeric($keysToFind->last())) {
                $index = $keysToFind->pop();

                if ($index !== '0') {
                    return null;
                }

                $key = collect(explode('.', $key));
                $key->pop();
                $key = $key->implode('.');
                $value = [];
            }

            $nextKey = $keysToFind->shift();
            $expectedDepth = 1;

            $depth = 0;

            foreach ($cachedParsed[$path] as $token) {
                if ($token === '[') {
                    $depth++;
                }

                if ($token === ']') {
                    $depth--;
                }

                if (!is_array($token)) {
                    continue;
                }

                $str = trim($token[1], '"\'');

                if (
                    $str === $nextKey &&
                    $depth === $expectedDepth &&
                    $token[0] === T_CONSTANT_ENCAPSED_STRING
                ) {
                    $nextKey = $keysToFind->shift();
                    $expectedDepth++;

                    if ($nextKey === null) {
                        $file = $path;
                        $line = $token[2];
                        break;
                    }
                }
            }

            if ($file) {
                break;
            }
        }
    }

    return [
        'name' => $key,
        'value' => $value,
        'file' => $file === null ? null : str_replace(base_path('/'), '', $file),
        'line' => $line,
    ];
}

return collect(Illuminate\Support\Arr::dot(config()->all()))
    ->map(fn ($value, $key) => vsCodeGetConfigValue($value, $key, $configPaths))
    ->filter()
    ->values();

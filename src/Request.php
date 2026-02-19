<?php

namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Request
{
    /**
     * Write the request helper file.
     *
     * @param Command $command
     * @param Filesystem $files
     * @param string $outputPath
     * @return void
     */
    public static function writeRequestHelper(Command $command, Filesystem $files, string $outputPath): void
    {
        $requestsPath = app_path('Http/Requests');
        $content = "<?php\n\n";

        if ($files->exists($requestsPath)) {
            $filesList = $files->allFiles($requestsPath);

            foreach ($filesList as $file) {
                $relativePath = $file->getRelativePathname(); // Get path relative to base directory
                $className = 'App\\Http\\Requests\\' . str_replace(['/', '\\', '.php'], ['\\', '\\', ''], $relativePath);

                if (class_exists($className)) {
                    $reflection = new \ReflectionClass($className);

                    if ($reflection->isSubclassOf('Illuminate\\Foundation\\Http\\FormRequest') && !$reflection->isAbstract()) {
                        $namespace = $reflection->getNamespaceName();
                        $shortName = $reflection->getShortName();

                        $content .= "namespace {$namespace} {\n";
                        $content .= "    /**\n";
                        $content .= "     * @method static array rules()\n";
                        $content .= "     */\n";
                        $content .= "    class {$shortName} {}\n";
                        $content .= "}\n\n";
                    }
                }
            }
        }

        $files->put($outputPath, $content);
        $command->info('IDE helper file for requests generated successfully.');
    }
}

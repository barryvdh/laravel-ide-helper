<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Test extends AbstractModelsCommand
{
    public function testFactory(): void
    {
        Factory::guessFactoryNamesUsing(static::getFactoryNameResolver());

        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertStringNotContainsString('not found', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }

    public static function getFactoryNameResolver(): Closure
    {
        // This mimics the default resolver, but with adjusted test namespaces.
        // Illuminate\Database\Eloquent\Factories\Factory::resolveFactoryName
        return function (string $modelName): string {
            $appNamespace = 'Barryvdh\\LaravelIdeHelper\\Tests\\Console\\ModelsCommand\\Factories\\';

            $modelName = Str::startsWith($modelName, $appNamespace . 'Models\\')
                ? Str::after($modelName, $appNamespace . 'Models\\')
                : Str::after($modelName, $appNamespace);

            return $appNamespace . 'Factories\\' . $modelName . 'Factory';
        };
    }
}

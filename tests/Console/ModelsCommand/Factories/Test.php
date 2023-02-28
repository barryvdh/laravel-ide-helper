<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;

class Test extends AbstractModelsCommand
{
    public function test_8(): void
    {
        if (!version_compare(Application::VERSION, '8.2', '>=') || !version_compare(Application::VERSION, '9', '<')) {
            $this->markTestSkipped(
                'This test only works in Laravel >= 8.2 and < 9'
            );
        }

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

    public function test_9(): void
    {
        if (!version_compare(Application::VERSION, '9', '>=')) {
            $this->markTestSkipped(
                'This test only works in Laravel >= 9'
            );
        }

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

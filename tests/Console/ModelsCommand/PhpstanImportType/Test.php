<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpstanImportType;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    /**
     * Types imported with `@phpstan-import-type` are local aliases, not classes
     * in the model's namespace, so they must not be prefixed with it.
     *
     * @link https://github.com/barryvdh/laravel-ide-helper/issues/1773
     */
    public function testImportedTypeIsNotQualifiedWithTheModelNamespace(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, ['--write' => true]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertMatchesMockedSnapshot();
    }
}

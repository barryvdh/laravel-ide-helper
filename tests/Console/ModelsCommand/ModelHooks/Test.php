<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelHooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelHooks\Hooks\CustomMethod;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelHooks\Hooks\CustomProperty;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelHooks\Hooks\UnsetMethod;

class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/ModelHooks/Models',
            ],
            'model_hooks' => [
                CustomProperty::class,
                CustomMethod::class,
                UnsetMethod::class,
            ],
        ]);
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}

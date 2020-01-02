<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand;

use Barryvdh\LaravelIdeHelper\Tests\TestCaseDatabase;

abstract class AbstractModelsCommand extends TestCaseDatabase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->artisan('migrate');
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $config = $app['config'];

        $config->set('database.default', 'sqlite');
        $config->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}

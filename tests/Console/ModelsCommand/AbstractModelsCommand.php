<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand;

use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Foundation\Application;

abstract class AbstractModelsCommand extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Skip older Laravel version for these tests
        if (version_compare(Application::VERSION, '6.0', '<')) {
            $this->markTestSkipped('This test requires Laravel 6.0 or higher');
            return;
        }

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

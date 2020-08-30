<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\SnapshotPhpDriver;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use Mockery;

abstract class AbstractModelsCommand extends TestCase
{
    protected $mockFilesystemOutput;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->artisan('migrate');
        $this->mockFilesystem();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [IdeHelperServiceProvider::class];
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

        // Load the Models from the Test dir
        $config->set('ide-helper.model_locations', [
            dirname((new \ReflectionClass(static::class))->getFileName()) . '/Models',
        ]);

        // Don't override integer -> int for tests
        $config->set('ide-helper.type_overrides', []);
    }

    protected function mockFilesystem()
    {
        $this->mockOutput = '';

        $mockFilesystem = Mockery::mock(Filesystem::class);

        $mockFilesystem
            ->shouldReceive('get')
            ->andReturnUsing(function ($file) {
                return file_get_contents($file);
            });

        $mockFilesystem
            ->shouldReceive('put')
            ->with(
                Mockery::any(),
                Mockery::any()
            )
            ->andReturnUsing(function ($path, $contents) {
                $this->mockFilesystemOutput .= $contents;

                return strlen($contents);
            });

        $this->instance(Filesystem::class, $mockFilesystem);
    }

    protected function assertMatchesMockedSnapshot()
    {
        $this->assertMatchesSnapshot($this->mockFilesystemOutput, new SnapshotPhpDriver());
    }
}

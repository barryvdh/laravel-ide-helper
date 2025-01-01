<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\SnapshotPhpDriver;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;

abstract class AbstractGeneratorCommand extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
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

    protected function assertMatchesMockedSnapshot()
    {
        $this->assertMatchesSnapshot($this->mockFilesystemOutput, new SnapshotPhpDriver());
    }
}

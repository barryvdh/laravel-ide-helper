<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

abstract class TestCaseDatabase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/Support/database/migrations');

        // This takes care of refreshing the database between tests
        // as we are using the in-memory SQLite db we do not need RefreshDatabase
        $this->artisan('migrate');
    }
}

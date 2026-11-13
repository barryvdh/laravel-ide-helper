<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\MetaCommand;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use stdClass;

class MetaCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mockFilesystem();
    }

    protected function tearDown(): void
    {
        $this->mockFilesystemOutput = '';

        parent::tearDown();
    }

    public function testCommand(): void
    {
        /** @var Filesystem|MockInterface $mockFileSystem */
        $mockFileSystem = $this->app->make(Filesystem::class);
        $this->instance(Filesystem::class, $mockFileSystem);

        $mockFileSystem
            ->shouldReceive('getRequire')
            ->andReturnUsing(function ($__path, $__data = []) {
                return (static function () use ($__path, $__data) {
                    extract($__data, EXTR_SKIP);

                    return require $__path;
                })();
            });

        $this->artisan('ide-helper:meta');

        // We're not testing the whole file, just some basic structure elements
        self::assertStringContainsString("namespace PHPSTORM_META {\n", $this->mockFilesystemOutput);
        self::assertStringContainsString("PhpStorm Meta file, to provide autocomplete information for PhpStorm\n", $this->mockFilesystemOutput);
        self::assertStringContainsString('override(', $this->mockFilesystemOutput);
        self::assertStringContainsString("'welcome',", $this->mockFilesystemOutput);
        self::assertStringContainsString("'pagination::tailwind',", $this->mockFilesystemOutput);
    }

    #[RunInSeparateProcess]
    public function testMetaExcludeViews(): void
    {
        $this->mockFilesystemOutput = '';
        $this->app['config']->set('ide-helper.meta_exclude_views', [
            'pagination::*',
            'welcome',
        ]);

        /** @var Filesystem|MockInterface $mockFileSystem */
        $mockFileSystem = $this->app->make(Filesystem::class);
        $this->instance(Filesystem::class, $mockFileSystem);

        $mockFileSystem
            ->shouldReceive('getRequire')
            ->andReturnUsing(function ($__path, $__data = []) {
                return (static function () use ($__path, $__data) {
                    extract($__data, EXTR_SKIP);

                    return require $__path;
                })();
            });

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("registerArgumentsSet('views',", $this->mockFilesystemOutput);
        self::assertStringContainsString("'errors.503',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'welcome',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'pagination::tailwind',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'pagination::bootstrap-5',", $this->mockFilesystemOutput);
    }

    #[RunInSeparateProcess]
    public function testMetaExcludeViewsAllWhenTrue(): void
    {
        $this->mockFilesystemOutput = '';
        $this->app['config']->set('ide-helper.meta_exclude_views', true);

        /** @var Filesystem|MockInterface $mockFileSystem */
        $mockFileSystem = $this->app->make(Filesystem::class);
        $this->instance(Filesystem::class, $mockFileSystem);

        $mockFileSystem
            ->shouldReceive('getRequire')
            ->andReturnUsing(function ($__path, $__data = []) {
                return (static function () use ($__path, $__data) {
                    extract($__data, EXTR_SKIP);

                    return require $__path;
                })();
            });

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("registerArgumentsSet('views',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'welcome',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'errors.503',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString("'pagination::tailwind',", $this->mockFilesystemOutput);
    }

    public function testUnregisterAutoloader(): void
    {
        $current = spl_autoload_functions();
        $appended = function () {
        };

        $this->app->bind('registers-autoloader', function () use ($appended) {
            spl_autoload_register($appended);
            return new stdClass();
        });

        /** @var Filesystem|MockInterface $mockFileSystem */
        $mockFileSystem = $this->app->make(Filesystem::class);
        $this->instance(Filesystem::class, $mockFileSystem);

        $mockFileSystem
            ->shouldReceive('getRequire')
            ->andReturnUsing(function ($__path, $__data = []) {
                return (static function () use ($__path, $__data) {
                    extract($__data, EXTR_SKIP);

                    return require $__path;
                })();
            });

        $this->artisan('ide-helper:meta');

        self::assertSame(array_merge($current, [$appended]), spl_autoload_functions());
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
}

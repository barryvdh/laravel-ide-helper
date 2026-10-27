<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\MetaCommand;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use Mockery\MockInterface;
use stdClass;

class MetaCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mockFilesystem();
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

    public function testConfigKeysUseRelativeBasePath(): void
    {
        $this->mockConfigsTemplate([
            'filesystems.links.' . base_path('public/storage') => storage_path('app/public'),
        ]);

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("'filesystems.links.public/storage' => 'string',", $this->mockFilesystemOutput);
        self::assertStringContainsString("'filesystems.links.public/storage',", $this->mockFilesystemOutput);
        self::assertStringNotContainsString(base_path('public/storage'), $this->mockFilesystemOutput);
    }

    public function testConfigKeysUseForwardSlashesInRelativeBasePath(): void
    {
        $this->mockConfigsTemplate([
            'filesystems.links.' . base_path() . '\\public\\storage' => storage_path('app/public'),
        ]);

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("'filesystems.links.public/storage' => 'string',", $this->mockFilesystemOutput);
        self::assertStringContainsString("'filesystems.links.public/storage',", $this->mockFilesystemOutput);
    }

    public function testConfigKeysKeepAbsoluteBasePathWhenDisabled(): void
    {
        $this->app['config']->set('ide-helper.meta_relative_config_keys', false);
        $absoluteKey = 'filesystems.links.' . base_path('public/storage');
        $this->mockConfigsTemplate([
            $absoluteKey => storage_path('app/public'),
        ]);

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("'$absoluteKey' => 'string',", $this->mockFilesystemOutput);
        self::assertStringContainsString(var_export($absoluteKey, true) . ',', $this->mockFilesystemOutput);
    }

    public function testConfigKeysKeepBasePathInsideASegment(): void
    {
        $key = 'paths.copy-of-' . base_path('public/storage');
        $this->mockConfigsTemplate([
            $key => 'value',
        ]);

        $this->artisan('ide-helper:meta');

        self::assertStringContainsString("'$key' => 'string',", $this->mockFilesystemOutput);
    }

    /**
     * Make the configs template return the given keys and values, as it would for a config
     * that flattens to them with Arr::dot(), and every other template return nothing.
     *
     * @param array<string, mixed> $configs
     */
    private function mockConfigsTemplate(array $configs): void
    {
        /** @var Filesystem|MockInterface $mockFileSystem */
        $mockFileSystem = $this->app->make(Filesystem::class);

        $mockFileSystem
            ->shouldReceive('requireOnce')
            ->andReturnUsing(function ($path) use ($configs) {
                if (basename($path) !== 'configs.php') {
                    return [];
                }

                return collect($configs)
                    ->map(fn ($value, $name) => ['name' => $name, 'value' => $value, 'file' => null, 'line' => null])
                    ->values();
            });
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

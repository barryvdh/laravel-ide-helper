<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\GenerateIdeHelper;

use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\AbstractGeneratorCommand;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Test extends AbstractGeneratorCommand
{
    public function testGenerator(): void
    {
        Arr::macro('arr_custom_macro', function () {
        });
        DB::macro('db_custom_macro', function () {
        });
        $this->app['config']->set('ide-helper.macro_default_return_types', [Arr::class => 'Custom_Fake_Class']);

        $command = $this->app->make(GeneratorCommand::class);

        $tester = $this->runCommand($command);

        $this->assertSame(0, $tester->getStatusCode());

        $this->assertStringContainsString('A new helper file was written to _ide_helper.php', $tester->getDisplay());
        $this->assertStringContainsString('public static function configure($basePath = null)', $this->mockFilesystemOutput);
        $this->assertStringContainsString('* @return \Custom_Fake_Class', $this->mockFilesystemOutput);
        $this->assertStringContainsString('public static function arr_custom_macro()', $this->mockFilesystemOutput);
        $this->assertStringContainsString('public static function db_custom_macro()', $this->mockFilesystemOutput);
    }

    public function testFilename(): void
    {
        $command = $this->app->make(GeneratorCommand::class);

        $tester = $this->runCommand($command, [
            'filename' => 'foo.php',
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('A new helper file was written to foo.php', $tester->getDisplay());
    }
}

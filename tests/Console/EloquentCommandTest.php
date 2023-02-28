<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console;

use Barryvdh\LaravelIdeHelper\Console\EloquentCommand;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Mockery;
use ReflectionClass;

class EloquentCommandTest extends TestCase
{
    public function testCommand()
    {
        $modelFilename = $this->getVendorModelFilename();
        $modelSource = file_get_contents($modelFilename);
        if (false !== strpos($modelSource, '* @mixin')) {
            $msg = sprintf('Class %s already contains the @mixin markers', Model::class);
            $this->markTestSkipped($msg);
        }

        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            // We don't care about actual args (filename)
            ->andReturn('abstract class Model implements'); // This is enough to trigger the replacement logic
        $mockFilesystem
            ->shouldReceive('put')
            ->with(
                Mockery::any(), // First arg is path, we don't care
                Mockery::capture($actualContent)
            )
            ->andReturn(1) // Simulate we wrote _something_ to the file
            ->once();

        $this->instance(Filesystem::class, $mockFilesystem);
        $command = $this->app->make(EloquentCommand::class);

        $tester = $this->runCommand($command);

        $this->assertMatchesTxtSnapshot($actualContent);

        $display = $tester->getDisplay();
        $this->assertMatchesRegularExpression(
            ';Unexpected no document on Illuminate\\\Database\\\Eloquent\\\Model;',
            $display
        );
        $modelClassFilePath = preg_quote(
            str_replace('/', DIRECTORY_SEPARATOR, '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php')
        );
        $this->assertMatchesRegularExpression(
            ';Wrote expected docblock to .*' . $modelClassFilePath . ';',
            $display
        );
    }

    private function getVendorModelFilename(): string
    {
        $class = Model::class;
        $reflectedClass = new ReflectionClass($class);

        return $reflectedClass->getFileName();
    }
}

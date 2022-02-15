<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
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

    protected function setUp(): void
    {
        parent::setUp();

        if (PHP_VERSION_ID < 80100) {
            $this->markTestSkipped('This test requires PHP 8.1 or higher');
        }
    }

}
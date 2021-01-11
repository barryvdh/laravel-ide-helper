<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Foundation\Application;

class Test extends AbstractModelsCommand
{
    public function test(): void
    {
        if (!version_compare(Application::VERSION, '8.2', '>=')) {
            $this->markTestSkipped(
                'This test only works in Laravel >= 8.2'
            );
        }

        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}

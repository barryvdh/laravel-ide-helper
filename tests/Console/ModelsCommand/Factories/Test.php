<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories;

use Illuminate\Support\Facades\Artisan;
use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    public function test(): void
    {
        if (! $this->isLaravel8Point2OrUpper()) {
            $this->markTestSkipped(
                'This test working only in laravel 8.x'
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

    private function isLaravel8Point2OrUpper()
    {
        Artisan::call('list', ['-V']);

        $version = str_replace(['Laravel Framework ', "\n"], '', Artisan::output());

        return $version >= '8.2';
    }
}

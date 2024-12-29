<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocWithEloquentHelper;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
            '--write-eloquent-helper' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertStringNotContainsString('Do you want to generate a minimal helper to generate the Eloquent methods?', $tester->getDisplay());
        $this->assertStringContainsString('Eloquent helper was written to _ide_helper.php', $tester->getDisplay());

        //        $this->assertMatchesMockedSnapshot();
    }
}

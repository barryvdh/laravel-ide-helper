<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\GenerateIdeHelper;

use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\AbstractGeneratorCommand;

class Test extends AbstractGeneratorCommand
{
    public function test(): void
    {
        $command = $this->app->make(GeneratorCommand::class);

        $tester = $this->runCommand($command);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('A new helper file was written to _ide_helper.php', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}

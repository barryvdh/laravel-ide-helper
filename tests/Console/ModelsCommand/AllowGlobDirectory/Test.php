<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AllowGlobDirectory;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

final class Test extends AbstractModelsCommand
{
    /** @var string */
    private $cwd;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cwd = getcwd();
    }

    protected function tearDown(): void
    {
        chdir($this->cwd);

        parent::tearDown();
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        chdir(__DIR__);

        $tester = $this->runCommand($command, [
            '--dir' => ['Services/*/Models'],
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}

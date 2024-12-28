<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\GenerateEloquentOnly;

use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\GeneratorCommand\AbstractGeneratorCommand;

class Test extends AbstractGeneratorCommand
{
    public function testGenerator(): void
    {
        $command = $this->app->make(GeneratorCommand::class);

        $tester = $this->runCommand($command, [
            '--eloquent' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('A new helper file was written to _ide_helper.php', $tester->getDisplay());
        $this->assertStringNotContainsString('public static function configure($basePath = null)', $this->mockFilesystemOutput);
        $this->assertStringContainsString('class Eloquent extends \Illuminate\Database\Eloquent\Model', $this->mockFilesystemOutput);
    }
}

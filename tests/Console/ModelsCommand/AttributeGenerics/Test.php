<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AttributeGenerics;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;

class Test extends AbstractModelsCommand
{
    public function testAttributeGenericTypesArePreserved(): void
    {
        $tester = $this->runCommand($this->app->make(ModelsCommand::class), ['--write' => true]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('@property-read array<string, mixed> $array_value', $this->mockFilesystemOutput);
        $this->assertStringContainsString('@property-read array<string, list<int>> $nested_value', $this->mockFilesystemOutput);
        $this->assertStringContainsString('@property-read array<int, \\Illuminate\\Database\\Eloquent\\Model> $models_value', $this->mockFilesystemOutput);
        $this->assertStringContainsString("@property-read array{label: 'left,right', values: list<int>} \$shape_value", $this->mockFilesystemOutput);
        $this->assertStringContainsString('@property-write array<int, string> $write_value', $this->mockFilesystemOutput);
        $this->assertStringContainsString('@property-read array $plain_value', $this->mockFilesystemOutput);
    }
}

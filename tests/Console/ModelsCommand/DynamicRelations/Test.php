<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations;

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

        $errors = [
            'Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicBelongsTo() : Attempt to read property "created_at" on null',
            'Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicHasMany() : Attempt to read property "created_at" on null',
            'Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicHasOne() : Attempt to read property "created_at" on null',
        ];

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        foreach ($errors as $error) {
            $this->assertStringContainsString($error, $tester->getDisplay());
        }
        $this->assertMatchesMockedSnapshot();
    }
}

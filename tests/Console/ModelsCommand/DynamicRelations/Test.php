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

        $errors = <<<TXT
Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicBelongsTo() : Trying to get property 'created_at' of non-object
Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicHasMany() : Trying to get property 'created_at' of non-object
Error resolving relation model of Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models\Dynamic:dynamicHasOne() : Trying to get property 'created_at' of non-object
TXT;

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertStringContainsString($errors, $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}

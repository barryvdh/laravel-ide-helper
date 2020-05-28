<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelHooks\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;

class CustomProperty implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        $command->setProperty('custom', 'string', true, false);
    }
}

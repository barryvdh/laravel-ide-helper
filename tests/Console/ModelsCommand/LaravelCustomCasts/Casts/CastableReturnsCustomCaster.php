<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;

class CastableReturnsCustomCaster implements Castable
{
    public static function castUsing(array $arguments)
    {
        return CustomCasterWithDocblockReturn::class;
    }
}

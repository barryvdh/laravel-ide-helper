<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastableWithGenericSelfType implements Castable
{
    /**
     * @return CastsAttributes<self, self>
     */
    public static function castUsing(array $arguments): CastsAttributes
    {
        return new CustomCasterWithDocblockReturn();
    }
}

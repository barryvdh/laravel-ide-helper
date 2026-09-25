<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;

/**
 * Mirrors packages such as spatie/laravel-data, where a Castable base class's
 * castUsing() resolves to a Cast that is generic over the calling subclass.
 * PHP has no runtime generics, so the Cast's get() method can only declare
 * the template's upper bound, not the concrete subclass actually being cast.
 */
abstract class GenericCastableData implements Castable
{
    public static function castUsing(array $arguments)
    {
        return new GenericCast(static::class, $arguments);
    }
}

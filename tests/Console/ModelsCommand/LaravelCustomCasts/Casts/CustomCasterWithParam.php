<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CustomCasterWithParam implements CastsAttributes
{
    public function __construct(string $param)
    {
    }

    public function get($model, string $key, $value, array $attributes): CastedProperty
    {
        return new CastedProperty();
    }

    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
    }
}

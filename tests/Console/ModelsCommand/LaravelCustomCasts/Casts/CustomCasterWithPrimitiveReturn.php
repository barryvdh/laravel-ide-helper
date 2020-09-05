<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CustomCasterWithPrimitiveReturn implements CastsAttributes
{
    /**
     * @inheritDoc
     * @return string
     */
    public function get($model, string $key, $value, array $attributes): array
    {
        return new CastedProperty();
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
    }
}

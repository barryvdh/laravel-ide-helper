<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SelfCastingCasterWithThisDocblockReturn implements CastsAttributes
{
    /**
     * @return $this
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
    }
}

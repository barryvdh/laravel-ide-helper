<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * @template TData of GenericCastableData
 *
 * @implements CastsAttributes<TData|null, TData|null>
 */
class GenericCast implements CastsAttributes
{
    public function __construct(
        protected string $dataClass,
        protected array $arguments
    ) {
    }

    public function get($model, string $key, $value, array $attributes): GenericCastableData|null
    {
        return $value === null ? null : new ($this->dataClass)();
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CustomCasterWithStaticReturnType implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): static
    {
        // TODO: Implement get() method.
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        // TODO: Implement set() method.
    }
}

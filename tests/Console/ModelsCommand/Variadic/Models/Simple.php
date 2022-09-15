<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Variadic\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    public function scopeWhereVariadic(Builder $query, ...$values): void
    {
    }

    public function scopeWhereTypedVariadic(Builder $query, int ...$values): void
    {
    }
}

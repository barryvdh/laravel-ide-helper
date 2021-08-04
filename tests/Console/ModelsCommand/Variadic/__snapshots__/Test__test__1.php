<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Variadic\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Variadic\Models\Simple
 *
 * @property integer $id
 * @method static Builder|Simple newModelQuery()
 * @method static Builder|Simple newQuery()
 * @method static Builder|Simple query()
 * @method static Builder|Simple whereId($value)
 * @method static Builder|Simple whereTypedVariadic(int ...$values)
 * @method static Builder|Simple whereVariadic(...$values)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    public function scopeWhereVariadic(Builder $query, ...$values): void
    {
    }

    public function scopeWhereTypedVariadic(Builder $query, int ...$values): void
    {
    }
}

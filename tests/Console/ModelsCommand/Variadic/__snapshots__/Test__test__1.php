<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Variadic\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @method static Builder<static>|Simple newModelQuery()
 * @method static Builder<static>|Simple newQuery()
 * @method static Builder<static>|Simple query()
 * @method static Builder<static>|Simple whereId($value)
 * @method static Builder<static>|Simple whereTypedVariadic(int ...$values)
 * @method static Builder<static>|Simple whereVariadic(...$values)
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

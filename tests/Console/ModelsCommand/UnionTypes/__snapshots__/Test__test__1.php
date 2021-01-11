<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\UnionTypes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\UnionTypes\Models\UnionTypeModel
 *
 * @property-read string|int|null $foo
 * @property-read \Illuminate\Database\Eloquent\Collection|UnionTypeModel[] $withUnionTypeReturn
 * @property-read int|null $with_union_type_return_count
 * @method static \Illuminate\Database\Eloquent\Builder|UnionTypeModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnionTypeModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnionTypeModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnionTypeModel withNullableUnionTypeParameter(string|int|null $bar)
 * @method static \Illuminate\Database\Eloquent\Builder|UnionTypeModel withUnionTypeParameter(string|int $bar)
 * @mixin \Eloquent
 */
class UnionTypeModel extends Model
{
    public function scopeWithUnionTypeParameter(Builder $query, string|int $bar): Builder
    {
        return $query->where('foo', $bar);
    }

    public function scopeWithNullableUnionTypeParameter(Builder $query, null|string|int $bar): Builder
    {
        return $query->where('foo', $bar);
    }

    public function withUnionTypeReturn(): HasMany|UnionTypeModel
    {
        return $this->hasMany(UnionTypeModel::class);
    }

    public function getFooAttribute(): string|int|null
    {
        return $this->getAttribute('foo');
    }
}

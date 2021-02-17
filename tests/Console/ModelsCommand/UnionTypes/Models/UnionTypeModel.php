<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\UnionTypes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

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

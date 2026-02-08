<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property-read SimpleCollection<int, Simple> $relationHasMany
 * @property-read int|null $relation_has_many_count
 * @property-read bool|null $relation_has_many_exists
 * @method static SimpleCollection<int, static> all($columns = ['*'])
 * @method static SimpleCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    public function newCollection(array $models = [])
    {
        return new SimpleCollection($models);
    }

    public function relationHasMany(): HasMany
    {
        return $this->hasMany(Simple::class);
    }
}

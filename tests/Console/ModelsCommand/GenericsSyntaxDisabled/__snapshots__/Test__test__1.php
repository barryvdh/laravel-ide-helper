<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericsSyntaxDisabled\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $regularBelongsToMany
 * @property-read int|null $regular_belongs_to_many_count
 * @property-read bool|null $regular_belongs_to_many_exists
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $regularHasMany
 * @property-read int|null $regular_has_many_count
 * @property-read bool|null $regular_has_many_exists
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    // Regular relations
    public function regularHasMany(): HasMany
    {
        return $this->hasMany(Simple::class);
    }

    public function regularBelongsToMany(): BelongsToMany
    {
        return $this->belongsToMany(Simple::class);
    }
}

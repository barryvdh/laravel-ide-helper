<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericsSyntaxDisabled\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericsSyntaxDisabled\Models\Simple
 *
 * @property integer $id
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $regularBelongsToMany
 * @property-read int|null $regular_belongs_to_many_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Simple[] $regularHasMany
 * @property-read int|null $regular_has_many_count
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
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

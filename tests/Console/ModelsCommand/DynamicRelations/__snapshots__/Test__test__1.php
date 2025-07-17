<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Dynamic> $regularHasMany
 * @property-read int|null $regular_has_many_count
 * @property-read bool|null $regular_has_many_exists
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dynamic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dynamic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dynamic query()
 * @mixin \Eloquent
 */
class Dynamic extends Model
{
    /** @var \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\OtherModels\Account */
    protected $account;

    // Regular relations
    public function regularHasMany(): HasMany
    {
        return $this->hasMany(Dynamic::class);
    }

    // Dynamic relations
    public function dynamicHasMany(): HasMany
    {
        return $this->hasMany(Dynamic::class)->where('date', '>=', $this->account->created_at);
    }

    public function dynamicHasOne(): HasOne
    {
        return $this->hasOne(Dynamic::class)->where('date', '>=', $this->account->created_at);
    }

    public function dynamicBelongsTo(): BelongsTo
    {
        return $this->belongsTo(Dynamic::class)->where('date', '>=', $this->account->created_at);
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DynamicRelations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

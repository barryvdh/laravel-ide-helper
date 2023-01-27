<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericsSyntaxDisabled\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

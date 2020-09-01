<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models;

use Eloquent;
use Illuminate\Database\Eloquent\{
    Builder as EloquentBuilder,
    Collection,
    SoftDeletes
};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use SoftDeletes;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeNull($query, string $unusedParam)
    {
        return $query;
    }
}

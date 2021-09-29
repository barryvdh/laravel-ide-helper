<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqn\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqn\Casts\CastType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use SoftDeletes;

    /**
     * Special hack to avoid code style fixer removing unused imports
     * which play a role when generating the snapshot
     */
    private $hack = [
        Carbon::class,
        Collection::class,
        Eloquent::class,
        EloquentBuilder::class,
        QueryBuilder::class,
    ];

    protected $casts = [
        'char_not_nullable' => CastType::class,
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function anotherModels(): HasMany
    {
        return $this->hasMany(AnotherModelSameNamespace::class);
    }

    public function scopeNull($query, string $unusedParam)
    {
        return $query;
    }
}

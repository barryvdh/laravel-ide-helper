<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\QueryScopes\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ArticleParent extends Model
{
    public function scopeDraft(Builder $query): Builder
    {
        return $query;
    }
}

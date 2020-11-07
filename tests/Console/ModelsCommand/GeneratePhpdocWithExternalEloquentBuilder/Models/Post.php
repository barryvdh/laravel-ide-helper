<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder;

class Post extends Model
{
    public function newEloquentBuilder($query): PostExternalQueryBuilder
    {
        return new PostExternalQueryBuilder($query);
    }
}

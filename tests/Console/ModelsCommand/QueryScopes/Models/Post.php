<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\QueryScopes\Models;

class Post extends PostParent
{
    public function scopePublic($query)
    {
        return $query;
    }
}

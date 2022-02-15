<?php

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Enums\PostMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class EnumerateTypeModel extends Model
{
    public function scopeMode(Builder $builder, PostMode $mode = PostMode::OPEN)
    {
        // pass
    }
}
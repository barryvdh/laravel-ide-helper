<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Enums\PostMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Models\EnumerateTypeModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EnumerateTypeModel mode(\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Enums\PostMode $mode = \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\EnumerateTypes\Enums\PostMode::OPEN)
 * @method static \Illuminate\Database\Eloquent\Builder|EnumerateTypeModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnumerateTypeModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnumerateTypeModel query()
 * @mixin \Eloquent
 */
class EnumerateTypeModel extends Model
{
    public function scopeMode(Builder $builder, PostMode $mode = PostMode::OPEN)
    {
        // pass
    }
}

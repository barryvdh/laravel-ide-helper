<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * @package Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models
 * @property AnotherModelSameNamespace $someProp
 */
class Post extends Model
{
    public function newEloquentBuilder($query): EMaterialQueryBuilder
    {
        return new EMaterialQueryBuilder($query);
    }
}

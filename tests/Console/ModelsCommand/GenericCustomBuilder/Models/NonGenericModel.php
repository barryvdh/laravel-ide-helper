<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders\NonGenericBuilder;
use Illuminate\Database\Eloquent\Model;

class NonGenericModel extends Model
{
    protected $table = 'simples';

    public function newEloquentBuilder($query): NonGenericBuilder
    {
        return new NonGenericBuilder($query);
    }

    public function scopeNamed($query, string $name)
    {
        return $query;
    }
}

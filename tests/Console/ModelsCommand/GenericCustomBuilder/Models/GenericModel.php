<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders\GenericBuilder;
use Illuminate\Database\Eloquent\Model;

class GenericModel extends Model
{
    protected $table = 'simples';

    public function newEloquentBuilder($query): GenericBuilder
    {
        return new GenericBuilder($query);
    }

    public function scopeNamed($query, string $name)
    {
        return $query;
    }
}

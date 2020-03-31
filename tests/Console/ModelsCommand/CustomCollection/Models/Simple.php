<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    public function newCollection(array $models = [])
    {
        return new SimpleCollection($models);
    }
}

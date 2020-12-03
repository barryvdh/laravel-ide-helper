<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\SimpleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\Simple
 *
 * @property integer $id
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories\SimpleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SimpleFactory::new();
    }
}

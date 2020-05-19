<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Scopes\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    protected function scopeReturnWithoutParameters(Builder $builder)
    {
    }

    protected function scopeReturnWithParameters(Builder $builder, $foo, int $bar, string $baz = null)
    {
    }
}

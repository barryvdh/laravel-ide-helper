<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesClosureInAttribute\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: closure expression inside an attribute argument (PHP 8.5+)
/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClosureInAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClosureInAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClosureInAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClosureInAttribute whereId($value)
 * @mixin \Eloquent
 */
#[SomeClosureAttr(fn() => true)]
class ClosureInAttribute extends Model
{
    protected $table = 'simples';
}

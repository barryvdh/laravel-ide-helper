<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesClosureInAttribute\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: closure expression inside an attribute argument (PHP 8.5+)
#[SomeClosureAttr(fn() => true)]
class ClosureInAttribute extends Model
{
    protected $table = 'simples';
}

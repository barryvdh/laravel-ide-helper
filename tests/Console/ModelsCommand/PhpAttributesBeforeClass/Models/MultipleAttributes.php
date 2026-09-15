<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

// Tests: multiple consecutive PHP 8 attributes before the class declaration
#[\AllowDynamicProperties]
#[SecondAttribute]
class MultipleAttributes extends Model
{
    protected $table = 'simples';
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

#[\AllowDynamicProperties]
class Simple extends Model
{
}

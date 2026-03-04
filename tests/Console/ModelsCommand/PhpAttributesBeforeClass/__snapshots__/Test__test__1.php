<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpAttributesBeforeClass\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @mixin \Eloquent
 */
#[\AllowDynamicProperties]
class Simple extends Model
{
}

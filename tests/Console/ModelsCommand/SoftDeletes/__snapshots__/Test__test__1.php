<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SoftDeletes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple withoutTrashed()
 * @mixin \Eloquent
 */
class Simple extends Model
{
    use SoftDeletes;
}

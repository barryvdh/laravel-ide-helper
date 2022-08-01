<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ResetAndSmartReset\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Text of existing phpdoc
 *
 * @property string $foo
 * @property integer $id
 * @property string $unset
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simple whereUnset($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
}

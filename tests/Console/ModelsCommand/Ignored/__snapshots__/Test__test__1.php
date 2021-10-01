<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Ignored\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Ignored\Models\NotIgnored
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored with($relations)
 * @mixin \Eloquent
 */
class NotIgnored extends Model
{
}

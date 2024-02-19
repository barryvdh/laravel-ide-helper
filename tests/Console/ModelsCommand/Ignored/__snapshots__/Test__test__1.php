<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Ignored\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored query()
 * @mixin \Eloquent
 */
class NotIgnored extends Model
{
}

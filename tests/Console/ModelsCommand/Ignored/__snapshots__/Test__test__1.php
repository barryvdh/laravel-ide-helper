<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Ignored\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotIgnored newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotIgnored newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotIgnored query()
 * @mixin \Eloquent
 */
class NotIgnored extends Model
{
}

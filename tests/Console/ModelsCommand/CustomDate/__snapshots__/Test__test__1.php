<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomDate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomDate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomDate extends Model
{
}

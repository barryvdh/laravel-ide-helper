<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomDate\Models\CustomDate
 *
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate on($connection = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate onWriteConnection()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomDate with($relations)
 * @mixin \Eloquent
 */
class CustomDate extends Model
{
}

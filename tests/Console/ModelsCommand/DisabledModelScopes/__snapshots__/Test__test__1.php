<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DisabledModelScopes\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment query()
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * @comment Scope using the 'Scope' attribute
     * @param Builder $query
     * @return void
     */
    #[Scope]
    protected function local(Builder $query): void
    {
        $query->where('ip_address', '127.0.0.1');
    }

    /**
     * @comment Scope using the 'scope' prefix
     * @param Builder $query
     * @return void
     */
    protected function scopeSystem(Builder $query): void
    {
        $query->where('system', true);
    }
}

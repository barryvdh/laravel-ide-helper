<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\QueryScopes\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelConnectionResolver\Resolvers;

use Barryvdh\LaravelIdeHelper\Contracts\ModelConnectionResolverInterface;
use Illuminate\Database\Eloquent\Model;

class SpyResolver implements ModelConnectionResolverInterface
{
    public array $calls = [];

    public function resolve(Model $model): void
    {
        $this->calls[] = 'resolve:' . class_basename($model);
    }

    public function after(Model $model): void
    {
        $this->calls[] = 'after:' . class_basename($model);
    }
}

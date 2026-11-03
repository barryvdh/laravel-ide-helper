<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 * @extends Builder<TModel>
 */
class GenericBuilder extends Builder
{
    public function isActive(): self
    {
        return $this;
    }
}

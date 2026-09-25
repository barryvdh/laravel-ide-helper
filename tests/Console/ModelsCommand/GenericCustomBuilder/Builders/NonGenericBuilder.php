<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Builders;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenericCustomBuilder\Models\NonGenericModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<NonGenericModel>
 */
class NonGenericBuilder extends Builder
{
    public function isActive(): self
    {
        return $this;
    }
}

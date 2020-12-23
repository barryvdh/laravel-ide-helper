<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DoesNotGeneratePhpdocWithExternalEloquentBuilder\Builders;

use Illuminate\Database\Eloquent\Builder;

class PostExternalQueryBuilder extends Builder
{
    public function isActive(): self
    {
        return $this;
    }

    public function isStatus(string $status): self
    {
        return $this;
    }
}

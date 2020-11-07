<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders;

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

    public function isLoadingWith(?string $with): self
    {
        return $this;
    }

    /**
     * @param int|null $number
     * @return $this
     */
    public function withTheNumber($number): self
    {
        return $this;
    }

    /**
     * @param int|string $someone
     * @return $this
     */
    public function withSomeone($someone): self
    {
        return $this;
    }

    /**
     * @param mixed $option
     * @return $this
     */
    public function withMixedOption($option): self
    {
        return $this;
    }
}

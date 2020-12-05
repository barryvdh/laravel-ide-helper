<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilderWithFqn\Builders;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
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
     * @param integer|null $number
     * @return $this
     */
    public function withTheNumberDifferently($number): self
    {
        return $this;
    }

    /**
     * @param bool|null $number
     * @return $this
     */
    public function withBool($booleanVar): self
    {
        return $this;
    }

    /**
     * @param bool|null $number
     * @return $this
     */
    public function withBoolDifferently($booleanVar): self
    {
        return $this;
    }

    public function withBoolTypeHinted(bool $booleanVar): self
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

    public function withTestCommand(ModelsCommand $testCommand): self
    {
        return $this;
    }

    public function withNullTestCommand(?ModelsCommand $testCommand): self
    {
        return $this;
    }

    public function withNullAndAssignmentTestCommand(?ModelsCommand $testCommand = null): self
    {
        return $this;
    }

    /**
     * @param ModelsCommand $testCommand
     * @return $this
     */
    public function withNullTestCommandInDocBlock($testCommand): self
    {
        return $this;
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AdvancedCasts\Collections;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class AdvancedCastMap implements Arrayable, JsonSerializable
{
    public function toArray(): array
    {
        return [];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

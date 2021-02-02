<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

/**
 * @internal
 * @coversDefaultClass \Barryvdh\LaravelIdeHelper\Macro
 */
class Php8Macro
{
    /**
     * Test docblock.
     */
    public function macro(\Stringable|string $a = null): \Stringable|string|null
    {
        return $a;
    }
}

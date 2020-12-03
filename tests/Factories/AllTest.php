<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Factories;

use Barryvdh\LaravelIdeHelper\Factories;
use PHPUnit\Framework\TestCase;

class AllTest extends TestCase
{
    public function testAll(): void
    {
        $factories = Factories::all();

        self::assertEmpty($factories);
    }
}

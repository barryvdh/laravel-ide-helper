<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\UsesResolver;
use PHPUnit\Framework\TestCase;

class UsesResolverTest extends TestCase
{
    /**
     * Test that we can correctly load uses from supplied code
     */
    public function testLoadFromCode()
    {
        $usesResolver = new UsesResolver();

        $code = <<<'DOC'
<?php
namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\UsesResolver as MyUsesResolver;
use PHPUnit\Framework\TestCase;

class UsesResolverTest extends TestCase
{
    //
}
DOC;

        $this->assertEquals(
            $usesResolver->loadFromCode('Barryvdh\\LaravelIdeHelper\\Tests\\UsesResolverTest', $code),
            [
                'MyUsesResolver' => '\\Barryvdh\\LaravelIdeHelper\\UsesResolver',
                'TestCase' => '\\PHPUnit\Framework\TestCase',
            ]
        );
    }

    /**
     * Test that we can correctly load uses from a class
     */
    public function testLoadFromClass()
    {
        $usesResolver = new UsesResolver();

        $this->assertEquals(
            $usesResolver->loadFromClass(self::class),
            [
                'UsesResolver' => '\\Barryvdh\\LaravelIdeHelper\\UsesResolver',
                'TestCase' => '\\PHPUnit\Framework\TestCase',
            ]
        );
    }
}

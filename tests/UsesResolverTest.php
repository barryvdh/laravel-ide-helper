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

        $usesResolver->loadFromCode('Barryvdh\\LaravelIdeHelper\\Tests\\UsesResolverTest', $code);

        $this->assertEquals($usesResolver->getClassAliases(), [
            'MyUsesResolver' => '\\Barryvdh\\LaravelIdeHelper\\UsesResolver',
            'TestCase' => '\\PHPUnit\Framework\TestCase',
        ]);
    }

    /**
     * Test that we can correctly load uses from a class
     */
    public function testLoadFromClass()
    {
        $usesResolver = new UsesResolver();

        $usesResolver->loadFromClass(self::class);

        $this->assertEquals($usesResolver->getClassAliases(), [
            'UsesResolver' => '\\Barryvdh\\LaravelIdeHelper\\UsesResolver',
            'TestCase' => '\\PHPUnit\Framework\TestCase',
        ]);
    }
}

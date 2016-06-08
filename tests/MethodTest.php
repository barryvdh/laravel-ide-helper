<?php

namespace Barryvdh\LaravelIdeHelper;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that we can actually instantiate the class
     */
    public function testCanInstantiate()
    {
        $class = new \ReflectionClass(Method::class);
        $method = new \ReflectionMethod(Method::class, 'getDocComment');

        $obj = new Method($method, 'Method', $class);

        $this->assertInstanceOf(Method::class, $obj);
    }
}
<?php

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Method;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that we can actually instantiate the class
     */
    public function testCanInstantiate()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, 'Example', $reflectionClass);

        $this->assertInstanceOf(Method::class, $method);
    }

    /**
     * Test the output of a class
     */
    public function testOutput()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, 'Example', $reflectionClass);

        $output = '/**
 * 
 *
 * @param string $last
 * @param string $first
 * @param string $middle
 * @static 
 */';
        $this->assertEquals($output, $method->getDocComment(''));
        $this->assertEquals('setName', $method->getName());
        $this->assertEquals('\\'.ExampleClass::class, $method->getDeclaringClass());
        $this->assertEquals('$last, $first, ...$middle', $method->getParams(true));
        $this->assertEquals(['$last', '$first', '...$middle'], $method->getParams(false));
        $this->assertEquals('$last, $first = \'Barry\', ...$middle', $method->getParamsWithDefault(true));
        $this->assertEquals(['$last', '$first = \'Barry\'', '...$middle'], $method->getParamsWithDefault(false));
        $this->assertEquals(true, $method->shouldReturn());
    }

    /**
     * Test special characters in method
     */
    public function testSpecialChars()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setSpecialChars');

        $method = new Method($reflectionMethod, 'Example', $reflectionClass);
        $this->assertEquals('$chars', $method->getParams(true));
        $this->assertEquals(['$chars'], $method->getParams(false));
        $this->assertEquals('$chars = \'$\\\'\\\\\'', $method->getParamsWithDefault(true));
        $this->assertEquals(['$chars = \'$\\\'\\\\\''], $method->getParamsWithDefault(false));
    }
}

class ExampleClass
{
    /**
     * @param string $last
     * @param string $first
     * @param string $middle
     */
    public function setName($last, $first = 'Barry', ...$middle)
    {
        return;
    }

    public function setSpecialChars($chars = "\$'\\")
    {
        return;
    }
}

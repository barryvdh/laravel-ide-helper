<?php

namespace Barryvdh\LaravelIdeHelper;

class ExampleTest extends \PHPUnit_Framework_TestCase
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
}

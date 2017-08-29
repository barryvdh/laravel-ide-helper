<?php

namespace Barryvdh\LaravelIdeHelper;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that we can actually instantiate the class
     */
    public function testCanInstantiate()
    {
        $reflectionClass = new \ReflectionClass('\\Barryvdh\\LaravelIdeHelper\\ExampleClass');
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, $reflectionClass);

        $this->assertInstanceOf('\Barryvdh\LaravelIdeHelper\Method', $method);
    }

    /**
     * Test the output of a class
     */
    public function testOutput()
    {
        $reflectionClass = new \ReflectionClass('\\Barryvdh\\LaravelIdeHelper\\ExampleClass');
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, $reflectionClass);

        $output = '/**
 * 
 *
 * @param string $last
 * @param string $first
 * @static 
 */';
        $this->assertEquals($output, $method->getDocComment(''));
        $this->assertEquals('setName', $method->getName());
        $this->assertEquals('\\'.'Barryvdh\LaravelIdeHelper\ExampleClass', $method->getDeclaringClass());
        $this->assertEquals('$last, $first', $method->getParams());
        $this->assertEquals(['$last', '$first'], $method->getParams(false));
        $this->assertEquals('$last, $first = \'Barry\'', $method->getParamsWithDefault());
        $this->assertEquals(['$last', '$first = \'Barry\''], $method->getParamsWithDefault(false));
        $this->assertEquals(true, $method->shouldReturn());
    }
}
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

        $method = new Method($reflectionMethod, $reflectionClass);

        $this->assertInstanceOf(Method::class, $method);
    }

    /**
     * Test with a method that is defined in the class itself
     */
    public function testDeclaredMethod()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, $reflectionClass);

        $output = '/**
 * 
 *
 * @param string $last
 * @param string $first
 * @return void 
 * @static 
 */';
        $this->assertEquals($output, $method->getDocComment(''));
        $this->assertEquals('\\'.ExampleClass::class, $method->getDeclaringClass());
        $this->assertEquals('\\'.ExampleClass::class, $method->getRootClass());
        $this->assertEquals('setName', $method->getRootMethod());
        $this->assertEquals('setName', $method->getName());
        $this->assertEquals('$last, $first', $method->getParams(true));
        $this->assertEquals(['$last', '$first'], $method->getParams(false));
        $this->assertEquals('$last, $first = \'Barry\'', $method->getParamsWithDefault(true));
        $this->assertEquals(['$last', '$first = \'Barry\''], $method->getParamsWithDefault(false));
        $this->assertEquals(false, $method->shouldReturn());
    }

    /**
     * Test a method that is added via magic
     */
    public function testMagicMethod()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setName');

        $method = new Method($reflectionMethod, $reflectionClass, 'updateName');

        $output = '/**
 * 
 *
 * @param string $last
 * @param string $first
 * @return void 
 * @static 
 */';
        $this->assertEquals($output, $method->getDocComment(''));
        $this->assertEquals('\\'.ExampleClass::class, $method->getDeclaringClass());
        $this->assertEquals('\\'.ExampleClass::class, $method->getRootClass());
        $this->assertEquals('setName', $method->getRootMethod());
        $this->assertEquals('updateName', $method->getName());
        $this->assertEquals('$last, $first', $method->getParams(true));
        $this->assertEquals(['$last', '$first'], $method->getParams(false));
        $this->assertEquals('$last, $first = \'Barry\'', $method->getParamsWithDefault(true));
        $this->assertEquals(['$last', '$first = \'Barry\''], $method->getParamsWithDefault(false));
        $this->assertEquals(false, $method->shouldReturn());
    }

    /**
     * Test with a method that is inherited from the superclass
     */
    public function testInheritedMethod()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('getName');

        $method = new Method($reflectionMethod, $reflectionClass);

        $output = '/**
 * 
 *
 * @return string 
 * @static 
 */';
        $this->assertEquals($output, $method->getDocComment(''));
        $this->assertEquals('\\'.ExampleSuperClass::class, $method->getDeclaringClass());
        $this->assertEquals('\\'.ExampleClass::class, $method->getRootClass());
        $this->assertEquals('getName', $method->getRootMethod());
        $this->assertEquals('getName', $method->getName());
        $this->assertEquals('', $method->getParams(true));
        $this->assertEquals([], $method->getParams(false));
        $this->assertEquals('', $method->getParamsWithDefault(true));
        $this->assertEquals([], $method->getParamsWithDefault(false));
        $this->assertEquals(true, $method->shouldReturn());
    }
}

class ExampleSuperClass
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Barry';
    }
}
class ExampleClass extends ExampleSuperClass
{
    /**
     * @param string $last
     * @param string $first
     * @return void
     */
    public function setName($last, $first = 'Barry')
    {
    }
}

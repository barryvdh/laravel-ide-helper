<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Method;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MethodTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        if ($this->getName() == 'testSeparateTags') {
            $app['config']->set('ide-helper.phpdoc_separate_tags', true);
        }
    }

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

        $output = <<<'DOC'
/**
 * 
 *
 * @param string $last
 * @param string $first
 * @param string $middle
 * @static 
 */
DOC;
        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('setName', $method->getName());
        $this->assertSame('\\' . ExampleClass::class, $method->getDeclaringClass());
        $this->assertSame('$last, $first, ...$middle', $method->getParams(true));
        $this->assertSame(['$last', '$first', '...$middle'], $method->getParams(false));
        $this->assertSame('$last, $first = \'Barry\', ...$middle', $method->getParamsWithDefault(true));
        $this->assertSame(['$last', '$first = \'Barry\'', '...$middle'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
    }

    /**
     * Test the output of a class
     */
    public function testEloquentBuilderOutput()
    {
        $reflectionClass = new \ReflectionClass(Builder::class);
        $reflectionMethod = $reflectionClass->getMethod('with');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass);

        $output =  <<<'DOC'
/**
 * Set the relationships that should be eager loaded.
 *
 * @param string|array $relations
 * @param string|\Closure|null $callback
 * @return \Illuminate\Database\Eloquent\Builder|static 
 * @static 
 */
DOC;
        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('with', $method->getName());
        $this->assertSame('\\' . Builder::class, $method->getDeclaringClass());
        $this->assertSame('$relations, $callback', $method->getParams(true));
        $this->assertSame(['$relations', '$callback'], $method->getParams(false));
        $this->assertSame('$relations, $callback = null', $method->getParamsWithDefault(true));
        $this->assertSame(['$relations', '$callback = null'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
    }

    /**
     * Test special characters in methods default values
     */
    public function testDefaultSpecialChars()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('setSpecialChars');

        $method = new Method($reflectionMethod, 'Example', $reflectionClass);
        $this->assertSame('$chars', $method->getParams(true));
        $this->assertSame(['$chars'], $method->getParams(false));
        $this->assertSame('$chars = \'$\\\'\\\\\'', $method->getParamsWithDefault(true));
        $this->assertSame(['$chars = \'$\\\'\\\\\''], $method->getParamsWithDefault(false));
    }

    /**
     * Test the output of a class when using class aliases for it
     */
    public function testClassAliases()
    {
        $reflectionClass = new \ReflectionClass(ExampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('getApplication');

        $method = new Method($reflectionMethod, 'Example', $reflectionClass, null, [], [
            'Application' => '\\Illuminate\\Foundation\\Application',
        ]);

        $output = <<<'DOC'
/**
 * 
 *
 * @return \Illuminate\Foundation\Application 
 * @static 
 */
DOC;

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('getApplication', $method->getName());
        $this->assertSame('\\' . ExampleClass::class, $method->getDeclaringClass());
        $this->assertSame('', $method->getParams(true));
        $this->assertSame([], $method->getParams(false));
        $this->assertSame('', $method->getParamsWithDefault(true));
        $this->assertSame([], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
    }

    /**
     * Test class output when separating tag groups
     */
    public function testSeparateTags()
    {
        $reflectionClass = new \ReflectionClass(Model::class);
        $reflectionMethod = $reflectionClass->getMethod('toJson');

        $method = new Method($reflectionMethod, 'Model', $reflectionClass);

        $output =  <<<'DOC'
/**
 * Convert the model instance to JSON.
 *
 * @param int $options
 * @return string 
 *
 * @throws \Illuminate\Database\Eloquent\JsonEncodingException
 *
 * @static 
 */
DOC;

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('toJson', $method->getName());
        $this->assertSame('\\' . Model::class, $method->getDeclaringClass());
        $this->assertSame('$options', $method->getParams(true));
        $this->assertSame(['$options'], $method->getParams(false));
        $this->assertSame('$options = 0', $method->getParamsWithDefault(true));
        $this->assertSame(['$options = 0'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
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

    /**
     * @return Application
     */
    public function getApplication()
    {
        return;
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Method;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use PHPUnit\Framework\TestCase;

class MethodTest extends TestCase
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
     * Test the output of Illuminate\Database\Eloquent\Builder
     */
    public function testEloquentBuilderOutput()
    {
        $reflectionClass = new \ReflectionClass(EloquentBuilder::class);
        $reflectionMethod = $reflectionClass->getMethod('with');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass, null, [], [], ['$this' => '\\' . EloquentBuilder::class . '|static']);

        $expectedDocComment =  <<<'DOC'
/**
 * Set the relationships that should be eager loaded.
 *
 * @param string|array $relations
 * @param string|\Closure|null $callback
 * @return \Illuminate\Database\Eloquent\Builder|static 
 * @static 
 */
DOC;
        $this->assertSame($expectedDocComment, $method->getDocComment(''));
        $this->assertSame('with', $method->getName());
        $this->assertSame('\\' . EloquentBuilder::class, $method->getDeclaringClass());
        $this->assertSame(['$relations', '$callback'], $method->getParams(false));
        $this->assertSame(['$relations', '$callback = null'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
        $this->assertSame('\Illuminate\Database\Eloquent\Builder|static', rtrim($method->getReturnTag()->getType()));
    }

    /**
     * Test the output of Illuminate\Database\Query\Builder
     */
    public function testQueryBuilderOutput()
    {
        $reflectionClass = new \ReflectionClass(QueryBuilder::class);
        $reflectionMethod = $reflectionClass->getMethod('whereNull');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass, null, [], [], ['$this' => '\\' . EloquentBuilder::class . '|static']);

        $expectedDocComment =  <<<'DOC'
/**
 * Add a "where null" clause to the query.
 *
 * @param string|array|\Illuminate\Contracts\Database\Query\Expression $columns
 * @param string $boolean
 * @param bool $not
 * @return \Illuminate\Database\Eloquent\Builder|static 
 * @static 
 */
DOC;

        $this->assertSame($expectedDocComment, $method->getDocComment(''));
        $this->assertSame('whereNull', $method->getName());
        $this->assertSame('\\' . QueryBuilder::class, $method->getDeclaringClass());
        $this->assertSame(['$columns', '$boolean', '$not'], $method->getParams(false));
        $this->assertSame(['$columns', "\$boolean = 'and'", '$not = false'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
        $this->assertSame('\Illuminate\Database\Eloquent\Builder|static', rtrim($method->getReturnTag()->getType()));
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

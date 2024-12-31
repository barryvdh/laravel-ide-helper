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
        $reflectionMethod = $reflectionClass->getMethod('upsert');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass);

        $output =  <<<'DOC'
/**
 * Insert new records or update the existing ones.
 *
 * @param array $values
 * @param array|string $uniqueBy
 * @param array|null $update
 * @return int 
 * @static 
 */
DOC;
        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('upsert', $method->getName());
        $this->assertSame('\\' . EloquentBuilder::class, $method->getDeclaringClass());
        $this->assertSame('$values, $uniqueBy, $update', $method->getParams(true));
        $this->assertSame(['$values', '$uniqueBy', '$update'], $method->getParams(false));
        $this->assertSame('$values, $uniqueBy, $update = null', $method->getParamsWithDefault(true));
        $this->assertSame(['$values', '$uniqueBy', '$update = null'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
        $this->assertSame('int', rtrim($method->getReturnTag()->getType()));
    }

    /**
     * Test normalized return type of Illuminate\Database\Eloquent\Builder
     */
    public function testEloquentBuilderNormalizedReturnType()
    {
        $reflectionClass = new \ReflectionClass(EloquentBuilder::class);
        $reflectionMethod = $reflectionClass->getMethod('where');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass, null, [], [], ['$this' => '\\' . EloquentBuilder::class . '<static>']);

        $output =  <<<'DOC'
/**
 * Add a basic where clause to the query.
 *
 * @param (\Closure(static): mixed)|string|array|\Illuminate\Contracts\Database\Query\Expression $column
 * @param mixed $operator
 * @param mixed $value
 * @param string $boolean
 * @return \Illuminate\Database\Eloquent\Builder<static> 
 * @static 
 */
DOC;
        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('where', $method->getName());
        $this->assertSame('\\' . EloquentBuilder::class, $method->getDeclaringClass());
        $this->assertSame(['$column', '$operator', '$value', '$boolean'], $method->getParams(false));
        $this->assertSame(['$column', '$operator = null', '$value = null', "\$boolean = 'and'"], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
        $this->assertSame('\Illuminate\Database\Eloquent\Builder<static>', rtrim($method->getReturnTag()->getType()));
    }

    /**
     * Test normalized return type of Illuminate\Database\Query\Builder
     */
    public function testQueryBuilderNormalizedReturnType()
    {
        $reflectionClass = new \ReflectionClass(QueryBuilder::class);
        $reflectionMethod = $reflectionClass->getMethod('whereNull');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass, null, [], [], ['$this' => '\\' . EloquentBuilder::class . '<static>']);

        $output =  <<<'DOC'
/**
 * Add a "where null" clause to the query.
 *
 * @param string|array|\Illuminate\Contracts\Database\Query\Expression $columns
 * @param string $boolean
 * @param bool $not
 * @return \Illuminate\Database\Eloquent\Builder<static> 
 * @static 
 */
DOC;

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('whereNull', $method->getName());
        $this->assertSame('\\' . QueryBuilder::class, $method->getDeclaringClass());
        $this->assertSame(['$columns', '$boolean', '$not'], $method->getParams(false));
        $this->assertSame(['$columns', "\$boolean = 'and'", '$not = false'], $method->getParamsWithDefault(false));
        $this->assertTrue($method->shouldReturn());
        $this->assertSame('\Illuminate\Database\Eloquent\Builder<static>', rtrim($method->getReturnTag()->getType()));
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

    public function testEloquentBuilderWithTemplates()
    {
        $reflectionClass = new \ReflectionClass(EloquentBuilder::class);
        $reflectionMethod = $reflectionClass->getMethod('firstOr');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass, null, [], [], [], ['TModel']);

        $output =  <<<'DOC'
/**
 * Execute the query and get the first result or call a callback.
 *
 * @template TValue
 * @param (\Closure(): TValue)|list<string> $columns
 * @param (\Closure(): TValue)|null $callback
 * @return TModel|TValue 
 * @static 
 */
DOC;
        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('firstOr', $method->getName());
        $this->assertSame('\\' . EloquentBuilder::class, $method->getDeclaringClass());
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

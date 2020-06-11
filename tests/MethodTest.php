<?php

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Method;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Carbon as AliasedCarbon;

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

        $output = "/**\n";
        $output .= " * \n";
        $output .= " *\n";
        $output .= " * @param string \$last\n";
        $output .= " * @param string \$first\n";
        $output .= " * @param string \$middle\n";
        $output .= " * @static \n";
        $output .= " */";

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('setName', $method->getName());
        $this->assertSame('\\'.ExampleClass::class, $method->getDeclaringClass());
        $this->assertSame('$last, $first, ...$middle', $method->getParams(true));
        $this->assertSame(['$last', '$first', '...$middle'], $method->getParams(false));
        $this->assertSame('$last, $first = \'Barry\', ...$middle', $method->getParamsWithDefault(true));
        $this->assertSame(['$last', '$first = \'Barry\'', '...$middle'], $method->getParamsWithDefault(false));
        $this->assertSame(true, $method->shouldReturn());
    }

    /**
     * Test the output of a class
     */
    public function testEloquentBuilderOutput()
    {
        $reflectionClass = new \ReflectionClass(Builder::class);
        $reflectionMethod = $reflectionClass->getMethod('with');

        $method = new Method($reflectionMethod, 'Builder', $reflectionClass);

        $output = "/**\n";
        $output .= " * Set the relationships that should be eager loaded.\n";
        $output .= " *\n";
        $output .= " * @param mixed \$relations\n";
        $output .= " * @return \Illuminate\Database\Eloquent\Builder|static \n";
        $output .= " * @static \n";
        $output .= " */";

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('with', $method->getName());
        $this->assertSame('\\'.Builder::class, $method->getDeclaringClass());
        $this->assertSame('$relations', $method->getParams(true));
        $this->assertSame(['$relations'], $method->getParams(false));
        $this->assertSame('$relations', $method->getParamsWithDefault(true));
        $this->assertSame(['$relations'], $method->getParamsWithDefault(false));
        $this->assertSame(true, $method->shouldReturn());
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

    public function testRespectsImportedNamespaces()
    {
        $reflectionClass = new \ReflectionClass(SampleClass::class);
        $reflectionMethod = $reflectionClass->getMethod('someMethod');

        $method = new Method($reflectionMethod, 'SampleClass', $reflectionClass);

        $output = "/**\n";
        $output .= " * \n";
        $output .= " *\n";
        $output .= " * @param \Illuminate\Support\Collection \$collection\n";
        $output .= " * @param \Illuminate\Database\Eloquent\Builder \$builder\n";
        $output .= " * @param \Illuminate\Support\Carbon \$carbon\n";
        $output .= " * @param \Barryvdh\LaravelIdeHelper\Tests\UnknownClass \$unknownClass\n";
        $output .= " * @return \Illuminate\Support\Collection \n";
        $output .= " * @static \n";
        $output .= " */";

        $this->assertSame($output, $method->getDocComment(''));
        $this->assertSame('someMethod', $method->getName());
        $this->assertSame('\\'. SampleClass::class, $method->getDeclaringClass());
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

class SampleClass {
    /**
     * @param Collection    $collection
     * @param Builder       $builder
     * @param AliasedCarbon $carbon
     * @param UnknownClass  $unknownClass
     *
     * @return Collection
     */
    function someMethod(Collection $collection, Builder $builder, AliasedCarbon $carbon, UnknownClass $unknownClass) {
        return collect();
    }
}

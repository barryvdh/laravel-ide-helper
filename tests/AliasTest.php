<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Alias;
use Barryvdh\LaravelIdeHelper\Macro;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;

/**
 * @internal
 * @coversDefaultClass \Barryvdh\LaravelIdeHelper\Alias
 */
class AliasTest extends TestCase
{
    /**
     * @covers ::detectMethods
     */
    public function testDetectMethodsMacroableMacros(): void
    {
        // Mock
        $macro = __FUNCTION__;
        $alias = new AliasMock();

        // Macros
        Builder::macro(
            $macro,
            function () {
                // empty
            }
        );

        // Prepare
        $alias->setClasses([Builder::class]);
        $alias->detectMethods();

        // Test
        $this->assertNotNull($this->getAliasMacro($alias, Builder::class, $macro));
    }

    /**
     * @covers ::detectMethods
     */
    public function testDetectMethodsEloquentBuilderMacros(): void
    {
        // Mock
        $macro = __FUNCTION__;
        $alias = new AliasMock();

        // Macros
        EloquentBuilder::macro(
            $macro,
            function () {
                // empty
            }
        );

        // Prepare
        $alias->setClasses([EloquentBuilder::class]);
        $alias->detectMethods();

        // Test
        $this->assertNotNull($this->getAliasMacro($alias, EloquentBuilder::class, $macro));
    }

    /**
     * @covers ::detectFake
     */
    public function testNoExceptionOnRequiredFakeParameters(): void
    {
        // Mock
        $alias = new AliasMock();

        // Prepare
        $alias->setFacade(MockFacade::class);
        $this->expectNotToPerformAssertions();

        // Test
        $alias->detectFake();
    }

    /**
     * @covers ::detectTemplateNames
     */
    public function testTemplateNamesAreDetected(): void
    {
        // Mock
        $alias = new AliasMock();

        // Prepare
        $alias->setClasses([EloquentBuilder::class]);

        // Test
        $this->assertSame(['TModel', 'TValue'], $alias->getTemplateNames());
    }

    protected function getAliasMacro(Alias $alias, string $class, string $method): ?Macro
    {
        return Arr::first(
            $alias->getMethods(),
            function ($macro) use ($class, $method) {
                return $macro instanceof Macro
                    && $macro->getDeclaringClass() === "\\{$class}"
                    && $macro->getName() === $method;
            }
        );
    }
}

/**
 * @internal
 * @noinspection PhpMultipleClassesDeclarationsInOneFile
 * @template TValue
 */
class AliasMock extends Alias
{
    public function __construct()
    {
        // no need to call parent
    }

    /**
     * @param string[] $classes
     */
    public function setClasses(array $classes)
    {
        $this->classes = $classes;
    }

    public function detectMethods()
    {
        parent::detectMethods();
    }

    public function detectFake()
    {
        parent::detectFake();
    }

    public function setFacade(string $facade)
    {
        $this->facade = $facade;
    }
}

class MockFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '';
    }

    public static function fake(string $test1, $test2 = null)
    {
    }
}

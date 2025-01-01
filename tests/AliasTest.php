<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Alias;
use Barryvdh\LaravelIdeHelper\Macro;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Arr;

/**
 * @internal
 * @coversDefaultClass \Barryvdh\LaravelIdeHelper\Alias
 */
class AliasTest extends TestCase
{
    /**
     * @covers ::detectMethods
     */
    public function testDetectMethodsEloquentBuilderMacros(): void
    {
        // Mock
        $macro = __FUNCTION__;
        $alias = new AliasMock();

        // Macrosx
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
}

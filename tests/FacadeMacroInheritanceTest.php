<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Alias;
use Barryvdh\LaravelIdeHelper\Macro;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Traits\Macroable;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @internal
 */
class FacadeMacroInheritanceTest extends TestCase
{
    public static function macroableRoutes(): array
    {
        return [
            'direct facade' => [InheritanceMacroDirectService::class, true],
            'inherited facade' => [InheritanceMacroChildService::class, true],
            'direct class' => [InheritanceMacroDirectService::class, false],
            'inherited class' => [InheritanceMacroChildService::class, false],
        ];
    }

    #[DataProvider('macroableRoutes')]
    public function testAliasesCollectCallableMacros(string $serviceClass, bool $throughFacade): void
    {
        $this->withAlias($serviceClass, $throughFacade, function (Alias $alias): void {
            $macros = array_values(array_filter(
                $alias->getMethods(),
                static fn ($method) => $method instanceof Macro && $method->getName() === 'fixtureMacro'
            ));

            $this->assertCount(1, $macros);
            $this->assertSame('$value', $macros[0]->getParamsWithDefault());
            $this->assertStringContainsString('@return string', $macros[0]->getDocComment(''));
        });
    }

    #[DataProvider('macroableRoutes')]
    public function testPublicRealMethodsTakePrecedence(string $serviceClass, bool $throughFacade): void
    {
        $this->withAlias($serviceClass, $throughFacade, function (Alias $alias) use ($throughFacade): void {
            foreach (['realMethod' => 'int', 'inheritedMethod' => 'string'] as $name => $returnType) {
                $methods = array_values(array_filter(
                    $alias->getMethods(),
                    static fn ($method) => $method->getName() === $name
                ));

                // A class alias inherits its real methods instead of redeclaring them.
                $this->assertCount($throughFacade ? 1 : 0, $methods);
                if ($throughFacade) {
                    $this->assertNotInstanceOf(Macro::class, $methods[0]);
                    $this->assertSame('$value', $methods[0]->getParamsWithDefault());
                    $this->assertStringContainsString('@return ' . $returnType, $methods[0]->getDocComment(''));
                }
            }
        });
    }

    private function withAlias(string $serviceClass, bool $throughFacade, callable $assertions): void
    {
        $serviceClass::flushMacros();
        InheritanceMacroFacade::swap(new $serviceClass());

        try {
            InheritanceMacroFacade::macro('fixtureMacro', function (string $value): string {
                return 'macro:' . $value;
            });
            InheritanceMacroFacade::macro('realMethod', function (bool $replacement): bool {
                return $replacement;
            });
            InheritanceMacroFacade::macro('inheritedMethod', function (bool $replacement): bool {
                return $replacement;
            });

            // Establish actual facade dispatch before checking generated method metadata.
            $this->assertSame('macro:input', InheritanceMacroFacade::fixtureMacro('input'));
            $this->assertSame(7, InheritanceMacroFacade::realMethod(7));
            $this->assertSame('parent:input', InheritanceMacroFacade::inheritedMethod('input'));

            $class = $throughFacade ? InheritanceMacroFacade::class : $serviceClass;
            $alias = new Alias(new Repository(), $class, $class);
            $this->assertTrue($alias->isValid());
            $assertions($alias);
        } finally {
            $serviceClass::flushMacros();
            InheritanceMacroFacade::clearResolvedInstance(InheritanceMacroFacade::class);
            $this->app->forgetInstance(InheritanceMacroFacade::class);
        }
    }
}

/**
 * @internal
 * @noinspection PhpMultipleClassesDeclarationsInOneFile
 */
class InheritanceMacroServiceBase
{
    /**
     * @param string $value
     * @return string
     */
    public function inheritedMethod(string $value): string
    {
        return 'parent:' . $value;
    }
}

/**
 * @internal
 */
class InheritanceMacroDirectService extends InheritanceMacroServiceBase
{
    use Macroable;

    /**
     * @param int $value
     * @return int
     */
    public function realMethod(int $value): int
    {
        return $value;
    }
}

/**
 * @internal
 */
class InheritanceMacroChildService extends InheritanceMacroDirectService
{
}

/**
 * @internal
 */
class InheritanceMacroFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }
}

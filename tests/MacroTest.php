<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Generator;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Macro;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\Macroable;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;

use function array_map;
use function implode;

use const PHP_EOL;

/**
 * @internal
 * @coversDefaultClass \Barryvdh\LaravelIdeHelper\Macro
 */
class MacroTest extends TestCase
{
    /**
     * @covers ::initPhpDoc
     * @throws \ReflectionException
     */
    public function testInitPhpDocEloquentBuilderHasStaticInReturnType(): void
    {
        $class = new ReflectionClass(EloquentBuilder::class);
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                function (): EloquentBuilder {
                    return $this;
                }
            ),
            $class
        );

        $this->assertNotNull($phpdoc);
        $this->assertEquals(
            '@return \Illuminate\Database\Eloquent\Builder|static',
            $this->tagsToString($phpdoc, 'return')
        );
    }

    /**
     * @covers ::initPhpDoc
     * @throws \ReflectionException
     */
    public function testInitPhpDocClosureWithoutDocBlock(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                function (?int $a = null): int {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertEmpty($phpdoc->getText());
        $this->assertEquals('@param int|null $a', $this->tagsToString($phpdoc, 'param'));
        $this->assertEquals('@return int', $this->tagsToString($phpdoc, 'return'));
        $this->assertTrue($phpdoc->hasTag('see'));
    }

    /**
     * @covers ::initPhpDoc
     * @throws \ReflectionException
     */
    public function testInitPhpDocClosureWithArgsAndReturnType(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                /**
                 * Test docblock.
                 */
                function (?int $a = null): int {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertEquals('@param int|null $a', $this->tagsToString($phpdoc, 'param'));
        $this->assertEquals('@return int', $this->tagsToString($phpdoc, 'return'));
        $this->assertTrue($phpdoc->hasTag('see'));
    }

    /**
     * @covers ::initPhpDoc
     * @throws \ReflectionException
     */
    public function testInitPhpDocClosureWithArgs(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                /**
                 * Test docblock.
                 */
                function (?int $a = null) {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertEquals('@param int|null $a', $this->tagsToString($phpdoc, 'param'));
        $this->assertFalse($phpdoc->hasTag('return'));
        $this->assertTrue($phpdoc->hasTag('see'));
    }

    /**
     * @covers ::initPhpDoc
     * @throws \ReflectionException
     */
    public function testInitPhpDocClosureWithReturnType(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                /**
                 * Test docblock.
                 */
                function (): int {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertFalse($phpdoc->hasTag('param'));
        $this->assertEquals('@return int', $this->tagsToString($phpdoc, 'return'));
        $this->assertTrue($phpdoc->hasTag('see'));
    }

    /**
     * @covers ::initPhpDoc
     */
    public function testInitPhpDocParamsAddedOnlyNotPresent(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                /**
                 * Test docblock.
                 *
                 * @param \stdClass|null $a aaaaa
                 */
                function ($a = null): int {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertEquals('@param \stdClass|null $a aaaaa', $this->tagsToString($phpdoc, 'param'));
        $this->assertEquals('@return int', $this->tagsToString($phpdoc, 'return'));
    }

    /**
     * @covers ::initPhpDoc
     */
    public function testInitPhpDocReturnAddedOnlyNotPresent(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(
            new ReflectionFunction(
                /**
                 * Test docblock.
                 *
                 * @return \stdClass|null rrrrrrr
                 */
                function ($a = null): int {
                    return 0;
                }
            )
        );

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertEquals('@param mixed $a', $this->tagsToString($phpdoc, 'param'));
        $this->assertEquals('@return \stdClass|null rrrrrrr', $this->tagsToString($phpdoc, 'return'));
    }

    public function testInitPhpDocParamsWithUnionTypes(): void
    {
        $phpdoc = (new MacroMock())->getPhpDoc(eval(<<<'PHP'
            return new ReflectionFunction(
                /**
                 * Test docblock.
                 */
                function (\Stringable|string $a = null): \Stringable|string|null {
                    return $a;
                }
            );
        PHP));

        $this->assertNotNull($phpdoc);
        $this->assertStringContainsString('Test docblock', $phpdoc->getText());
        $this->assertEquals('@param \Stringable|string|null $a', $this->tagsToString($phpdoc, 'param'));
        $this->assertEquals('@return \Stringable|string|null', $this->tagsToString($phpdoc, 'return'));
    }

    protected function tagsToString(DocBlock $docBlock, string $name)
    {
        $tags = $docBlock->getTagsByName($name);
        $tags = array_map(
            function (Tag $tag) {
                return trim((string)$tag);
            },
            $tags
        );
        $tags = implode(PHP_EOL, $tags);

        return $tags;
    }
    /**
     * Test that we can actually instantiate the class
     */
    public function testCanInstantiate()
    {
        $reflectionMethod = new \ReflectionMethod(UrlGeneratorMacroClass::class, '__invoke');

        $macro = new Macro($reflectionMethod, UrlGenerator::class, new ReflectionClass(UrlGenerator::class), 'macroName');

        $this->assertInstanceOf(Macro::class, $macro);
    }

    /**
     * Test the output of a class
     */
    public function testOutput()
    {
        $reflectionMethod = new \ReflectionMethod(UrlGeneratorMacroClass::class, '__invoke');

        $macro = new Macro($reflectionMethod, 'URL', new ReflectionClass(UrlGenerator::class), 'macroName');
        $output = <<<'DOC'
/**
 * @param string $foo
 * @param int $bar
 * @return string
 * @see \Barryvdh\LaravelIdeHelper\Tests\UrlGeneratorMacroClass::__invoke()
 * @static
 */
DOC;
        $this->assertSame($output, $macro->getDocComment(''));
        $this->assertSame('__invoke', $macro->getRealName());
        $this->assertSame('\\' . UrlGenerator::class, $macro->getDeclaringClass());
        $this->assertSame('$foo, $bar', $macro->getParams(true));
        $this->assertSame(['$foo', '$bar'], $macro->getParams(false));
        $this->assertSame('$foo, $bar = 0', $macro->getParamsWithDefault(true));
        $this->assertSame(['$foo', '$bar = 0'], $macro->getParamsWithDefault(false));
        $this->assertTrue($macro->shouldReturn());
        $this->assertSame('$instance->__invoke($foo, $bar)', $macro->getRootMethodCall());
    }

    public function testFacadeWithMacroableAccessorGeneratesMethodsOnBothClasses(): void
    {
        View::addLocation(__DIR__ . '/../resources/views');
        $this->app->register(MyServiceProvider::class);
        AliasLoader::getInstance()->setAliases([
            'MyFacade' => MyFacade::class,
        ]);
        Request::flushMacros();

        $generator = new Generator($this->app['config'], $this->app['view'], null, false);
        $content = $generator->generate();

        $namespacePattern = 'namespace Barryvdh\\\\LaravelIdeHelper\\\\Tests';
        $serviceClassPattern = "/$namespacePattern\s*{.*?\s*class MyService\s*{.*?public static function myMethod\(\)/s";
        $facadeClassPattern = "/$namespacePattern\s*{.*?\s*class MyFacade\s*{.*?public static function myMethod\(\)/s";

        // Assert that the myMethod definition exists inside the namespaced MyService class block.
        $this->assertMatchesRegularExpression(
            $serviceClassPattern,
            $content,
            'The helper file should contain the myMethod() definition for the MyService class within its namespace.'
        );

        // Assert that the myMethod definition ALSO exists inside the namespaced MyFacade class block.
        $this->assertMatchesRegularExpression(
            $facadeClassPattern,
            $content,
            'The helper file should contain the myMethod() definition for the MyFacade class within its namespace.'
        );

        // Additionally, check for the correct fully-qualified method body in one of the definitions.
        $this->assertStringContainsString(
            'return \Barryvdh\LaravelIdeHelper\Tests\MyService::myMethod();',
            $content
        );
    }

    protected function getPackageProviders($app)
    {
        return [IdeHelperServiceProvider::class];
    }
}

/**
 * @internal
 * @noinspection PhpMultipleClassesDeclarationsInOneFile
 */
class MacroMock extends Macro
{
    public function __construct()
    {
        // no need to call parent
    }

    public function getPhpDoc(ReflectionFunctionAbstract $method, ?ReflectionClass $class = null): DocBlock
    {
        return (new Macro($method, '', $class ?? $method->getClosureScopeClass()))->phpdoc;
    }
}

/**
 * Example of an invokable class to be used as a macro.
 */
class UrlGeneratorMacroClass
{
    /**
     * @param  string  $foo
     * @param  int  $bar
     * @return string
     */
    public function __invoke(string $foo, int $bar = 0): string
    {
        return '';
    }
}

class MyService
{
    use Macroable;
}

class MyFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MyService::class;
    }
}

class MyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MyService::class, fn () => new MyService());
    }

    public function boot(): void
    {
        MyFacade::macro(
            'myMethod',
            function (): string {
                return 'Walter was here';
            },
        );
    }
}

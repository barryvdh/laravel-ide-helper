<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests;

use Barryvdh\LaravelIdeHelper\Macro;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
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
                function (int $a = null): int {
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
                function (int $a = null): int {
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
                function (int $a = null) {
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

    public function getPhpDoc(ReflectionFunctionAbstract $method, ReflectionClass $class = null): DocBlock
    {
        return (new Macro($method, '', $class ?? $method->getClosureScopeClass()))->phpdoc;
    }
}

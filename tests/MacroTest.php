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

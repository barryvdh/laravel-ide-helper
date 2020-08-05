<?php

namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\ParserFactory;
use ReflectionException;

class NamespaceUses
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var Use_[]|GroupUse[]
     */
    protected $blocks;

    /**
     * @var string
     */
    protected $classFQN;

    /**
     * @var array
     */
    public $classAliases;

    /**
     * NamespaceUses constructor.
     * @param string $classFQN
     * @throws ReflectionException
     */
    public function __construct(string $classFQN)
    {
        $this->classFQN = ltrim($classFQN, '\\');

        $this->namespace = ltrim(
            preg_replace(
                '/\\\\' . class_basename($classFQN) . '$/',
                '',
                $classFQN
            ),
            '\\'
        );

        $this->parse();
    }

    /**
     * @throws ReflectionException
     */
    protected function parse(): void
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        /** @var Namespace_ $namespaceData */
        $namespaceData = Arr::first(
            $parser->parse(
                file_get_contents(
                    (new \ReflectionClass($this->classFQN))->getFileName()
                )
            ),
            function ($node) {
                return $node instanceof Namespace_
                    && $node->name->toCodeString() === $this->namespace;
            }
        );

        $this->classAliases = [];

        foreach ($namespaceData->stmts as $stmt) {
            if ($stmt instanceof Use_) {
                $this->blocks[] = $stmt;

                if ($stmt->type !== Use_::TYPE_NORMAL) {
                    continue;
                }

                foreach ($stmt->uses as $use) {
                    /** @var UseUse $use */
                    $classFQN = '\\' . $use->name->toCodeString();

                    if ($use->alias) {
                        $this->classAliases[$use->alias->name] = $classFQN;
                    } else {
                        $classBasename = class_basename($classFQN);

                        $this->classAliases[$classBasename] = $classFQN;
                    }
                }
            } elseif ($stmt instanceof GroupUse) {
                $this->blocks[] = $stmt;

                foreach ($stmt->uses as $use) {
                    $classFQN = '\\' . $stmt->prefix->toCodeString() . '\\' . $use->name->toCodeString();

                    /** @var UseUse $use */
                    if ($use->alias) {
                        $this->classAliases[$use->alias->name] = $classFQN;
                    } else {
                        $classBasename = class_basename($classFQN);

                        $this->classAliases[$classBasename] = $classFQN;
                    }
                }
            }
        }
    }
}
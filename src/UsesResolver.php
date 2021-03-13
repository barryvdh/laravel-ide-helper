<?php

/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2014 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;

use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\ParserFactory;

class UsesResolver
{
    /**
     * @var array
     */
    protected $classAliases = [];

    /**
     * @return array
     */
    public function getClassAliases()
    {
        return $this->classAliases;
    }

    /**
     * @param string $classFQN
     * @return $this
     */
    public function loadFromClass(string $classFQN)
    {
        return $this->loadFromFile(
            $classFQN,
            (new \ReflectionClass($classFQN))->getFileName()
        );
    }

    /**
     * @param string $classFQN
     * @param string $filename
     * @return $this
     */
    public function loadFromFile(string $classFQN, string $filename)
    {
        return $this->loadFromCode(
            $classFQN,
            file_get_contents(
                $filename
            )
        );
    }

    /**
     * @param string $classFQN
     * @param string $code
     * @return $this
     */
    public function loadFromCode(string $classFQN, string $code)
    {
        $classFQN = ltrim($classFQN, '\\');

        $namespace = rtrim(
            preg_replace(
                '/([^\\\\]+)$/',
                '',
                $classFQN
            ),
            '\\'
        );

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $namespaceData = null;

        foreach ($parser->parse($code) as $node) {
            if ($node instanceof Namespace_ && $node->name->toCodeString() === $namespace) {
                $namespaceData = $node;
                break;
            }
        }

        if ($namespaceData === null) {
            return $this;
        }

        /** @var Namespace_ $namespaceData */

        foreach ($namespaceData->stmts as $stmt) {
            if ($stmt instanceof Use_) {
                if ($stmt->type !== Use_::TYPE_NORMAL) {
                    continue;
                }

                foreach ($stmt->uses as $use) {
                    /** @var UseUse $use */

                    $this->addClassAlias(
                        '\\' . $use->name->toCodeString(),
                        $use->alias ? $use->alias->name : null
                    );
                }
            } elseif ($stmt instanceof GroupUse) {
                foreach ($stmt->uses as $use) {
                    /** @var UseUse $use */

                    $this->addClassAlias(
                        '\\' . $stmt->prefix->toCodeString() . '\\' . $use->name->toCodeString(),
                        $use->alias ? $use->alias->name : null
                    );
                }
            }
        }

        return $this;
    }

    /**
     * @param string $classFQN
     * @param string|null $alias
     * @return void
     */
    protected function addClassAlias(string $classFQN, string $alias = null)
    {
        if ($alias === null) {
            $alias = class_basename($classFQN);
        }

        $this->classAliases[$alias] = $classFQN;
    }
}

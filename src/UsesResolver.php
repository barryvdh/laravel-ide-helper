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
     * @param string $classFQN
     * @return array
     */
    public function loadFromClass(string $classFQN): array
    {
        return $this->loadFromFile(
            $classFQN,
            (new \ReflectionClass($classFQN))->getFileName()
        );
    }

    /**
     * @param string $classFQN
     * @param string $filename
     * @return array
     */
    public function loadFromFile(string $classFQN, string $filename): array
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
     * @return array
     */
    public function loadFromCode(string $classFQN, string $code): array
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
            return [];
        }

        /** @var Namespace_ $namespaceData */

        $aliases = [];

        foreach ($namespaceData->stmts as $stmt) {
            if ($stmt instanceof Use_) {
                if ($stmt->type !== Use_::TYPE_NORMAL) {
                    continue;
                }

                foreach ($stmt->uses as $use) {
                    /** @var UseUse $use */

                    $alias = $use->alias ?
                        $use->alias->name :
                        self::classBasename($use->name->toCodeString());

                    $aliases[$alias] = '\\' . $use->name->toCodeString();
                }
            } elseif ($stmt instanceof GroupUse) {
                foreach ($stmt->uses as $use) {
                    /** @var UseUse $use */

                    $alias = $use->alias ?
                        $use->alias->name :
                        self::classBasename($use->name->toCodeString());

                    $aliases[$alias] = '\\' . $stmt->prefix->toCodeString() . '\\' . $use->name->toCodeString();
                }
            }
        }

        return $aliases;
    }

    /**
     * @param string $classFQN
     * @return string
     */
    protected static function classBasename(string $classFQN): string
    {
        return preg_replace('/^.*\\\\([^\\\\]+)$/', '$1', $classFQN);
    }
}

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

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Serializer as DocBlockSerializer;
use Barryvdh\Reflection\DocBlock\Tag\MethodTag;
use Closure;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Facade;
use ReflectionClass;
use Throwable;

class Alias
{
    protected $alias;
    /** @psalm-var class-string $facade */
    protected $facade;
    protected $extends = null;
    protected $extendsClass = null;
    protected $extendsNamespace = null;
    protected $classType = 'class';
    protected $short;
    protected $namespace = '__root';
    protected $root = null;
    protected $classes = [];
    protected $methods = [];
    protected $usedMethods = [];
    protected $valid = false;
    protected $magicMethods = [];
    protected $interfaces = [];
    protected $phpdoc = null;
    protected $classAliases = [];

    /** @var ConfigRepository  */
    protected $config;

    /**
     * @param ConfigRepository $config
     * @param string           $alias
     * @psalm-param class-string $facade
     * @param string           $facade
     * @param array            $magicMethods
     * @param array            $interfaces
     */
    public function __construct($config, $alias, $facade, $magicMethods = [], $interfaces = [])
    {
        $this->alias = $alias;
        $this->magicMethods = $magicMethods;
        $this->interfaces = $interfaces;
        $this->config = $config;

        // Make the class absolute
        $facade = '\\' . ltrim($facade, '\\');
        $this->facade = $facade;

        $this->detectRoot();

        if (!$this->root || $this->isTrait()) {
            return;
        }

        $this->valid = true;

        $this->addClass($this->root);
        $this->detectFake();
        $this->detectNamespace();
        $this->detectClassType();
        $this->detectExtendsNamespace();

        if (!empty($this->namespace)) {
            $this->classAliases = (new UsesResolver())->loadFromClass($this->root);

            //Create a DocBlock and serializer instance
            $this->phpdoc = new DocBlock(new ReflectionClass($alias), new Context($this->namespace, $this->classAliases));
        }

        if ($facade === '\Illuminate\Database\Eloquent\Model') {
            $this->usedMethods = ['decrement', 'increment'];
        }
    }

    /**
     * Add one or more classes to analyze
     *
     * @param array|string $classes
     */
    public function addClass($classes)
    {
        $classes = (array)$classes;
        foreach ($classes as $class) {
            if (class_exists($class) || interface_exists($class)) {
                $this->classes[] = $class;
            } else {
                echo "Class not exists: $class\r\n";
            }
        }
    }

    /**
     * Check if this class is valid to process.
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * Get the classtype, 'interface' or 'class'
     *
     * @return string
     */
    public function getClasstype()
    {
        return $this->classType;
    }

    /**
     * Get the class which this alias extends
     *
     * @return null|string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Get the class short name which this alias extends
     *
     * @return null|string
     */
    public function getExtendsClass()
    {
        return $this->extendsClass;
    }

    /**
     * Get the namespace of the class which this alias extends
     *
     * @return null|string
     */
    public function getExtendsNamespace()
    {
        return $this->extendsNamespace;
    }

    /**
     * Get the Alias by which this class is called
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Return the short name (without namespace)
     */
    public function getShortName()
    {
        return $this->short;
    }
    /**
     * Get the namespace from the alias
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get the methods found by this Alias
     *
     * @return array|Method[]
     */
    public function getMethods()
    {
        if (count($this->methods) > 0) {
            return $this->methods;
        }

        $this->addMagicMethods();
        $this->detectMethods();
        return $this->methods;
    }

    /**
     * Detect class returned by ::fake()
     */
    protected function detectFake()
    {
        $facade = $this->facade;

        if (!is_subclass_of($facade, Facade::class)) {
            return;
        }

        if (!method_exists($facade, 'fake')) {
            return;
        }

        $real = $facade::getFacadeRoot();

        try {
            $facade::fake();
            $fake = $facade::getFacadeRoot();
            if ($fake !== $real) {
                $this->addClass(get_class($fake));
            }
        } finally {
            $facade::swap($real);
        }
    }

    /**
     * Detect the namespace
     */
    protected function detectNamespace()
    {
        if (strpos($this->alias, '\\')) {
            $nsParts = explode('\\', $this->alias);
            $this->short = array_pop($nsParts);
            $this->namespace = implode('\\', $nsParts);
        } else {
            $this->short = $this->alias;
        }
    }

    /**
     * Detect the extends namespace
     */
    protected function detectExtendsNamespace()
    {
        if (strpos($this->extends, '\\') !== false) {
            $nsParts = explode('\\', $this->extends);
            $this->extendsClass = array_pop($nsParts);
            $this->extendsNamespace = implode('\\', $nsParts);
        }
    }

    /**
     * Detect the class type
     */
    protected function detectClassType()
    {
        //Some classes extend the facade
        if (interface_exists($this->facade)) {
            $this->classType = 'interface';
            $this->extends = $this->facade;
        } else {
            $this->classType = 'class';
            if (class_exists($this->facade)) {
                $this->extends = $this->facade;
            }
        }
    }

    /**
     * Get the real root of a facade
     *
     * @return bool|string
     */
    protected function detectRoot()
    {
        $facade = $this->facade;

        try {
            //If possible, get the facade root
            if (method_exists($facade, 'getFacadeRoot')) {
                $root = get_class($facade::getFacadeRoot());
            } else {
                $root = $facade;
            }

            //If it doesn't exist, skip it
            if (!class_exists($root) && !interface_exists($root)) {
                return;
            }

            $this->root = $root;

            //When the database connection is not set, some classes will be skipped
        } catch (\PDOException $e) {
            $this->error(
                'PDOException: ' . $e->getMessage() .
                "\nPlease configure your database connection correctly, or use the sqlite memory driver (-M)." .
                " Skipping $facade."
            );
        } catch (Throwable $e) {
            $this->error('Exception: ' . $e->getMessage() . "\nSkipping $facade.");
        }
    }

    /**
     * Detect if this class is a trait or not.
     *
     * @return bool
     */
    protected function isTrait()
    {
        // Check if the facade is not a Trait
        return trait_exists($this->facade);
    }

    /**
     * Add magic methods, as defined in the configuration files
     */
    protected function addMagicMethods()
    {
        foreach ($this->magicMethods as $magic => $real) {
            [$className, $name] = explode('::', $real);
            if ((!class_exists($className) && !interface_exists($className)) || !method_exists($className, $name)) {
                continue;
            }
            $method = new \ReflectionMethod($className, $name);
            $class = new ReflectionClass($className);

            if (!in_array($magic, $this->usedMethods)) {
                if ($class !== $this->root) {
                    $this->methods[] = new Method($method, $this->alias, $class, $magic, $this->interfaces, $this->classAliases);
                }
                $this->usedMethods[] = $magic;
            }
        }
    }

    /**
     * Get the methods for one or multiple classes.
     *
     * @return string
     */
    protected function detectMethods()
    {
        foreach ($this->classes as $class) {
            $reflection = new ReflectionClass($class);

            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            if ($methods) {
                foreach ($methods as $method) {
                    if (!in_array($method->name, $this->usedMethods)) {
                        // Only add the methods to the output when the root is not the same as the class.
                        // And don't add the __*() methods
                        if ($this->extends !== $class && substr($method->name, 0, 2) !== '__') {
                            $this->methods[] = new Method(
                                $method,
                                $this->alias,
                                $reflection,
                                $method->name,
                                $this->interfaces,
                                $this->classAliases
                            );
                        }
                        $this->usedMethods[] = $method->name;
                    }
                }
            }

            // Check if the class is macroable
            // (Eloquent\Builder is also macroable but doesn't use Macroable trait)
            $traits = collect($reflection->getTraitNames());
            if ($traits->contains('Illuminate\Support\Traits\Macroable') || $class === EloquentBuilder::class) {
                $properties = $reflection->getStaticProperties();
                $macros = isset($properties['macros']) ? $properties['macros'] : [];
                foreach ($macros as $macro_name => $macro_func) {
                    if (!in_array($macro_name, $this->usedMethods)) {
                        // Add macros
                        $this->methods[] = new Macro(
                            $this->getMacroFunction($macro_func),
                            $this->alias,
                            $reflection,
                            $macro_name,
                            $this->interfaces,
                            $this->classAliases
                        );
                        $this->usedMethods[] = $macro_name;
                    }
                }
            }
        }
    }

    /**
     * @param $macro_func
     *
     * @return \ReflectionFunctionAbstract
     * @throws \ReflectionException
     */
    protected function getMacroFunction($macro_func)
    {
        if (is_array($macro_func) && is_callable($macro_func)) {
            return new \ReflectionMethod($macro_func[0], $macro_func[1]);
        }

        if (is_object($macro_func) && is_callable($macro_func) && !$macro_func instanceof Closure) {
            return new \ReflectionMethod($macro_func, '__invoke');
        }

        return new \ReflectionFunction($macro_func);
    }

    /*
     * Get the docblock for this alias
     *
     * @param string $prefix
     * @return mixed
     */
    public function getDocComment($prefix = "\t\t")
    {
        $serializer = new DocBlockSerializer(1, $prefix);

        if (!$this->phpdoc) {
            return '';
        }

        if ($this->config->get('ide-helper.include_class_docblocks')) {
            // if a class doesn't expose any DocBlock tags
            // we can perform reflection on the class and
            // add in the original class DocBlock
            if (count($this->phpdoc->getTags()) === 0) {
                $class = new ReflectionClass($this->root);
                $this->phpdoc = new DocBlock($class->getDocComment());
            }
        }

        $this->removeDuplicateMethodsFromPhpDoc();
        return $serializer->getDocComment($this->phpdoc);
    }

    /**
     * Removes method tags from the doc comment that already appear as functions inside the class.
     * This prevents duplicate function errors in the IDE.
     *
     * @return void
     */
    protected function removeDuplicateMethodsFromPhpDoc()
    {
        $methodNames = array_map(function (Method $method) {
            return $method->getName();
        }, $this->getMethods());

        foreach ($this->phpdoc->getTags() as $tag) {
            if ($tag instanceof MethodTag && in_array($tag->getMethodName(), $methodNames)) {
                $this->phpdoc->deleteTag($tag);
            }
        }
    }

    /**
     * Output an error.
     *
     * @param  string  $string
     * @return void
     */
    protected function error($string)
    {
        echo $string . "\r\n";
    }
}

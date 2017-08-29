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


class Alias
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $facade;

    /**
     * @var string|null $extends
     */
    protected $extends;

    /**
     * @var null|string $extendsClass
     */
    protected $extendsClass;

    /**
     * @var null|string $extendsNamespace
     */
    protected $extendsNamespace;
    protected $classType = 'class';

    /**
     * @var string $short
     */
    protected $short;
    protected $namespace = '__root';

    /**
     * @var string $root
     */
    protected $root;
    protected $classes = [];
    protected $methods = [];
    protected $usedMethods = [];
    protected $valid = false;
    protected $magicMethods = [];
    protected $interfaces = [];

    /**
     * @param string $alias
     * @param string $facade
     * @param array $magicMethods
     * @param array $interfaces
     */
    public function __construct($alias, $facade, array $magicMethods = [], array $interfaces = [])
    {
        $this->alias = $alias;
        $this->magicMethods = $magicMethods;
        $this->interfaces = $interfaces;

        // Make the class absolute
        $facade = '\\' . ltrim($facade, '\\');
        $this->facade = $facade;

        $this->detectRoot();

        if ((!$this->isTrait() && $this->root)) {
            $this->valid = true;
        } else {
            return;
        }

        $this->addClass($this->root);
        $this->detectNamespace();
        $this->detectClassType();
        $this->detectExtendsNamespace();
        
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
     * @return array
     */
    public function getMethods()
    {
        $this->addMagicMethods();
        $this->detectMethods();
        return $this->methods;
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
            $root = method_exists($facade, 'getFacadeRoot') ? get_class($facade::getFacadeRoot()) : $facade;

            //If it doesn't exist, skip it
            if (!class_exists($root) && !interface_exists($root)) {
                return;
            }

            $this->root = $root;

            //When the database connection is not set, some classes will be skipped
        } catch (\PDOException $e) {
            $this->error(
                "PDOException: " . $e->getMessage() .
                "\nPlease configure your database connection correctly, or use the sqlite memory driver (-M)." .
                " Skipping $facade."
            );
        } catch (\Exception $e) {
            $this->error("Exception: " . $e->getMessage() . "\nSkipping $facade.");
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
        return function_exists('trait_exists') && trait_exists($this->facade);
    }

    /**
     * Add magic methods, as defined in the configuration files
     */
    protected function addMagicMethods()
    {
        foreach ($this->magicMethods as $magic => $real) {
            list($className, $name) = explode('::', $real);
            if (!class_exists($className) && !interface_exists($className)) {
                continue;
            }
            $method = new \ReflectionMethod($className, $name);
            $class = new \ReflectionClass($className);

            if (!$this->isUsedMethod($method)) {
                if ($class !== $this->root) {
                    $this->methods[] = new Method($method, $class, $magic, $this->interfaces);
                }
                $this->usedMethods[] = $magic;
            }
        }
    }

    /**
     * @param \ReflectionMethod $method
     * @return bool
     */
    protected function isUsedMethod(\ReflectionMethod $method)
    {
        return in_array($method->name, $this->usedMethods);
    }

    /**
     * Get the methods for one or multiple classes.
     *
     * @return string
     */
    protected function detectMethods()
    {

        foreach ($this->classes as $class) {
            $reflection = new \ReflectionClass($class);

            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            if ($methods) {
                foreach ($methods as $method) {
                    if (!$this->isUsedMethod($method)) {
                        // Only add the methods to the output when the root is not the same as the class.
                        // And don't add the __*() methods
                        if ($this->extends !== $class && substr($method->name, 0, 2) !== '__') {
                            $this->methods[] = new Method(
                                $method,
                                $reflection,
                                $method->name,
                                $this->interfaces
                            );
                        }
                        $this->usedMethods[] = $method->name;
                    }
                }
            }

            // Check if the class is macroable
            $traits = collect($reflection->getTraitNames());
            if ($traits->contains('Illuminate\Support\Traits\Macroable')) {
                $properties = $reflection->getStaticProperties();
                //todo simplify to  ?? when PHP min >= 7.0
                $macros = isset($properties['macros']) ? $properties['macros'] : [];
                foreach ($macros as $macro_name => $macro_func) {
                    $function = new \ReflectionFunction($macro_func);
                    // Add macros
                    $this->methods[] = new Macro(
                        $function,
                        $reflection,
                        $macro_name,
                        $this->interfaces
                    );
                }
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

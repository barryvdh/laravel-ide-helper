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

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Tag\ReturnTag;

class Method
{
    /** @var \phpDocumentor\Reflection\DocBlock */
    protected $phpdoc;

    /** @var \ReflectionMethod */
    protected $method;

    protected $name;
    protected $namespace;
    protected $params = array();
    protected $params_with_default = array();
    protected $interfaces = array();
    protected $return = null;

    /**
     * @param \ReflectionMethod $method
     * @param string $alias
     * @param \ReflectionClass $class
     * @param string|null $methodName
     * @param array $interfaces
     */
    public function __construct(\ReflectionMethod $method, $alias, $class, $methodName = null, $interfaces = array())
    {
        $this->method = $method;
        $this->interfaces = $interfaces;
        $this->name = $methodName ?: $method->name;
        $declaringClass = $method->getDeclaringClass();
        $this->namespace = $declaringClass->getNamespaceName();

        //Create a DocBlock and serializer instance
        $this->phpdoc = new DocBlock($method, new Context($this->namespace, static::getUseStatements($declaringClass)));

        //Normalize the description and inherit the docs from parents/interfaces
        try {
            $this->normalizeReturnTags($this->phpdoc);
            $this->normalizeDescription($this->phpdoc);
        } catch (\Exception $e) {}

        //Get the parameters, including formatted default values
        $this->getParameters($method);

        //Make the method static
        //$this->phpdoc->appendTag(Tag::createInstance('@static', $this->phpdoc));

        //Reference the 'real' function in the declaringClass
        $this->declaringClassName = '\\' . ltrim($declaringClass->name, '\\');
        $this->root = '\\' . ltrim($class->getName(), '\\');
    }

    /**
     * Get the class wherein the function resides
     *
     * @return string
     */
    public function getDeclaringClass()
    {
        return $this->declaringClassName;
    }

    /**
     * Return the class from which this function would be called
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Get the docblock for this method
     *
     * @param string $prefix
     * @param bool $trim
     * @return string
     */
    public function getDocComment($prefix = "\t\t", $trim = false)
    {
        $serializer = new DocBlock\Serializer(1, $prefix);
        $str = $serializer->getDocComment($this->phpdoc);
        if ($trim) {
            $str = preg_replace(array('/\s+$/m', '#^(\s*/\*\*[\r\n])(?:\s*\*[\r\n])+#u', '#(?:[\r\n]\s*\*)+([\r\n]\s*\*/)$#u'), array('', '$1', '$1'), $str);
        }
        return $str;
    }

    /**
     * Get the method name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Checks whether the method is deprecated
     *
     * @return bool
     */
    public function isDeprecated()
    {
        return $this->phpdoc->hasTag('deprecated');
    }

    /**
     * Get the declared parameters for this method
     *
     * @return array
     */
    public function getDocParams()
    {
        return $this->phpdoc->getTagsByName('param');
    }

    /**
     * Get the parameters for this method
     *
     * @param bool $implode Whether to implode the array or not
     * @return string|array
     */
    public function getParams($implode = true)
    {
        return $implode ? implode(', ', $this->params) : $this->params;
    }

    /**
     * Get the parameters for this method including default values
     *
     * @param bool $implode Whether to implode the array or not
     * @return string|array
     */
    public function getParamsWithDefault($implode = true)
    {
        return $implode ? implode(', ', $this->params_with_default) : $this->params_with_default;
    }

    /**
     * Get the description and get the inherited docs.
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeDescription(DocBlock $phpdoc)
    {
        //Get the short + long description from the DocBlock
        $description = $phpdoc->getText();

        //Loop through parents/interfaces, to fill in {@inheritdoc}
        if (stripos($description, '{@inheritdoc}') !== false && ($inheritdoc = $this->getInheritDoc($this->method))) {
            $inheritDescription = $inheritdoc->getText();

            $description = str_ireplace('{@inheritdoc}', $inheritDescription, $description);
            $phpdoc->setText($description);

            $this->normalizeReturnTags($inheritdoc);

            //Add the tags that are inherited
            foreach ($inheritdoc->getTags() as $tag) {
                $tag->setDocBlock();
                $phpdoc->appendTag($tag);
            }
        }
    }

    /**
     * Normalize the return tag (make full namespace, replace interfaces)
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeReturnTags(DocBlock $phpdoc)
    {
        static $typeProp;
        if (!isset($typeProp)) {
            $typeProp = new \ReflectionProperty('phpDocumentor\Reflection\DocBlock\Tag\ReturnTag', 'type');
            $typeProp->setAccessible(true);
        }

        $this->return = null;
        //Get the return type and adjust them for better autocomplete
        foreach ($phpdoc->getTags() as $tag) {
            if ($tag instanceof ReturnTag) {
                // Convert the keywords
                $typeValue = static::convertKeywords($typeProp->getValue($tag));
                $typeProp->setValue($tag, $typeValue);

                // Get the expanded type
                $typeValue = $tag->getType();

                // Replace the interfaces
                if (preg_match('/\bReturnTag$/', get_class($tag))) {
                    foreach ($this->interfaces as $interface => $real) {
                        $typeValue = preg_replace('/(^|\|)' . preg_quote($interface, '/') . '\b/', $real, $typeValue);
                    }
                    $this->return = $typeValue;
                }

                // Re-set the type
                $typeProp->setValue($tag, $typeValue);
                $tag->setDescription($tag->getDescription());
            }
        }
    }

    /**
     * Convert keywords that are incorrect.
     *
     * @param  string $string
     * @return string
     */
    protected static function convertKeywords($string)
    {
        $types = explode('|', $string);
        foreach ($types as &$type) {
            if ($type === 'Closure')
                $type = '\Closure';
            elseif ($type === 'dynamic')
                $type = 'mixed';
            elseif (strrpos($type, '\\') && $type[0] !== '\\' && (class_exists($type) || interface_exists($type)))
                $type = '\\' . $type;
        }
        return implode('|', $types);
    }

    /**
     * Should the function return a value?
     *
     * @return bool|int
     */
    public function shouldReturn()
    {
        if ($this->return !== 'void' && $this->method->name !== '__construct') {
            return isset($this->return) ? true : 1;
        }

        return false;
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param \ReflectionMethod $method
     * @return void
     */
    public function getParameters($method)
    {
        //Loop through the default values for parameters, and make the correct output string
        $params = array();
        $paramsWithDefault = array();

        foreach ($method->getParameters() as $param) {
            $paramStr = '$' . $param->getName();
            $params[] = $paramStr;

            if ($param->isOptional()) {
                $default = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                if (is_bool($default)) {
                    $default = $default ? 'true' : 'false';
                } elseif (is_array($default)) {
                    $default = 'array()';
                } elseif (is_null($default)) {
                    $default = 'null';
                } elseif (is_int($default)) {
                    //$default = $default;
                } else {
                    $default = "'" . trim($default) . "'";
                }
                $paramStr .= " = $default";
            }

            $paramsWithDefault[] = $paramStr;
        }

        $this->params = $params;
        $this->params_with_default = $paramsWithDefault;
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     * @return DocBlock|null
     */
    protected function getInheritDoc($reflectionMethod)
    {
        $parentClass = $reflectionMethod->getDeclaringClass()->getParentClass();

        //Get either a parent or the interface
        if ($parentClass) {
            $method = $parentClass->getMethod($reflectionMethod->getName());
        } else {
            $method = $reflectionMethod->getPrototype();
        }
        if ($method) {
            $namespace = $method->getDeclaringClass()->getNamespaceName();
            $phpdoc = new DocBlock($method, new Context($namespace, static::getUseStatements($method->getDeclaringClass())));

            if (stripos($phpdoc->getText(), '{@inheritdoc}') !== false) {
                //Not at the end yet, try another parent/interface..
                return $this->getInheritDoc($method);
            } else {
                return $phpdoc;
            }
        }
        return null;
    }

    protected static function getUseStatements(\ReflectionClass $class)
    {
        try {
            return PhpReflection::getUseStatements($class);
        } catch (\Exception $e) {
            return array();
        }
    }
}

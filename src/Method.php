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

use Barryvdh\LaravelIdeHelper\DocBlock\DocBlockBuilder;
use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Context;
use Barryvdh\Reflection\DocBlock\Tag;
use Barryvdh\Reflection\DocBlock\Tag\ParamTag;
use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Serializer;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Method
{
    /** @var DocBlockBuilder  */
    protected $phpdoc;

    /** @var \ReflectionMethod  */
    protected $method;

    protected $output = '';
    protected $declaringClassName;
    protected $name;
    protected $namespace;
    protected $params = [];
    protected $params_with_default = [];
    protected $interfaces = [];
    protected $real_name;
    protected $return = null;
    protected $root;
    protected $classAliases;

    /**
     * @param \ReflectionMethod|\ReflectionFunctionAbstract $method
     * @param string $alias
     * @param \ReflectionClass $class
     * @param string|null $methodName
     * @param array $interfaces
     * @param array $classAliases
     */
    public function __construct($method, $alias, $class, $methodName = null, $interfaces = [], array $classAliases = [])
    {
        $this->method = $method;
        $this->interfaces = $interfaces;
        $this->classAliases = $classAliases;
        $this->name = $methodName ?: $method->name;
        $this->real_name = $method->isClosure() ? $this->name : $method->name;
        $this->initClassDefinedProperties($method, $class);

        //Reference the 'real' function in the declaring class
        $this->root = '\\' . ltrim($method->name === '__invoke' ? $method->getDeclaringClass()->getName() : $class->getName(), '\\');

        //Create a DocBlock and serializer instance
        $this->initPhpDoc($method);

        //Normalize the returns and inherit the docs from parents/interfaces
        try {
            $this->normalizeReturn($this->phpdoc);
        } catch (\Exception $e) {
        }

        //Get the parameters, including formatted default values
        $this->getParameters($method);

        //Make the method static
        $this->phpdoc->appendTagline('@static');
    }

    /**
     * @param \ReflectionMethod $method
     */
    protected function initPhpDoc($method)
    {
        $context = new \phpDocumentor\Reflection\Types\Context($this->namespace, $this->classAliases);
        $this->phpdoc = DocBlockBuilder::createFromReflector($method, $context);
    }

    /**
     * @param \ReflectionMethod $method
     * @param \ReflectionClass $class
     */
    protected function initClassDefinedProperties($method, \ReflectionClass $class)
    {
        $declaringClass = $method->getDeclaringClass();
        $this->namespace = $declaringClass->getNamespaceName();
        $this->declaringClassName = '\\' . ltrim($declaringClass->name, '\\');
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
     * @return bool
     */
    public function isInstanceCall()
    {
        return !($this->method->isClosure() || $this->method->isStatic());
    }

    /**
     * @return string
     */
    public function getRootMethodCall()
    {
        if ($this->isInstanceCall()) {
            return "\$instance->{$this->getRealName()}({$this->getParams()})";
        } else {
            return "{$this->getRoot()}::{$this->getRealName()}({$this->getParams()})";
        }
    }

    /**
     * Get the docblock for this method
     *
     * @param string $prefix
     * @return mixed
     */
    public function getDocComment($prefix = "\t\t")
    {
        $serializer = new Serializer(1, $prefix);
        return $serializer->getDocComment($this->phpdoc->getDocBlock());
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
     * Get the real method name
     *
     * @return string
     */
    public function getRealName()
    {
        return $this->real_name;
    }

    /**
     * Get the parameters for this method
     *
     * @param bool $implode Wether to implode the array or not
     * @return string
     */
    public function getParams($implode = true)
    {
        return $implode ? implode(', ', $this->params) : $this->params;
    }

    /**
     * Get the parameters for this method including default values
     *
     * @param bool $implode Wether to implode the array or not
     * @return string
     */
    public function getParamsWithDefault($implode = true)
    {
        return $implode ? implode(', ', $this->params_with_default) : $this->params_with_default;
    }

    /**
     * Normalize the return tag (make full namespace, replace interfaces)
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeReturn(DocBlockBuilder $phpdoc)
    {
        //Get the return type and adjust them for better autocomplete
        $returnTags = $phpdoc->getTagsByName('return');

        if (count($returnTags) === 0) {
            $this->return = null;
            return;
        }


        /** @var Return_ $tag */
        $tag = reset($returnTags);

        if ($tag instanceof InvalidTag) {
            return;
        }
        // Get the expanded type
        $returnValue = $tag->getType();

        // Replace the interfaces
        foreach ($this->interfaces as $interface => $real) {
            $returnValue = str_replace($interface, $real, $returnValue);
        }

        $this->return = $returnValue;

        if ($returnValue === '$this') {
            $returnValue = Str::contains($this->root, Builder::class)
                ? $this->root . '|static'
                : $this->root;
        }

        // Set the changed content
        $this->phpdoc->removeTag($tag);
        $this->phpdoc->appendTagline('@return ' . $returnValue . ' ' . $tag->getDescription());

    }

    /**
     * Convert keywords that are incorrect.
     *
     * @param  string $string
     * @return string
     */
    protected function convertKeywords($string)
    {
        $string = str_replace('\Closure', 'Closure', $string);
        $string = str_replace('Closure', '\Closure', $string);
        $string = str_replace('dynamic', 'mixed', $string);

        return $string;
    }

    /**
     * Should the function return a value?
     *
     * @return bool
     */
    public function shouldReturn()
    {
        if ($this->return !== 'void' && $this->method->name !== '__construct') {
            return true;
        }

        return false;
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param  \ReflectionMethod $method
     * @return void
     */
    public function getParameters($method)
    {
        //Loop through the default values for parameters, and make the correct output string
        $params = [];
        $paramsWithDefault = [];
        foreach ($method->getParameters() as $param) {
            $paramStr = $param->isVariadic() ? '...$' . $param->getName() : '$' . $param->getName();
            $params[] = $paramStr;
            if ($param->isOptional() && !$param->isVariadic()) {
                $default = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                if (is_bool($default)) {
                    $default = $default ? 'true' : 'false';
                } elseif (is_array($default)) {
                    $default = '[]';
                } elseif (is_null($default)) {
                    $default = 'null';
                } elseif (is_int($default)) {
                    //$default = $default;
                } elseif (is_resource($default)) {
                    //skip to not fail
                } else {
                    $default = var_export($default, true);
                }
                $paramStr .= " = $default";
            }
            $paramsWithDefault[] = $paramStr;
        }

        $this->params = $params;
        $this->params_with_default = $paramsWithDefault;
    }
}

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
use Barryvdh\Reflection\DocBlock\Tag;
use Barryvdh\Reflection\DocBlock\Tag\ParamTag;
use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;

class Method
{
    /** @var DocBlock  */
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
    protected $returnTypeNormalizers;

    /** @var string[] */
    protected $templateNames = [];

    /**
     * @param \ReflectionMethod|\ReflectionFunctionAbstract $method
     * @param string $alias
     * @param \ReflectionClass $class
     * @param string|null $methodName
     * @param array $interfaces
     * @param array $classAliases
     * @param array $returnTypeNormalizers
     * @param string[] $templateNames
     */
    public function __construct($method, $alias, $class, $methodName = null, $interfaces = [], array $classAliases = [], array $returnTypeNormalizers = [], array $templateNames = [])
    {
        $this->method = $method;
        $this->interfaces = $interfaces;
        $this->classAliases = $classAliases;
        $this->returnTypeNormalizers = $returnTypeNormalizers;
        $this->name = $methodName ?: $method->name;
        $this->real_name = $method->isClosure() ? $this->name : $method->name;
        $this->templateNames = $templateNames;
        $this->initClassDefinedProperties($method, $class);

        //Reference the 'real' function in the declaring class
        $this->root = '\\' . ltrim($method->name === '__invoke' ? $method->getDeclaringClass()->getName() : $class->getName(), '\\');

        //Create a DocBlock and serializer instance
        $this->initPhpDoc($method);

        //Normalize the description and inherit the docs from parents/interfaces
        try {
            $this->normalizeParams($this->phpdoc);
            $this->normalizeReturn($this->phpdoc);
            $this->normalizeDescription($this->phpdoc);
        } catch (\Exception $e) {
        }

        //Get the parameters, including formatted default values
        $this->getParameters($method);

        //Make the method static
        $this->phpdoc->appendTag(Tag::createInstance('@static', $this->phpdoc));
    }

    /**
     * @param \ReflectionMethod $method
     */
    protected function initPhpDoc($method)
    {
        $this->phpdoc = new DocBlock($method, new Context($this->namespace, $this->classAliases, generics: $this->templateNames));
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
        $serializer = new DocBlockSerializer(1, $prefix);
        return $serializer->getDocComment($this->phpdoc);
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
     * @param DocBlock|null $phpdoc
     * @return ReturnTag|null
     */
    public function getReturnTag($phpdoc = null)
    {
        if ($phpdoc === null) {
            $phpdoc = $this->phpdoc;
        }

        $returnTags = $phpdoc->getTagsByName('return');

        if (count($returnTags) === 0) {
            return null;
        }

        return reset($returnTags);
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
     * Get the description and get the inherited docs.
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeDescription(DocBlock $phpdoc)
    {
        //Get the short + long description from the DocBlock
        $description = $phpdoc->getText();

        //Loop through parents/interfaces, to fill in {@inheritdoc}
        if (strpos($description, '{@inheritdoc}') !== false) {
            $inheritdoc = $this->getInheritDoc($this->method);
            $inheritDescription = $inheritdoc->getText();

            $description = str_replace('{@inheritdoc}', $inheritDescription, $description);
            $phpdoc->setText($description);

            $this->normalizeParams($inheritdoc);
            $this->normalizeReturn($inheritdoc);

            //Add the tags that are inherited
            $inheritTags = $inheritdoc->getTags();
            if ($inheritTags) {
                /** @var Tag $tag */
                foreach ($inheritTags as $tag) {
                    $tag->setDocBlock();
                    $phpdoc->appendTag($tag);
                }
            }
        }
    }

    /**
     * Normalize the parameters
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeParams(DocBlock $phpdoc)
    {
        //Get the return type and adjust them for beter autocomplete
        $paramTags = $phpdoc->getTagsByName('param');
        if ($paramTags) {
            /** @var ParamTag $tag */
            foreach ($paramTags as $tag) {
                // Convert the keywords
                $content = $this->convertKeywords($tag->getContent());
                $tag->setContent($content);

                // Get the expanded type and re-set the content
                $content = $tag->getType() . ' ' . $tag->getVariableName() . ' ' . $tag->getDescription();
                $tag->setContent(trim($content));
            }
        }
    }

    /**
     * Normalize the return tag (make full namespace, replace interfaces, resolve $this)
     *
     * @param DocBlock $phpdoc
     */
    protected function normalizeReturn(DocBlock $phpdoc)
    {
        //Get the return type and adjust them for better autocomplete
        $tag = $this->getReturnTag($phpdoc);

        if ($tag === null) {
            $this->return = null;
            return;
        }

        // Get the expanded type
        $returnValue = $tag->getType();

        if (array_key_exists($returnValue, $this->returnTypeNormalizers)) {
            $returnValue = $this->returnTypeNormalizers[$returnValue];
        }

        if ($returnValue === '$this') {
            $returnValue = $this->root;
        }

        // Replace the interfaces
        foreach ($this->interfaces as $interface => $real) {
            $returnValue = str_replace($interface, $real, $returnValue);
        }

        // Set the changed content
        $tag->setContent($returnValue . ' ' . $tag->getDescription());
        $this->return = $returnValue;
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

    /**
     * @param \ReflectionMethod $reflectionMethod
     * @return DocBlock
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
            $phpdoc = new DocBlock($method, new Context($namespace, $this->classAliases, generics: $this->templateNames));

            if (strpos($phpdoc->getText(), '{@inheritdoc}') !== false) {
                //Not at the end yet, try another parent/interface..
                return $this->getInheritDoc($method);
            }

            return $phpdoc;
        }
    }
}

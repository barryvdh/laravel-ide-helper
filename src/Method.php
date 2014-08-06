<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2013 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Serializer as DocBlockSerializer;

class Method
{

    protected $output = '';
    protected $name;
    protected $namespace;
    protected $phpdoc;
    protected $params = array();
    protected $params_with_default = array();
    protected $interfaces = array();

    public function __construct($method, $alias, $class, $interfaces = array())
    {
        $this->interfaces = $interfaces;
        $this->name = $method->name;
        $this->namespace = $method->getDeclaringClass()->getNamespaceName();

        //Create a DocBlock and serializer instance
        $this->phpdoc = new DocBlock($method, new Context($this->namespace));

        //Normalize the description and inherit the docs from parents/interfaces
        try {
            $this->normalizeDescription($method);
        } catch (\Exception $e) {
            $this->info("Cannot normalize method $alias::{$this->name}..");
        }

        //Get the parameters, including formatted default values
        $this->getParameters($method);

        //Make the method static
        $this->phpdoc->appendTag(Tag::createInstance('@static', $this->phpdoc));

        //Correct the return values
        $returnValue = $this->getReturn();
        //Only return when not a constructor and not void.
        $this->return = ($returnValue && $returnValue !== "void" && $method->name !== "__construct");

        //Reference the 'real' function in the declaringclass
        $declaringClass = $method->getDeclaringClass();
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
     * Should the function return a value?
     *
     * @return bool
     */
    public function shouldReturn()
    {
        return $this->return;
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
     * Get the parameters for this method
     *
     * @param bool $implode Wether to implode the array or not
     * @return string
     */
    public function getParams($implode = true)
    {
        return implode(', ', $this->params);
    }

    /**
     * Get the parameters for this method including default values
     *
     * @param bool $implode Wether to implode the array or not
     * @return string
     */
    public function getParamsWithDefault($implode = true)
    {
        return implode(', ', $this->params_with_default);
    }

    /**
     * Get the description and get the inherited docs.
     *
     * @param $method
     */
    protected function normalizeDescription($method)
    {
        //Get the short + long description from the DocBlock
        $description = $this->phpdoc->getText();

        //Loop through parents/interfaces, to fill in {@inheritdoc}
        if (strpos($description, '{@inheritdoc}') !== false) {
            $inheritdoc = $this->getInheritDoc($method);
            $inheritDescription = $inheritdoc->getText();

            $description = str_replace('{@inheritdoc}', $inheritDescription, $description);
            $this->phpdoc->setText($description);

            //Add the tags that are inherited
            $inheritTags = $inheritdoc->getTags();
            if ($inheritTags) {
                foreach ($inheritTags as $tag) {
                    $tag->setDocBlock();
                    $this->phpdoc->appendTag($tag);
                }
            }
        }
    }

    /**
     * Make some changes to the return types, if needed.
     *
     * @return string|null
     */
    protected function getReturn()
    {
        //Get the return type and adjust them for beter autocomplete
        $returnTags = $this->phpdoc->getTagsByName('return');
        if ($returnTags) {
            /** @var Tag $tag */
            $tag = reset($returnTags);
            $returnValue = $tag->getType();

            foreach($this->interfaces as $interface => $real){
                $returnValue = str_replace($interface, $real, $returnValue);
            }
            $tag->setContent($returnValue);
        } else {
            $returnValue = null;
        }

        return $returnValue;
    }

    /**
     * Get the parameters and format them correctly
     *
     * @param $method
     * @return array
     */
    public function getParameters($method)
    {
        //Loop through the default values for paremeters, and make the correct output string
        $params = array();
        $paramsWithDefault = array();
        foreach ($method->getParameters() as $param) {
            $paramStr = '$' . $param->getName();
            $params[] = $paramStr;
            if ($param->isOptional()) {
                $default = $param->getDefaultValue();
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
     * @return string
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
            $phpdoc = new DocBlock($method);
            if (strpos($phpdoc->getText(), '{@inheritdoc}') !== false) {
                //Not at the end yet, try another parent/interface..
                return $this->getInheritDoc($method);
            } else {
                return $phpdoc;
            }
        }
    }

}

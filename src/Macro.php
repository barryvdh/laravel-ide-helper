<?php

namespace Barryvdh\LaravelIdeHelper;

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;

class Macro extends Method
{
    /**
     * Macro constructor.
     *
     * @param \ReflectionFunction $method
     * @param string              $alias
     * @param \ReflectionClass    $class
     * @param null                $methodName
     * @param array               $interfaces
     */
    public function __construct(\ReflectionFunction $method, $alias, $class, $methodName = null, $interfaces = array())
    {
        $this->method = $method;
        $this->interfaces = $interfaces;
        $this->name = $methodName ?: $method->name;
        $this->namespace = $class->getNamespaceName();

        //Create a DocBlock and serializer instance
        $this->phpdoc = new DocBlock($method);

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

        //Reference the 'real' function in the declaringclass
        $this->declaringClassName = '\\' . ltrim($class->name, '\\');
        $this->root = '\\' . ltrim($class->getName(), '\\');
    }
}

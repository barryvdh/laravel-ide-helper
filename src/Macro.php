<?php

namespace Barryvdh\LaravelIdeHelper;

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Support\Collection;

class Macro extends Method
{
    /**
     * Macro constructor.
     *
     * @param \ReflectionFunctionAbstract $method
     * @param string              $alias
     * @param \ReflectionClass    $class
     * @param null                $methodName
     * @param array               $interfaces
     */
    public function __construct(
        $method,
        $alias,
        $class,
        $methodName = null,
        $interfaces = []
    ) {
        parent::__construct($method, $alias, $class, $methodName, $interfaces);
    }

    /**
     * @param \ReflectionFunctionAbstract $method
     */
    protected function initPhpDoc($method)
    {
        $this->phpdoc = new DocBlock('/** */');

        $this->addLocationToPhpDoc();

        // Add macro parameters
        foreach ($method->getParameters() as $parameter) {
            $type = $parameter->hasType() ? $parameter->getType()->getName() : 'mixed';
            $type .= $parameter->hasType() && $parameter->getType()->allowsNull() ? '|null' : '';

            $name = $parameter->isVariadic() ? '...' : '';
            $name .= '$' . $parameter->getName();

            $this->phpdoc->appendTag(Tag::createInstance("@param {$type} {$name}"));
        }

        // Add macro return type
        if ($method->hasReturnType()) {
            $type = $method->getReturnType()->getName();
            $type .= $method->getReturnType()->allowsNull() ? '|null' : '';

            $this->phpdoc->appendTag(Tag::createInstance("@return {$type}"));
        }
    }

    protected function addLocationToPhpDoc()
    {
        $enclosingClass = $this->method->getClosureScopeClass();

        /** @var \ReflectionMethod $enclosingMethod */
        $enclosingMethod = Collection::make($enclosingClass->getMethods())
            ->first(function (\ReflectionMethod $method) {
                return $method->getStartLine() <= $this->method->getStartLine()
                    && $method->getEndLine() >= $this->method->getEndLine();
            });

        if ($enclosingMethod) {
            $this->phpdoc->appendTag(Tag::createInstance(
                '@see \\' . $enclosingClass->getName() . '::' . $enclosingMethod->getName() . '()'
            ));
        }
    }

    /**
     * @param \ReflectionFunctionAbstract $method
     * @param \ReflectionClass $class
     */
    protected function initClassDefinedProperties($method, \ReflectionClass $class)
    {
        $this->namespace = $class->getNamespaceName();
        $this->declaringClassName = '\\' . ltrim($class->name, '\\');
    }
}

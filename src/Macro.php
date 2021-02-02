<?php

namespace Barryvdh\LaravelIdeHelper;

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
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
        $this->phpdoc = new DocBlock($method);

        $this->addLocationToPhpDoc();

        // Add macro parameters if they are missed in original docblock
        if (!$this->phpdoc->hasTag('param')) {
            foreach ($method->getParameters() as $parameter) {
                $reflectionType = $parameter->getType();

                $reflectionTypes = $reflectionType instanceof \ReflectionUnionType
                    ? $reflectionType->getTypes()
                    : [$reflectionType];

                $type = Collection::make($reflectionTypes)
                    ->filter()
                    ->map->getName()
                    ->implode('|');

                if ($reflectionType && ! $reflectionType instanceof \ReflectionUnionType && $reflectionType->allowsNull()) {
                    $type .= '|null';
                }

                $type = $type ?: 'mixed';

                $name = $parameter->isVariadic() ? '...' : '';
                $name .= '$' . $parameter->getName();

                $this->phpdoc->appendTag(Tag::createInstance("@param {$type} {$name}"));
            }
        }

        // Add macro return type if it missed in original docblock
        if ($method->hasReturnType() && !$this->phpdoc->hasTag('return')) {
            $builder = EloquentBuilder::class;
            $return = $method->getReturnType();

            $returnTypes = $return instanceof \ReflectionUnionType
                ? $return->getTypes()
                : [$return];

            $type = Collection::make($returnTypes)
                ->filter()
                ->map->getName()
                ->implode('|');

            if (! $return instanceof \ReflectionUnionType) {
                $type .= $this->root === "\\{$builder}" && $return->getName() === $builder ? '|static' : '';
                $type .= $return->allowsNull() ? '|null' : '';
            }

            $this->phpdoc->appendTag(Tag::createInstance("@return {$type}"));
        }
    }

    protected function addLocationToPhpDoc()
    {
        if ($this->method->name === '__invoke') {
            $enclosingClass = $this->method->getDeclaringClass();
        } else {
            $enclosingClass = $this->method->getClosureScopeClass();
        }

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

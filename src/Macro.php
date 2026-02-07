<?php

namespace Barryvdh\LaravelIdeHelper;

use Barryvdh\Reflection\DocBlock;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Collection;

class Macro extends Method
{
    protected static $macroDefaults = [];

    /**
     * Macro constructor.
     *
     * @param \ReflectionFunctionAbstract $method
     * @param \ReflectionClass    $class
     * @param null                $methodName
     * @param array               $interfaces
     * @param array               $classAliases
     * @param array               $returnTypeNormalizers
     */
    public function __construct(
        $method,
        $class,
        $methodName = null,
        $interfaces = [],
        $classAliases = [],
        $returnTypeNormalizers = []
    ) {
        parent::__construct($method, $class, $methodName, $interfaces, $classAliases, $returnTypeNormalizers);
    }

    public static function setDefaultReturnTypes(array $map = [])
    {
        static::$macroDefaults = array_merge(static::$macroDefaults, $map);
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

                $type = $this->concatReflectionTypes($reflectionType);

                /** @psalm-suppress UndefinedClass */
                if ($reflectionType && !$reflectionType instanceof \ReflectionUnionType && $reflectionType->allowsNull()) {
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

            $type = $this->concatReflectionTypes($return);

            if (!$return instanceof \ReflectionUnionType) {
                /** @phpstan-ignore method.notFound */
                $type .= $this->root === "\\{$builder}" && $return->getName() === $builder ? '|static' : '';
                $type .= $return->allowsNull() ? '|null' : '';
            }

            $this->phpdoc->appendTag(Tag::createInstance("@return {$type}"));
        }

        $class = ltrim($this->declaringClassName, '\\');
        if (!$this->phpdoc->hasTag('return') && isset(static::$macroDefaults[$class])) {
            $type = static::$macroDefaults[$class];
            $this->phpdoc->appendTag(Tag::createInstance("@return {$type}"));
        }
    }

    protected function concatReflectionTypes(?\ReflectionType $type): string
    {
        if ($type instanceof \ReflectionNamedType) {
            return $type->getName();
        }

        if ($type instanceof \ReflectionIntersectionType) {
            return $this->formatIntersectionType($type);
        }

        if ($type instanceof \ReflectionUnionType) {
            return $this->formatUnionType($type);
        }

        // Unknown or null type
        return '';
    }

    protected function formatUnionType(\ReflectionUnionType $type): string
    {
        return Collection::make($type->getTypes())
            ->map(function (\ReflectionType $inner) {
                if ($inner instanceof \ReflectionNamedType) {
                    return $inner->getName();
                }
                if ($inner instanceof \ReflectionIntersectionType) {
                    return $this->formatIntersectionType($inner);
                }
                // ReflectionUnionType cannot be nested per PHP's DNF rules
                return null;
            })
            ->filter()
            ->implode('|');
    }

    protected function formatIntersectionType(\ReflectionIntersectionType $type): string
    {
        $parts = Collection::make($type->getTypes())
            ->map(fn (\ReflectionNamedType $t) => $t->getName())
            ->toArray();

        return '(' . implode('&', $parts) . ')';
    }

    protected function addLocationToPhpDoc()
    {
        if ($this->method->name === '__invoke') {
            $enclosingClass = $this->method->getDeclaringClass();
        } else {
            $enclosingClass = $this->method->getClosureScopeClass();
        }

        if (!$enclosingClass) {
            return;
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

<?php namespace Barryvdh\LaravelIdeHelper;

/**
 * PHP reflection helpers.
 *
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 *
 * @see https://github.com/nette/di/blob/v2.4/src/DI/PhpReflection.php
 */
class PhpReflection
{
    /**
     * Expands class name into full name.
     *
     * @param  string $name
     * @param  \ReflectionClass $rc
     * @return string  full name
     * @throws \InvalidArgumentException
     */
    public static function expandClassName($name, \ReflectionClass $rc)
    {
        $lower = strtolower($name);
        if (empty($name)) {
            throw new \InvalidArgumentException('Class name must not be empty.');
        } elseif (self::isBuiltinType($lower)) {
            return $lower;
        } elseif ($lower === 'self' || $lower === 'static' || $lower === '$this') {
            return $rc->getName();
        } elseif ($name[0] === '\\') { // fully qualified name
            return ltrim($name, '\\');
        }

        $uses = self::getUseStatements($rc);
        $parts = explode('\\', $name, 2);
        if (isset($uses[$parts[0]])) {
            $parts[0] = $uses[$parts[0]];
            return implode('\\', $parts);
        } elseif ($rc->inNamespace()) {
            return $rc->getNamespaceName() . '\\' . $name;
        } else {
            return $name;
        }
    }

    /**
     * @param  \ReflectionClass
     * @return array of [alias => class]
     */
    public static function getUseStatements(\ReflectionClass $class)
    {
        static $cache = array();
        if (!isset($cache[$name = $class->getName()])) {
            if ($class->isInternal() || !($code = @file_get_contents($class->getFileName()))) {
                $cache[$name] = array();
            } else {
                $cache = self::parseUseStatements($code, $name) + $cache;
            }
        }
        return $cache[$name];
    }

    /**
     * @param  string
     * @return bool
     */
    public static function isBuiltinType($type)
    {
        return in_array(strtolower($type), array('string', 'int', 'float', 'bool', 'array', 'callable'), true);
    }

    /**
     * Parses PHP code.
     *
     * @param  string $code
     * @param  string $forClass
     * @return array of [class => [alias => class, ...]]
     */
    public static function parseUseStatements($code, $forClass = null)
    {
        $tokens = token_get_all($code);
        $namespace = $class = $classLevel = $level = null;
        $res = $uses = array();

        while ($token = current($tokens)) {
            next($tokens);
            switch (is_array($token) ? $token[0] : $token) {
                case T_NAMESPACE:
                    $namespace = ltrim(self::fetch($tokens, array(T_STRING, T_NS_SEPARATOR)) . '\\', '\\');
                    $uses = array();
                    break;

                case T_CLASS:
                case T_INTERFACE:
                case PHP_VERSION_ID < 50400 ? -1 : T_TRAIT:
                    if ($name = self::fetch($tokens, T_STRING)) {
                        $class = $namespace . $name;
                        $classLevel = $level + 1;
                        $res[$class] = $uses;
                        if ($class === $forClass) {
                            return $res;
                        }
                    }
                    break;

                case T_USE:
                    while (!$class && ($name = self::fetch($tokens, array(T_STRING, T_NS_SEPARATOR)))) {
                        $name = ltrim($name, '\\');
                        if (self::fetch($tokens, '{')) {
                            while ($suffix = self::fetch($tokens, array(T_STRING, T_NS_SEPARATOR))) {
                                if (self::fetch($tokens, T_AS)) {
                                    $uses[self::fetch($tokens, T_STRING)] = $name . $suffix;
                                } else {
                                    $tmp = explode('\\', $suffix);
                                    $uses[end($tmp)] = $name . $suffix;
                                }
                                if (!self::fetch($tokens, ',')) {
                                    break;
                                }
                            }

                        } elseif (self::fetch($tokens, T_AS)) {
                            $uses[self::fetch($tokens, T_STRING)] = $name;

                        } else {
                            $tmp = explode('\\', $name);
                            $uses[end($tmp)] = $name;
                        }
                        if (!self::fetch($tokens, ',')) {
                            break;
                        }
                    }
                    break;

                case T_CURLY_OPEN:
                case T_DOLLAR_OPEN_CURLY_BRACES:
                case '{':
                    $level++;
                    break;

                case '}':
                    if ($level === $classLevel) {
                        $class = $classLevel = null;
                    }
                    $level--;
            }
        }

        return $res;
    }

    private static function fetch(&$tokens, $take)
    {
        $res = null;
        while ($token = current($tokens)) {
            list($token, $s) = is_array($token) ? $token : array($token, $token);
            if (in_array($token, (array)$take, true)) {
                $res .= $s;
            } elseif (!in_array($token, array(T_DOC_COMMENT, T_WHITESPACE, T_COMMENT), true)) {
                break;
            }
            next($tokens);
        }
        return $res;
    }
}

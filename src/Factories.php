<?php

namespace Barryvdh\LaravelIdeHelper;

use Exception;
use Illuminate\Database\Eloquent\Factory;
use ReflectionClass;

class Factories
{
    public static function all()
    {
        $factories = [];

        if (static::isLaravel8()) {
            return $factories;
        }

        $factory = app(Factory::class);

        $definitions = (new ReflectionClass(Factory::class))->getProperty('definitions');
        $definitions->setAccessible(true);

        foreach ($definitions->getValue($factory) as $factory_target => $config) {
            try {
                $factories[] = new ReflectionClass($factory_target);
            } catch (Exception $exception) {
            }
        }

        return $factories;
    }

    protected static function isLaravel8(): bool
    {
        return version_compare(app()->version(), '8.0.0', '>=');
    }
}

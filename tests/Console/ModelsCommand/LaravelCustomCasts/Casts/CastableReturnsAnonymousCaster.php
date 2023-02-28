<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastableReturnsAnonymousCaster implements Castable
{
    public static function castUsing(array $arguments)
    {
        return new class() implements CastsAttributes {
            /**
             * @inheritDoc
             * @return CastedProperty
             */
            public function get($model, string $key, $value, array $attributes)
            {
                return new CastedProperty();
            }

            /**
             * @inheritDoc
             */
            public function set($model, string $key, $value, array $attributes)
            {
                // TODO: Implement set() method.
            }
        };
    }
}

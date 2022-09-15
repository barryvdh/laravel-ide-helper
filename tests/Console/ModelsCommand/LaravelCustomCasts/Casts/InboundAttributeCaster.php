<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;

class InboundAttributeCaster implements CastsInboundAttributes
{
    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
    }
}

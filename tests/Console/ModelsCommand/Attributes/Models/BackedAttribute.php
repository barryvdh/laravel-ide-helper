<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Attributes\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class BackedAttribute extends Model
{
    protected function name(): Attribute
    {
        return new Attribute(
            function (?string $name): ?string {
                return $name;
            },
            function (?string $name): ?string {
                return $name;
            }
        );
    }

    protected function nameRead(): Attribute
    {
        return new Attribute(
            function (?string $name): ?string {
                return $name;
            },
        );
    }

    protected function nameWrite(): Attribute
    {
        return new Attribute(
            set: function (?string $name): ?string {
                return $name;
            },
        );
    }

    protected function nonBackedSet(): Attribute
    {
        return new Attribute(
            set: function (?string $name): ?string {
                return $name;
            },
        );
    }

    protected function nonBackedGet(): Attribute
    {
        return new Attribute(
            get: function (): ?string {
                return 'test';
            },
        );
    }
}

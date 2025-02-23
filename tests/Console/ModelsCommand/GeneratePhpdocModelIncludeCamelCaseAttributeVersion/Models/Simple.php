<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocModelIncludeCamelCaseAttributeVersion\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use stdClass;

class Simple extends Model
{
    public function getIntValueAttribute(): int
    {
        return rand();
    }

    public function setIntValueAttribute(int $value): int
    {
        return $value;
    }

    public function stringValue(): Attribute
    {
        return new Attribute(
            get: fn (): string => Str::random(),
            set: fn (string $value): string => $value,
        );
    }
    public function getBoolValueAttribute(): bool
    {
        return (bool) rand(0, 1);
    }

    public function arrayValue(): Attribute
    {
        return new Attribute(
            get: fn (): array => [],
        );
    }

    public function setStdClassValueAttribute(stdClass $stdClass): stdClass
    {
        return $stdClass;
    }

    public function voidValue(): Attribute
    {
        return new Attribute(
            set: function (): void {
            }
        );
    }
}

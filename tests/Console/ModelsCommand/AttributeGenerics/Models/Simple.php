<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AttributeGenerics\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as EloquentAttribute;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    /**
     * @return Attribute<array<string, mixed>, never>
     */
    protected function arrayValue(): Attribute
    {
        return Attribute::get(fn (): array => ['hello' => 'world']);
    }

    /**
     * @return Attribute<array<string, list<int>>, never>
     */
    protected function nestedValue(): Attribute
    {
        return Attribute::get(fn (): array => ['numbers' => [1, 2]]);
    }

    /**
     * @return EloquentAttribute<array<int, Model>, never>
     */
    protected function modelsValue(): EloquentAttribute
    {
        return EloquentAttribute::get(fn (): array => [$this]);
    }

    /**
     * @return Attribute<array{label: 'left,right', values: list<int>}, never>
     */
    protected function shapeValue(): Attribute
    {
        return Attribute::get(fn (): array => ['label' => 'left,right', 'values' => [1, 2]]);
    }

    /**
     * @return Attribute<never, array<int, string>>
     */
    protected function writeValue(): Attribute
    {
        return Attribute::set(fn (array $value): array => ['value' => json_encode($value)]);
    }

    protected function plainValue(): Attribute
    {
        return Attribute::get(fn (): array => []);
    }
}

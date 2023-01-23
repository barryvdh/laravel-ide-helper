<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Castables;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CustomCaster implements CastsAttributes
{
    /** @var class-string The class to cast to. */
    private $castToClass;

    /**
     * Constructor.
     *
     * @param string $castToClass The class to cast to.
     * @return void
     */
    public function __construct(string $castToClass)
    {
        $this->castToClass = $castToClass;
    }

    /**
     * Transform the attribute from the underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new $this->castToClass($value);
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        /** @var ParentObject $value */
        return [$key => $value->getValue()];
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Castables;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;

/**
 * @ide-helper-eloquent-cast-to-specified-class
 */
class ParentObject implements Castable
{
    /** @var mixed The value that this Value object represents. */
    protected $value;

    /**
     * Constructor.
     *
     * @param mixed $value The value to represent.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
    /**
     * Retrieve the value stored in this Value object.
     *
     * @return mixed
     */
    public function getValue()
    {
        return mb_strtoupper($this->value);
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return string|CastsAttributes|CastsInboundAttributes
     */
    public static function castUsing(array $arguments): CastsAttributes
    {
        return new CustomCaster(static::class);
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Castables;

class ChildObject extends ParentObject
{
    /**
     * Retrieve the value stored in this Value object.
     *
     * @return mixed
     */
    public function getValue()
    {
        return mb_strtolower($this->value);
    }
}

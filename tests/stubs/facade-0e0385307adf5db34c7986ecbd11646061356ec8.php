<?php

declare(strict_types=1);

namespace Facades\Illuminate\Foundation\Exceptions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Foundation\Exceptions\Handler
 */
class Handler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Illuminate\Foundation\Exceptions\Handler';
    }
}

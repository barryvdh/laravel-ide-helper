<?php

declare(strict_types=1);

namespace Facades\App\Exceptions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Exceptions\Handler
 */
class Handler extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'App\Exceptions\Handler';
    }
}

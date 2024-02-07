<?php

namespace Barryvdh\LaravelIdeHelper\Database\Concerns;

use Barryvdh\LaravelIdeHelper\Database\PDOConnection;

/**
 * Migrated classes removed in Laravel 11 from Laravel 10.
 *
 * @see https://github.com/laravel/framework/blob/v10.43.0/src/Illuminate/Database/PDO/Concerns/ConnectsToDatabase.php
 */
trait ConnectsToDatabase
{
    public function connect(array $params)
    {
        return new PDOConnection($params['pdo']);
    }
}

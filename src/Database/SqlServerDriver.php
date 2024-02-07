<?php

namespace Barryvdh\LaravelIdeHelper\Database;

use Doctrine\DBAL\Driver\AbstractSQLServerDriver;

/**
 * Migrated classes removed in Laravel 11 from Laravel 10.
 *
 * @see https://github.com/laravel/framework/blob/v10.43.0/src/Illuminate/Database/PDO/SqlServerDriver.php
 */
class SqlServerDriver extends AbstractSQLServerDriver
{
    public function connect(array $params)
    {
        return new SqlServerConnection(
            new PDOConnection($params['pdo'])
        );
    }

    public function getName()
    {
        return 'pdo_sqlsrv';
    }
}

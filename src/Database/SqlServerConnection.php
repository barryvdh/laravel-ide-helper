<?php

namespace Barryvdh\LaravelIdeHelper\Database;

use Doctrine\DBAL\Driver\PDO\SQLSrv\Statement;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\Driver\ServerInfoAwareConnection;
use Doctrine\DBAL\Driver\Statement as StatementInterface;
use Doctrine\DBAL\ParameterType;
use PDO;

/**
 * Migrated classes removed in Laravel 11 from Laravel 10.
 *
 * @see https://github.com/laravel/framework/blob/v10.43.0/src/Illuminate/Database/PDO/SqlServerConnection.php
 */
class SqlServerConnection implements ServerInfoAwareConnection
{
    /**
     * The underlying connection instance.
     */
    protected PDOConnection $connection;

    /**
     * Create a new SQL Server connection instance.
     */
    public function __construct(PDOConnection $connection)
    {
        $this->connection = $connection;
    }

    public function prepare(string $sql): StatementInterface
    {
        return new Statement(
            $this->connection->prepare($sql)
        );
    }

    public function query(string $sql): Result
    {
        return $this->connection->query($sql);
    }

    public function exec(string $sql): int
    {
        return $this->connection->exec($sql);
    }

    public function lastInsertId($name = null)
    {
        if ($name === null) {
            return $this->connection->lastInsertId($name);
        }

        return $this->prepare('SELECT CONVERT(VARCHAR(MAX), current_value) FROM sys.sequences WHERE name = ?')
            ->execute([$name])
            ->fetchOne();
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    public function quote($value, $type = ParameterType::STRING)
    {
        $val = $this->connection->quote($value, $type);

        // Fix for a driver version terminating all values with null byte...
        if (is_string($val) && str_contains($val, "\0")) {
            $val = substr($val, 0, -1);
        }

        return $val;
    }

    public function getServerVersion()
    {
        return $this->connection->getServerVersion();
    }

    /**
     * Get the wrapped PDO connection.
     */
    public function getWrappedConnection(): PDO
    {
        return $this->connection->getWrappedConnection();
    }

    public function getNativeConnection()
    {
        //
    }
}

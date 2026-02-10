<?php

namespace Barryvdh\LaravelIdeHelper\Console\ModelsCommand;

use Illuminate\Database\Connection;

/**
 * Lazy-loading cache that bulk-prefetches all column and foreign key data
 * for an entire database on first access, reducing queries from 2N to 2
 * per database connection (where N is the number of models).
 */
class SchemaAggregator
{
    /** @var array<string, array<string, list<array<string, mixed>>>> */
    protected array $columns = [];

    /** @var array<string, array<string, list<array<string, mixed>>>> */
    protected array $foreignKeys = [];

    /** @var array<string, bool> */
    protected array $prefetched = [];

    /** @var array<string, bool> Connections where bulk prefetch is not supported */
    protected array $useFallback = [];

    /**
     * @return list<array<string, mixed>>
     */
    public function getColumns(Connection $connection, string $table): array
    {
        $connectionName = $connection->getName();

        if (!isset($this->prefetched[$connectionName])) {
            $this->prefetch($connection);
        }

        if (isset($this->useFallback[$connectionName])) {
            return $connection->getSchemaBuilder()->getColumns($table);
        }

        $prefixedTable = $connection->getTablePrefix() . $table;

        return $this->columns[$connectionName][$prefixedTable] ?? [];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getForeignKeys(Connection $connection, string $table): array
    {
        $connectionName = $connection->getName();

        if (!isset($this->prefetched[$connectionName])) {
            $this->prefetch($connection);
        }

        if (isset($this->useFallback[$connectionName])) {
            return $connection->getSchemaBuilder()->getForeignKeys($table);
        }

        $prefixedTable = $connection->getTablePrefix() . $table;

        return $this->foreignKeys[$connectionName][$prefixedTable] ?? [];
    }

    protected function prefetch(Connection $connection): void
    {
        $connectionName = $connection->getName();
        $this->prefetched[$connectionName] = true;
        $this->columns[$connectionName] = [];
        $this->foreignKeys[$connectionName] = [];

        $driver = $connection->getDriverName();

        match ($driver) {
            'mysql', 'mariadb' => $this->prefetchMysql($connection),
            'pgsql' => $this->prefetchPostgres($connection),
            'sqlsrv' => $this->prefetchSqlServer($connection),
            default => $this->useFallback[$connectionName] = true,
        };
    }

    protected function prefetchMysql(Connection $connection): void
    {
        $connectionName = $connection->getName();
        $schema = $connection->getDatabaseName();
        $grammar = $this->ensureSchemaGrammar($connection);
        $processor = $connection->getPostProcessor();

        // Bulk columns query - same as MySqlGrammar::compileColumns but without table_name filter
        $columnsSql = sprintf(
            'select table_name as `table_name`, column_name as `name`, data_type as `type_name`, column_type as `type`, '
            . 'collation_name as `collation`, is_nullable as `nullable`, '
            . 'column_default as `default`, column_comment as `comment`, '
            . 'generation_expression as `expression`, extra as `extra` '
            . 'from information_schema.columns where table_schema = %s '
            . 'order by table_name, ordinal_position asc',
            $schema ? $grammar->quoteString($schema) : 'schema()'
        );

        $this->groupAndCacheColumns($connection, $connectionName, $processor, $columnsSql);

        // Bulk foreign keys query - same as MySqlGrammar::compileForeignKeys but without table_name filter
        $fkSql = sprintf(
            'select kc.table_name as `table_name`, kc.constraint_name as `name`, '
            . 'group_concat(kc.column_name order by kc.ordinal_position) as `columns`, '
            . 'kc.referenced_table_schema as `foreign_schema`, '
            . 'kc.referenced_table_name as `foreign_table`, '
            . 'group_concat(kc.referenced_column_name order by kc.ordinal_position) as `foreign_columns`, '
            . 'rc.update_rule as `on_update`, '
            . 'rc.delete_rule as `on_delete` '
            . 'from information_schema.key_column_usage kc join information_schema.referential_constraints rc '
            . 'on kc.constraint_schema = rc.constraint_schema and kc.constraint_name = rc.constraint_name '
            . 'where kc.table_schema = %s and kc.referenced_table_name is not null '
            . 'group by kc.table_name, kc.constraint_name, kc.referenced_table_schema, kc.referenced_table_name, rc.update_rule, rc.delete_rule',
            $schema ? $grammar->quoteString($schema) : 'schema()'
        );

        $this->groupAndCacheForeignKeys($connection, $connectionName, $processor, $fkSql);
    }

    protected function prefetchPostgres(Connection $connection): void
    {
        $connectionName = $connection->getName();
        $processor = $connection->getPostProcessor();

        $serverVersion = $connection->getServerVersion();
        $generatedColumn = version_compare($serverVersion, '12.0', '<')
            ? "'' as generated"
            : 'a.attgenerated as generated';

        // Bulk columns query - same as PostgresGrammar::compileColumns but without table filter
        $columnsSql = sprintf(
            'select c.relname as table_name, a.attname as name, t.typname as type_name, format_type(a.atttypid, a.atttypmod) as type, '
            . '(select tc.collcollate from pg_catalog.pg_collation tc where tc.oid = a.attcollation) as collation, '
            . 'not a.attnotnull as nullable, '
            . '(select pg_get_expr(adbin, adrelid) from pg_attrdef where c.oid = pg_attrdef.adrelid and pg_attrdef.adnum = a.attnum) as default, '
            . '%s, '
            . 'col_description(c.oid, a.attnum) as comment '
            . 'from pg_attribute a, pg_class c, pg_type t, pg_namespace n '
            . 'where n.nspname = %s and a.attnum > 0 and a.attrelid = c.oid and a.atttypid = t.oid and n.oid = c.relnamespace '
            . "and c.relkind in ('r', 'v', 'm', 'p') "
            . 'order by c.relname, a.attnum',
            $generatedColumn,
            'current_schema()'
        );

        $this->groupAndCacheColumns($connection, $connectionName, $processor, $columnsSql);

        // Bulk foreign keys query - same as PostgresGrammar::compileForeignKeys but without table filter
        $fkSql = 'select tc.relname as table_name, c.conname as name, '
            . "string_agg(la.attname, ',' order by conseq.ord) as columns, "
            . 'fn.nspname as foreign_schema, fc.relname as foreign_table, '
            . "string_agg(fa.attname, ',' order by conseq.ord) as foreign_columns, "
            . 'c.confupdtype as on_update, c.confdeltype as on_delete '
            . 'from pg_constraint c '
            . 'join pg_class tc on c.conrelid = tc.oid '
            . 'join pg_namespace tn on tn.oid = tc.relnamespace '
            . 'join pg_class fc on c.confrelid = fc.oid '
            . 'join pg_namespace fn on fn.oid = fc.relnamespace '
            . 'join lateral unnest(c.conkey) with ordinality as conseq(num, ord) on true '
            . 'join pg_attribute la on la.attrelid = c.conrelid and la.attnum = conseq.num '
            . 'join pg_attribute fa on fa.attrelid = c.confrelid and fa.attnum = c.confkey[conseq.ord] '
            . "where c.contype = 'f' and tn.nspname = current_schema() "
            . 'group by tc.relname, c.conname, fn.nspname, fc.relname, c.confupdtype, c.confdeltype';

        $this->groupAndCacheForeignKeys($connection, $connectionName, $processor, $fkSql);
    }

    protected function prefetchSqlServer(Connection $connection): void
    {
        $connectionName = $connection->getName();
        $processor = $connection->getPostProcessor();

        // Bulk columns query - same as SqlServerGrammar::compileColumns but without table filter
        $columnsSql = 'select obj.name as table_name, col.name, type.name as type_name, '
            . 'col.max_length as length, col.precision as precision, col.scale as places, '
            . 'col.is_nullable as nullable, def.definition as [default], '
            . 'col.is_identity as autoincrement, col.collation_name as collation, '
            . 'com.definition as [expression], is_persisted as [persisted], '
            . 'cast(prop.value as nvarchar(max)) as comment '
            . 'from sys.columns as col '
            . 'join sys.types as type on col.user_type_id = type.user_type_id '
            . 'join sys.objects as obj on col.object_id = obj.object_id '
            . 'join sys.schemas as scm on obj.schema_id = scm.schema_id '
            . 'left join sys.default_constraints def on col.default_object_id = def.object_id and col.object_id = def.parent_object_id '
            . "left join sys.extended_properties as prop on obj.object_id = prop.major_id and col.column_id = prop.minor_id and prop.name = 'MS_Description' "
            . 'left join sys.computed_columns as com on col.column_id = com.column_id and col.object_id = com.object_id '
            . "where obj.type in ('U', 'V') and scm.name = schema_name() "
            . 'order by obj.name, col.column_id';

        $this->groupAndCacheColumns($connection, $connectionName, $processor, $columnsSql);

        // Bulk foreign keys query - same as SqlServerGrammar::compileForeignKeys but without table filter
        $fkSql = 'select lt.name as table_name, fk.name as name, '
            . "string_agg(lc.name, ',') within group (order by fkc.constraint_column_id) as columns, "
            . 'fs.name as foreign_schema, ft.name as foreign_table, '
            . "string_agg(fc.name, ',') within group (order by fkc.constraint_column_id) as foreign_columns, "
            . 'fk.update_referential_action_desc as on_update, '
            . 'fk.delete_referential_action_desc as on_delete '
            . 'from sys.foreign_keys as fk '
            . 'join sys.foreign_key_columns as fkc on fkc.constraint_object_id = fk.object_id '
            . 'join sys.tables as lt on lt.object_id = fk.parent_object_id '
            . 'join sys.schemas as ls on lt.schema_id = ls.schema_id '
            . 'join sys.columns as lc on fkc.parent_object_id = lc.object_id and fkc.parent_column_id = lc.column_id '
            . 'join sys.tables as ft on ft.object_id = fk.referenced_object_id '
            . 'join sys.schemas as fs on ft.schema_id = fs.schema_id '
            . 'join sys.columns as fc on fkc.referenced_object_id = fc.object_id and fkc.referenced_column_id = fc.column_id '
            . 'where ls.name = schema_name() '
            . 'group by lt.name, fk.name, fs.name, ft.name, fk.update_referential_action_desc, fk.delete_referential_action_desc';

        $this->groupAndCacheForeignKeys($connection, $connectionName, $processor, $fkSql);
    }

    /**
     * @return \Illuminate\Database\Schema\Grammars\Grammar
     */
    protected function ensureSchemaGrammar(Connection $connection)
    {
        $grammar = $connection->getSchemaGrammar();

        if ($grammar === null) {
            $connection->getSchemaBuilder();
            $grammar = $connection->getSchemaGrammar();
        }

        return $grammar;
    }

    /**
     * @param \Illuminate\Database\Query\Processors\Processor $processor
     */
    protected function groupAndCacheColumns(Connection $connection, string $connectionName, $processor, string $sql): void
    {
        $rows = $connection->selectFromWriteConnection($sql);
        $grouped = [];

        foreach ($rows as $row) {
            $row = (array) $row;
            $tableName = $row['table_name'];
            unset($row['table_name']);
            $grouped[$tableName][] = $row;
        }

        foreach ($grouped as $tableName => $tableRows) {
            $this->columns[$connectionName][$tableName] = $processor->processColumns($tableRows);
        }
    }

    /**
     * @param \Illuminate\Database\Query\Processors\Processor $processor
     */
    protected function groupAndCacheForeignKeys(Connection $connection, string $connectionName, $processor, string $sql): void
    {
        $rows = $connection->selectFromWriteConnection($sql);
        $grouped = [];

        foreach ($rows as $row) {
            $row = (array) $row;
            $tableName = $row['table_name'];
            unset($row['table_name']);
            $grouped[$tableName][] = $row;
        }

        foreach ($grouped as $tableName => $tableRows) {
            $this->foreignKeys[$connectionName][$tableName] = $processor->processForeignKeys($tableRows);
        }
    }
}

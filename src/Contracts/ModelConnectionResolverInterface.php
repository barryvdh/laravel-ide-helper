<?php

namespace Barryvdh\LaravelIdeHelper\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Implement this interface to resolve/configure the database connection
 * before ide-helper introspects a model's table columns.
 *
 * This is useful for multi-tenant setups where the connection or schema
 * must be configured per-model before the SchemaBuilder runs.
 */
interface ModelConnectionResolverInterface
{
    /**
     * Called before getPropertiesFromTable() for each model.
     * Use this to set the correct connection, search_path, or tenant context.
     *
     * @param  Model  $model  The model instance about to be introspected
     * @return void
     */
    public function resolve(Model $model): void;

    /**
     * Called after getPropertiesFromTable() finishes for the model.
     * Use this to revert any connection changes made in resolve().
     *
     * @param  Model  $model
     * @return void
     */
    public function after(Model $model): void;
}

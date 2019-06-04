<?php


namespace Barryvdh\LaravelIdeHelper\Listeners;

class RecordMigrationQueries
{
    /**
     * Enable query recording
     *
     * @return void
     */
    public function handle()
    {
        if (app()->has('migration-query-recorder')) {
            app()->make('migration-query-recorder')->setRecording(true);
        }
    }
}

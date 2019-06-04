<?php


namespace Barryvdh\LaravelIdeHelper\Listeners;

use Barryvdh\LaravelIdeHelper\MigrationQueryRecorder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Output\StreamOutput;

class UpdateAffectedModels
{
    /**
     * Enable query recording
     *
     * @return void
     */
    public function handle()
    {
        if (app()->has('migration-query-recorder')) {
            /** @var MigrationQueryRecorder $recorder */
            $recorder = app()->make('migration-query-recorder');
            $recorder->setRecording(false);
            $affectedModels = $recorder->getAffectedModels();
            if ($affectedModels->isNotEmpty()) {
                $output = new StreamOutput(STDOUT);
                $params = array_merge(Config::get('ide-helper.automatic_model_updates.options'), [
                    'model' => $affectedModels->toArray()
                ]);
                Artisan::call('ide-helper:models', $params, $output);
            }
        }
    }
}

<?php

namespace Barryvdh\LaravelIdeHelper\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Artisan;

class GenerateHelpers
{
    /**
     * Handle the event.
     *
     * @param  CommandFinished  $event
     * @return void
     */
    public function handle(CommandFinished $event)
    {
        switch ($event->command) {
            case "package:discover":
                Artisan::call('ide-helper:generate', [], $event->output);
                break;
            case "migrate":
            case "migrate:rollback":
                Artisan::call('ide-helper:models', ['--no-write'], $event->output);
                break;
        }
    }
}

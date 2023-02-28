<?php

namespace Barryvdh\LaravelIdeHelper\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Console\Kernel as Artisan;

class GenerateModelHelper
{
    /**
     * Tracks whether we should run the models command on the CommandFinished event or not.
     * Set to true by the MigrationsEnded event, needs to be cleared before artisan call to prevent infinite loop.
     *
     * @var bool
     */
    public static $shouldRun = false;

    /** @var \Illuminate\Contracts\Console\Kernel */
    protected $artisan;

    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    /**
     * @param  \Illuminate\Contracts\Console\Kernel  $artisan
     * @param  \Illuminate\Contracts\Config\Repository  $config
     */
    public function __construct(Artisan $artisan, Config $config)
    {
        $this->artisan = $artisan;
        $this->config = $config;
    }

    /**
     * Handle the event.
     *
     * @param  CommandFinished  $event
     */
    public function handle(CommandFinished $event)
    {
        if (!self::$shouldRun) {
            return;
        }

        self::$shouldRun = false;

        foreach ($this->config->get('ide-helper.post_migrate', []) as $command) {
            $this->artisan->call($command, [], $event->output);
        }
    }
}

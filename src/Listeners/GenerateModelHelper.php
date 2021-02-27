<?php

namespace Barryvdh\LaravelIdeHelper\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Console\Kernel as Artisan;

class GenerateModelHelper
{
    /** @var bool */
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

        $parameters = $this->config->get('ide-helper.post_migrate');
        $this->artisan->call(
            is_array($parameters) ? 'ide-helper:models' : 'ide-helper:models ' . $parameters,
            is_array($parameters) ? $parameters : [],
            $event->output,
        );
    }
}

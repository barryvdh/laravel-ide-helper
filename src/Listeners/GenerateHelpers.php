<?php

namespace Barryvdh\LaravelIdeHelper\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Console\Kernel as Artisan;

class GenerateHelpers
{
    /** @var \Illuminate\Contracts\Console\Kernel */
    protected $artisan;

    /** @var \Illuminate\Config\Repository */
    protected $config;

    /**
     * @param \Illuminate\Contracts\Console\Kernel $artisan
     * @param \Illuminate\Config\Repository $config
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
        switch ($event->command) {
            case "package:discover":
                $this->generate('generate', $event->output);
                break;
            case "migrate":
            case "migrate:rollback":
                $this->generate('models', $event->output);
                break;
        }
    }

    /**
     * Run an "ide-helper:..." command.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface
     */
    protected function generate($command, $output)
    {
        $parameters = $this->config->get(
            'ide-helper.listen_'.$command.'_parameters',
                array()
        );

        if ($parameters === false) {
            return;
        }

        $this->artisan->call('ide-helper:'.$command, $parameters, $output);
    }
}

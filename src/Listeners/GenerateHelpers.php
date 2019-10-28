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
                $this->generateHelper($event->output);
                break;
            case "migrate":
            case "migrate:rollback":
                $this->generateModels($event->output);
                break;
        }
    }

    /**
     * Run "ide-helper:generate" command.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface
     */
    protected function generateHelper($output)
    {
        $this->artisan->call(
            'ide-helper:generate',
            $this->config->get(
                'ide-helper.listen_generate_parameters',
                array()
            ),
            $output
        );
    }

    /**
     * Run "ide-helper:models" command.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface
     */
    protected function generateModels($output)
    {
        $this->artisan->call(
            'ide-helper:models',
            $this->config->get(
                'ide-helper.listen_models_parameters',
                array()
            ),
            $output
        );
    }
}

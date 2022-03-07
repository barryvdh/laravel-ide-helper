<?php

namespace Barryvdh\LaravelIdeHelper\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Console\Kernel as Artisan;

class GenerateHelperAndMeta
{
    /** @var \Illuminate\Contracts\Console\Kernel */
    protected $artisan;

    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    /**
     * @param \Illuminate\Contracts\Console\Kernel    $artisan
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Artisan $artisan, Config $config)
    {
        $this->artisan = $artisan;
        $this->config  = $config;
    }

    /**
     * Handle the event.
     *
     * @param CommandFinished $event
     */
    public function handle(CommandFinished $event)
    {
        if ($this->shouldntRun($event)) {
            return;
        }

        foreach ($this->config->get('ide-helper.post_discover', []) as $command) {
            $this->artisan->call($command, [], $event->output);
        }
    }

    /**
     * Decides whether the helper generation should be skipped or not.
     * 
     * It should be skipped if the executed command failed, was not
     * `package:discover`, or a no-op parameter is present.
     *
     * @param CommandFinished $event
     * @return bool
     */
    protected function shouldntRun(CommandFinished $event): bool
    {
        return $event->exitCode != 0 ||
            $event->command != 'package:discover' ||
            $event->input->hasParameterOption(['--version', '-V'], true) ||
            $event->input->hasParameterOption(['--help', '-h'], true);
    }
}

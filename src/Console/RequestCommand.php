<?php

namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\Request;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RequestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:request';

    /**
     * @var Filesystem $files
     */
    protected Filesystem $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add \Request helper to \Illuminate\Http\Request';

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $outputPath = base_path('_ide_helper_requests.php');
        Request::writeRequestHelper($this, $this->files, $outputPath);
    }
}

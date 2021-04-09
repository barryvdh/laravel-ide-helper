<?php

/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2015 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\Factories;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * A command to generate phpstorm meta data
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
class MetaCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ide-helper:meta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate metadata for PhpStorm';

    /** @var \Illuminate\Contracts\Filesystem\Filesystem */
    protected $files;

    /** @var \Illuminate\Contracts\View\Factory */
    protected $view;

    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    protected $methods = [
      'new \Illuminate\Contracts\Container\Container',
      '\Illuminate\Container\Container::makeWith(0)',
      '\Illuminate\Contracts\Container\Container::get(0)',
      '\Illuminate\Contracts\Container\Container::make(0)',
      '\Illuminate\Contracts\Container\Container::makeWith(0)',
      '\App::get(0)',
      '\App::make(0)',
      '\App::makeWith(0)',
      '\app(0)',
      '\resolve(0)',
      '\Psr\Container\ContainerInterface::get(0)',
    ];

    /**
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $files
     * @param \Illuminate\Contracts\View\Factory $view
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct($files, $view, $config)
    {
        $this->files = $files;
        $this->view = $view;
        $this->config = $config;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Needs to run before exception handler is registered
        $factories = $this->config->get('ide-helper.include_factory_builders') ? Factories::all() : [];

        $ourAutoloader = $this->registerClassAutoloadExceptions();

        $bindings = [];
        foreach ($this->getAbstracts() as $abstract) {
            // Validator and seeder cause problems
            if (in_array($abstract, ['validator', 'seeder'])) {
                continue;
            }

            try {
                $concrete = $this->laravel->make($abstract);
                $reflectionClass = new \ReflectionClass($concrete);
                if (is_object($concrete) && !$reflectionClass->isAnonymous()) {
                    $bindings[$abstract] = get_class($concrete);
                }
            } catch (\Throwable $e) {
                if ($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                    $this->comment("Cannot make '$abstract': " . $e->getMessage());
                }
            }
        }

        $this->unregisterClassAutoloadExceptions($ourAutoloader);

        $content = $this->view->make('meta', [
          'bindings' => $bindings,
          'methods' => $this->methods,
          'factories' => $factories,
        ])->render();

        $filename = $this->option('filename');
        $written = $this->files->put($filename, $content);

        if ($written !== false) {
            $this->info("A new meta file was written to $filename");
        } else {
            $this->error("The meta file could not be created at $filename");
        }
    }

    /**
     * Get a list of abstracts from the Laravel Application.
     *
     * @return array
     */
    protected function getAbstracts()
    {
        $abstracts = $this->laravel->getBindings();

        // Return the abstract names only
        $keys = array_keys($abstracts);

        sort($keys);

        return $keys;
    }

    /**
     * Register an autoloader the throws exceptions when a class is not found.
     *
     * @return callable
     */
    protected function registerClassAutoloadExceptions(): callable
    {
        $autoloader = function ($class) {
            throw new \ReflectionException("Class '$class' not found.");
        };
        spl_autoload_register($autoloader);
        return $autoloader;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $filename = $this->config->get('ide-helper.meta_filename');

        return [
            ['filename', 'F', InputOption::VALUE_OPTIONAL, 'The path to the meta file', $filename],
        ];
    }

    /**
     * Remove our custom autoloader that we pushed onto the autoload stack
     *
     * @param callable $ourAutoloader
     */
    private function unregisterClassAutoloadExceptions(callable $ourAutoloader): void
    {
        spl_autoload_unregister($ourAutoloader);
    }
}

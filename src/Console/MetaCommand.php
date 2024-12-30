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
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use RuntimeException;
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

    /** @var Factory */
    protected $view;

    /** @var Repository */
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

    protected $configMethods = [
        '\config()',
        '\Illuminate\Config\Repository::get()',
        '\Illuminate\Config\Repository::set()',
        '\Illuminate\Support\Facades\Config::get()',
        '\Illuminate\Support\Facades\Config::set()',
    ];

    protected $userMethods = [
        '\auth()->user()',
        '\Illuminate\Contracts\Auth\Guard::user()',
        '\Illuminate\Support\Facades\Auth::user()',
        '\request()->user()',
        '\Illuminate\Http\Request::user()',
        '\Illuminate\Support\Facades\Request::user()',
    ];

    protected $templateCache = [];

    /**
     *
     * @param Filesystem $files
     * @param Factory $view
     * @param Repository $config
     */
    public function __construct(
        Filesystem $files,
        Factory $view,
        Repository $config
    ) {
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

                if ($concrete === null) {
                    throw new RuntimeException("Cannot create instance for '$abstract', received 'null'");
                }

                $reflectionClass = new \ReflectionClass($concrete);
                if (is_object($concrete) && !$reflectionClass->isAnonymous() && $abstract !== get_class($concrete)) {
                    $bindings[$abstract] = get_class($concrete);
                }
            } catch (\Throwable $e) {
                if ($this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                    $this->comment("Cannot make '$abstract': " . $e->getMessage());
                }
            }
        }

        $this->unregisterClassAutoloadExceptions($ourAutoloader);

        $configValues = $this->loadTemplate('configs')->pluck('value', 'name')->map(function ($value, $key) {
            return gettype($value);
        });

        $defaultUserModel = $this->config->get('auth.providers.users.model', $this->config->get('auth.model', 'App\User'));

        $content = $this->view->make('ide-helper::meta', [
            'bindings' => $bindings,
            'methods' => $this->methods,
            'factories' => $factories,
            'configMethods' => $this->configMethods,
            'configValues' => $configValues,
            'expectedArgumentSets' => $this->getExpectedArgumentSets(),
            'expectedArguments' => $this->getExpectedArguments(),
            'userModel' => $defaultUserModel,
            'userMethods' => $this->userMethods,
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

    protected function getExpectedArgumentSets()
    {
        return [
            'configs' => $this->loadTemplate('configs')->pluck('name')->filter()->toArray(),
            'routes' => $this->loadTemplate('routes')->pluck('name')->filter()->toArray(),
            'views' => $this->loadTemplate('views')->pluck('key')->filter()->map(function ($value) {
                return (string) $value;
            })->toArray(),
            'translations' => $this->loadTemplate('translations')->filter()->keys()->toArray(),
        ];
    }

    protected function getExpectedArguments()
    {
        return [
            '\config()' => [
                0 => 'configs',
            ],
            '\Illuminate\Config\Repository::get()' => [
                0 => 'configs',
            ],
            '\Illuminate\Config\Repository::set()' => [
                0 => 'configs',
            ],
            '\Illuminate\Support\Facades\Config::get()' => [
                0 => 'configs',
            ],
            '\Illuminate\Support\Facades\Config::set()' => [
                0 => 'configs',
            ],
            '\route()' => [
                0 => 'routes',
            ],
            '\Illuminate\Support\Facades\Route::get()' => [
                0 => 'routes',
            ],
            '\Illuminate\Routing\Router::get()' => [
                0 => 'routes',
            ],
            '\view()' => [
                0 => 'views',
            ],
            '\Illuminate\Support\Facades\View::make()' => [
                0 => 'views',
            ],
            '\Illuminate\View\Factory::make()' => [
                0 => 'views',
            ],
            '\__()' => [
                0 => 'translations',
            ],
            '\trans()' => [
                0 => 'translations',
            ],
            '\Illuminate\Contracts\Translation\Translator::get()' => [
                0 => 'translations',
            ],
        ];
    }

    /**
     * @return Collection
     */
    protected function loadTemplate($name)
    {
        if (!isset($this->templateCache[$name])) {
            $file =  __DIR__ . '/../../php-templates/' . basename($name) . '.php';
            $value = $this->files->requireOnce($file) ?: [];
            if (!$value instanceof Collection) {
                $value = collect($value);
            }
            $this->templateCache[$name] = $value;
        }

        return $this->templateCache[$name];
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

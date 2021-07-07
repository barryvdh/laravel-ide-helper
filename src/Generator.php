<?php

/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2014 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use ReflectionClass;
use Symfony\Component\Console\Output\OutputInterface;

class Generator
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    /** @var \Illuminate\View\Factory */
    protected $view;

    /** @var \Symfony\Component\Console\Output\OutputInterface */
    protected $output;

    protected $extra = [];
    protected $magic = [];
    protected $interfaces = [];
    protected $helpers;

    /**
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\View\Factory $view
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param string $helpers
     */
    public function __construct(
        /*ConfigRepository */
        $config,
        /* Illuminate\View\Factory */
        $view,
        OutputInterface $output = null,
        $helpers = ''
    ) {
        $this->config = $config;
        $this->view = $view;

        // Find the drivers to add to the extra/interfaces
        $this->detectDrivers();

        $this->extra = array_merge($this->extra, $this->config->get('ide-helper.extra'), []);
        $this->magic = array_merge($this->magic, $this->config->get('ide-helper.magic'), []);
        $this->interfaces = array_merge($this->interfaces, $this->config->get('ide-helper.interfaces'), []);
        // Make all interface classes absolute
        foreach ($this->interfaces as &$interface) {
            $interface = '\\' . ltrim($interface, '\\');
        }
        $this->helpers = $helpers;
    }

    /**
     * Generate the helper file contents;
     *
     * @return string;
     */
    public function generate()
    {
        $app = app();
        return $this->view->make('helper')
            ->with('namespaces_by_extends_ns', $this->getAliasesByExtendsNamespace())
            ->with('namespaces_by_alias_ns', $this->getAliasesByAliasNamespace())
            ->with('helpers', $this->helpers)
            ->with('version', $app->version())
            ->with('include_fluent', $this->config->get('ide-helper.include_fluent', true))
            ->with('factories', $this->config->get('ide-helper.include_factory_builders') ? Factories::all() : [])
            ->render();
    }

    protected function detectDrivers()
    {
        $defaultUserModel = config('auth.providers.users.model', config('auth.model', 'App\User'));
        $this->interfaces['\Illuminate\Contracts\Auth\Authenticatable'] = $defaultUserModel;

        try {
            if (
                class_exists('Auth') && is_a('Auth', '\Illuminate\Support\Facades\Auth', true)
                && app()->bound('auth')
            ) {
                $class = get_class(\Auth::guard());
                $this->extra['Auth'] = [$class];
                $this->interfaces['\Illuminate\Auth\UserProviderInterface'] = $class;
            }
        } catch (\Exception $e) {
        }

        try {
            if (class_exists('DB') && is_a('DB', '\Illuminate\Support\Facades\DB', true)) {
                $class = get_class(\DB::connection());
                $this->extra['DB'] = [$class];
                $this->interfaces['\Illuminate\Database\ConnectionInterface'] = $class;
            }
        } catch (\Exception $e) {
        }

        try {
            if (class_exists('Cache') && is_a('Cache', '\Illuminate\Support\Facades\Cache', true)) {
                $driver = get_class(\Cache::driver());
                $store = get_class(\Cache::getStore());
                $this->extra['Cache'] = [$driver, $store];
                $this->interfaces['\Illuminate\Cache\StoreInterface'] = $store;
            }
        } catch (\Exception $e) {
        }

        try {
            if (class_exists('Queue') && is_a('Queue', '\Illuminate\Support\Facades\Queue', true)) {
                $class = get_class(\Queue::connection());
                $this->extra['Queue'] = [$class];
                $this->interfaces['\Illuminate\Queue\QueueInterface'] = $class;
            }
        } catch (\Exception $e) {
        }

        try {
            if (class_exists('SSH') && is_a('SSH', '\Illuminate\Support\Facades\SSH', true)) {
                $class = get_class(\SSH::connection());
                $this->extra['SSH'] = [$class];
                $this->interfaces['\Illuminate\Remote\ConnectionInterface'] = $class;
            }
        } catch (\Exception $e) {
        }

        try {
            if (class_exists('Storage') && is_a('Storage', '\Illuminate\Support\Facades\Storage', true)) {
                $class = get_class(\Storage::disk());
                $this->extra['Storage'] = [$class];
                $this->interfaces['\Illuminate\Contracts\Filesystem\Filesystem'] = $class;
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * Find all aliases that are valid for us to render
     *
     * @return Collection
     */
    protected function getValidAliases()
    {
        $aliases = new Collection();

        // Get all aliases
        foreach ($this->getAliases() as $name => $facade) {
            // Skip the Redis facade, if not available (otherwise Fatal PHP Error)
            if ($facade == 'Illuminate\Support\Facades\Redis' && $name == 'Redis' && !class_exists('Predis\Client')) {
                continue;
            }

            $magicMethods = array_key_exists($name, $this->magic) ? $this->magic[$name] : [];
            $alias = new Alias($this->config, $name, $facade, $magicMethods, $this->interfaces);
            if ($alias->isValid()) {
                //Add extra methods, from other classes (magic static calls)
                if (array_key_exists($name, $this->extra)) {
                    $alias->addClass($this->extra[$name]);
                }

                $aliases[] = $alias;
            }
        }

        return $aliases;
    }

    /**
     * Regroup aliases by namespace of extended classes
     *
     * @return Collection
     */
    protected function getAliasesByExtendsNamespace()
    {
        $aliases = $this->getValidAliases();

        $this->addMacroableClasses($aliases);

        return $aliases->groupBy(function (Alias $alias) {
            return $alias->getExtendsNamespace();
        });
    }

    /**
     * Regroup aliases by namespace of alias
     *
     * @return Collection
     */
    protected function getAliasesByAliasNamespace()
    {
        return $this->getValidAliases()->groupBy(function (Alias $alias) {
            return $alias->getNamespace();
        });
    }

    protected function getAliases()
    {
        // For Laravel, use the AliasLoader
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            return AliasLoader::getInstance()->getAliases();
        }

        $facades = [
          'App' => 'Illuminate\Support\Facades\App',
          'Auth' => 'Illuminate\Support\Facades\Auth',
          'Bus' => 'Illuminate\Support\Facades\Bus',
          'DB' => 'Illuminate\Support\Facades\DB',
          'Cache' => 'Illuminate\Support\Facades\Cache',
          'Cookie' => 'Illuminate\Support\Facades\Cookie',
          'Crypt' => 'Illuminate\Support\Facades\Crypt',
          'Event' => 'Illuminate\Support\Facades\Event',
          'Hash' => 'Illuminate\Support\Facades\Hash',
          'Log' => 'Illuminate\Support\Facades\Log',
          'Mail' => 'Illuminate\Support\Facades\Mail',
          'Queue' => 'Illuminate\Support\Facades\Queue',
          'Request' => 'Illuminate\Support\Facades\Request',
          'Schema' => 'Illuminate\Support\Facades\Schema',
          'Session' => 'Illuminate\Support\Facades\Session',
          'Storage' => 'Illuminate\Support\Facades\Storage',
          'Validator' => 'Illuminate\Support\Facades\Validator',
          'Gate' => 'Illuminate\Support\Facades\Gate',
        ];

        $facades = array_merge($facades, $this->config->get('app.aliases', []));

        // Only return the ones that actually exist
        return array_filter(
            $facades,
            function ($alias) {
                return class_exists($alias);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Write a string as error output.
     *
     * @param  string  $string
     * @return void
     */
    protected function error($string)
    {
        if ($this->output) {
            $this->output->writeln("<error>$string</error>");
        } else {
            echo $string . "\r\n";
        }
    }

    /**
     * Add all macroable classes which are not already loaded as an alias and have defined macros.
     *
     * @param Collection $aliases
     */
    protected function addMacroableClasses(Collection $aliases)
    {
        $macroable = $this->getMacroableClasses($aliases);

        foreach ($macroable as $class) {
            $reflection = new ReflectionClass($class);

            if (!$reflection->getStaticProperties()['macros']) {
                continue;
            }

            $aliases[] = new Alias($this->config, $class, $class, [], $this->interfaces);
        }
    }

    /**
     * Get all loaded macroable classes which are not loaded as an alias.
     *
     * @param Collection $aliases
     * @return Collection
     */
    protected function getMacroableClasses(Collection $aliases)
    {
        return (new Collection(get_declared_classes()))
            ->filter(function ($class) {
                $reflection = new ReflectionClass($class);

                // Filter out internal classes and class aliases
                return !$reflection->isInternal() && $reflection->getName() === $class;
            })
            ->filter(function ($class) {
                $traits = class_uses_recursive($class);

                // Filter only classes with the macroable trait
                return isset($traits[Macroable::class]);
            })
            ->filter(function ($class) use ($aliases) {
                $class = Str::start($class, '\\');

                // Filter out aliases
                return !$aliases->first(function (Alias $alias) use ($class) {
                    return $alias->getExtends() === $class;
                });
            });
    }
}

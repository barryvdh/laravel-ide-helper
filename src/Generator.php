<?php
/**
 * Laravel IDE Helper Generator
 *
 * @author    Barry vd. Heuvel <barryvdh@gmail.com>
 * @copyright 2013 Barry vd. Heuvel / Fruitcake Studio (http://www.fruitcakestudio.nl)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/barryvdh/laravel-ide-helper
 */

namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Config\Repository as ConfigRepository;

class Generator
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    /** @var \Illuminate\View\Factory */
    protected $view;

    protected $extra;
    protected $magic;
    protected $helpers;

    /**
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\View\Factory $view
     * @param string $helpers
     */
    public function __construct(ConfigRepository $config,
        /* Illuminate\View\Factory */ $view,
        $helpers = ''
    ) {
        $this->config = $config;
        $this->view = $view;
        $this->extra = $this->config->get('laravel-ide-helper::extra');
        $this->magic = $this->config->get('laravel-ide-helper::magic');
        $this->interfaces = $this->config->get('laravel-ide-helper::interfaces');
        $this->helpers = $helpers;
    }

    /**
     * Generate the helper file contents;
     *
     * @return string;
     */
    public function generate()
    {
        return $this->view->make('laravel-ide-helper::ide-helper')
            ->with('namespaces', $this->getNamespaces())
            ->with('helpers', $this->helpers)
            ->render();

    }

    /**
     * Find all namespaces/aliases that are valid for us to render
     *
     * @return array
     */
    protected function getNamespaces()
    {
        $namespaces = array();

        // Get all aliases
        foreach (AliasLoader::getInstance()->getAliases() as $name => $facade) {
            $magicMethods = array_key_exists($name, $this->magic) ? $this->magic[$name] : array();
            $alias = new Alias($name, $facade, $magicMethods, $this->interfaces);

            if ($alias->isValid()) {

                $driver = $this->getDriver($name);
                if ($driver) {
                    $alias->addClass($driver);
                }

                //Add extra methods, from other classes (magic static calls)
                if (array_key_exists($name, $this->extra)) {
                    $alias->addClass($this->extra[$name]);
                }

                $namespace = $alias->getNamespace();
                if (!isset($namespaces[$namespace])) {
                    $namespaces[$namespace] = array();
                }
                $namespaces[$namespace][] = $alias;
            }

        }

        return $namespaces;
    }

    /**
     * Get the driver/connection/store from the managers
     *
     * @param $alias
     * @return array|bool|string
     */
    public function getDriver($alias)
    {
        try {
            if ($alias == "Auth") {
                $driver = \Auth::driver();
            } elseif ($alias == "DB") {
                $driver = \DB::connection();
            } elseif ($alias == "Cache") {
                $driver = get_class(\Cache::driver());
                $store = get_class(\Cache::getStore());
                return array($driver, $store);
            } elseif ($alias == "Queue") {
                $driver = \Queue::connection();
            } else {
                return false;
            }

            return get_class($driver);
        } catch (\Exception $e) {
            $this->error("Could not determine driver/connection for $alias.");
            return false;
        }
    }

}

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

use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\Console\MetaCommand;
use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;

class IdeHelperServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('barryvdh/laravel-ide-helper', 'laravel-ide-helper', __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.ide-helper.generate'] = $this->app->share(
            function ($app) {
                return new GeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app['command.ide-helper.models'] = $this->app->share(
            function () {
                return new ModelsCommand();
            }
        );
        
        $this->app['command.ide-helper.meta'] = $this->app->share(
          function ($app) {
              return new MetaCommand($app['files'], $app['view']);
          }
        );

        $this->commands('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('command.ide-helper.generate', 'command.ide-helper.models');
    }
    
    /**
     * Register the package's component namespaces.
     *
     * @param  string  $package
     * @param  string  $namespace
     * @param  string  $path
     * @return void
     */
    public function package($package, $namespace = null, $path = null)
    {

        // Is it possible to register the config?
        if (method_exists($this->app['config'], 'package')) {
            $this->app['config']->package($package, $path.'/config', $namespace);
        } else {
            // Load the config for now..
            $config = $this->app['files']->getRequire($path .'/config/config.php');
            foreach($config as $key => $value){
                $this->app['config']->set($namespace.'::'.$key, $value);
            }
        }

        // Register view files
        $appView = $this->app['path']."/views/packages/{$package}";
        if ($this->app['files']->isDirectory($appView))
        {
            $this->app['view']->addNamespace($namespace, $appView);
        }

        $this->app['view']->addNamespace($namespace, $path.'/views');
    }

}

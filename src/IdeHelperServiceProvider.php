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
        $viewPath = __DIR__.'/../resources/views';
        $this->loadViewsFrom($viewPath, 'ide-helper');
        
        $configPath = __DIR__ . '/../config/ide-helper.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('ide-helper.php');
        } else {
            $publishPath = base_path('config/ide-helper.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/ide-helper.php';
        $this->mergeConfigFrom($configPath, 'ide-helper');
        
        $this->app['command.ide-helper.generate'] = $this->app->share(
            function ($app) {
                return new GeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app['command.ide-helper.models'] = $this->app->share(
            function ($app) {
                return new ModelsCommand($app['files']);
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
}

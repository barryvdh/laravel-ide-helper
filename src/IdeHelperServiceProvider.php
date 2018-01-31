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

/**
 * @property \Illuminate\Container\Container $app
 */
class IdeHelperServiceProvider extends ServiceProvider
{

    /**
     * {@inheritdoc}
     */
    protected $defer = true;

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->package('barryvdh/laravel-ide-helper', 'laravel-ide-helper', __DIR__);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app['command.ide-helper.generate'] = $this->app->share(
            function ($app) {
                return new GeneratorCommand($app['config'], $app['files'], $app['view']);
            }
        );

        $this->app['command.ide-helper.models'] = $this->app->share(
            function ($app) {
                return new ModelsCommand($app);
            }
        );

        $this->app['command.ide-helper.meta'] = $this->app->share(
            function ($app) {
                return new MetaCommand($app);
            }
        );

        $this->commands('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta');
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta');
    }

    /**
     * {@inheritdoc}
     */
    protected function getAppViewPath($package, $namespace = null)
    {
        return $this->app['path'] . "/views/packages/{$package}";
    }

}

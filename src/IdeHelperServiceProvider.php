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

use Barryvdh\LaravelIdeHelper\Console\EloquentCommand;
use Barryvdh\LaravelIdeHelper\Console\GeneratorCommand;
use Barryvdh\LaravelIdeHelper\Console\MetaCommand;
use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Listeners\GenerateModelHelper;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class IdeHelperServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningUnitTests() && $this->app['config']->get('ide-helper.post_migrate', [])) {
            $this->app['events']->listen(CommandFinished::class, GenerateModelHelper::class);
            $this->app['events']->listen(MigrationsEnded::class, function () {
                GenerateModelHelper::$shouldRun = true;
            });
        }

        if ($this->app->has('view')) {
            $viewPath = __DIR__ . '/../resources/views';
            $this->loadViewsFrom($viewPath, 'ide-helper');
        }

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

        $this->app->when([GeneratorCommand::class, MetaCommand::class, ModelsCommand::class])
            ->needs(\Illuminate\Contracts\View\Factory::class)
            ->give(function () {
                return $this->createLocalViewFactory();
            });

        $this->commands(
            [
                GeneratorCommand::class,
                ModelsCommand::class,
                MetaCommand::class,
                EloquentCommand::class,
             ]
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            GeneratorCommand::class,
            ModelsCommand::class,
            MetaCommand::class,
            EloquentCommand::class,
        ];
    }

    /**
     * @return Factory
     */
    private function createLocalViewFactory()
    {
        $resolver = new EngineResolver();
        $resolver->register('php', function () {
            return new PhpEngine($this->app['files']);
        });
        $finder = new FileViewFinder($this->app['files'], [__DIR__ . '/../resources/views']);
        $factory = new Factory($resolver, $finder, $this->app['events']);
        $factory->addExtension('php', 'php');

        return $factory;
    }
}

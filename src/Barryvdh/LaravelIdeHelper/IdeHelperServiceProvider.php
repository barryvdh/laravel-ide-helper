<?php namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Support\ServiceProvider;

class IdeHelperServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('barryvdh/laravel-ide-helper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $this->app['command.ide-helper.generate'] = $this->app->share(function($app)
        {
            return new GeneratorCommand;
        });
        $this->commands('command.ide-helper.generate');

        $this->app['command.ide-helper.models'] = $this->app->share(function($app)
            {
                return new ModelsCommand();
            });
        $this->commands('command.ide-helper.models');
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

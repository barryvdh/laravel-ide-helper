<?php

// Register The Composer Auto Loader
require __DIR__ . '/vendor/autoload.php';

// Setup Patchwork UTF-8 Handling

// Register The Laravel Auto Loader

// Create The Application
if (!class_exists('Illuminate\Foundation\Application', false)) {
    eval('namespace Illuminate\Foundation { class Application extends \Illuminate\Container\Container { public function booted() { } } }');
}
$mocker = new PHPUnit_Framework_MockObject_Generator;
/** @var PHPUnit_Framework_MockObject_MockObject|Illuminate\Container\Container $app */
$app = $mocker->getMock('Illuminate\Foundation\Application', array(), array(), '', true, true, true, false, true);
/** @noinspection PhpParamsInspection */
$provider = new Illuminate\Events\EventServiceProvider($app);
$provider->register();

// Detect The Application Environment
$env = 'testing';

// Bind Paths
$app->instance('path', __DIR__ . '/tests');
$app->instance('path.base', __DIR__);
$app->instance('path.storage', sys_get_temp_dir());

// Bind The Application In The Container
$app->instance('app', $app);

// Check For The Test Environment
$app['env'] = $env;

// Load The Illuminate Facades
Illuminate\Support\Facades\Facade::clearResolvedInstances();
/** @noinspection PhpParamsInspection */
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

// Register Facade Aliases To Full Classes
foreach (array(
             'app' => 'Illuminate\Foundation\Application',
             'artisan' => 'Illuminate\Console\Application',
             'blade.compiler' => 'Illuminate\View\Compilers\BladeCompiler',
             'config' => 'Illuminate\Config\Repository',
             'db' => 'Illuminate\Database\DatabaseManager',
             'events' => 'Illuminate\Events\Dispatcher',
             'files' => 'Illuminate\Filesystem\Filesystem',
             'view' => 'Illuminate\View\Factory',
         ) as $key => $alias) {
    $app->alias($key, $alias);
}

// Register The Configuration Repository
$loader = new Illuminate\Config\FileLoader(new Illuminate\Filesystem\Filesystem, __DIR__ . '/tests/config');
$config = $mocker->getMock('Illuminate\Config\Repository', array(), array($loader, $env), '', false, true, true, false, true);
$app->instance('config', $config);

/** @var PHPUnit_Framework_MockObject_MockObject|Illuminate\Config\Repository $config */
$config->set('view.paths', array());
unset($config, $env);

// Register Application Exception Handling

// Set The Console Request If Necessary

// Set The Default Timezone
//date_default_timezone_set('UTC');

// Register The Alias Loader
if (!class_exists('Illuminate\Foundation\AliasLoader', false)) {
    eval('namespace Illuminate\Foundation { class AliasLoader { static $instance; public static function getInstance() { return static::$instance; } } }');
}
/** @var PHPUnit_Framework_MockObject_MockObject|object $loader */
$loader = $mocker->getMock('Illuminate\Foundation\AliasLoader', array('getAliases'));
$loader->method('getAliases')->willReturn(array(
    'App' => 'Illuminate\Support\Facades\App',
    'Blade' => 'Illuminate\Support\Facades\Blade',
    'ClassLoader' => 'Illuminate\Support\ClassLoader',
    'Config' => 'Illuminate\Support\Facades\Config',
    'DB' => 'Illuminate\Support\Facades\DB',
    'Eloquent' => 'Illuminate\Database\Eloquent\Model',
    'Event' => 'Illuminate\Support\Facades\Event',
    'File' => 'Illuminate\Support\Facades\File',
    'Schema' => 'Illuminate\Support\Facades\Schema',
    'SoftDeletingTrait' => 'Illuminate\Database\Eloquent\SoftDeletingTrait',
    'Str' => 'Illuminate\Support\Str',
    'View' => 'Illuminate\Support\Facades\View',
));
$loader::$instance = $loader;
unset($loader, $mocker);

// Register The Core Service Providers
foreach (array(
             'Illuminate\Filesystem\FilesystemServiceProvider',
             'Illuminate\View\ViewServiceProvider',
             'Illuminate\Database\DatabaseServiceProvider',
         ) as $provider) {
    $provider = new $provider($app);
    /* @var Illuminate\Support\ServiceProvider $provider */
    $provider->register();
}

// Boot The Application -> boot each service provider
$provider->boot();
unset($provider, $app);

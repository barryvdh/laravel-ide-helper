<?php

// Register The Composer Auto Loader
require __DIR__ . '/vendor/autoload.php';

// Setup Patchwork UTF-8 Handling

// Register The Laravel Auto Loader

// Create The Application
if (!class_exists('Illuminate\Foundation\Application')) {
    eval('namespace Illuminate\Foundation { class Application extends \Illuminate\Container\Container { const VERSION = \'4.0.0\'; public function booted() { } } }');
}
$mocker = new PHPUnit_Framework_MockObject_Generator;
/* @var PHPUnit_Framework_MockObject_MockObject|Illuminate\Container\Container $app */
$app = $mocker->getMock('Illuminate\Foundation\Application', array('bind', 'make', 'offsetGet', 'offsetSet'), array(), '', true, true, true, false, true, new stdClass);
$app->__phpunit_setOriginalObject('parent');
$app->instance('events', $mocker->getMock('Illuminate\Events\Dispatcher', null, array($app)));

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

$app->instance('files', $fs = $mocker->getMock('Illuminate\Filesystem\Filesystem', null));
// Register The Configuration Repository
$loader = $mocker->getMock('Illuminate\Config\FileLoader', null, array($fs, __DIR__ . '/tests/config'));
$config = $mocker->getMock('Illuminate\Config\Repository', array('get', 'set', 'package'), array($loader, $env), '', true, true, true, false, true, new stdClass);
/* @var PHPUnit_Framework_MockObject_MockObject|Illuminate\Config\Repository $config */
$config->__phpunit_setOriginalObject('parent');
$app->instance('config', $config);

$config->set('view.paths', array());
unset($config);

// Register Application Exception Handling

// Set The Console Request If Necessary

// Set The Default Timezone
//date_default_timezone_set('UTC');

// Register The Alias Loader
if (!class_exists('Illuminate\Foundation\AliasLoader')) {
    eval('namespace Illuminate\Foundation {
    class AliasLoader {
        protected $aliases;
        protected $registered = false;
        static $instance;
        public function __construct(array $aliases = array()) { $this->aliases = $aliases; }
        public static function getInstance() { return static::$instance; }
        public function load($alias) {
            if (isset($this->aliases[$alias]))
                return class_alias($this->aliases[$alias], $alias);
        }
        public function register() {
            if (!$this->registered) {
                spl_autoload_register(array($this, \'load\'), true, true);
                $this->registered = true;
            }
        }
        public function getAliases() { return $this->aliases; }
    }
}');
}
/* @var PHPUnit_Framework_MockObject_MockObject|object $loader */
$loader = $mocker->getMock('Illuminate\Foundation\AliasLoader', null, array(array(
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
)));
$loader->register();
$loader::$instance = $loader;
unset($loader, $mocker);

// Register The Core Service Providers
foreach (array('Illuminate\View\ViewServiceProvider', 'Illuminate\Database\DatabaseServiceProvider') as $provider) {
    $provider = new $provider($app);
    /* @var Illuminate\Support\ServiceProvider $provider */
    $provider->register();
}

// Boot The Application -> boot each service provider
//$provider->boot();
unset($provider);

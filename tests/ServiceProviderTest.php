<?php namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Config\FileLoader;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Facade;

class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var IdeHelperServiceProvider */
    protected $provider;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        $mocker = new \PHPUnit_Framework_MockObject_Generator;

        $m = new \ReflectionMethod(get_class($mocker), 'getClassMethods');
        $m->setAccessible(true);
        $methods = $m->invoke($mocker, 'Illuminate\Container\Container');

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = $mocker->getMock('Illuminate\Container\Container', array_merge($methods, array('booted')), array(), '', false, true, true, false, true);
        /** @noinspection PhpParamsInspection */
        $provider = new EventServiceProvider($app);
        $provider->register();

        // Bind Paths
        $app->instance('path', __DIR__);
        $app->instance('path.base', dirname(__DIR__));
        $app->instance('path.storage', sys_get_temp_dir());

        // Bind The Application In The Container
        $app->instance('app', $app);
        // Check For The Test Environment
        $app['env'] = $env = 'testing';

        // Load The Illuminate Facades
        Facade::clearResolvedInstances();
        /** @noinspection PhpParamsInspection */
        Facade::setFacadeApplication($app);

        // Register The Configuration Repository
        $loader = new FileLoader(new Filesystem, __DIR__ . '/config');
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $mocker->getMock('Illuminate\Config\Repository', array(), array($loader, $env), '', false, true, true, false, true);
        $app->instance('config', $config);

        $config->set('view.paths', array());
        // Register The Core Service Providers
        foreach (array(
                     'Illuminate\Filesystem\FilesystemServiceProvider',
                     'Illuminate\View\ViewServiceProvider',
                     'Illuminate\Database\DatabaseServiceProvider',
                 ) as $provider) {
            $provider = new $provider($app);
            /* @var \Illuminate\Support\ServiceProvider $provider */
            $provider->register();
        }

        // Boot The Application -> boot each service provider
        $provider->boot();
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->provider = new IdeHelperServiceProvider(Facade::getFacadeApplication());
    }

    public function testDeferred()
    {
        $this->assertTrue($this->provider->isDeferred());
    }

    public function testProvides()
    {
        $this->assertEquals(array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta'), $this->provider->provides());
    }

    public function testRegister()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = Facade::getFacadeApplication();

        $app->expects($this->exactly(3))->method('bind')->withConsecutive(
            array('command.ide-helper.generate', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
            array('command.ide-helper.models', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
            array('command.ide-helper.meta', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse())
        );

        $this->provider->register();

        /** @var \Illuminate\Events\Dispatcher $events */
        $events = $app['events'];
        $expected = print_r(array('commands' => array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta')), true);
        $this->assertContains(preg_replace('/^\s+/mu', '', $expected), preg_replace('/^\s+/mu', '', print_r($events->getListeners('artisan.start'), true)));

        return $this->provider;
    }

    /**
     * @depends testRegister
     * @param IdeHelperServiceProvider $provider
     */
    public function testBoot($provider)
    {
        $path = realpath(__DIR__ . '/../src');
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = Facade::getFacadeApplication();

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $app['config'];
        $config->expects($this->once())->method('package')->with('barryvdh/laravel-ide-helper', $path . '/config', 'laravel-ide-helper');

        $provider->boot();

        $this->assertSame('_ide_helper', $config->get('laravel-ide-helper::filename'));
        $this->assertEquals(array('\Illuminate\Auth\UserInterface' => 'User'), $config['laravel-ide-helper::interfaces']);
        $this->assertEquals(array(dirname(__DIR__) . '/vendor/laravel/framework/src/Illuminate/Support/helpers.php'), $config['laravel-ide-helper::helper_files']);

        /** @var \Illuminate\View\Factory $view */
        $view = $app['view'];
        $this->assertTrue($view->exists('laravel-ide-helper::ide-helper'));
        $this->assertTrue($view->exists('laravel-ide-helper::meta'));

        $this->assertInstanceOf(__NAMESPACE__ . '\Console\GeneratorCommand', $app['command.ide-helper.generate']);
        $this->assertInstanceOf(__NAMESPACE__ . '\Console\ModelsCommand', $app['command.ide-helper.models']);
        $this->assertInstanceOf(__NAMESPACE__ . '\Console\MetaCommand', $app['command.ide-helper.meta']);
    }

}

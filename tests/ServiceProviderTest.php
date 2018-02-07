<?php namespace Barryvdh\LaravelIdeHelper;

class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    static function addMockObjects(\PHPUnit_Framework_TestCase $test, $_ = null)
    {
        static $prop;
        if (!isset($prop)) {
            $prop = new \ReflectionProperty('PHPUnit_Framework_TestCase', 'mockObjects');
            $prop->setAccessible(true);
        }
        $prop->setValue($test, array_merge($prop->getValue($test), array_slice(func_get_args(), 1)));
    }

    public function testDeferred()
    {
        $provider = new IdeHelperServiceProvider(null);
        $this->assertTrue($provider->isDeferred());
    }

    public function testProvides()
    {
        $provider = new IdeHelperServiceProvider(null);
        $this->assertEquals(array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta'), $provider->provides());
    }

    public function testRegister()
    {
        global $app;
        static::addMockObjects($this, $app);

        $app->expects($this->exactly(3))->method('bind')->withConsecutive(
            array('command.ide-helper.generate', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
            array('command.ide-helper.models', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
            array('command.ide-helper.meta', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse())
        );

        /** @noinspection PhpParamsInspection */
        $provider = new IdeHelperServiceProvider($app);
        $provider->register();

        /** @var \Illuminate\Events\Dispatcher $evt */
        $evt = $app['events'];
        $expected = print_r(array('commands' => array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta')), true);
        $this->assertContains(preg_replace('/^\s+/mu', '', $expected), preg_replace('/^\s+/mu', '', print_r($evt->getListeners('artisan.start'), true)));

        return $provider;
    }

    /**
     * @depends testRegister
     * @param IdeHelperServiceProvider $provider
     */
    public function testBoot($provider)
    {
        $path = realpath(__DIR__ . '/../src');
        global $app;

        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $app['config'];
        static::addMockObjects($this, $config);

        $config->expects($this->once())->method('package')->with('barryvdh/laravel-ide-helper', $path . '/config', 'laravel-ide-helper');

        $provider->boot();

        $this->assertSame('_ide_helper', $config->get('laravel-ide-helper::filename'));
        $this->assertEquals(array('\Illuminate\Auth\UserInterface' => 'User'), $config['laravel-ide-helper::interfaces']);
        $this->assertEquals(array(dirname(__DIR__) . '/vendor/laravel/framework/src/Illuminate/Support/helpers.php'), $config['laravel-ide-helper::helper_files']);

        /* @var \Illuminate\View\Factory $view */
        $view = $app['view'];
        $this->assertTrue($view->exists('laravel-ide-helper::ide-helper'));
        $this->assertTrue($view->exists('laravel-ide-helper::meta'));

        $this->assertInstanceOf(__NAMESPACE__ . '\Console\GeneratorCommand', $app['command.ide-helper.generate']);
        $this->assertInstanceOf(__NAMESPACE__ . '\Console\ModelsCommand', $app['command.ide-helper.models']);
        $this->assertInstanceOf(__NAMESPACE__ . '\Console\MetaCommand', $app['command.ide-helper.meta']);
    }

}

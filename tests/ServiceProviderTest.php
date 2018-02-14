<?php namespace Barryvdh\LaravelIdeHelper;

class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    static function laravelViewClass()
    {
        static $cls;
        if (!isset($cls)) {
            $cls = class_exists('Illuminate\View\Environment') ? 'Illuminate\View\Environment' : 'Illuminate\View\Factory';
        }
        return $cls;
    }

    public function testDeferred()
    {
        $provider = new IdeHelperServiceProvider(null);

        $this->assertAttributeEquals(null, 'app', $provider);
        $this->assertTrue($provider->isDeferred());
    }

    public function testProvides()
    {
        $provider = new IdeHelperServiceProvider(null);
        $this->assertEquals(array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta'), $provider->provides());
    }

    public function testRegister()
    {
        $app = $this->getMock('Illuminate\Container\Container', array('bind', 'make'));

        $events = $this->getMock('Illuminate\Events\Dispatcher', array('listen'), array($app));
        $files = $this->getMock('Illuminate\Filesystem\Filesystem', null);
        $config = $this->getMock('Illuminate\Config\Repository', array('get'), array(), '', false);

        $app->expects($this->any())->method('make')->willReturnMap(array(
            array('events', array(), $events),
            array('files', array(), $files),
            array('config', array(), $config),
        ));

        $app->expects($this->exactly(3))->method('bind')
            ->withConsecutive(
                array('command.ide-helper.generate', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
                array('command.ide-helper.models', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
                array('command.ide-helper.meta', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse())
            )
            ->willReturnCallback(function ($abstract, $closure) use ($app) {
                /** @noinspection SpellCheckingInspection */
                $classType = 'Barryvdh\LaravelIdeHelper\Console\\' . str_replace('rate', 'rator', substr($abstract, 19)) . 'Command';
                $object = $closure($app);
                assert($object instanceof $classType);
            });

        $events->expects($this->once())->method('listen')->with('artisan.start', $this->callback(function ($closure) {
            $expected = print_r(array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta'), true);
            return strpos(preg_replace('/^\s+/mu', '', print_r($closure, true)), preg_replace('/^\s+/mu', '', $expected)) > 0;
        }));

        /** @noinspection PhpParamsInspection */
        $provider = new IdeHelperServiceProvider($app);
        $provider->register();

        return $provider;
    }

    public function testBoot()
    {
        $app = $this->getMock('Illuminate\Container\Container', array('make'));

        $files = $this->getMock('Illuminate\Filesystem\Filesystem', null);
        $config = $this->getMock('Illuminate\Config\Repository', array('package'), array(), '', false);
        $view = $this->getMock(static::laravelViewClass(), array('addNamespace'), array(), '', false);

        $app->expects($this->any())->method('make')->withConsecutive(array('files'), array('config'))->willReturnMap(array(
            array('files', array(), $files),
            array('config', array(), $config),
            array('view', array(), $view),
        ));

        $path = realpath(__DIR__ . '/../src');
        $config->expects($this->once())->method('package')
            ->with('barryvdh/laravel-ide-helper', $path . '/config', 'laravel-ide-helper');

        $view->expects($this->once())->method('addNamespace')
            ->with('laravel-ide-helper', $path . '/views');

        /** @noinspection PhpParamsInspection */
        $provider = new IdeHelperServiceProvider($app);
        $provider->boot();
    }

}

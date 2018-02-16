<?php namespace Barryvdh\LaravelIdeHelper;

use Doctrine\Instantiator\Instantiator;
use Illuminate\Support\Facades\Config as ConfigFacade;
use Illuminate\Support\Facades\DB as DbFacade;
use Illuminate\Support\Facades\Facade;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to
     */
    public function testConstructorWithoutConfig()
    {
        new Generator(null, null);
    }

    public function testConstructor()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $this->getMock('Illuminate\Config\Repository', array('get'), array(), '', false);

        $config->expects($this->exactly(3))->method('get')
            ->withConsecutive(
                array('laravel-ide-helper::extra'),
                array('laravel-ide-helper::magic'),
                array('laravel-ide-helper::interfaces')
            )
            ->willReturn($a = array('\Bar' => 'Foo'));

        $object = new Generator($config, null);

        $this->assertAttributeEquals(null, 'view', $object);
        $this->assertAttributeEquals(null, 'output', $object);
        $this->assertArrayHasKey('\Bar', $this->getObjectAttribute($object, 'extra'));
        $this->assertAttributeEquals($a, 'magic', $object);
        $this->assertContains('\Foo', $this->getObjectAttribute($object, 'interfaces'));
        $this->assertAttributeEquals('', 'helpers', $object);

        return $object;
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverEmpty($object)
    {
        $this->assertFalse($object->getDriver(null));
    }

    static function mockDbFacade()
    {
        if (!class_exists('DB'))
            class_alias('Illuminate\Support\Facades\DB', 'DB');
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     * @return Generator
     */
    public function testGetDriverError($object)
    {
        static::mockDbFacade();

        $db = $this->getMock('Illuminate\Database\DatabaseManager', array('connection'), array(), '', false);
        $app = $this->getMock('Illuminate\Container\Container', array('make'));
        $app->expects($this->once())->method('make')->with('db')->willReturn($db);

        Facade::clearResolvedInstances();
        /** @noinspection PhpParamsInspection */
        Facade::setFacadeApplication($app);

        $db->expects($this->exactly(2))->method('connection')->with(null)->willThrowException(new \Exception);

        $this->expectOutputString("Could not determine driver/connection for DB.\r\n");
        $this->assertFalse($object->getDriver('DB'));

        //:: For error case
        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $output->expects($this->once())->method('writeln')->with('<error>Could not determine driver/connection for DB.</error>');

        $prop = new \ReflectionProperty(get_class($object), 'output');
        $prop->setAccessible(true);
        $prop->setValue($object, $output);

        $this->assertFalse($object->getDriver('DB'));

        return $object;
    }

    static function mockAuthFacade()
    {
        if (!class_exists('Illuminate\Auth\Guard')) {
            eval('namespace Illuminate\Auth {
    class Guard {}
    class EloquentUserProvider {}
}
namespace {
    class Auth extends \Illuminate\Support\Facades\Auth {
        static function driver() { return new \Illuminate\Auth\Guard; }
        static function getProvider() { return new \Illuminate\Auth\EloquentUserProvider; }
    }
}');
        }
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverAuth($object)
    {
        static::mockAuthFacade();
        $this->assertEquals(array('Illuminate\Auth\Guard', 'Illuminate\Auth\EloquentUserProvider'), $object->getDriver('Auth'));
    }

    static function addMockObjects(\PHPUnit_Framework_TestCase $test, $_ = null)
    {
        static $prop;
        if (!isset($prop)) {
            $prop = new \ReflectionProperty('PHPUnit_Framework_TestCase', 'mockObjects');
            $prop->setAccessible(true);
        }
        $prop->setValue($test, array_merge($prop->getValue($test), array_slice(func_get_args(), 1)));
    }

    static function mockDbObject(\PHPUnit_Framework_MockObject_MockObject $db)
    {
        $conn = with(new Instantiator)->instantiate('Illuminate\Database\SQLiteConnection');
        $db->expects(static::atLeast(1))->method('connection')->with(null)->willReturn($conn);
    }

    /**
     * @depends testGetDriverError
     * @param Generator $object
     */
    public function testGetDriverDB($object = null)
    {
        if (is_null($db = DbFacade::getFacadeRoot())) {
            $db = $this->getMock('Illuminate\Database\DatabaseManager', array('connection'), array(), '', false);
            DbFacade::swap($db);
        } else {
            static::addMockObjects($this, $db);
        }

        static::mockDbObject($db);

        if (isset($object))
            $this->assertSame('Illuminate\Database\SQLiteConnection', $object->getDriver('DB'));
    }

    static function mockCacheFacade()
    {
        if (!class_exists('Illuminate\Cache\Repository')) {
            eval('namespace Illuminate\Cache {
    class Repository {}
    class FileStore {}
}
namespace {
    class Cache extends \Illuminate\Support\Facades\Cache {
        static function driver() { return new \Illuminate\Cache\Repository; }
        static function getStore() { return new \Illuminate\Cache\FileStore; }
    }
}');
        }
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverCache($object)
    {
        static::mockCacheFacade();
        $this->assertEquals(array('Illuminate\Cache\Repository', 'Illuminate\Cache\FileStore'), $object->getDriver('Cache'));
    }

    static function mockQueueFacade()
    {
        if (!class_exists('Illuminate\Queue\SyncQueue')) {
            eval('namespace Illuminate\Queue { class SyncQueue {} }
namespace {
    class Queue extends \Illuminate\Support\Facades\Queue {
        static function connection() { return new \Illuminate\Queue\SyncQueue; }
    }
}');
        }
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverQueue($object)
    {
        static::mockQueueFacade();
        $this->assertSame('Illuminate\Queue\SyncQueue', $object->getDriver('Queue'));
    }

    static function mockSshFacade()
    {
        if (!class_exists('Illuminate\Support\Facades\SSH')) {
            eval('namespace Illuminate\Support\Facades { class SSH {} }');
        }
        if (!class_exists('Illuminate\Remote\Connection')) {
            eval('namespace Illuminate\Remote { class Connection {} }
namespace {
    class SSH extends \Illuminate\Support\Facades\SSH {
        static function connection() { return new \Illuminate\Remote\Connection; }
    }
}');
        }
    }

    static function mockConfigObject(\PHPUnit_Framework_MockObject_MockObject $config, $map = array())
    {
        ConfigFacade::swap($config);

        $config->expects(static::once())->method('get')->with('auth.model', 'User')->willReturn('User');
        $items = require __DIR__ . '/../src/config/config.php';
        $config->__phpunit_verify();

        $config->expects(static::atLeast(3))->method('get')->willReturnMap(array_merge($map, array(
            array('laravel-ide-helper::extra', null, $items['extra']),
            array('laravel-ide-helper::magic', null, $items['magic']),
            array('laravel-ide-helper::interfaces', null, $items['interfaces']),
        )));
    }

    /**
     * @depends testGetDriverError
     * @return Generator
     */
    public function testDetectDrivers()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $this->getMock('Illuminate\Config\Repository', array('get'), array(), '', false);
        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\View\Factory $view */
        $view = $this->getMock(ServiceProviderTest::laravelViewClass(), array('make', 'getEngineResolver', 'callComposer'), array(), '', false);

        Facade::clearResolvedInstances();
        static::mockConfigObject($config);

        static::mockAuthFacade();
        $this->testGetDriverDB();
        static::mockCacheFacade();
        static::mockQueueFacade();
        static::mockSshFacade();

        $object = new Generator($config, $view);

        $extra = array(
            'Artisan' => array('Illuminate\Foundation\Artisan'),
            'Eloquent' => array('Illuminate\Database\Eloquent\Builder', 'Illuminate\Database\Query\Builder'),
            'Session' => array('Illuminate\Session\Store'),
            'Auth' => array('Illuminate\Auth\Guard'),
            'DB' => array('Illuminate\Database\SQLiteConnection'),
            'Cache' => array('Illuminate\Cache\Repository', 'Illuminate\Cache\FileStore'),
            'Queue' => array('Illuminate\Queue\SyncQueue'),
            'SSH' => array('Illuminate\Remote\Connection'),
        );
        $this->assertAttributeEquals($extra, 'extra', $object);

        $interfaces = array(
            '\Illuminate\Auth\UserInterface' => '\User',
            '\Illuminate\Auth\UserProviderInterface' => '\Illuminate\Auth\EloquentUserProvider',
            '\Illuminate\Database\ConnectionInterface' => '\Illuminate\Database\SQLiteConnection',
            '\Illuminate\Cache\StoreInterface' => '\Illuminate\Cache\FileStore',
            '\Illuminate\Queue\QueueInterface' => '\Illuminate\Queue\SyncQueue',
            '\Illuminate\Remote\ConnectionInterface' => '\Illuminate\Remote\Connection',
        );
        $this->assertAttributeEquals($interfaces, 'interfaces', $object);

        return $object;
    }

    static function mockAliasLoaderClass(\PHPUnit_Framework_TestCase $test)
    {
        if (!class_exists('Illuminate\Foundation\AliasLoader')) {
            eval('namespace Illuminate\Foundation {
    class AliasLoader {
        protected static $instance;
        public static function getInstance() { return static::$instance; }
        public static function setInstance($loader) { static::$instance = $loader; }
    }
}');
        }

        $loader = $test->getMock('Illuminate\Foundation\AliasLoader', array('getAliases'));
        /** @noinspection PhpUndefinedMethodInspection */
        $loader->setInstance($loader);

        $loader->expects($test->once())->method('getAliases')->willReturn(array(
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
        return $loader;
    }

    static function mockLaravelApp(
        \PHPUnit_Framework_TestCase $test, \PHPUnit_Framework_MockObject_MockObject $view = null, $config = null, $files = null, $db = null)
    {
        if (is_bool($db) || is_null($db = DbFacade::getFacadeRoot()))
            $db = $test->getMock('Illuminate\Database\DatabaseManager', array('connection'), array(), '', false);

        if (is_null($config))
            $config = $test->getMock('Illuminate\Config\Repository', array('get'), array(), '', false);

        if (is_null($view))
            $view = $test->getMock(ServiceProviderTest::laravelViewClass(), array('make', 'getEngineResolver', 'callComposer'), array(), '', false);
        else
            static::addMockObjects($test, $view);

        if (!class_exists('Illuminate\Foundation\Application')) {
            eval('namespace Illuminate\Foundation { class Application extends \Illuminate\Container\Container { const VERSION = \'4.0.0\'; } }');
        }
        if (is_null($app = Facade::getFacadeApplication()) || !is_a($app, 'Illuminate\Foundation\Application'))
            $app = $test->getMock('Illuminate\Foundation\Application', array('make'));
        else
            static::addMockObjects($test, $app);

        $app->expects($test->atLeast(1))->method('make')->willReturnMap(array(
            array('app', array(), $app),
            array('events', array(), $test->getMock('Illuminate\Events\Dispatcher', null, array($app))),
            array('files', array(), $files ?: $test->getMock('Illuminate\Filesystem\Filesystem', null)),
            array('config', array(), $config),
            array('view', array(), $view),
            array('db', array(), $db),
            array('path.base', array(), dirname(__DIR__)),
        ));

        Facade::clearResolvedInstances();
        /** @noinspection PhpParamsInspection */
        Facade::setFacadeApplication($app);

        $viewEngine = $test->getMock('Illuminate\View\Engines\CompilerEngine', array('getCompiler'), array(), '', false);
        $viewEngine->expects($test->once())->method('getCompiler')
            ->willReturn(with(new Instantiator)->instantiate('Illuminate\View\Compilers\BladeCompiler'));

        $viewResolver = $test->getMock('Illuminate\View\Engines\EngineResolver', array('resolve'));
        $viewResolver->expects($test->once())->method('resolve')->with('blade')->willReturn($viewEngine);
        $view->expects($test->once())->method('getEngineResolver')->willReturn($viewResolver);

        return $app;
    }

    /**
     * @depends testDetectDrivers
     * @param Generator $object
     */
    public function testGenerateJson($object)
    {
        static::mockAliasLoaderClass($this);

        static::mockLaravelApp($this, $this->getObjectAttribute($object, 'view'), $this->getObjectAttribute($object, 'config'));
        $this->testGetDriverDB();

        $result = $object->generate('json');
        $s = defined('JSON_PRETTY_PRINT') ? ' ' : '';

        $this->assertNotEmpty($result);
        $this->assertStringStartsWith('{', $result);
        $this->assertStringEndsWith('}', $result);
        $this->assertContains('"bind":' . $s . '"($abstract, $concrete = null, $shared = false)",', $result);
        $this->assertContains('"Eloquent":', $result);
        $this->assertContains('"first":' . $s . '"($columns = array(\'*\'))",', $result);
        $this->assertContains('"distinct":' . $s . '"()",', $result);
    }

    static function mockViewObject(\PHPUnit_Framework_TestCase $test, \PHPUnit_Framework_MockObject_MockObject $viewFactory)
    {
        $view = $test->getMock('Illuminate\View\View', null, array(
            $viewFactory,
            $test->getMock('Illuminate\View\Engines\PhpEngine', null),
            'laravel-ide-helper::ide-helper',
            realpath(__DIR__ . '/../src/views') . '/ide-helper.php',
        ));
        $viewFactory->expects($test->once())->method('make')->with('laravel-ide-helper::ide-helper')->willReturn($view);
    }

    /**
     * @depends testDetectDrivers
     * @param Generator $object
     */
    public function testGenerate($object)
    {
        static::mockAliasLoaderClass($this);

        $view = $this->getObjectAttribute($object, 'view');
        static::mockLaravelApp($this, $view, $this->getObjectAttribute($object, 'config'));
        $this->testGetDriverDB();
        static::mockViewObject($this, $view);

        $prop = new \ReflectionProperty(get_class($object), 'helpers');
        $prop->setAccessible(true);
        $prop->setValue($object, 'function is_true() {}');

        $result = $object->generate(null);

        $this->assertNotEmpty($result);
        $this->assertStringStartsWith('<?php', $result);
        $this->assertContains("function is_true() {}\n", $result);
        $this->assertContains('static function bind($abstract, $concrete = null, $shared = false)', $result);
        $this->assertContains('class Eloquent extends \Illuminate\Database\Eloquent\Model', $result);
        $this->assertContains('static function first($columns = array(\'*\'))', $result);
        $this->assertContains('\Illuminate\Database\Eloquent\Builder::first($columns);', $result);

        $this->assertContains('\Illuminate\Database\Query\Builder::select($columns);', $result);
        $this->assertContains('\Illuminate\Database\SQLiteConnection::table($table);', $result);
    }

}

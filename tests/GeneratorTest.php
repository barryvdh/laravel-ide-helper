<?php namespace Barryvdh\LaravelIdeHelper;

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
            ->withConsecutive(array('laravel-ide-helper::extra'), array('laravel-ide-helper::magic'), array('laravel-ide-helper::interfaces'))
            ->willReturn($a = array('\Bar' => 'Foo'));

        $object = new Generator($config, null);

        $this->assertAttributeEquals(null, 'view', $object);
        $this->assertAttributeEquals(null, 'output', $object);
        $this->assertAttributeEquals($a, 'extra', $object);
        $this->assertAttributeEquals($a, 'magic', $object);
        $this->assertAttributeEquals(array('\Bar' => '\Foo'), 'interfaces', $object);
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

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverError($object)
    {
        $this->expectOutputString("Could not determine driver/connection for DB.\r\n");
        $this->assertFalse($object->getDriver('DB'));

        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $output->expects($this->once())->method('writeln')->with('<error>Could not determine driver/connection for DB.</error>');

        $prop = new \ReflectionProperty(get_class($object), 'output');
        $prop->setAccessible(true);
        $prop->setValue($object, $output);

        $this->assertFalse($object->getDriver('DB'));
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverAuth($object = null)
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

        if (isset($object))
            $this->assertEquals(array('Illuminate\Auth\Guard', 'Illuminate\Auth\EloquentUserProvider'), $object->getDriver('Auth'));
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverDB($object = null)
    {
        global $app;

        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
        $config = $app['config'];
        $config->set('database.connections.sqlite', array('driver' => 'sqlite', 'database' => ':memory:'));
        $config->set('database.default', 'sqlite');

        if (isset($object))
            $this->assertSame('Illuminate\Database\SQLiteConnection', $object->getDriver('DB'));
    }

    /**
     * {@inheritDoc}
     */
    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();

        global $app;
        unset($app['config']['database']);
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverCache($object = null)
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

        if (isset($object))
            $this->assertEquals(array('Illuminate\Cache\Repository', 'Illuminate\Cache\FileStore'), $object->getDriver('Cache'));
    }

    /**
     * @depends testConstructor
     * @param Generator $object
     */
    public function testGetDriverQueue($object = null)
    {
        if (!class_exists('Illuminate\Queue\SyncQueue')) {
            eval('namespace Illuminate\Queue { class SyncQueue {} }
namespace {
    class Queue extends \Illuminate\Support\Facades\Queue {
        static function connection() { return new \Illuminate\Queue\SyncQueue; }
    }
}');
        }

        if (isset($object))
            $this->assertSame('Illuminate\Queue\SyncQueue', $object->getDriver('Queue'));
    }

    protected function makeGenerator($helpers = '')
    {
        global $app;

        /** @noinspection PhpParamsInspection */
        $provider = new IdeHelperServiceProvider($app);
        $provider->boot();

        return new Generator($app['config'], $app['view'], null, $helpers);
    }

    public function testDetectDrivers()
    {
        $this->testGetDriverAuth();
        $this->testGetDriverDB();
        $this->testGetDriverCache();
        $this->testGetDriverQueue();

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

        $object = $this->makeGenerator();

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

    /**
     * @depends testDetectDrivers
     * @param Generator $object
     */
    public function testGenerateJson($object)
    {
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

    /**
     * @depends testDetectDrivers
     * @param Generator $object
     */
    public function testGenerate($object)
    {
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

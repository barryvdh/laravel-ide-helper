<?php namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\GeneratorTest;
use Barryvdh\LaravelIdeHelper\ServiceProviderTest;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class MetaCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorWithoutApp()
    {
        $object = new MetaCommand(null);

        $this->assertAttributeEquals('ide-helper:meta', 'name', $object);
        $this->assertNull($object->getLaravel());
        $this->assertAttributeEquals(null, 'files', $object);
        $this->assertAttributeEquals(null, 'view', $object);
    }

    public function testConstructor()
    {
        $files = $this->getMock('Illuminate\Filesystem\Filesystem', array('put'));
        $view = $this->getMock(ServiceProviderTest::laravelViewClass(), array('make', 'callComposer'), array(), '', false);

        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = $this->getMock('Illuminate\Container\Container', array('make', 'getBindings'));
        $app->expects($this->exactly(2))->method('make')->willReturnMap(array(
            array('files', array(), $files),
            array('view', array(), $view),
        ));

        $object = new MetaCommand($app);
        $this->assertAttributeEquals('.phpstorm.meta.php', 'filename', $object);

        return $object;
    }

    /**
     * @param MetaCommand $object
     * @param array $bindings
     * @return array|\PHPUnit_Framework_MockObject_MockObject[]
     */
    protected function mockExpectations($object, $bindings = array())
    {
        $app = $object->getLaravel();
        $files = $this->getObjectAttribute($object, 'files');
        $view = $this->getObjectAttribute($object, 'view');
        GeneratorTest::addMockObjects($me = $this, $app, $files, $view);

        /* @var \PHPUnit_Framework_MockObject_MockObject $app */
        $bindings += compact('app', 'files', 'view');
        $app->expects($this->once())->method('getBindings')->willReturn($bindings);

        $app->expects($this->atLeast(1))->method('make')->willReturnCallback(function ($abstract) use ($bindings) {
            if ($bindings[$abstract] instanceof \Exception)
                throw $bindings[$abstract];

            return $bindings[$abstract];
        });

        /* @var \PHPUnit_Framework_MockObject_MockObject $view */
        $view->expects($this->once())->method('make')->with('laravel-ide-helper::meta')->willReturnCallback(function ($name, $data) use ($me, $view) {
            return $me->getMock('Illuminate\View\View', null, array(
                $view,
                $me->getMock('Illuminate\View\Engines\PhpEngine', null),
                $name,
                realpath(__DIR__ . '/../../src/views') . '/meta.php',
                $data
            ));
        });

        return array($app, $files);
    }

    /**
     * @depends testConstructor
     * @param MetaCommand $object
     */
    public function testRunWithoutAliases($object)
    {
        list(, $files) = $this->mockExpectations($object, array('foo.bar' => false, 'hello' => new \Exception('Foo!')));

        /* @var \PHPUnit_Framework_MockObject_MockObject $files */
        $files->expects($this->once())->method('put')->with('.phpstorm.meta.php', $this->callback(function ($content) {
            return (!empty($content)
                && strpos($content, "'hello'") === false && strpos($content, "'foo.bar'") === false
                && strpos($content, "'artisan'") === false
                && strpos($content, "'app'") > 0 && strpos($content, "'view'") > 0
                && strpos($content, "'files' instanceof \\Mock_Filesystem_") > 0);
        }))->willReturn(false);

        $result = $object->run(new ArrayInput(array()), $output = new BufferedOutput());
        $this->assertNull($object->option('exclude'));

        $this->assertSame(0, $result);
        $this->assertSame("Cannot make hello: Foo!\nThe meta file could not be created at .phpstorm.meta.php\n", $output->fetch());
    }

    /**
     * @depends testConstructor
     * @param MetaCommand $object
     */
    public function testRunWithExclusion($object)
    {
        list($app, $files) = $this->mockExpectations($object, array('me' => $this, '~foo' => new \stdClass));

        // Register Facade Aliases To Full Classes
        $aliases = array(
            'artisan' => 'Illuminate\Console\Application',
            'blade.compiler' => 'Illuminate\View\Compilers\BladeCompiler',
            'config' => 'Illuminate\Config\Repository',
            'db' => 'Illuminate\Database\DatabaseManager',
            'events' => 'Illuminate\Events\Dispatcher',
        );
        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        foreach ($aliases as $key => $alias)
            $app->alias($key, $alias);

        /* @var \PHPUnit_Framework_MockObject_MockObject $files */
        $files->expects($this->once())->method('put')->with($file = '/phpstorm.meta.php', $this->callback(function ($content) {
            return (!empty($content)
                && strpos($content, "'~foo'") === false
                && strpos($content, "'app'") > 0 && strpos($content, "'view'") > 0 && strpos($content, "'events'") > 0
                && strpos($content, "'me' instanceof \\" . __CLASS__ . ",\n") > 0
                && strpos($content, "'artisan' instanceof \\Illuminate\\Console\\Application,\n") > 0
                && strpos($content, "'files' instanceof \\Mock_Filesystem_") > 0);
        }))->willReturn(1);

        $result = $object->run(new ArrayInput(array('--filename' => $file, '-E' => '~')), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertSame("A new meta file was written to $file\n", $output->fetch());
    }

}

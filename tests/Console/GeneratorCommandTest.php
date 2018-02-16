<?php namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\GeneratorTest;
use Barryvdh\LaravelIdeHelper\ServiceProviderTest;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class GeneratorCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $config = $this->getMock('Illuminate\Config\Repository', array('get', 'set'), array(), '', false);
        $files = $this->getMock('Illuminate\Filesystem\Filesystem', array('put', 'exists'));
        $view = $this->getMock(ServiceProviderTest::laravelViewClass(), array('make', 'getEngineResolver', 'callComposer'), array(), '', false);

        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = $this->getMock('Illuminate\Container\Container', array('make'));
        $app->expects($this->exactly(3))->method('make')
            ->withConsecutive(array('config'), array('files'), array('view'))
            ->willReturnOnConsecutiveCalls($config, $files, $view);

        $config->expects($this->exactly(2))->method('get')
            ->withConsecutive(array('laravel-ide-helper::filename'), array('laravel-ide-helper::format'))
            ->willReturnOnConsecutiveCalls('_ide_helper.php', 'json');

        $object = new GeneratorCommand($app);

        $this->assertAttributeEquals('ide-helper:generate', 'name', $object);
        $this->assertAttributeEquals(null, 'input', $object);

        return $object;
    }

    /**
     * @depends testConstructor
     * @param GeneratorCommand $object
     */
    public function testRunError($object)
    {
        $files = $this->getObjectAttribute($object, 'files');
        GeneratorTest::addMockObjects($this, $files);

        /* @var \PHPUnit_Framework_MockObject_MockObject $files */
        $files->expects($this->once())->method('exists')->with('/bootstrap/compiled.php')->willReturn(true);

        $result = $object->run(new ArrayInput(array()), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertEquals("Error generating IDE Helper: first delete bootstrap/compiled.php (php artisan clear-compiled)\n", $output->fetch());
        $this->assertEquals('_ide_helper.php', $object->argument('filename'));
        $this->assertEquals('json', $object->option('format'));
    }

    /**
     * @param GeneratorCommand $object
     * @param array $map
     * @return array|\PHPUnit_Framework_MockObject_MockObject[]
     */
    protected function mockExpectations($object, $map = array())
    {
        GeneratorTest::mockAuthFacade();
        GeneratorTest::mockDbFacade();
        GeneratorTest::mockCacheFacade();
        GeneratorTest::mockQueueFacade();
        GeneratorTest::mockSshFacade();

        GeneratorTest::mockAliasLoaderClass($this);

        $config = $this->getObjectAttribute($object, 'config');
        $files = $this->getObjectAttribute($object, 'files');
        $view = $this->getObjectAttribute($object, 'view');
        GeneratorTest::addMockObjects($this, $config, $files);

        Facade::clearResolvedInstances();
        GeneratorTest::mockConfigObject($config, $map);

        $app = GeneratorTest::mockLaravelApp($this, $view, $config, $files, false);
        GeneratorTest::mockDbObject($app['db']);

        /** @noinspection PhpParamsInspection */
        $object->setLaravel($app);
        return array($config, $files, $view);
    }

    /**
     * @depends testConstructor
     * @param GeneratorCommand $object
     */
    public function testRunWithMemoryDB($object)
    {
        list($config, $files) = $this->mockExpectations($object);

        /* @var \PHPUnit_Framework_MockObject_MockObject $config */
        $config->expects($this->exactly(2))->method('set')->withConsecutive(
            array('database.connections.sqlite', array('driver' => 'sqlite', 'database' => ':memory:')),
            array('database.default', 'sqlite')
        );

        /* @var \PHPUnit_Framework_MockObject_MockObject $files */
        $files->expects($this->once())->method('exists')->willReturnCallback('file_exists');

        $files->expects($this->once())->method('put')->with($filename = '_ide_helper.json', $this->callback(function ($content) {
            $s = defined('JSON_PRETTY_PRINT') ? ' ' : '';

            return (!empty($content) && $content[0] == '{' && substr($content, -1) == '}'
                && strpos($content, '"bind":' . $s . '"($abstract, $concrete = null, $shared = false)",') > 0
                && strpos($content, '"Eloquent":') > 0
                && strpos($content, '"first":' . $s . '"($columns = array(\'*\'))",') > 0
                && strpos($content, '"distinct":' . $s . '"()",') > 0);
        }))->willReturn(false);

        $result = $object->run(new ArrayInput(array('-M' => null)), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertEquals("The helper file could not be created at $filename\n", $output->fetch());
    }

    /**
     * @depends testConstructor
     * @param GeneratorCommand $object
     */
    public function testRunWithHelpers($object)
    {
        $config = array('laravel-ide-helper::helper_files', array(),
            array(dirname(dirname(__DIR__)) . '/vendor/illuminate/support/Illuminate/Support/helpers.php'));
        list(, $files, $view) = $this->mockExpectations($object, array($config));

        /* @var \PHPUnit_Framework_MockObject_MockObject $files */
        $files->expects($this->exactly(2))->method('exists')->willReturnCallback('file_exists');

        $files->expects($this->once())->method('put')->with($filename = '.ide_helper.php', $this->callback(function ($content) {
            return (!empty($content) && substr($content, 0, 5) == '<?php'
                && strpos($content, "	function app(\$make = null)\n") > 0
                && strpos($content, 'static function bind($abstract, $concrete = null, $shared = false)') > 0
                && strpos($content, 'class Eloquent extends \Illuminate\Database\Eloquent\Model') > 0
                && strpos($content, 'static function first($columns = array(\'*\'))') > 0
                && strpos($content, '\Illuminate\Database\Eloquent\Builder::first($columns);') > 0
                && strpos($content, '\Illuminate\Database\Query\Builder::select($columns);') > 0
                && strpos($content, '\Illuminate\Database\SQLiteConnection::table($table);') > 0);
        }))->willReturn(true);

        GeneratorTest::mockViewObject($this, $view);

        $result = $object->run(
            new ArrayInput(array('filename' => '.ide_helper', '--format' => 'php', '-H' => null, '-S' => null)),
            $output = new BufferedOutput()
        );

        $this->assertSame(0, $result);
        $this->assertEquals("A new helper file was written to $filename\n", $output->fetch());
    }

}

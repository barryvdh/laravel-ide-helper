<?php namespace Barryvdh\LaravelIdeHelper\Console;

use Barryvdh\LaravelIdeHelper\GeneratorTest;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class ModelsCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorWithoutApp()
    {
        $object = new ModelsCommand(null);

        $this->assertAttributeEquals('ide-helper:models', 'name', $object);
        $this->assertNull($object->getLaravel());
        $this->assertAttributeEquals(null, 'files', $object);
        $this->assertAttributeEquals(array(), 'dirs', $object);
        $this->assertAttributeEquals(false, 'write', $object);
    }

    public function testConstructor()
    {
        $files = $this->getMock('Illuminate\Filesystem\Filesystem', array('put', 'exists'));

        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = $this->getMock('Illuminate\Container\Container', array('make', 'getBindings'));
        $app->expects($this->once())->method('make')->with('files')->willReturn($files);

        $object = new ModelsCommand($app);
        $this->assertAttributeEquals('_ide_helper_models.php', 'filename', $object);

        return $object;
    }

    static $NO_DOCTRINE = false;

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        static::$NO_DOCTRINE = false;
        Model::unsetConnectionResolver();
    }

    static function mockGlobalFunctions()
    {
        if (!function_exists(__NAMESPACE__ . '\interface_exists')) {
            eval('namespace ' . __NAMESPACE__ . ' {
    function interface_exists($name, $autoload = true) {
        if ($name === \'Doctrine\DBAL\Driver\' && ModelsCommandTest::$NO_DOCTRINE)
            return false;
        return \interface_exists($name, $autoload);
    }
}');
        }
    }

    static function mockModelClasses()
    {
        if (!class_exists(__NAMESPACE__ . '\ClassMapBuilder')) {
            require 'ModelsCommandTestData.php';

            class_alias(__NAMESPACE__ . '\ClassMapBuilder', 'Symfony\Component\ClassLoader\ClassMapGenerator');
        }

        if (!class_exists('Eloquent')) {
            class_alias('Illuminate\Database\Eloquent\Model', 'Eloquent');
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        static::mockGlobalFunctions();
        static::mockModelClasses();
    }

    protected function mockConfigObject()
    {
        $config = $this->getMock('Illuminate\Config\Repository', array('get'), array(), '', false);
        $config->expects($this->once())->method('get')
            ->with('laravel-ide-helper::model_locations')
            ->willReturn(array('app/models'));

        return $config;
    }

    protected function mockDbConnection()
    {
        $platform = $this->getMock('Doctrine\DBAL\Platforms\SqlitePlatform', array('registerDoctrineTypeMapping'));
        $platform->expects($this->atLeast(3))->method('registerDoctrineTypeMapping')->with('enum', 'string');

        $sm = $this->getMock('Doctrine\DBAL\Schema\SqliteSchemaManager', array('getDatabasePlatform', 'listTableColumns'), array(), '', false);
        $sm->expects($this->atLeast(3))->method('getDatabasePlatform')->willReturn($platform);

        $conn = $this->getMock('Illuminate\Database\SQLiteConnection', array('getDoctrineSchemaManager'), array(), '', false);
        $conn->expects($this->atLeast(3))->method('getDoctrineSchemaManager')->willReturn($sm);

        $cols1 = array(
            new Column('id', Type::getType(Type::BIGINT)),
            new Column('name', Type::getType(Type::STRING)),
            new Column('birthDate', Type::getType(Type::DATETIMETZ)),
            new Column('desc', Type::getType(Type::TEXT), array('Comment' => 'Description.')),
            new Column('created_at', Type::getType(Type::DATETIME)),
        );
        $cols2 = array(
            new Column('uId', Type::getType(Type::GUID), array('Comment' => 'Unique ID.')),
            new Column('photo', Type::getType(Type::BLOB)),
            new Column('PRICE', Type::getType(Type::FLOAT)),
            new Column('Qty', Type::getType(Type::SMALLINT), array('Comment' => 'Quantity.')),
            new Column('is_valid', Type::getType(Type::BOOLEAN)),
        );
        $sm->expects($this->atLeast(3))->method('listTableColumns')
            ->withConsecutive(array('bar'), array('foo'), array('bar_foo'))
            ->willReturnOnConsecutiveCalls($cols1, array(), $cols2);

        Model::setConnectionResolver(new ConnectionResolver(array(null => $conn)));
    }

    /**
     * @param ModelsCommand $object
     * @param bool $noDoctrine
     * @param bool $specifyModels
     * @return \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Filesystem\Filesystem
     */
    protected function mockExpectations($object, $noDoctrine = false, $specifyModels = false)
    {
        $files = $this->getObjectAttribute($object, 'files');
        $app = $object->getLaravel();
        GeneratorTest::addMockObjects($this, $app, $files);

        $config = $this->mockConfigObject();
        if (!$noDoctrine) $this->mockDbConnection();

        /* @var \PHPUnit_Framework_MockObject_MockObject $app */
        $app->expects($this->atLeast(3))->method('make')->willReturnCallback(function ($abstract) use ($config) {
            if ($abstract === 'path.base') return '~';
            if ($abstract === 'config') return $config;
            return new $abstract();
        });

        if (!$specifyModels) {
            /* @var \PHPUnit_Framework_MockObject_MockObject $files */
            $files->expects($this->atLeast(1))->method('exists')->willReturnMap(array(
                array('~/app/models', true),
                array('~/tests/stubs', true),
                array('~/vendor/stubs', false),
            ));
        }

        return $files;
    }

    /**
     * @param ModelsCommand $object
     * @param bool $result
     */
    protected function mockCommandConfirm($object, $result = false)
    {
        if (!class_exists('Symfony\Component\Console\Helper\QuestionHelper')) {
            $helper = $this->getMock('Symfony\Component\Console\Helper\DialogHelper', array('askConfirmation'));
            $helper->expects($this->once())->method('askConfirmation')->willReturn($result);
        } else {
            $helper = $this->getMock('Symfony\Component\Console\Helper\QuestionHelper', array('ask'));
            $helper->expects($this->once())->method('ask')->willReturn($result);
        }

        $object->setHelperSet(new HelperSet(array($helper)));
    }

    /**
     * @depends testConstructor
     * @param ModelsCommand $object
     */
    public function testRunWithoutConfirm($object)
    {
        $this->mockCommandConfirm($object);
        $files = $this->mockExpectations($object, static::$NO_DOCTRINE = true);

        $files->expects($this->once())->method('put')->with($fn = '_ide_helper_models.php', $this->callback(function ($content) {
            return (!empty($content)
                && substr($content, 0, 5) == '<?php'
                && strpos($content, "barryvdh@gmail.com>\n */\n\n") > 0
                && strpos($content, 'class BarFoo {') === false
                && strpos($content, " *\n\t" . ' * @property string $name' . "\n\t" .
                    ' * @property-read mixed $created_at ' . "\n\t" .
                    ' * @property-write mixed $updated_at ' . "\n\t" .
                    ' * @property-read \Barryvdh\LaravelIdeHelper\Console\Bar $parent ' . "\n\t" .
                    ' * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Console\Bar[] $children ' .
                    "\n\t */\n\tclass Bar {") > 0
                && strpos($content, " *\n\t" . ' * @method static Foo byValid($not = false)' . "\n\t" .
                    ' * @property mixed $updated_at ' . "\n\t" .
                    ' * @property-read \Illuminate\Database\Eloquent\Collection|\BarFoo[] $bars ' .
                    "\n\t */\n\tclass Foo {") > 0);
        }))->willReturn(false);

        $result = $object->run(new ArrayInput(array()), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertAttributeEquals(array('app/models'), 'dirs', $object);
        $this->assertAttributeSame(false, 'write', $object);

        $expected = array(
            "Loading model '" . __NAMESPACE__ . "\\Bar'",
            "Loading model '" . __NAMESPACE__ . "\\Foo'",
            "Loading model '" . __NAMESPACE__ . "\\Skip'",
            'Exception: ' . __NAMESPACE__ . "\\Skip is not instantiable.\nCould not analyze class " . __NAMESPACE__ . '\Skip.',
            'Warning: `"doctrine/dbal": "~2.3"` is required to load database information. Please require that in your composer.json and run `composer update`.',
            "Failed to write model information to $fn\n",
        );
        $this->assertSame(implode("\n", $expected), $output->fetch());
    }

    /**
     * @depends testConstructor
     * @param ModelsCommand $object
     */
    public function testRunWithoutWrite($object)
    {
        $files = $this->mockExpectations($object);

        $files->expects($this->once())->method('put')->with($fn = '_ide_helper_models.php', $this->callback(function ($content) {
            return (!empty($content)
                && substr($content, 0, 5) == '<?php'
                && strpos($content, "barryvdh@gmail.com>\n */\n\n") > 0
                && strpos($content, " *\n\t" . ' * @method static Foo byValid($not = false)' . "\n\t" .
                    ' * @property mixed $updated_at ' . "\n\t" .
                    ' * @property-read \Illuminate\Database\Eloquent\Collection|\BarFoo[] $bars ' .
                    "\n\t */\n\tclass Foo {") > 0
                && strpos($content, " *\n\t" . ' * @property string $name' . "\n\t" .
                    ' * @property integer $id ' . "\n\t" .
                    ' * @property string $birthDate ' . "\n\t" .
                    ' * @property string $desc Description.' . "\n\t" .
                    ' * @property \Carbon\Carbon $created_at ' . "\n\t" .
                    ' * @property-write mixed $updated_at ' . "\n\t" .
                    ' * @property-read \Barryvdh\LaravelIdeHelper\Console\Bar $parent ' . "\n\t" .
                    ' * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Console\Bar[] $children ' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\Bar whereId($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\Bar whereName($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\Bar whereBirthDate($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\Bar whereDesc($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\Bar whereCreatedAt($value)' .
                    "\n\t */\n\tclass Bar {") > 0
                && strpos($content, " *\n\t" . ' * @property string $uId Unique ID.' . "\n\t" .
                    ' * @property mixed $photo ' . "\n\t" .
                    ' * @property float $PRICE ' . "\n\t" .
                    ' * @property integer $Qty Quantity.' . "\n\t" .
                    ' * @property boolean $is_valid ' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\BarFoo whereUId($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\BarFoo wherePhoto($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\BarFoo wherePRICE($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\BarFoo whereQty($value)' . "\n\t" .
                    ' * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Console\BarFoo whereIsValid($value)' .
                    "\n\t */\n\tclass BarFoo {") > 0);
        }))->willReturn(0);

        $inputs = array('--dir' => array('tests/stubs', 'vendor/stubs'), '-N' => null, '-I' => __NAMESPACE__ . '\Skip');
        $result = $object->run(new ArrayInput($inputs), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertAttributeEquals(array('app/models', 'tests/stubs', 'vendor/stubs'), 'dirs', $object);
        $this->assertAttributeSame(false, 'write', $object);

        $expected = array(
            "Loading model '" . __NAMESPACE__ . "\\Bar'",
            "Loading model '" . __NAMESPACE__ . "\\Foo'",
            "Ignoring model '" . __NAMESPACE__ . "\\Skip'",
            "Loading model '" . __NAMESPACE__ . "\\BarFoo'",
            "Model information was written to $fn\n",
        );
        $this->assertSame(implode("\n", $expected), $output->fetch());
    }

    /**
     * @depends testConstructor
     * @param ModelsCommand $object
     */
    public function testRunWithConfirmWritten($object)
    {
        $this->mockCommandConfirm($object, true);
        $files = $this->mockExpectations($object, false, true);

        $fn = __DIR__ . DIRECTORY_SEPARATOR . 'ModelsCommandTestData.php';
        $me = $this;
        $files->expects($this->exactly(3))->method('put')->willReturnCallback(function ($filename, $content) use ($me, $fn) {
            $me->assertEquals($fn, $filename);

            $me->assertNotEmpty($content);
            $me->assertStringStartsWith('<?php namespace ' . __NAMESPACE__ . ';', $content);

            $i1 = strpos($content, ' * @property \Carbon\Carbon $created_at ');
            $i2 = strpos($content, ' * @property-read \Illuminate\Database\Eloquent\Collection|\BarFoo[] $bars ');
            $i3 = strpos($content, ' * @property integer $Qty Quantity.');
            $me->assertTrue(($i1 > 0 && !$i2 && !$i3) || (!$i1 && $i2 > 0 && !$i3) || (!$i1 && !$i2 && $i3 > 0));

            return (strpos($content, '* @property boolean $is_valid') === false);
        });

        $inputs = array('model' => array(__NAMESPACE__ . '\Bar', __NAMESPACE__ . '\Foo', __NAMESPACE__ . '\BarFoo'));
        $result = $object->run(new ArrayInput($inputs), $output = new BufferedOutput());

        $this->assertSame(0, $result);
        $this->assertAttributeEquals(array('app/models'), 'dirs', $object);
        $this->assertAttributeSame(true, 'write', $object);

        $expected = array(
            "Loading model '" . __NAMESPACE__ . "\\Bar'",
            'Written new phpDocBlock to ' . $fn,
            "Loading model '" . __NAMESPACE__ . "\\Foo'",
            'Written new phpDocBlock to ' . $fn,
            "Loading model '" . __NAMESPACE__ . "\\BarFoo'\n",
        );
        $this->assertSame(implode("\n", $expected), $output->fetch());
    }

    public function testGetClassName()
    {
        $method = new \ReflectionMethod(substr(__CLASS__, 0, -4), 'getClassName');
        $method->setAccessible(true);

        $this->assertSame('Foo', $method->invoke(null, ' Foo::class ', null));
        $this->assertSame('Foo\Bar', $method->invoke(null, 'Foo\Bar::class ', null));

        $this->assertSame('\Exception', $method->invoke(null, ' static::class ', new \Exception));
        $this->assertSame('\Bar\Foo', $method->invoke(null, ' "Bar\Foo "', null));
    }
}

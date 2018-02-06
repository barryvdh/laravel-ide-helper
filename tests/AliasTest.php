<?php namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Support\Facades\Facade;

class AliasTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error_Notice
     * @expectedExceptionMessage Uninitialized string offset:
     */
    public function testConstructorWithoutFacade()
    {
        $this->expectOutputString("Exception: Uninitialized string offset: 0\nSkipping \\.\r\n");
        new Alias(null, null);
    }

    public function testConstructorWithEmptyFacade()
    {
        $object = new Alias(null, ' ');

        $this->assertNull($object->getAlias());
        $this->assertInvalidAlias($object);
    }

    protected function assertInvalidAlias(Alias $object)
    {
        $this->assertFalse($object->isValid());

        $this->assertSame('class', $object->getClassType());
        $this->assertNull($object->getExtends());
        $this->assertEmpty($object->getShortName());
        $this->assertSame('__root', $object->getNamespace());
        $this->assertEmpty($object->getMethods());
    }

    public function testConstructor()
    {
        $object = new Alias('Foo\View', 'Illuminate\Support\Facades\View');

        $this->assertSame('Foo\View', $object->getAlias());
        $this->assertTrue($object->isValid());

        $this->assertSame('class', $object->getClassType());
        $this->assertSame('\Illuminate\Support\Facades\View', $object->getExtends());
        $this->assertSame('View', $object->getShortName());
        $this->assertSame('Foo', $object->getNamespace());
        $this->assertNotEmpty($methods = $object->getMethods());
        $this->assertSame('make', $methods[0]->getName());
    }

    /**
     * @requires PHP 5.4
     */
    public function testIsTrait()
    {
        $object = new Alias('SoftDeletingTrait', 'Illuminate\Database\Eloquent\SoftDeletingTrait');

        $this->assertSame('SoftDeletingTrait', $object->getAlias());
        $this->assertInvalidAlias($object);
    }

    public function testAddClass()
    {
        $object = new Alias('View', 'Illuminate\Support\Facades\View');

        $this->expectOutputString("Class not exists: \\Foo\\NotFound\r\n");
        $object->addClass('\Foo\NotFound');
    }

    public function testDetectClassType()
    {
        $object = new Alias('Config\Loader', 'Illuminate\Config\LoaderInterface');

        $this->assertSame('Config\Loader', $object->getAlias());
        $this->assertTrue($object->isValid());

        $this->assertSame('interface', $object->getClassType());
        $this->assertSame('\Illuminate\Config\LoaderInterface', $object->getExtends());
        $this->assertSame('Loader', $object->getShortName());
        $this->assertSame('Config', $object->getNamespace());
        $this->assertEmpty($object->getMethods());
    }

    public function testAddMagicMethods()
    {
        $object = new Alias('Eloquent', 'Illuminate\Database\Eloquent\Model', array(
            'find' => 'Illuminate\Database\Eloquent\Builder::find',
            'increment' => 'Illuminate\Database\Eloquent\Builder::increment',
            'decrement' => 'Illuminate\Database\Query\Builder::decrement',
            'foo' => 'Foo\NotFound::foo',
        ));

        $this->assertSame('Eloquent', $object->getAlias());
        $this->assertTrue($object->isValid());

        $this->assertSame('class', $object->getClassType());
        $this->assertSame('\Illuminate\Database\Eloquent\Model', $object->getExtends());
        $this->assertSame('Eloquent', $object->getShortName());
        $this->assertSame('__root', $object->getNamespace());

        $this->assertNotEmpty($methods = $object->getMethods());
        $methods = array_map(function ($m) {
            /* @var Method $m */
            return $m->getName();
        }, $methods);

        $this->assertSame('find', $methods[count($methods) - 1]);
        $this->assertNotContains('increment', $methods);
        $this->assertNotContains('decrement', $methods);
        $this->assertNotContains('foo', $methods);
    }

    public function testDetectRoot()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container $app */
        $app = Facade::getFacadeApplication();
        $app->expects($this->any())->method('offsetGet')->willReturnCallback(function ($key) {
            if ($key === 'db') throw new \PDOException('Foo');
        });

        $this->expectOutputString("PDOException: Foo\nPlease configure your database connection correctly, or use the sqlite memory driver (-M). Skipping \\Illuminate\\Support\\Facades\\DB.\r\n");
        new Alias('DB', 'Illuminate\Support\Facades\DB');
    }

}

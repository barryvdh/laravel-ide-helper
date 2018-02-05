<?php namespace Barryvdh\LaravelIdeHelper;

class AliasTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error_Notice
     * @expectedExceptionMessage Uninitialized string offset:
     */
    public function testConstructorWithoutFacade()
    {
        new Alias(null, null);
    }

    public function testConstructorWithEmptyFacade()
    {
        $object = new Alias(null, ' ');

        $this->assertNull($object->getAlias());
        $this->assertFalse($object->isValid());

        $this->assertSame('class', $object->getClassType());
        $this->assertNull($object->getExtends());
        $this->assertEmpty($object->getShortName());
        $this->assertSame('__root', $object->getNamespace());
        $this->assertEmpty($object->getMethods());
    }

    public function testConstructor()
    {
        $object = new Alias('View', 'Illuminate\Support\Facades\View');

        $this->assertSame('View', $object->getAlias());
        $this->assertTrue($object->isValid());

        $this->assertSame('class', $object->getClassType());
        $this->assertSame('\Illuminate\Support\Facades\View', $object->getExtends());
        $this->assertSame('View', $object->getShortName());
        $this->assertSame('__root', $object->getNamespace());
        $this->assertNotEmpty($methods = $object->getMethods());
        $this->assertSame('make', $methods[0]->getName());
    }

}

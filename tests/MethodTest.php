<?php namespace Barryvdh\LaravelIdeHelper;

class MethodTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException \PHPUnit_Framework_Error
	 * @expectedExceptionMessage Argument 1 passed to
	 */
	public function testConstructorWithoutMethod()
	{
		new Method(null, null, null);
	}

	public function testConstructor()
	{
		$method = new \ReflectionMethod('PHPUnit_Framework_TestCase', 'getMock');
		$object = new Method($method, null, new \ReflectionClass(get_class($this)));

		$this->assertSame('\PHPUnit_Framework_TestCase', $object->getDeclaringClass());
		$this->assertSame('\\' . get_class($this), $object->getRoot());
		$this->assertSame('getMock', $object->getName());

		$prop = new \ReflectionProperty(get_class($object), 'namespace');
		$prop->setAccessible(true);
		$this->assertSame('', $prop->getValue($object));

		$this->assertFalse($object->isDeprecated());
		$this->assertCount($method->getNumberOfParameters(), $object->getDocParams());

		$doc = $object->getDocComment('', true);
		$this->assertContains("\n * " . '@param array|null $methods', $doc);
		$this->assertContains("\n * " . '@return \PHPUnit_Framework_MockObject_MockObject', $doc);
		$this->assertContains("\n * " . '@throws \PHPUnit_Framework_Exception', $doc);

		$this->assertTrue($object->shouldReturn());
	}

}

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

        $this->assertAttributeEquals('', 'namespace', $object);
        $this->assertFalse($object->isDeprecated());
        $this->assertCount($method->getNumberOfParameters(), $object->getDocParams());

        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . '@param array|null $methods', $doc);
        $this->assertContains("\n * " . '@return \PHPUnit_Framework_MockObject_MockObject', $doc);
        $this->assertContains("\n * " . '@throws \PHPUnit_Framework_Exception', $doc);

        $this->assertTrue($object->shouldReturn());
    }

    public function testGetDocComment()
    {
        $method = new \ReflectionMethod('PHPUnit_Framework_TestCase', 'run');
        $object = new Method($method, null, new \ReflectionClass(get_class($this)), null, array('\PHPUnit_Framework_TestResult' => '\TestResult'));

        $this->assertSame('\PHPUnit_Framework_TestCase', $object->getDeclaringClass());
        $this->assertSame('\\' . get_class($this), $object->getRoot());
        $this->assertSame('run', $object->getName());

        $this->assertTrue($object->shouldReturn());
        $this->assertCount($method->getNumberOfParameters(), $object->getDocParams());

        $this->assertEquals('$result', $object->getParams());
        $this->assertEquals(array('$result = null'), $object->getParamsWithDefault(false));

        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . '@param \PHPUnit_Framework_TestResult ', $doc);
        $this->assertContains("\n * " . '@return \TestResult', $doc);
        $this->assertContains("\n * " . '@throws \PHPUnit_Framework_Exception', $doc);
    }

    public function testIsDeprecated()
    {
        $method = new \ReflectionMethod('PHPUnit_Framework_TestCase', 'hasPerformedExpectationsOnOutput');
        $object = new Method($method, null, new \ReflectionClass(get_class($this)));

        $this->assertTrue($object->shouldReturn());
        $this->assertEmpty($object->getDocParams());
        $this->assertEmpty($object->getParams(false));
        $this->assertEmpty($object->getParamsWithDefault());

        $this->assertTrue($object->isDeprecated());

        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . '@return bool', $doc);
        $this->assertContains("\n * " . '@deprecated', $doc);
    }

    public function testGetInheritDoc()
    {
        $class = new \ReflectionClass(__NAMESPACE__ . '\Console\GeneratorCommand');
        $method = $class->getConstructor();

        $object = new Method($method, null, $class, null, array('void' => '\Command'));
        $this->assertSame('\\' . $class->name, $object->getDeclaringClass());
        $this->assertSame('\\' . $class->name, $object->getRoot());
        $this->assertSame('__construct', $object->getName());

        $this->assertFalse($object->shouldReturn());
        $this->assertCount($method->getNumberOfParameters(), $object->getDocParams());

        $this->assertEquals(array('$config', '$files', '$view'), $object->getParams(false));
        $this->assertEquals('$config, $files, $view', $object->getParamsWithDefault());

        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . 'Create a new console command instance.', $doc);
        $this->assertContains("\n * " . '@param \Illuminate\Config\Repository ', $doc);
        $this->assertContains("\n * " . '@param \Illuminate\Filesystem\Filesystem ', $doc);
        $this->assertContains("\n * " . '@param \Illuminate\View\Factory ', $doc);
        $this->assertContains("\n * " . '@return \Command', $doc);
    }

    public function testConvertKeywords()
    {
        $method = new \ReflectionMethod('PHPUnit_Framework_TestCase', 'getProphet');
        $object = new Method($method, null, new \ReflectionClass(get_class($this)));

        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . '@return \Prophecy\Prophet', $doc);
        $this->assertContains("\n * " . '@since ', $doc);

        $method = new \ReflectionMethod('Doctrine\Common\Collections\Collection', 'exists');
        $object = new Method($method, null, $method->getDeclaringClass());
        //
        $doc = $object->getDocComment('', true);
        $this->assertContains("\n * " . '@param \Closure ', $doc);
        $this->assertContains("\n * " . '@return boolean ', $doc);
    }

    public function testGetParameters()
    {
        $method = new \ReflectionMethod(__NAMESPACE__ . '\Method', 'getDocComment');
        $object = new Method($method, null, $method->getDeclaringClass());

        $this->assertEquals('$prefix = ' . "'\t\t'" . ', $trim = false', $object->getParamsWithDefault());
        $this->assertEquals('$prefix, $trim', $object->getParams());

        $method = new \ReflectionMethod('Illuminate\Database\Query\Builder', 'select');
        $expected = array(array('$columns'), array('$columns = array(\'*\')'));
        $this->assertEquals($expected, $object->getParameters($method));
    }

    public function testGetUseStatements()
    {
        $rc = $this->getMock('ReflectionClass', array('getFileName'), array('PHPUnit_Exception'));
        $rc->expects($this->once())->method('getFileName')->willThrowException(new \Exception);

        $method = new \ReflectionMethod(__NAMESPACE__ . '\Method', 'getUseStatements');
        $method->setAccessible(true);
        $this->assertEmpty($method->invoke(null, $rc));
    }

    public function testGetInheritDocDeeply()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|\ReflectionMethod $method */
        $method = $this->getMock('ReflectionMethod', array('getDocComment', 'getPrototype'), array(__NAMESPACE__ . '\Method', 'getRoot'));
        $method->expects($this->once())->method('getDocComment')->willReturn('/**
 * {@inheritDoc}
 * @return dynamic
 */');
        $method->expects($this->once())->method('getPrototype')->willReturn(null);

        $object = new Method($method, null, $method->getDeclaringClass());
        $doc = $object->getDocComment('', true);
        //
        $this->assertContains("\n * " . '{@inheritDoc}', $doc);
        $this->assertContains("\n * " . '@return mixed', $doc);

        /* @var \PHPUnit_Framework_MockObject_MockObject|\ReflectionClass $class */
        $class = $this->getMock('ReflectionClass', array('getParentClass'), array(__NAMESPACE__ . '\Console\MetaCommand'));
        $method = $this->getMock('ReflectionMethod', array('getDeclaringClass'), array($class->name, '__construct'));
        $method->method('getDeclaringClass')->willReturn($class);

        /* @var \PHPUnit_Framework_MockObject_MockObject|\ReflectionClass $parent */
        $parent = $this->getMock('ReflectionClass', array('getMethod'), array('Illuminate\Console\Command'));
        $class->expects($this->once())->method('getParentClass')->willReturn($parent);

        $pm = $this->getMock('ReflectionMethod', array('getDeclaringClass', 'getDocComment'), array($parent->name, '__construct'));
        $parent->expects($this->once())->method('getMethod')->with('__construct')->willReturn($pm);

        $pm->method('getDeclaringClass')->willReturn($parent);
        $pm->expects($this->once())->method('getDocComment')->willReturn('/**
 * {@inheritDoc}
 * @return void
 */');

        $object = new Method($method, null, $class);
        $doc = $object->getDocComment('', true);

        $this->assertContains("\n * " . 'Constructor.', $doc);
        $this->assertContains("\n * " . '@param string|null $name ', $doc);
        $this->assertContains("\n * " . '@throws \LogicException ', $doc);
        $this->assertContains("\n * " . '@return void', $doc);
        $this->assertContains("\n * " . '@param \Illuminate\Container\Container', $doc);
    }

}

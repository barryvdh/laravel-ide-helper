<?php namespace Barryvdh\LaravelIdeHelper;

class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{
	/** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Container\Container */
	protected $app;
	/** @var IdeHelperServiceProvider */
	protected $provider;

	static function makeAppMock(\PHPUnit_Framework_TestCase $testCase)
	{
		$app = $testCase->getMock('Illuminate\Container\Container', array('make', 'bind'));

		$fs = $testCase->getMock('Illuminate\Filesystem\Filesystem', null);
		$config = $testCase->getMock('Illuminate\Config\Repository', array('get', 'set', 'package'), array(), '', false);
		$events = $testCase->getMock('Illuminate\Events\Dispatcher', array('listen'), array($app));
		$view = $testCase->getMock('Illuminate\View\Factory', array('addNamespace'), array(), '', false);

		$app->expects($testCase->any())->method('make')->willReturnMap(array(
			array('files', array(), $fs),
			array('config', array(), $config),
			array('events', array(), $events),
			array('view', array(), $view),
			array('path', array(), __DIR__),
		));

		return $app;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function setUp()
	{
		$this->app = static::makeAppMock($this);
		/** @noinspection PhpParamsInspection */
		$this->provider = new IdeHelperServiceProvider($this->app);
	}

	public function testDeferred()
	{
		$this->assertTrue($this->provider->isDeferred());
	}

	public function testProvides()
	{
		$this->assertEquals(array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta'), $this->provider->provides());
	}

	public function testRegister()
	{
		$this->app->expects($this->exactly(3))->method('bind')->withConsecutive(
			array('command.ide-helper.generate', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
			array('command.ide-helper.models', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse()),
			array('command.ide-helper.meta', $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_CALLABLE), $this->isFalse())
		);

		/** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Events\Dispatcher $events */
		$events = $this->app['events'];
		$events->expects($this->once())->method('listen')->with('artisan.start', $this->callback(function ($listener) {
			$params = print_r(array('commands' => array('command.ide-helper.generate', 'command.ide-helper.models', 'command.ide-helper.meta')), true);
			return strpos(preg_replace('/^\s+/mu', '', print_r($listener, true)), preg_replace('/^\s+/mu', '', $params));
		}), 0);

		$this->provider->register();
	}

	public function testBoot()
	{
		$path = realpath(__DIR__ . '/../src');

		/** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\Config\Repository $config */
		$config = $this->app['config'];
		$config->expects($this->once())->method('package')->with('barryvdh/laravel-ide-helper', $path . '/config', 'laravel-ide-helper');

		/** @var \PHPUnit_Framework_MockObject_MockObject|\Illuminate\View\Factory $view */
		$view = $this->app['view'];
		$view->expects($this->once())->method('addNamespace')->with('laravel-ide-helper', $path . '/views');

		$this->provider->boot();
	}

}

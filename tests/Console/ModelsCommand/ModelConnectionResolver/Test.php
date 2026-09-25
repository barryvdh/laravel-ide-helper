<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelConnectionResolver;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ModelConnectionResolver\Resolvers\SpyResolver;

class Test extends AbstractModelsCommand
{
    public function testResolveAndAfterAreCalledInOrder(): void
    {
        $spy = new SpyResolver();

        $this->app['config']->set('ide-helper.model_connection_resolver', SpyResolver::class);
        $this->app->instance(SpyResolver::class, $spy);

        $command = $this->app->make(ModelsCommand::class);
        $tester = $this->runCommand($command, ['--write' => true]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertContains('resolve:Simple', $spy->calls);
        $this->assertContains('after:Simple', $spy->calls);

        $resolveIndex = array_search('resolve:Simple', $spy->calls);
        $afterIndex = array_search('after:Simple', $spy->calls);
        $this->assertLessThan($afterIndex, $resolveIndex);
    }

    public function testSkipsResolverWhenConfigIsNull(): void
    {
        $this->app['config']->set('ide-helper.model_connection_resolver', null);

        $command = $this->app->make(ModelsCommand::class);
        $tester = $this->runCommand($command, ['--write' => true]);

        $this->assertSame(0, $tester->getStatusCode());
    }

    public function testThrowsRuntimeExceptionForInvalidResolver(): void
    {
        $this->app['config']->set('ide-helper.model_connection_resolver', \stdClass::class);

        $this->expectException(\RuntimeException::class);

        $command = $this->app->make(ModelsCommand::class);
        $this->runCommand($command, ['--write' => true]);
    }
}

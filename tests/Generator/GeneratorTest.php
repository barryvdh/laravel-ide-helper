<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Generator;

use Barryvdh\LaravelIdeHelper\Generator;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;

class GeneratorTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [IdeHelperServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        /** @var Repository $config */
        $config = $app->get('config');
        $config->set('view.paths', [
            realpath(__DIR__ . '/../../resources/views'),
        ]);
    }

    public function testGenerator(): void
    {
        // Feel free to bump this with a major Laravel release!
        if ((int) Application::VERSION !== 7) {
            self::markTestSkipped('This test only works with Laravel 7');
        }

        $generator = new Generator(
            $this->app->get('config'),
            $this->app->get('view')
        );

        $output = $generator->generate();

        $output = preg_replace("/.*Generated for Laravel 7.*\n/", '', $output);

        $this->assertMatchesPhpSnapshot($output);
    }
}

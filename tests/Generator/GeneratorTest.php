<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Generator;

use Barryvdh\LaravelIdeHelper\Generator;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\LaravelIdeHelper\Tests\TestCase;
use Illuminate\Contracts\Config\Repository;

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
        $generator = new Generator(
            $this->app->get('config'),
            $this->app->get('view')
        );

        $output = $generator->generate();

        $this->assertMatchesPhpSnapshot($output);
    }
}

<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Filesystem\Filesystem;
use Mockery;

final class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/Interfaces/Models',
            ],
        ]);
    }

    public function test(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);

        $mockFilesystem
            ->shouldReceive('put')
            ->with(
                Mockery::any(),
                Mockery::capture($actualContent)
            )
            ->andReturn(1) // Simulate we wrote _something_ to the file
            ->once();

        $this->instance(Filesystem::class, $mockFilesystem);

        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--nowrite' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertEmpty($tester->getDisplay());

        $expectedContent = <<<'PHP'
<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces\Models{
/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces\Models\User
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Interfaces\Models\User query()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable {}
}


PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

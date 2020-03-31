<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection;
use Illuminate\Filesystem\Filesystem;
use Mockery;

class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/CustomCollection/Models',
            ],
        ]);
    }

    public function test(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__ . '/Models/Simple.php'))
            ->once();
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
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertEmpty($tester->getDisplay());

        $expectedContent = <<<'PHP'
<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple
 *
 * @property integer $id
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple[] all($columns = ['*'])
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Collections\SimpleCollection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\CustomCollection\Models\Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    public function newCollection(array $models = [])
    {
        return new SimpleCollection($models);
    }
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

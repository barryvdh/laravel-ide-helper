<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Mockery;

class ReturnTypeTest extends AbstractModelsCommand
{

    protected function setUp(): void
    {
        parent::setUp();

        if (version_compare(Application::VERSION, '7.0', '<')) {
            $this->markTestSkipped('This test requires Laravel 7.0 or higher');
            return;
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/LaravelCustomCasts/Models/CustomCastWithReturnType',
            ],
        ]);
    }

    public function test_it_parses_casted_object_with_return_type(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__.'/Models/CustomCastWithReturnType/CustomCastWithReturnType.php'))
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType\CustomCastWithReturnType
 *
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType\CustomCastWithReturnType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType\CustomCastWithReturnType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType\CustomCastWithReturnType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithReturnType\CustomCastWithReturnType whereCastedProperty($value)
 * @mixin \Eloquent
 */
class CustomCastWithReturnType extends Model
{
    protected $table = 'custom_casts';
    protected $casts = [
        'casted_property' => CustomCasterWithReturnType::class
    ];
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

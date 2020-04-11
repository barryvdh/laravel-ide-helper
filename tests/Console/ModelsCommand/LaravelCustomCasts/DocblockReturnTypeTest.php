<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Mockery;

class DocblockReturnTypeTest extends AbstractModelsCommand
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
                '/../../../../tests/Console/ModelsCommand/LaravelCustomCasts/Models/CustomCastWithDocblockReturnType',
            ],
        ]);
    }

    public function test_it_parses_casted_object_with_docblock_return_type(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__.'/Models/CustomCastWithDocblockReturnType/CustomCastWithDocblockReturnType.php'))
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
//dd($actualContent);
        $expectedContent = <<<'PHP'
<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType\CustomCastWithDocblockReturnType
 *
 * @property \CastedProperty $casted_property
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType\CustomCastWithDocblockReturnType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType\CustomCastWithDocblockReturnType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType\CustomCastWithDocblockReturnType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCastWithDocblockReturnType\CustomCastWithDocblockReturnType whereCastedProperty($value)
 * @mixin \Eloquent
 */
class CustomCastWithDocblockReturnType extends Model
{
    protected $table = 'custom_casts';
    protected $casts = [
        'casted_property' => CustomCasterWithDocblockReturn::class
    ];
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

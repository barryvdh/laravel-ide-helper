<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Mockery;

class Test extends AbstractModelsCommand
{

    protected function setUp(): void
    {
        parent::setUp();

        if (version_compare(Application::VERSION, '7.0', '<')) {
            $this->markTestSkipped('This test requires Laravel 7.0 or higher');
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper', [
            'model_locations' => [
                // This is calculated from the base_path() which points to
                // vendor/orchestra/testbench-core/laravel
                '/../../../../tests/Console/ModelsCommand/LaravelCustomCasts/Models',
            ],
        ]);
    }

    public function test_it_parses_casted_properties_correctly(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__.'/Models/CustomCast.php'))
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithDocblockReturnFqn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithNullablePrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithoutReturnType;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveDocblockReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithPrimitiveReturn;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CustomCasterWithReturnType;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Models\CustomCast
 *
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_type
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock
 * @property \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\LaravelCustomCasts\Casts\CastedProperty $casted_property_with_return_docblock_fqn
 * @property array $casted_property_with_return_primitive
 * @property array|null $casted_property_with_return_primitive_docblock
 * @property array|null $casted_property_with_return_nullable_primitive
 * @property $casted_property_without_return
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnDocblockFqn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnNullablePrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnPrimitiveDocblock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomCast whereCastedPropertyWithoutReturn($value)
 * @mixin \Eloquent
 */
class CustomCast extends Model
{
    protected $casts = [
        'casted_property_with_return_type' => CustomCasterWithReturnType::class,
        'casted_property_with_return_docblock' => CustomCasterWithDocblockReturn::class,
        'casted_property_with_return_docblock_fqn' => CustomCasterWithDocblockReturnFqn::class,
        'casted_property_with_return_primitive' => CustomCasterWithPrimitiveReturn::class,
        'casted_property_with_return_primitive_docblock' => CustomCasterWithPrimitiveDocblockReturn::class,
        'casted_property_with_return_nullable_primitive' => CustomCasterWithNullablePrimitiveReturn::class,
        'casted_property_without_return' => CustomCasterWithoutReturnType::class,
    ];
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

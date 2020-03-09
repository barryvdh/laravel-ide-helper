<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AbstractModelsCommand;
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
                '/../../../../tests/Console/ModelsCommand/Getter/Models',
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple
 *
 * @property integer $id
 * @property-read mixed $attribute_return_type_int_or_null
 * @property-read \what|\ever|\we-write/here $attribute_takes_phpdoc_literal
 * @property-read int $attribute_with_int_return_phpdoc
 * @property-read string $attribute_with_int_return_type_and_but_phpdoc_string
 * @property-read int $attribute_with_int_return_type_and_phpdoc
 * @property-read mixed $attribute_with_int_return_type
 * @property-read mixed $attribute_without_type
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    /**
     * @return int
     */
    public function getAttributeWithIntReturnPhpdocAttribute()
    {
    }

    public function getAttributeWithIntReturnTypeAttribute(): int
    {
    }

    /**
     * @return int
     */
    public function getAttributeWithIntReturnTypeAndPhpdocAttribute(): int
    {
    }

    /**
     * @return string
     */
    public function getAttributeWithIntReturnTypeAndButPhpdocStringAttribute(): int
    {
    }

    public function getAttributeWithoutTypeAttribute()
    {
    }

    /**
     * @return what|ever|we-write/here
     */
    public function getAttributeTakesPhpdocLiteralAttribute()
    {
    }

    public function getAttributeReturnTypeIntOrNullAttribute(): ?int
    {
    }

    public function getAttributeReturnsImportedClass(): DateTime
    {
    }

    public function getAttributeReturnsFqnClass(): \Illuminate\Support\Facades\Date
    {
    }
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

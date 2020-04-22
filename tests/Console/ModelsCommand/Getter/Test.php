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
 * @property-read int|null $attribute_return_type_int_or_null
 * @property-read array $attribute_returns_array
 * @property-read bool $attribute_returns_bool
 * @property-read callable $attribute_returns_callable
 * @property-read bool $attribute_returns_float
 * @property-read \Illuminate\Support\Facades\Date $attribute_returns_fqn_class
 * @property-read \DateTime $attribute_returns_imported_class
 * @property-read array|null $attribute_returns_nullable_array
 * @property-read bool|null $attribute_returns_nullable_bool
 * @property-read callable|null $attribute_returns_nullable_callable
 * @property-read bool|null $attribute_returns_nullable_float
 * @property-read \stdClass|null $attribute_returns_nullable_std_class
 * @property-read \stdClass $attribute_returns_std_class
 * @property-read void $attribute_returns_void
 * @property-read \what|\ever|\we-write/here $attribute_takes_phpdoc_literal
 * @property-read int $attribute_with_int_return_phpdoc
 * @property-read string $attribute_with_int_return_type_and_but_phpdoc_string
 * @property-read int $attribute_with_int_return_type_and_phpdoc
 * @property-read int $attribute_with_int_return_type
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

    public function getAttributeReturnsImportedClassAttribute(): DateTime
    {
    }

    public function getAttributeReturnsFqnClassAttribute(): \Illuminate\Support\Facades\Date
    {
    }

    public function getAttributeReturnsArrayAttribute(): array
    {
    }

    public function getAttributeReturnsNullableArrayAttribute(): ?array
    {
    }

    public function getAttributeReturnsStdClassAttribute(): \stdClass
    {
    }

    public function getAttributeReturnsNullableStdClassAttribute(): ?\stdClass
    {
    }

    public function getAttributeReturnsBoolAttribute(): bool
    {
    }

    public function getAttributeReturnsNullableBoolAttribute(): ?bool
    {
    }

    public function getAttributeReturnsFloatAttribute(): bool
    {
    }

    public function getAttributeReturnsNullableFloatAttribute(): ?bool
    {
    }

    public function getAttributeReturnsCallableAttribute(): callable
    {
    }

    public function getAttributeReturnsNullableCallableAttribute(): ?callable
    {
    }

    /**
     * Doesn't make sense, but…
     */
    public function getAttributeReturnsVoidAttribute(): void
    {
    }
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

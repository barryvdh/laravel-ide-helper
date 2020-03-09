<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc;

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
                '/../../../../tests/Console/ModelsCommand/GenerateBasicPhpdoc/Models',
            ],
        ]);
    }

    public function test(): void
    {
        $actualContent = null;
        $mockFilesystem = Mockery::mock(Filesystem::class);
        $mockFilesystem
            ->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__ . '/Models/Post.php'))
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post
 *
 * @property integer $id
 * @property string|null $char_nullable
 * @property string $char_not_nullable
 * @property string|null $string_nullable
 * @property string $string_not_nullable
 * @property string|null $text_nullable
 * @property string $text_not_nullable
 * @property string|null $medium_text_nullable
 * @property string $medium_text_not_nullable
 * @property string|null $long_text_nullable
 * @property string $long_text_not_nullable
 * @property integer|null $integer_nullable
 * @property integer $integer_not_nullable
 * @property integer|null $tiny_integer_nullable
 * @property integer $tiny_integer_not_nullable
 * @property integer|null $small_integer_nullable
 * @property integer $small_integer_not_nullable
 * @property integer|null $medium_integer_nullable
 * @property integer $medium_integer_not_nullable
 * @property integer|null $big_integer_nullable
 * @property integer $big_integer_not_nullable
 * @property integer|null $unsigned_integer_nullable
 * @property integer $unsigned_integer_not_nullable
 * @property integer|null $unsigned_tiny_integer_nullable
 * @property integer $unsigned_tiny_integer_not_nullable
 * @property integer|null $unsigned_small_integer_nullable
 * @property integer $unsigned_small_integer_not_nullable
 * @property integer|null $unsigned_medium_integer_nullable
 * @property integer $unsigned_medium_integer_not_nullable
 * @property integer|null $unsigned_big_integer_nullable
 * @property integer $unsigned_big_integer_not_nullable
 * @property float|null $float_nullable
 * @property float $float_not_nullable
 * @property float|null $double_nullable
 * @property float $double_not_nullable
 * @property float|null $decimal_nullable
 * @property float $decimal_not_nullable
 * @property float|null $unsigned_decimal_nullable
 * @property float $unsigned_decimal_not_nullable
 * @property integer|null $boolean_nullable
 * @property integer $boolean_not_nullable
 * @property string|null $enum_nullable
 * @property string $enum_not_nullable
 * @property string|null $json_nullable
 * @property string $json_not_nullable
 * @property string|null $jsonb_nullable
 * @property string $jsonb_not_nullable
 * @property string|null $date_nullable
 * @property string $date_not_nullable
 * @property string|null $datetime_nullable
 * @property string $datetime_not_nullable
 * @property string|null $datetimetz_nullable
 * @property string $datetimetz_not_nullable
 * @property string|null $time_nullable
 * @property string $time_not_nullable
 * @property string|null $timetz_nullable
 * @property string $timetz_not_nullable
 * @property string|null $timestamp_nullable
 * @property string $timestamp_not_nullable
 * @property string|null $timestamptz_nullable
 * @property string $timestamptz_not_nullable
 * @property integer|null $year_nullable
 * @property integer $year_not_nullable
 * @property mixed|null $binary_nullable
 * @property mixed $binary_not_nullable
 * @property string|null $uuid_nullable
 * @property string $uuid_not_nullable
 * @property string|null $ipaddress_nullable
 * @property string $ipaddress_not_nullable
 * @property string|null $macaddress_nullable
 * @property string $macaddress_not_nullable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models\Post whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

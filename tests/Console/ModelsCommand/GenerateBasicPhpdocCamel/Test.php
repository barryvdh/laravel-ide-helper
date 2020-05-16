<?php declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel;

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
                '/../../../../tests/Console/ModelsCommand/GenerateBasicPhpdocCamel/Models',
            ],
            // Activate the camel_case mode
            'model_camel_case_properties' => true,
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

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post
 *
 * @property integer $id
 * @property string|null $charNullable
 * @property string $charNotNullable
 * @property string|null $stringNullable
 * @property string $stringNotNullable
 * @property string|null $textNullable
 * @property string $textNotNullable
 * @property string|null $mediumTextNullable
 * @property string $mediumTextNotNullable
 * @property string|null $longTextNullable
 * @property string $longTextNotNullable
 * @property integer|null $integerNullable
 * @property integer $integerNotNullable
 * @property integer|null $tinyIntegerNullable
 * @property integer $tinyIntegerNotNullable
 * @property integer|null $smallIntegerNullable
 * @property integer $smallIntegerNotNullable
 * @property integer|null $mediumIntegerNullable
 * @property integer $mediumIntegerNotNullable
 * @property integer|null $bigIntegerNullable
 * @property integer $bigIntegerNotNullable
 * @property integer|null $unsignedIntegerNullable
 * @property integer $unsignedIntegerNotNullable
 * @property integer|null $unsignedTinyIntegerNullable
 * @property integer $unsignedTinyIntegerNotNullable
 * @property integer|null $unsignedSmallIntegerNullable
 * @property integer $unsignedSmallIntegerNotNullable
 * @property integer|null $unsignedMediumIntegerNullable
 * @property integer $unsignedMediumIntegerNotNullable
 * @property integer|null $unsignedBigIntegerNullable
 * @property integer $unsignedBigIntegerNotNullable
 * @property float|null $floatNullable
 * @property float $floatNotNullable
 * @property float|null $doubleNullable
 * @property float $doubleNotNullable
 * @property float|null $decimalNullable
 * @property float $decimalNotNullable
 * @property float|null $unsignedDecimalNullable
 * @property float $unsignedDecimalNotNullable
 * @property integer|null $booleanNullable
 * @property integer $booleanNotNullable
 * @property string|null $enumNullable
 * @property string $enumNotNullable
 * @property string|null $jsonNullable
 * @property string $jsonNotNullable
 * @property string|null $jsonbNullable
 * @property string $jsonbNotNullable
 * @property string|null $dateNullable
 * @property string $dateNotNullable
 * @property string|null $datetimeNullable
 * @property string $datetimeNotNullable
 * @property string|null $datetimetzNullable
 * @property string $datetimetzNotNullable
 * @property string|null $timeNullable
 * @property string $timeNotNullable
 * @property string|null $timetzNullable
 * @property string $timetzNotNullable
 * @property string|null $timestampNullable
 * @property string $timestampNotNullable
 * @property string|null $timestamptzNullable
 * @property string $timestamptzNotNullable
 * @property integer|null $yearNullable
 * @property integer $yearNotNullable
 * @property mixed|null $binaryNullable
 * @property mixed $binaryNotNullable
 * @property string|null $uuidNullable
 * @property string $uuidNotNullable
 * @property string|null $ipaddressNullable
 * @property string $ipaddressNotNullable
 * @property string|null $macaddressNullable
 * @property string $macaddressNotNullable
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|self newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|self newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|self query()
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|self whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

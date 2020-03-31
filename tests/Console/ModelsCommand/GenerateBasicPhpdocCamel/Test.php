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
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models\Post whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

PHP;

        $this->assertSame($expectedContent, $actualContent);
    }
}

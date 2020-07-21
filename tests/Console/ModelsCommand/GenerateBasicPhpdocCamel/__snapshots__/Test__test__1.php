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
 * @property string|null $decimalNullable
 * @property string $decimalNotNullable
 * @property string|null $unsignedDecimalNullable
 * @property string $unsignedDecimalNotNullable
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
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

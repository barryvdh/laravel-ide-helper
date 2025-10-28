<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocCamel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
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
 * @property int|null $integerNullable
 * @property int $integerNotNullable
 * @property int|null $tinyIntegerNullable
 * @property int $tinyIntegerNotNullable
 * @property int|null $smallIntegerNullable
 * @property int $smallIntegerNotNullable
 * @property int|null $mediumIntegerNullable
 * @property int $mediumIntegerNotNullable
 * @property int|null $bigIntegerNullable
 * @property int $bigIntegerNotNullable
 * @property int|null $unsignedIntegerNullable
 * @property int $unsignedIntegerNotNullable
 * @property int|null $unsignedTinyIntegerNullable
 * @property int $unsignedTinyIntegerNotNullable
 * @property int|null $unsignedSmallIntegerNullable
 * @property int $unsignedSmallIntegerNotNullable
 * @property int|null $unsignedMediumIntegerNullable
 * @property int $unsignedMediumIntegerNotNullable
 * @property int|null $unsignedBigIntegerNullable
 * @property int $unsignedBigIntegerNotNullable
 * @property float|null $floatNullable
 * @property float $floatNotNullable
 * @property float|null $doubleNullable
 * @property float $doubleNotNullable
 * @property numeric|null $decimalNullable
 * @property numeric $decimalNotNullable
 * @property int|null $booleanNullable
 * @property int $booleanNotNullable
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
 * @property int|null $yearNullable
 * @property int $yearNotNullable
 * @property string|null $binaryNullable
 * @property string $binaryNotNullable
 * @property string|null $uuidNullable
 * @property string $uuidNotNullable
 * @property string|null $ipaddressNullable
 * @property string $ipaddressNotNullable
 * @property string|null $macaddressNullable
 * @property string $macaddressNotNullable
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

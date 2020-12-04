<?php

declare(strict_types=1);

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
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBigIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBigIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBinaryNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBinaryNullable(mixed|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBooleanNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBooleanNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCharNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCharNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt(\Illuminate\Support\Carbon|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDateNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDateNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimeNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimeNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimetzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDatetimetzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDecimalNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDecimalNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDoubleNotNullable(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDoubleNullable(float|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEnumNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEnumNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFloatNotNullable(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFloatNullable(float|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIpaddressNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIpaddressNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonbNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonbNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLongTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLongTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMacaddressNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMacaddressNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMediumTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStringNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStringNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimeNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimeNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestampNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestampNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestamptzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimestamptzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimetzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTimetzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTinyIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTinyIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedBigIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedBigIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedDecimalNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedDecimalNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedMediumIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedMediumIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedSmallIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedSmallIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedTinyIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUnsignedTinyIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt(\Illuminate\Support\Carbon|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUuidNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUuidNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereYearNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereYearNullable(integer|null $value)
 * @mixin \Eloquent
 */
class Post extends Model
{
}

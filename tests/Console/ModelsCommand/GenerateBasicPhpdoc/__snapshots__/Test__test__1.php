<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdoc\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
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
 * @property int|null $integer_nullable
 * @property int $integer_not_nullable
 * @property int|null $tiny_integer_nullable
 * @property int $tiny_integer_not_nullable
 * @property int|null $small_integer_nullable
 * @property int $small_integer_not_nullable
 * @property int|null $medium_integer_nullable
 * @property int $medium_integer_not_nullable
 * @property int|null $big_integer_nullable
 * @property int $big_integer_not_nullable
 * @property int|null $unsigned_integer_nullable
 * @property int $unsigned_integer_not_nullable
 * @property int|null $unsigned_tiny_integer_nullable
 * @property int $unsigned_tiny_integer_not_nullable
 * @property int|null $unsigned_small_integer_nullable
 * @property int $unsigned_small_integer_not_nullable
 * @property int|null $unsigned_medium_integer_nullable
 * @property int $unsigned_medium_integer_not_nullable
 * @property int|null $unsigned_big_integer_nullable
 * @property int $unsigned_big_integer_not_nullable
 * @property float|null $float_nullable
 * @property float $float_not_nullable
 * @property float|null $double_nullable
 * @property float $double_not_nullable
 * @property string|null $decimal_nullable
 * @property string $decimal_not_nullable
 * @property int|null $boolean_nullable
 * @property int $boolean_not_nullable
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
 * @property int|null $year_nullable
 * @property int $year_not_nullable
 * @property string|null $binary_nullable
 * @property string $binary_not_nullable
 * @property string|null $uuid_nullable
 * @property string $uuid_not_nullable
 * @property string|null $ipaddress_nullable
 * @property string $ipaddress_not_nullable
 * @property string|null $macaddress_nullable
 * @property string $macaddress_not_nullable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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

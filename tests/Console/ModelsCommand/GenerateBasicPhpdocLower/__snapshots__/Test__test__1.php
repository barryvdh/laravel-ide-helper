<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocLower\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpdocLower\Models\Upper
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
 * @property string|null $decimal_nullable
 * @property string $decimal_not_nullable
 * @property string|null $unsigned_decimal_nullable
 * @property string $unsigned_decimal_not_nullable
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
 * @method static \Illuminate\Database\Eloquent\Builder|Upper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upper query()
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBinaryNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBinaryNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBooleanNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereBooleanNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereCharNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereCharNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDateNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDateNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDatetimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDatetimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDatetimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDatetimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDoubleNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereDoubleNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereEnumNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereEnumNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereFloatNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereFloatNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereIpaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereIpaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereJsonNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereJsonNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereJsonbNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereJsonbNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereLongTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereLongTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMacaddressNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMacaddressNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMediumTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereMediumTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereStringNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereStringNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTextNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTextNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimeNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimeNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimestampNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimestampNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimestamptzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimestamptzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimetzNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTimetzNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedBigIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedBigIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedDecimalNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedDecimalNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedMediumIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedSmallIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUnsignedTinyIntegerNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUuidNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereUuidNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereYearNotNullable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upper whereYearNullable($value)
 * @mixin \Eloquent
 */
class Upper extends Model
{
}

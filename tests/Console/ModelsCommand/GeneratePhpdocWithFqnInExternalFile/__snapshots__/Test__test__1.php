<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models{
/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models\Post
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder|Post newModelQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder|Post newQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder|Post query()
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
 */
	class Post extends \Eloquent {}
}


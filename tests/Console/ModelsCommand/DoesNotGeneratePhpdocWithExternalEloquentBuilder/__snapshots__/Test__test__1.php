<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DoesNotGeneratePhpdocWithExternalEloquentBuilder\Models{
/**
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
 * @property numeric|null $decimal_nullable
 * @property numeric $decimal_not_nullable
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DoesNotGeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder<static>|Post newModelQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DoesNotGeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder<static>|Post newQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\DoesNotGeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder<static>|Post query()
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
 */
	class Post extends \Eloquent {}
}


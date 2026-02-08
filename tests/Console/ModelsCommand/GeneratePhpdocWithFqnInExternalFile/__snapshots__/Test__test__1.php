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


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models{
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post newModelQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post newQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post query()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBigIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBigIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBinaryNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBinaryNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBooleanNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereBooleanNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereCharNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereCharNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereCreatedAt($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDateNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDateNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDatetimeNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDatetimeNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDatetimetzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDatetimetzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDecimalNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDecimalNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDoubleNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereDoubleNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereEnumNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereEnumNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereFloatNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereFloatNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereId($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereIpaddressNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereIpaddressNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereJsonNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereJsonNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereJsonbNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereJsonbNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereLongTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereLongTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMacaddressNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMacaddressNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMediumIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMediumIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMediumTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereMediumTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereSmallIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereSmallIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereStringNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereStringNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimeNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimeNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimestampNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimestampNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimestamptzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimestamptzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimetzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTimetzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTinyIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereTinyIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedBigIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUpdatedAt($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUuidNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereUuidNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereYearNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder<static>|Post whereYearNullable($value)
 */
	class Post extends \Eloquent {}
}


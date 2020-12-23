<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Models{
/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Models\Post
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
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post isActive()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post isLoadingWith(?string $with)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post isStatus(string $status)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post newModelQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post newQuery()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post query()
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBigIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBigIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBinaryNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBinaryNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBooleanNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereBooleanNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereCharNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereCharNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereCreatedAt($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDateNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDateNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDatetimeNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDatetimeNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDatetimetzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDatetimetzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDecimalNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDecimalNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDoubleNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereDoubleNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereEnumNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereEnumNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereFloatNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereFloatNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereId($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereIpaddressNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereIpaddressNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereJsonNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereJsonNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereJsonbNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereJsonbNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereLongTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereLongTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMacaddressNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMacaddressNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMediumIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMediumIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMediumTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereMediumTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereSmallIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereSmallIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereStringNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereStringNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTextNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTextNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimeNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimeNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimestampNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimestampNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimestamptzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimestamptzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimetzNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTimetzNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTinyIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereTinyIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedBigIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedDecimalNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedDecimalNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedMediumIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedSmallIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUnsignedTinyIntegerNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUpdatedAt($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUuidNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereUuidNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereYearNotNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post whereYearNullable($value)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withBool(?bool $booleanVar)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withBoolDifferently(?bool $booleanVar)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withBoolTypeHinted(bool $booleanVar)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withMixedOption($option)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withNullAndAssignmentTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand = null)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withNullTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withNullTestCommandInDocBlock($testCommand)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withSomeone($someone)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withTestCommand(\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withTheNumber(?int $number)
 * @method static \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilder\Builders\PostExternalQueryBuilder|Post withTheNumberDifferently(?int $number)
 */
	class Post extends \Eloquent {}
}


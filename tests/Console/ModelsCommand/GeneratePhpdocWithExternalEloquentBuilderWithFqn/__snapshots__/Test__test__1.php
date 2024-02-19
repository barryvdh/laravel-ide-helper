<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilderWithFqn\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilderWithFqn\Builders\PostExternalQueryBuilder;
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
 * @method static PostExternalQueryBuilder|Post isActive()
 * @method static PostExternalQueryBuilder|Post isLoadingWith(?string $with)
 * @method static PostExternalQueryBuilder|Post isStatus(string $status)
 * @method static PostExternalQueryBuilder|Post newModelQuery()
 * @method static PostExternalQueryBuilder|Post newQuery()
 * @method static PostExternalQueryBuilder|Post query()
 * @method static PostExternalQueryBuilder|Post whereBigIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereBigIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereBinaryNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereBinaryNullable($value)
 * @method static PostExternalQueryBuilder|Post whereBooleanNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereBooleanNullable($value)
 * @method static PostExternalQueryBuilder|Post whereCharNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereCharNullable($value)
 * @method static PostExternalQueryBuilder|Post whereCreatedAt($value)
 * @method static PostExternalQueryBuilder|Post whereDateNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDateNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDatetimeNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDatetimeNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDatetimetzNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDatetimetzNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDecimalNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDecimalNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDoubleNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereDoubleNullable($value)
 * @method static PostExternalQueryBuilder|Post whereEnumNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereEnumNullable($value)
 * @method static PostExternalQueryBuilder|Post whereFloatNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereFloatNullable($value)
 * @method static PostExternalQueryBuilder|Post whereId($value)
 * @method static PostExternalQueryBuilder|Post whereIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereIpaddressNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereIpaddressNullable($value)
 * @method static PostExternalQueryBuilder|Post whereJsonNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereJsonNullable($value)
 * @method static PostExternalQueryBuilder|Post whereJsonbNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereJsonbNullable($value)
 * @method static PostExternalQueryBuilder|Post whereLongTextNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereLongTextNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMacaddressNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMacaddressNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMediumIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMediumIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMediumTextNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereMediumTextNullable($value)
 * @method static PostExternalQueryBuilder|Post whereSmallIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereSmallIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereStringNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereStringNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTextNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTextNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimeNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimeNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimestampNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimestampNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimestamptzNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimestamptzNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimetzNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTimetzNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTinyIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereTinyIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedBigIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedMediumIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedSmallIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUnsignedTinyIntegerNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUpdatedAt($value)
 * @method static PostExternalQueryBuilder|Post whereUuidNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereUuidNullable($value)
 * @method static PostExternalQueryBuilder|Post whereYearNotNullable($value)
 * @method static PostExternalQueryBuilder|Post whereYearNullable($value)
 * @method static PostExternalQueryBuilder|Post withBool(?bool $booleanVar)
 * @method static PostExternalQueryBuilder|Post withBoolDifferently(?bool $booleanVar)
 * @method static PostExternalQueryBuilder|Post withBoolTypeHinted(bool $booleanVar)
 * @method static PostExternalQueryBuilder|Post withMixedOption($option)
 * @method static PostExternalQueryBuilder|Post withNullAndAssignmentTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand = null)
 * @method static PostExternalQueryBuilder|Post withNullTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static PostExternalQueryBuilder|Post withNullTestCommandInDocBlock($testCommand)
 * @method static PostExternalQueryBuilder|Post withSomeone($someone)
 * @method static PostExternalQueryBuilder|Post withTestCommand(\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static PostExternalQueryBuilder|Post withTheNumber(?int $number)
 * @method static PostExternalQueryBuilder|Post withTheNumberDifferently(?int $number)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function newEloquentBuilder($query): PostExternalQueryBuilder
    {
        return new PostExternalQueryBuilder($query);
    }
}

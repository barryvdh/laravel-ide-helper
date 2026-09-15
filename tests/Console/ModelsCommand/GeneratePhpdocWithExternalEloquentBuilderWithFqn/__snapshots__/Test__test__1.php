<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilderWithFqn\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithExternalEloquentBuilderWithFqn\Builders\PostExternalQueryBuilder;
use Illuminate\Database\Eloquent\Model;

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
 * @method static PostExternalQueryBuilder<static>|Post isActive()
 * @method static PostExternalQueryBuilder<static>|Post isLoadingWith(?string $with)
 * @method static PostExternalQueryBuilder<static>|Post isStatus(string $status)
 * @method static PostExternalQueryBuilder<static>|Post newModelQuery()
 * @method static PostExternalQueryBuilder<static>|Post newQuery()
 * @method static PostExternalQueryBuilder<static>|Post query()
 * @method static PostExternalQueryBuilder<static>|Post whereBigIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereBigIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereBinaryNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereBinaryNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereBooleanNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereBooleanNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereCharNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereCharNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereCreatedAt($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDateNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDateNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDatetimeNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDatetimeNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDatetimetzNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDatetimetzNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDecimalNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDecimalNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDoubleNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereDoubleNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereEnumNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereEnumNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereFloatNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereFloatNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereId($value)
 * @method static PostExternalQueryBuilder<static>|Post whereIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereIpaddressNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereIpaddressNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereJsonNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereJsonNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereJsonbNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereJsonbNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereLongTextNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereLongTextNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMacaddressNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMacaddressNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMediumIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMediumIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMediumTextNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereMediumTextNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereSmallIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereSmallIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereStringNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereStringNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTextNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTextNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimeNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimeNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimestampNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimestampNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimestamptzNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimestamptzNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimetzNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTimetzNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTinyIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereTinyIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedBigIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedMediumIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedSmallIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUnsignedTinyIntegerNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUpdatedAt($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUuidNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereUuidNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereYearNotNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post whereYearNullable($value)
 * @method static PostExternalQueryBuilder<static>|Post withBool(?bool $booleanVar)
 * @method static PostExternalQueryBuilder<static>|Post withBoolDifferently(?bool $booleanVar)
 * @method static PostExternalQueryBuilder<static>|Post withBoolTypeHinted(bool $booleanVar)
 * @method static PostExternalQueryBuilder<static>|Post withMixedOption($option)
 * @method static PostExternalQueryBuilder<static>|Post withNullAndAssignmentTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand = null)
 * @method static PostExternalQueryBuilder<static>|Post withNullTestCommand(?\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static PostExternalQueryBuilder<static>|Post withNullTestCommandInDocBlock($testCommand)
 * @method static PostExternalQueryBuilder<static>|Post withSomeone($someone)
 * @method static PostExternalQueryBuilder<static>|Post withTestCommand(\Barryvdh\LaravelIdeHelper\Console\ModelsCommand $testCommand)
 * @method static PostExternalQueryBuilder<static>|Post withTheNumber(?int $number)
 * @method static PostExternalQueryBuilder<static>|Post withTheNumberDifferently(?int $number)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function newEloquentBuilder($query): PostExternalQueryBuilder
    {
        return new PostExternalQueryBuilder($query);
    }
}

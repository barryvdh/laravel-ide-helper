<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder|Post hasStatus(?\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Enums\PostStatus $status = \Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GenerateBasicPhpDocWithEnumDefaults\Enums\PostStatus::Published)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereBigIntegerNotNullable($value)
 * @method static Builder|Post whereBigIntegerNullable($value)
 * @method static Builder|Post whereBinaryNotNullable($value)
 * @method static Builder|Post whereBinaryNullable($value)
 * @method static Builder|Post whereBooleanNotNullable($value)
 * @method static Builder|Post whereBooleanNullable($value)
 * @method static Builder|Post whereCharNotNullable($value)
 * @method static Builder|Post whereCharNullable($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDateNotNullable($value)
 * @method static Builder|Post whereDateNullable($value)
 * @method static Builder|Post whereDatetimeNotNullable($value)
 * @method static Builder|Post whereDatetimeNullable($value)
 * @method static Builder|Post whereDatetimetzNotNullable($value)
 * @method static Builder|Post whereDatetimetzNullable($value)
 * @method static Builder|Post whereDecimalNotNullable($value)
 * @method static Builder|Post whereDecimalNullable($value)
 * @method static Builder|Post whereDoubleNotNullable($value)
 * @method static Builder|Post whereDoubleNullable($value)
 * @method static Builder|Post whereEnumNotNullable($value)
 * @method static Builder|Post whereEnumNullable($value)
 * @method static Builder|Post whereFloatNotNullable($value)
 * @method static Builder|Post whereFloatNullable($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereIntegerNotNullable($value)
 * @method static Builder|Post whereIntegerNullable($value)
 * @method static Builder|Post whereIpaddressNotNullable($value)
 * @method static Builder|Post whereIpaddressNullable($value)
 * @method static Builder|Post whereJsonNotNullable($value)
 * @method static Builder|Post whereJsonNullable($value)
 * @method static Builder|Post whereJsonbNotNullable($value)
 * @method static Builder|Post whereJsonbNullable($value)
 * @method static Builder|Post whereLongTextNotNullable($value)
 * @method static Builder|Post whereLongTextNullable($value)
 * @method static Builder|Post whereMacaddressNotNullable($value)
 * @method static Builder|Post whereMacaddressNullable($value)
 * @method static Builder|Post whereMediumIntegerNotNullable($value)
 * @method static Builder|Post whereMediumIntegerNullable($value)
 * @method static Builder|Post whereMediumTextNotNullable($value)
 * @method static Builder|Post whereMediumTextNullable($value)
 * @method static Builder|Post whereSmallIntegerNotNullable($value)
 * @method static Builder|Post whereSmallIntegerNullable($value)
 * @method static Builder|Post whereStringNotNullable($value)
 * @method static Builder|Post whereStringNullable($value)
 * @method static Builder|Post whereTextNotNullable($value)
 * @method static Builder|Post whereTextNullable($value)
 * @method static Builder|Post whereTimeNotNullable($value)
 * @method static Builder|Post whereTimeNullable($value)
 * @method static Builder|Post whereTimestampNotNullable($value)
 * @method static Builder|Post whereTimestampNullable($value)
 * @method static Builder|Post whereTimestamptzNotNullable($value)
 * @method static Builder|Post whereTimestamptzNullable($value)
 * @method static Builder|Post whereTimetzNotNullable($value)
 * @method static Builder|Post whereTimetzNullable($value)
 * @method static Builder|Post whereTinyIntegerNotNullable($value)
 * @method static Builder|Post whereTinyIntegerNullable($value)
 * @method static Builder|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static Builder|Post whereUnsignedBigIntegerNullable($value)
 * @method static Builder|Post whereUnsignedIntegerNotNullable($value)
 * @method static Builder|Post whereUnsignedIntegerNullable($value)
 * @method static Builder|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static Builder|Post whereUnsignedMediumIntegerNullable($value)
 * @method static Builder|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static Builder|Post whereUnsignedSmallIntegerNullable($value)
 * @method static Builder|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static Builder|Post whereUnsignedTinyIntegerNullable($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUuidNotNullable($value)
 * @method static Builder|Post whereUuidNullable($value)
 * @method static Builder|Post whereYearNotNullable($value)
 * @method static Builder|Post whereYearNullable($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function scopeHasStatus(Builder $query, ?PostStatus $status = PostStatus::Published)
    {
        //
    }
}

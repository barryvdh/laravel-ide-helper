<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post null($unusedParam)
 * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBigIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBigIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBinaryNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBinaryNullable(mixed|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBooleanNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBooleanNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCharNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCharNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCreatedAt(\Illuminate\Support\Carbon|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDateNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDateNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimeNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimeNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimetzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimetzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDecimalNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDecimalNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDoubleNotNullable(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDoubleNullable(float|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereEnumNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereEnumNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereFloatNotNullable(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereFloatNullable(float|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereId(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIpaddressNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIpaddressNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonbNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonbNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereLongTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereLongTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMacaddressNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMacaddressNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereSmallIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereSmallIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereStringNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereStringNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTextNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTextNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimeNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimeNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestampNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestampNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestamptzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestamptzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimetzNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimetzNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTinyIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTinyIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedBigIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedBigIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedDecimalNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedDecimalNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedMediumIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedMediumIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedSmallIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedSmallIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedTinyIntegerNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedTinyIntegerNullable(integer|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUpdatedAt(\Illuminate\Support\Carbon|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUuidNotNullable(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUuidNullable(string|null $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereYearNotNullable(integer $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereYearNullable(integer|null $value)
 * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use SoftDeletes;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeNull($query, string $unusedParam)
    {
        return $query;
    }
}

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int,\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post null(string $unusedParam)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBigIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBigIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBinaryNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBinaryNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBooleanNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereBooleanNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCharNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCharNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereCreatedAt(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDateNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDateNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimeNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimeNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimetzNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDatetimetzNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDecimalNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDecimalNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDoubleNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereDoubleNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereEnumNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereEnumNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereFloatNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereFloatNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereId(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIpaddressNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereIpaddressNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonbNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereJsonbNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereLongTextNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereLongTextNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMacaddressNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMacaddressNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumTextNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereMediumTextNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereSmallIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereSmallIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereStringNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereStringNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTextNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTextNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimeNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimeNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestampNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestampNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestamptzNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimestamptzNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimetzNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTimetzNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTinyIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereTinyIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedBigIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedBigIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedMediumIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedMediumIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedSmallIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedSmallIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedTinyIntegerNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUnsignedTinyIntegerNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUpdatedAt(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUuidNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereUuidNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereYearNotNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post whereYearNullable(mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithForcedFqn\Models\Post withoutTrashed()
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

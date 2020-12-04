<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqn\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqn\Casts\CastType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\GeneratePhpdocWithFqn\Models\Post
 *
 * @property integer $id
 * @property string|null $char_nullable
 * @property CastType $char_not_nullable
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @method static EloquentBuilder|Post newModelQuery()
 * @method static EloquentBuilder|Post newQuery()
 * @method static EloquentBuilder|Post null($unusedParam)
 * @method static QueryBuilder|Post onlyTrashed()
 * @method static EloquentBuilder|Post query()
 * @method static EloquentBuilder|Post whereBigIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereBigIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereBinaryNotNullable(mixed $value)
 * @method static EloquentBuilder|Post whereBinaryNullable(mixed|null $value)
 * @method static EloquentBuilder|Post whereBooleanNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereBooleanNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereCharNotNullable(string $value)
 * @method static EloquentBuilder|Post whereCharNullable(string|null $value)
 * @method static EloquentBuilder|Post whereCreatedAt(Carbon|null $value)
 * @method static EloquentBuilder|Post whereDateNotNullable(string $value)
 * @method static EloquentBuilder|Post whereDateNullable(string|null $value)
 * @method static EloquentBuilder|Post whereDatetimeNotNullable(string $value)
 * @method static EloquentBuilder|Post whereDatetimeNullable(string|null $value)
 * @method static EloquentBuilder|Post whereDatetimetzNotNullable(string $value)
 * @method static EloquentBuilder|Post whereDatetimetzNullable(string|null $value)
 * @method static EloquentBuilder|Post whereDecimalNotNullable(string $value)
 * @method static EloquentBuilder|Post whereDecimalNullable(string|null $value)
 * @method static EloquentBuilder|Post whereDoubleNotNullable(float $value)
 * @method static EloquentBuilder|Post whereDoubleNullable(float|null $value)
 * @method static EloquentBuilder|Post whereEnumNotNullable(string $value)
 * @method static EloquentBuilder|Post whereEnumNullable(string|null $value)
 * @method static EloquentBuilder|Post whereFloatNotNullable(float $value)
 * @method static EloquentBuilder|Post whereFloatNullable(float|null $value)
 * @method static EloquentBuilder|Post whereId(integer $value)
 * @method static EloquentBuilder|Post whereIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereIpaddressNotNullable(string $value)
 * @method static EloquentBuilder|Post whereIpaddressNullable(string|null $value)
 * @method static EloquentBuilder|Post whereJsonNotNullable(string $value)
 * @method static EloquentBuilder|Post whereJsonNullable(string|null $value)
 * @method static EloquentBuilder|Post whereJsonbNotNullable(string $value)
 * @method static EloquentBuilder|Post whereJsonbNullable(string|null $value)
 * @method static EloquentBuilder|Post whereLongTextNotNullable(string $value)
 * @method static EloquentBuilder|Post whereLongTextNullable(string|null $value)
 * @method static EloquentBuilder|Post whereMacaddressNotNullable(string $value)
 * @method static EloquentBuilder|Post whereMacaddressNullable(string|null $value)
 * @method static EloquentBuilder|Post whereMediumIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereMediumIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereMediumTextNotNullable(string $value)
 * @method static EloquentBuilder|Post whereMediumTextNullable(string|null $value)
 * @method static EloquentBuilder|Post whereSmallIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereSmallIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereStringNotNullable(string $value)
 * @method static EloquentBuilder|Post whereStringNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTextNotNullable(string $value)
 * @method static EloquentBuilder|Post whereTextNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTimeNotNullable(string $value)
 * @method static EloquentBuilder|Post whereTimeNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTimestampNotNullable(string $value)
 * @method static EloquentBuilder|Post whereTimestampNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTimestamptzNotNullable(string $value)
 * @method static EloquentBuilder|Post whereTimestamptzNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTimetzNotNullable(string $value)
 * @method static EloquentBuilder|Post whereTimetzNullable(string|null $value)
 * @method static EloquentBuilder|Post whereTinyIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereTinyIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUnsignedBigIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereUnsignedBigIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUnsignedDecimalNotNullable(string $value)
 * @method static EloquentBuilder|Post whereUnsignedDecimalNullable(string|null $value)
 * @method static EloquentBuilder|Post whereUnsignedIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereUnsignedIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUnsignedMediumIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereUnsignedMediumIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUnsignedSmallIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereUnsignedSmallIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUnsignedTinyIntegerNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereUnsignedTinyIntegerNullable(integer|null $value)
 * @method static EloquentBuilder|Post whereUpdatedAt(Carbon|null $value)
 * @method static EloquentBuilder|Post whereUuidNotNullable(string $value)
 * @method static EloquentBuilder|Post whereUuidNullable(string|null $value)
 * @method static EloquentBuilder|Post whereYearNotNullable(integer $value)
 * @method static EloquentBuilder|Post whereYearNullable(integer|null $value)
 * @method static QueryBuilder|Post withTrashed()
 * @method static QueryBuilder|Post withoutTrashed()
 * @mixin Eloquent
 */
class Post extends Model
{
    use SoftDeletes;

    /**
     * Special hack to avoid code style fixer removing unused imports
     * which play a role when generating the snapshot
     */
    private $hack = [
        Carbon::class,
        Collection::class,
        Eloquent::class,
        EloquentBuilder::class,
        QueryBuilder::class,
    ];

    protected $casts = [
        'char_not_nullable' => CastType::class,
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeNull($query, string $unusedParam)
    {
        return $query;
    }
}

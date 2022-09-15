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
 * @method static EloquentBuilder|Post null(string $unusedParam)
 * @method static EloquentBuilder|Post onlyTrashed()
 * @method static EloquentBuilder|Post query()
 * @method static EloquentBuilder|Post whereBigIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereBigIntegerNullable($value)
 * @method static EloquentBuilder|Post whereBinaryNotNullable($value)
 * @method static EloquentBuilder|Post whereBinaryNullable($value)
 * @method static EloquentBuilder|Post whereBooleanNotNullable($value)
 * @method static EloquentBuilder|Post whereBooleanNullable($value)
 * @method static EloquentBuilder|Post whereCharNotNullable($value)
 * @method static EloquentBuilder|Post whereCharNullable($value)
 * @method static EloquentBuilder|Post whereCreatedAt($value)
 * @method static EloquentBuilder|Post whereDateNotNullable($value)
 * @method static EloquentBuilder|Post whereDateNullable($value)
 * @method static EloquentBuilder|Post whereDatetimeNotNullable($value)
 * @method static EloquentBuilder|Post whereDatetimeNullable($value)
 * @method static EloquentBuilder|Post whereDatetimetzNotNullable($value)
 * @method static EloquentBuilder|Post whereDatetimetzNullable($value)
 * @method static EloquentBuilder|Post whereDecimalNotNullable($value)
 * @method static EloquentBuilder|Post whereDecimalNullable($value)
 * @method static EloquentBuilder|Post whereDoubleNotNullable($value)
 * @method static EloquentBuilder|Post whereDoubleNullable($value)
 * @method static EloquentBuilder|Post whereEnumNotNullable($value)
 * @method static EloquentBuilder|Post whereEnumNullable($value)
 * @method static EloquentBuilder|Post whereFloatNotNullable($value)
 * @method static EloquentBuilder|Post whereFloatNullable($value)
 * @method static EloquentBuilder|Post whereId($value)
 * @method static EloquentBuilder|Post whereIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereIntegerNullable($value)
 * @method static EloquentBuilder|Post whereIpaddressNotNullable($value)
 * @method static EloquentBuilder|Post whereIpaddressNullable($value)
 * @method static EloquentBuilder|Post whereJsonNotNullable($value)
 * @method static EloquentBuilder|Post whereJsonNullable($value)
 * @method static EloquentBuilder|Post whereJsonbNotNullable($value)
 * @method static EloquentBuilder|Post whereJsonbNullable($value)
 * @method static EloquentBuilder|Post whereLongTextNotNullable($value)
 * @method static EloquentBuilder|Post whereLongTextNullable($value)
 * @method static EloquentBuilder|Post whereMacaddressNotNullable($value)
 * @method static EloquentBuilder|Post whereMacaddressNullable($value)
 * @method static EloquentBuilder|Post whereMediumIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereMediumIntegerNullable($value)
 * @method static EloquentBuilder|Post whereMediumTextNotNullable($value)
 * @method static EloquentBuilder|Post whereMediumTextNullable($value)
 * @method static EloquentBuilder|Post whereSmallIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereSmallIntegerNullable($value)
 * @method static EloquentBuilder|Post whereStringNotNullable($value)
 * @method static EloquentBuilder|Post whereStringNullable($value)
 * @method static EloquentBuilder|Post whereTextNotNullable($value)
 * @method static EloquentBuilder|Post whereTextNullable($value)
 * @method static EloquentBuilder|Post whereTimeNotNullable($value)
 * @method static EloquentBuilder|Post whereTimeNullable($value)
 * @method static EloquentBuilder|Post whereTimestampNotNullable($value)
 * @method static EloquentBuilder|Post whereTimestampNullable($value)
 * @method static EloquentBuilder|Post whereTimestamptzNotNullable($value)
 * @method static EloquentBuilder|Post whereTimestamptzNullable($value)
 * @method static EloquentBuilder|Post whereTimetzNotNullable($value)
 * @method static EloquentBuilder|Post whereTimetzNullable($value)
 * @method static EloquentBuilder|Post whereTinyIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereTinyIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedBigIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedDecimalNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedDecimalNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedMediumIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedSmallIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static EloquentBuilder|Post whereUnsignedTinyIntegerNullable($value)
 * @method static EloquentBuilder|Post whereUpdatedAt($value)
 * @method static EloquentBuilder|Post whereUuidNotNullable($value)
 * @method static EloquentBuilder|Post whereUuidNullable($value)
 * @method static EloquentBuilder|Post whereYearNotNullable($value)
 * @method static EloquentBuilder|Post whereYearNullable($value)
 * @method static EloquentBuilder|Post withTrashed()
 * @method static EloquentBuilder|Post withoutTrashed()
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

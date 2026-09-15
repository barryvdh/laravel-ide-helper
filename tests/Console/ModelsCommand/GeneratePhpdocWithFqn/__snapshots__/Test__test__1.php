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
 * @property int $id
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @property-read bool|null $posts_exists
 * @method static EloquentBuilder<static>|Post newModelQuery()
 * @method static EloquentBuilder<static>|Post newQuery()
 * @method static EloquentBuilder<static>|Post null(string $unusedParam)
 * @method static EloquentBuilder<static>|Post onlyTrashed()
 * @method static EloquentBuilder<static>|Post query()
 * @method static EloquentBuilder<static>|Post whereBigIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereBigIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereBinaryNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereBinaryNullable($value)
 * @method static EloquentBuilder<static>|Post whereBooleanNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereBooleanNullable($value)
 * @method static EloquentBuilder<static>|Post whereCharNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereCharNullable($value)
 * @method static EloquentBuilder<static>|Post whereCreatedAt($value)
 * @method static EloquentBuilder<static>|Post whereDateNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereDateNullable($value)
 * @method static EloquentBuilder<static>|Post whereDatetimeNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereDatetimeNullable($value)
 * @method static EloquentBuilder<static>|Post whereDatetimetzNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereDatetimetzNullable($value)
 * @method static EloquentBuilder<static>|Post whereDecimalNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereDecimalNullable($value)
 * @method static EloquentBuilder<static>|Post whereDoubleNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereDoubleNullable($value)
 * @method static EloquentBuilder<static>|Post whereEnumNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereEnumNullable($value)
 * @method static EloquentBuilder<static>|Post whereFloatNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereFloatNullable($value)
 * @method static EloquentBuilder<static>|Post whereId($value)
 * @method static EloquentBuilder<static>|Post whereIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereIpaddressNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereIpaddressNullable($value)
 * @method static EloquentBuilder<static>|Post whereJsonNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereJsonNullable($value)
 * @method static EloquentBuilder<static>|Post whereJsonbNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereJsonbNullable($value)
 * @method static EloquentBuilder<static>|Post whereLongTextNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereLongTextNullable($value)
 * @method static EloquentBuilder<static>|Post whereMacaddressNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereMacaddressNullable($value)
 * @method static EloquentBuilder<static>|Post whereMediumIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereMediumIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereMediumTextNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereMediumTextNullable($value)
 * @method static EloquentBuilder<static>|Post whereSmallIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereSmallIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereStringNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereStringNullable($value)
 * @method static EloquentBuilder<static>|Post whereTextNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTextNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimeNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimeNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimestampNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimestampNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimestamptzNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimestamptzNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimetzNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTimetzNullable($value)
 * @method static EloquentBuilder<static>|Post whereTinyIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereTinyIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedBigIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedBigIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedMediumIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedMediumIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedSmallIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedSmallIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedTinyIntegerNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUnsignedTinyIntegerNullable($value)
 * @method static EloquentBuilder<static>|Post whereUpdatedAt($value)
 * @method static EloquentBuilder<static>|Post whereUuidNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereUuidNullable($value)
 * @method static EloquentBuilder<static>|Post whereYearNotNullable($value)
 * @method static EloquentBuilder<static>|Post whereYearNullable($value)
 * @method static EloquentBuilder<static>|Post withTrashed(bool $withTrashed = true)
 * @method static EloquentBuilder<static>|Post withoutTrashed()
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

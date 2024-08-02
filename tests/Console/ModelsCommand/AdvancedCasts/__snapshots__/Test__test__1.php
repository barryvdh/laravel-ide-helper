<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AdvancedCasts\Models;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AdvancedCasts\Collections\AdvancedCastCollection;
use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\AdvancedCasts\Enums\AdvancedCastEnum;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property \Illuminate\Support\Carbon $cast_to_date_serialization
 * @property \Illuminate\Support\Carbon $cast_to_datetime_serialization
 * @property \Illuminate\Support\Carbon $cast_to_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_date
 * @property \Carbon\CarbonImmutable $cast_to_immutable_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_datetime
 * @property int $cast_to_timestamp
 * @property mixed $cast_to_encrypted
 * @property array $cast_to_encrypted_array
 * @property \Illuminate\Support\Collection $cast_to_encrypted_collection
 * @property array $cast_to_encrypted_json
 * @property object $cast_to_encrypted_object
 * @property \Illuminate\Support\Collection $cast_to_as_collection
 * @property \Illuminate\Support\Collection $cast_to_as_enum_collection
 * @property \ArrayObject $cast_to_as_array_object
 * @property AdvancedCastCollection $cast_to_as_collection_using
 * @property \Illuminate\Support\Collection<int, AdvancedCastEnum> $cast_to_as_enum_collection_of
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToAsArrayObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToAsCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToAsEnumCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToEncryptedArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToEncryptedCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToEncryptedJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToEncryptedObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToImmutableCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToImmutableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToImmutableDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedCast whereCastToTimestamp($value)
 * @mixin \Eloquent
 */
class AdvancedCast extends Model
{
    protected function casts(): array
    {
        return [
            'cast_to_date_serialization' => 'date:Y-m-d',
            'cast_to_datetime_serialization' => 'datetime:Y-m-d H:i:s',
            'cast_to_custom_datetime' => 'custom_datetime:Y-m-d H:i:s',
            'cast_to_immutable_date' => 'immutable_date',
            'cast_to_immutable_custom_datetime' => 'immutable_custom_datetime:Y-m-d H:i:s',
            'cast_to_immutable_datetime' => 'immutable_datetime',
            'cast_to_timestamp' => 'timestamp',
            'cast_to_encrypted' => 'encrypted',
            'cast_to_encrypted_array' => 'encrypted:array',
            'cast_to_encrypted_collection' => 'encrypted:collection',
            'cast_to_encrypted_json' => 'encrypted:json',
            'cast_to_encrypted_object' => 'encrypted:object',
            'cast_to_as_collection' => AsCollection::class,
            'cast_to_as_collection_using' => AsCollection::using(AdvancedCastCollection::class),
            'cast_to_as_enum_collection' => AsEnumCollection::class,
            'cast_to_as_enum_collection_of' => AsEnumCollection::of(AdvancedCastEnum::class),
            'cast_to_as_array_object' => AsArrayObject::class,
        ];
    }
}

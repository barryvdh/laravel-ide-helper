<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $cast_to_int
 * @property int $cast_to_integer
 * @property float $cast_to_real
 * @property float $cast_to_float
 * @property float $cast_to_double
 * @property numeric $cast_to_decimal
 * @property string $cast_to_string
 * @property bool $cast_to_bool
 * @property bool $cast_to_boolean
 * @property object $cast_to_object
 * @property array<array-key, mixed> $cast_to_array
 * @property array<array-key, mixed> $cast_to_json
 * @property \Illuminate\Support\Collection<array-key, mixed> $cast_to_collection
 * @property \Illuminate\Support\Carbon $cast_to_date
 * @property \Illuminate\Support\Carbon $cast_to_datetime
 * @property \Illuminate\Support\Carbon $cast_to_date_serialization
 * @property \Illuminate\Support\Carbon $cast_to_datetime_serialization
 * @property \Illuminate\Support\Carbon $cast_to_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_date
 * @property \Carbon\CarbonImmutable $cast_to_immutable_date_serialization
 * @property \Carbon\CarbonImmutable $cast_to_immutable_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_datetime_serialization
 * @property int $cast_to_timestamp
 * @property mixed $cast_to_encrypted
 * @property array<array-key, mixed> $cast_to_encrypted_array
 * @property \Illuminate\Support\Collection<array-key, mixed> $cast_to_encrypted_collection
 * @property array<array-key, mixed> $cast_to_encrypted_json
 * @property object $cast_to_encrypted_object
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToEncryptedArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToEncryptedCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToEncryptedJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToEncryptedObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToImmutableCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToImmutableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToImmutableDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToImmutableDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToImmutableDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToInteger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToString($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimpleCast whereCastToTimestamp($value)
 * @mixin \Eloquent
 */
class SimpleCast extends Model
{
    protected $casts = [
        'cast_to_int' => 'int',
        'cast_to_integer' => 'integer',
        'cast_to_real' => 'real',
        'cast_to_float' => 'float',
        'cast_to_double' => 'double',
        'cast_to_decimal' => 'decimal:4',
        'cast_to_string' => 'string',
        'cast_to_bool' => 'bool',
        'cast_to_boolean' => 'boolean',
        'cast_to_object' => 'object',
        'cast_to_array' => 'array',
        'cast_to_json' => 'json',
        'cast_to_collection' => 'collection',
        'cast_to_enum_collection' => 'collection',
        'cast_to_date' => 'date',
        'cast_to_datetime' => 'datetime',
        'cast_to_date_serialization' => 'date:Y-m-d',
        'cast_to_datetime_serialization' => 'datetime:Y-m-d H:i:s',
        'cast_to_custom_datetime' => 'custom_datetime:Y-m-d H:i:s',
        'cast_to_immutable_date' => 'immutable_date',
        'cast_to_immutable_date_serialization' => 'immutable_date:Y-m-d',
        'cast_to_immutable_custom_datetime' => 'immutable_custom_datetime:Y-m-d H:i:s',
        'cast_to_immutable_datetime' => 'immutable_datetime',
        'cast_to_immutable_datetime_serialization' => 'immutable_datetime:Y-m-d H:i:s',
        'cast_to_timestamp' => 'timestamp',
        'cast_to_encrypted' => 'encrypted',
        'cast_to_encrypted_array' => 'encrypted:array',
        'cast_to_encrypted_collection' => 'encrypted:collection',
        'cast_to_encrypted_json' => 'encrypted:json',
        'cast_to_encrypted_object' => 'encrypted:object',
        'cast_to_hashed' => 'hashed',
    ];
}

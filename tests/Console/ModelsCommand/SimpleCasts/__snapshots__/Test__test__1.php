<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Models\SimpleCast
 *
 * @property integer $cast_to_int
 * @property integer $cast_to_integer
 * @property float $cast_to_real
 * @property float $cast_to_float
 * @property float $cast_to_double
 * @property string $cast_to_decimal
 * @property string $cast_to_string
 * @property boolean $cast_to_bool
 * @property boolean $cast_to_boolean
 * @property object $cast_to_object
 * @property array $cast_to_array
 * @property array $cast_to_json
 * @property \Illuminate\Support\Collection $cast_to_collection
 * @property \Illuminate\Support\Carbon $cast_to_date
 * @property \Illuminate\Support\Carbon $cast_to_datetime
 * @property \Illuminate\Support\Carbon $cast_to_date_serialization
 * @property \Illuminate\Support\Carbon $cast_to_datetime_serialization
 * @property \Illuminate\Support\Carbon $cast_to_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_date
 * @property \Carbon\CarbonImmutable $cast_to_immutable_custom_datetime
 * @property \Carbon\CarbonImmutable $cast_to_immutable_datetime
 * @property integer $cast_to_timestamp
 * @property mixed $cast_to_encrypted
 * @property array $cast_to_encrypted_array
 * @property \Illuminate\Support\Collection $cast_to_encrypted_collection
 * @property array $cast_to_encrypted_json
 * @property object $cast_to_encrypted_object
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast query()
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToEncryptedArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToEncryptedCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToEncryptedJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToEncryptedObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToImmutableCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToImmutableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToImmutableDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToInteger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToString($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SimpleCast whereCastToTimestamp($value)
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
        'cast_to_date' => 'date',
        'cast_to_datetime' => 'datetime',
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
    ];
}

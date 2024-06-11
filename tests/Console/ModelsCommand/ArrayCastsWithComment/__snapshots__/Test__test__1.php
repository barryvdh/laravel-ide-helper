<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ArrayCastsWithComment\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property array<int, string>|null $cast_to_array -- These three should not be duplicated
 * @property array<int, string> $cast_to_json some-description
 * @property \Illuminate\Support\Collection<int, string> $cast_to_collection some-description
 * @property array|null $cast_to_encrypted_array -- These three are OK (no types)
 * @property array $cast_to_encrypted_json some-description
 * @property \Illuminate\Support\Collection $cast_to_encrypted_collection some-description
 * @property string $cast_to_string -- The next three are OK (no description), this not included
 * @property array<int, string>|null $cast_to_immutable_date
 * @property array<int, string> $cast_to_immutable_date_serialization
 * @property \Illuminate\Support\Collection<int, string> $cast_to_immutable_custom_datetime
 * @property string $cast_to_int
 * @property string $cast_to_integer
 * @property string $cast_to_real
 * @property string $cast_to_float
 * @property string $cast_to_double
 * @property string $cast_to_decimal
 * @property string $cast_to_bool
 * @property string $cast_to_boolean
 * @property string $cast_to_object
 * @property array $cast_to_array
 * @property array $cast_to_json
 * @property \Illuminate\Support\Collection $cast_to_collection
 * @property string $cast_to_date
 * @property string $cast_to_datetime
 * @property string $cast_to_date_serialization
 * @property string $cast_to_datetime_serialization
 * @property string $cast_to_custom_datetime
 * @property string $cast_to_immutable_datetime
 * @property string $cast_to_immutable_datetime_serialization
 * @property string $cast_to_timestamp
 * @property string $cast_to_encrypted
 * @property string $cast_to_encrypted_object
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToEncryptedArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToEncryptedCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToEncryptedJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToEncryptedObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToImmutableCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToImmutableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToImmutableDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToImmutableDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToImmutableDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToInteger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToString($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArrayCastsWithComment whereCastToTimestamp($value)
 * @mixin \Eloquent
 */
class ArrayCastsWithComment extends Model
{
    protected $table = 'simple_casts';

    protected $casts = [
        'cast_to_array' => 'array',
        'cast_to_json' => 'json',
        'cast_to_collection' => 'collection',

        'cast_to_encrypted_array' => 'array',
        'cast_to_encrypted_json' => 'json',
        'cast_to_encrypted_collection' => 'collection',

        'cast_to_string' => 'string',

        'cast_to_immutable_date' => 'array',
        'cast_to_immutable_date_serialization' => 'json',
        'cast_to_immutable_custom_datetime' => 'collection',
    ];
}

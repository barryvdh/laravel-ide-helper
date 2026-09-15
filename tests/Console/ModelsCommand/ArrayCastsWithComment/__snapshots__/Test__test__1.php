<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ArrayCastsWithComment\Models;

use Illuminate\Database\Eloquent\Model;

/**
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToEncryptedArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToEncryptedCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToEncryptedJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToEncryptedObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToImmutableCustomDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToImmutableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToImmutableDateSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToImmutableDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToImmutableDatetimeSerialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToInteger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToString($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArrayCastsWithComment whereCastToTimestamp($value)
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

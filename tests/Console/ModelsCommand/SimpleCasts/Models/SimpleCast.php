<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\SimpleCasts\Models;

use Illuminate\Database\Eloquent\Model;

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

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ArrayCastsWithComment\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array<int, string>|null $cast_to_array -- These three should not be duplicated
 * @property array<int, string> $cast_to_json some-description
 * @property \Illuminate\Support\Collection<int, string> $cast_to_collection some-description
 *
 * @property array|null $cast_to_encrypted_array -- These three are OK (no types)
 * @property array $cast_to_encrypted_json some-description
 * @property \Illuminate\Support\Collection $cast_to_encrypted_collection some-description
 *
 * @property string $cast_to_string -- The next three are OK (no description), this not included
 *
 * @property array<int, string>|null $cast_to_immutable_date
 * @property array<int, string> $cast_to_immutable_date_serialization
 * @property \Illuminate\Support\Collection<int, string> $cast_to_immutable_custom_datetime
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

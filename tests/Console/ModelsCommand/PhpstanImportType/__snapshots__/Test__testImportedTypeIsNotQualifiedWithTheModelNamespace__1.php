<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpstanImportType\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @phpstan-import-type ArrayShape from Shapes
 * @property int $id
 * @property-read array $local
 * @property-read ArrayShape $some_array
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simple whereId($value)
 * @mixin \Eloquent
 */
class Simple extends Model
{
    /**
     * @return ArrayShape
     */
    public function getSomeArrayAttribute(): array
    {
        return ['name' => 'Taylor', 'age' => 40];
    }

    /**
     * @phpstan-return LocalShape
     */
    public function getLocalAttribute(): array
    {
        return [];
    }
}

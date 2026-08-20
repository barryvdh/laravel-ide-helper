<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\PhpstanImportType\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @phpstan-import-type ArrayShape from Shapes
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

<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Factories;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\ImportedClassNames\Models\Simple;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimpleFactory extends Factory
{
    protected $model = Simple::class;

    public function definition(): array
    {
        return [];
    }
}

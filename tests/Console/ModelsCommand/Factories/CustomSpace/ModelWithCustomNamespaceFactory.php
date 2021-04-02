<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\CustomSpace;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithCustomNamespace;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelWithCustomNamespaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelWithCustomNamespace::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}

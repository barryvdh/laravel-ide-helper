<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithNestedFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelWithNestedFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelWithNestedFactory::class;

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

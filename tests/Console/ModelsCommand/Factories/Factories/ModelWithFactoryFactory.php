<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Models\ModelWithFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelWithFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelWithFactory::class;

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

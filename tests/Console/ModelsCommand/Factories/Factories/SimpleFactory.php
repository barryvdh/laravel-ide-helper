<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Factories\Factories;

use Barryvdh\LaravelIdeHelper\Tests\Console\ModelsCommand\Getter\Models\Simple;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimpleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Simple::class;

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

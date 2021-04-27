<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->words(2, true),
            'prices' => $this->faker->sentence(),
            'inventory' => $this->faker->randomNumber(3),
            'variations' => $this->faker->sentence(), // password
            'weight' => $this->faker->randomNumber(2) . 'kg',
        ];
    }
}

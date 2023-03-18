<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->randomDigit,
            'title' => $this->faker->word,
            'price' => 1000 * rand(1,50),
            'discount' => 5 * rand(1,3),
        ];
    }
}

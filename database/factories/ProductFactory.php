<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'manufacturer' => $this->faker->name,
            'price' => $this->faker->numberBetween(50000, 1000000),
            'price_sale' => $this->faker->numberBetween(50000, 1000000),
            'status' => $this->faker->boolean(),
            'content' => $this->faker->randomHtml(4, 10),
            'detail' => $this->faker->randomHtml(),
            'thumbnail' => $this->faker->imageUrl(),
            'img_list' => $this->faker->imageUrl(),
            'count_in_sock' => $this->faker->randomDigit(),
            'rate' => $this->faker->randomDigit(),
            'count' => $this->faker->randomDigit(),
            'category_id' => Category::all()->random()->id
        ];
    }
}

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
            'price' => $this->faker->numberBetween(50000, 1000000),
            'price_sale' => $this->faker->numberBetween(50000, 1000000),
            'content' => $this->faker->text(),
            'detail' => $this->faker->text(),
            'thumbnail' => $this->faker->image(),
            'img_list' => $this->faker->text(),
            'count_in_sock' => $this->faker->randomDigit(),
            'category_id' => Category::all()->random()->id
        ];
    }
}

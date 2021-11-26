<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->randomElement(['Laptop', 'Điện thoại', 'Phụ kiện']),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->boolean(),
            'position' => $this->faker->randomDigit(),
        ];
    }
}

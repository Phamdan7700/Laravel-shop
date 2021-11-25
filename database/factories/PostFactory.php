<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'content' => $this->faker->randomHtml(4, 10),
            'thumbnail' => $this->faker->imageUrl(),
            'view' => $this->faker->randomDigit(),
            'status' => $this->faker->boolean(),
        ];
    }
}

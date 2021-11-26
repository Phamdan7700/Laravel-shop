<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $slider = '/uploads/photos/1/Slider/619ddd754da81.webp,/uploads/photos/1/Slider/619ddd7599e22.jpg,/uploads/photos/1/Slider/619ddd7676786.webp,/uploads/photos/1/Slider/619ddd771ed79.jpg,/uploads/photos/1/Slider/619ddd7760815.jpg,/uploads/photos/1/Slider/619ddd78cb182.webp';
        return [
            'img' => $this->faker->unique()->randomElement(explode(',', $slider))
        ];
    }
}

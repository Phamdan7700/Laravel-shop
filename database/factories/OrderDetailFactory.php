<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::all()->random()->id,
            'amount' => $this->faker->randomDigit(),
            'order_id' => Order::all()->random()->id,
            'total_price' => $this->faker->numberBetween(1000, 20000),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['diantar', 'diambil', 'sukses']),
            'tgl' => $this->faker->date(),
            'berat' => $this->faker->randomDigit(),
            'total_harga' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}

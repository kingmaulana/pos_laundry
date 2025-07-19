<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->randomElement(['Paket Miskin', 'Paket KPR', 'Paket Gaya Elit', 'Paket Ekonomi Syulit', 'Paket Mewah']),
            'deskripsi' => fake()->text(),
            'harga' => fake()->randomNumber(5, true),
            'tgl' => fake()->date('mY-m-d'),
        ];
    }
}

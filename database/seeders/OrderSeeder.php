<?php

namespace Database\Seeders;

use Database\Factories\OrderFactory;
use Database\Factories\PaketFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        UserFactory::new()->count(5)->create()->each(function ($user){
            $paket = PaketFactory::new()->create();
            OrderFactory::new()->count(2)->create(['user_id' => $user->id, 'paket_id' => $paket->id]);
        });
    }
}

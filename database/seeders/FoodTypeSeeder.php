<?php

namespace Database\Seeders;

use App\Models\FoodType;
use Illuminate\Database\Seeder;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodType::create([
            'food_type' => 'Flat'
        ]);
        FoodType::create([
            'food_type' => 'Mystery'
        ]);
    }
}

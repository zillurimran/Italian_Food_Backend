<?php

namespace Database\Seeders;

use App\Models\MysteryType;
use Illuminate\Database\Seeder;

class MysteryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MysteryType::create([
            'mystery_name' => 'Plats'
        ]);
        MysteryType::create([
            'mystery_name' => 'Pâtes'
        ]);
        MysteryType::create([
            'mystery_name' => 'Charcuterie'
        ]);
    }
}

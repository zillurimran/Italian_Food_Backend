<?php

namespace Database\Seeders;

use App\Models\HideShow;
use Illuminate\Database\Seeder;

class HideShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       HideShow::create([

        'banner_status' => 1,
        'banner_bottom_status' => 1,
        'pricing_status' => 1,
        'testimonial_status' => 1,
        'contact_status' => 1,
        'map_status' => 1,

       ]);
    }
}

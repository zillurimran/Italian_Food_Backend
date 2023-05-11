<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::create([
            'title'         => 'Why Choose Sticko?',
            'sub_title'     => 'Improve your customer experience with Sticko',
            'description'   => 'Stop wasting time and money with NFC technology.',
            'image'         => 'feature_default_image.png',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\SingleFeature;
use Illuminate\Database\Seeder;

class FeatureSpecsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        SingleFeature::create([
            'feature' => 'Configuration de base'
        ]);
        SingleFeature::create([
            'feature' => 'Paramètres généraux'
        ]);
        SingleFeature::create([
            'feature' => 'Multi-langues'
        ]);
        SingleFeature::create([
            'feature' => 'Reservation'
        ]);
        SingleFeature::create([
            'feature' => 'QR Code'
        ]);
        
        
    }
}

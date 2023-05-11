<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
            'email'              => 'admin@admin.com',
            'phone'              => '+966123456789',
            'address'            => 'Al-Ahsa, Saudi Arabia',
            'logo'               => 'logo.png', 
            'favicon'            => 'favicon.png',
            'meta_title'         => 'Meta Title',
            'meta_description'   => 'Meta Description',
            'meta_keywords'      => 'Meta Keywords',
        ]); 
    }
}

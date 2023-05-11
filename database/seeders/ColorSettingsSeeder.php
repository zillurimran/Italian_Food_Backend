<?php

namespace Database\Seeders;

use App\Models\ColorSetting;
use Illuminate\Database\Seeder;

class ColorSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorSetting::create([
            'primary_color'    => '#44680E',
            'secondary_color'  => '#000000',
            'button_color'     => '#ffffff',
            'hover_color'      => '#618034',
            'text_color'       => '#666666',
            'bg_color'         => '#09122a',
        ]);
    }
}

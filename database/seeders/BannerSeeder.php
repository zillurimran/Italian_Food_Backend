<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'heading' => 'Puces NFC',
            'sub_heading' => 'Partagez vos réseaux',
            'tag_line' => 'Coller une puce sur votre téléphone pour afficher et partager vos réseaux',
            'btn_txt' => 'Acheter',
            'btn_url' => '#!',
            'media' => 'banner-image.jpg',
        ]);
    }
}

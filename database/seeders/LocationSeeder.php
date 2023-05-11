<?php

namespace Database\Seeders;

use App\Models\SetLocation;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetLocation::create([
            'location_url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16186.597967438824!2d2.185486964789583!3d48.878654337142166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6635c51722e49%3A0xf831080bee57a629!2s6%20Pl.%20de%20l&#39;%C3%89glise%2C%2092500%20Rueil-Malmaison%2C%20France!5e0!3m2!1sen!2sbd!4v1676895972826!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}

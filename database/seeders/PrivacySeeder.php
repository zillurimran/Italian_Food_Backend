<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivacyPolicy::create([
            'privacy_policy' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, quos alias! Facere, ab dicta, dolorem itaque tempora autem minima excepturi recusandae earum, iste eveniet tenetur? Aut, facere provident ullam at tempore ex placeat fugiat corporis quibusdam quia soluta quam possimus alias quos, aperiam ipsa nam sed. Iusto, ipsa tempora fuga nulla necessitatibus quam ipsum saepe officiis laborum ducimus pariatur voluptates debitis quod harum blanditiis? Ipsam nihil amet facere doloribus maxime? Ipsum eaque assumenda doloremque consequatur asperiores saepe molestiae deserunt quisquam maxime quaerat. Sapiente dolores modi nostrum cum labore harum, eaque rem. Repudiandae ut laudantium nam ullam, sapiente quas cumque ipsam.'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\AdminProfileSetting;
use Illuminate\Database\Seeder;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminProfileSetting::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '88888888',
        ]);
    }
}

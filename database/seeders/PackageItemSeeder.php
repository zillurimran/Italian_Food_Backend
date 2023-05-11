<?php

namespace Database\Seeders;

use App\Models\PackageItems;
use Illuminate\Database\Seeder;

class PackageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageItems::create([
            'package_items' => ' Basic setup'
        ]);
        PackageItems::create([
            'package_items' => ' General Settings'
        ]);
        PackageItems::create([
            'package_items' => '  Multi-Languages'
        ]);
        PackageItems::create([
            'package_items' => '  Reservation'
        ]);
        PackageItems::create([
            'package_items' => ' QR Code'
        ]);
    }
}

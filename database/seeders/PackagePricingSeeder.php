<?php

namespace Database\Seeders;

use App\Models\PackageType;
use Illuminate\Database\Seeder;

class PackagePricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageType::create([
            'package_type' => 'STARTER',
            'package_price' => '80',
            'sms_quantity' => '400',
            'package_purpose' => 'For small to medium business',
        ]);
        
        PackageType::create([
            'package_type' => 'POPULAR',
            'package_price' => '300',
            'sms_quantity' => '1200',
            'package_purpose' => 'For small to medium business',
        ]);
       
        PackageType::create([
            'package_type' => 'ADVANCE',
            'package_price' => '800',
            'sms_quantity' => '54000',
            'package_purpose' => 'Solution for big organizations',
        ]);
       
       
    }
}

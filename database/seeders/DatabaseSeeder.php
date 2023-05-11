<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ColorSettingsSeeder::class,
            SocialUrlSeeder::class,
            GeneralSettingsSeeder::class,
            SubscriberSeeder::class,
            ContactSeeder::class,
            UserSeeder::class,
            FeatureSeeder::class,
            AddressSeeder::class,
            PhoneNumberSeeder::class,
            BannerSeeder::class,
            FeatureSpecsSeeder::class,
            PackagePricingSeeder::class,
            PackageItemSeeder::class,
            StripeKeySeeder::class,
            HideShowSeeder::class,
            LocationSeeder::class,
            FoodTypeSeeder::class,
            AdminSettingSeeder::class,
            MysteryTypeSeeder::class,
            TutorialStepSeeder::class,
            PrivacySeeder::class,           
            OrderStatusSeeder::class,
        ]);
    }
}

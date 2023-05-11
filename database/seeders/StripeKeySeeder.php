<?php

namespace Database\Seeders;

use App\Models\StripeSetting;
use Illuminate\Database\Seeder;

class StripeKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StripeSetting::create([
            'stripe_key' => "pk_test_51MdVopI5vndzPyR8dKn6Rwiy8AnLUxlZKmMJ5A42U57LSajaTsHKjlaKTO3ZhrFP45G7uIAmj6JFaXV0i43WA5Wf000QVUrGy8",
            'secret_key' => "sk_test_51MdVopI5vndzPyR8raL9vEY79KT2Iv22xGMebpbPOnFMc8jClAEjvnCeqMIGYeJQGgD9SWAHqduTPB64YA1KqmIY00cfZ7o7Ml"
        ]);
    }
}

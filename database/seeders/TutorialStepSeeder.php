<?php

namespace Database\Seeders;

use App\Models\TutorialStep;
use Illuminate\Database\Seeder;

class TutorialStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TutorialStep::create([
            'tutorial_title' => 'Le concept-1',
            'tutorial_sub_title' => 'Quisque sit amet sagittis erat. Duis pharetra ornare venenatis. Nulla maximus porta velit ut molestie. Proin quis convallis mauris. In facilisis justo at mi pharetra lobortis. s.-1',
            'image' => asset('uploads/tutorials').'/'.'food-1.jpeg'
        ]);
        TutorialStep::create([
            'tutorial_title' => 'Le concept-2',
            'tutorial_sub_title' => 'Quisque sit amet sagittis erat. Duis pharetra ornare venenatis. Nulla maximus porta velit ut molestie. Proin quis convallis mauris. In facilisis justo at mi pharetra lobortis. s.-2',
            'image' => asset('uploads/tutorials').'/'.'food-2.jpeg'
        ]);
        TutorialStep::create([
            'tutorial_title' => 'Le concept-3',
            'tutorial_sub_title' => 'Quisque sit amet sagittis erat. Duis pharetra ornare venenatis. Nulla maximus porta velit ut molestie. Proin quis convallis mauris. In facilisis justo at mi pharetra lobortis. s.-3',
            'image' => asset('uploads/tutorials').'/'.'food-3.jpeg'
        ]);
    }
}

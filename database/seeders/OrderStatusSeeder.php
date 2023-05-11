<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['New', 'In process', 'Ready to pickup', 'Delivered'];
        foreach($statuses as $key => $status){
            OrderStatus::create([
                'name' => $status,
                'order' => $key + 1,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->longText('food_type');
            $table->text('food_name');
            $table->longText('food_description');
            $table->longText('food_image');
            $table->longText('food_stock');
            $table->longText('price');
            $table->longText('boutique_name');
            $table->longText('pickup_location');
            $table->longText('pickup_date_from')->nullable();
            $table->longText('pickup_date_to')->nullable();
            $table->longText('pickup_time_from')->nullable();
            $table->longText('pickup_time_to')->nullable();
            $table->tinyInteger('hide_show')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}

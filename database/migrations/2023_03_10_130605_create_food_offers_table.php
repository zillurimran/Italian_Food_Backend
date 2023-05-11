<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_offers', function (Blueprint $table) {
            
            $table->id();
            $table->longText('offer_title');
            $table->text('offer_type');
            $table->text('food_name');
            $table->longText('food_description');
            $table->longText('food_image');
            $table->string('food_stock');
            $table->string('price');
            $table->string('boutique_name');
            $table->text('pickup_location');
            $table->text('pickup_time');
            $table-> tinyInteger('hide/show')->default(0);
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
        Schema::dropIfExists('food_offers');
    }
}

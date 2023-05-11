<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('food_type'); 
            $table->integer('mystery_type_id')->nullable(); 
            $table->string('food_name'); 
            $table->longText('food_description'); 
            $table->longText('food_image'); 
            $table->longText('thumbnail_image')->nullable(); 
            $table->longText('list_image')->nullable(); 
            $table->bigInteger('food_stock'); 
            $table->float('price'); 
            $table->float('discount_price'); 
            $table->string('prefix'); 
            $table->bigInteger('boutique_id'); 
            $table->longText('pickup_date_from'); 
            $table->longText('pickup_date_to'); 
            $table->longText('pickup_time_from'); 
            $table->longText('pickup_time_to'); 
            $table->longText('allergy_ids')->nullable(); 
            $table->integer('hide_show')->default(1); 
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
        Schema::dropIfExists('foods_offers');
    }
}

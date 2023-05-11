<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHideShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hide_shows', function (Blueprint $table) {
            $table->id();
            $table->integer('banner_status')->default(1); 
            $table->integer('banner_bottom_status')->default(1); 
            $table->integer('pricing_status')->default(1); 
            $table->integer('testimonial_status')->default(1); 
            $table->integer('contact_status')->default(1); 
            $table->integer('map_status')->default(1); 
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
        Schema::dropIfExists('hide_shows');
    }
}

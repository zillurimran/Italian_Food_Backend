<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rollback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food_offers', function (Blueprint $table) {
            
            $table->dropColumn('hide/show');
            $table->tinyInteger('hide_show');
           
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_offers', function (Blueprint $table) {
            
            $table->tinyInteger('hide/show');
            $table->dropColumn('hide_show');
        });
    }
}

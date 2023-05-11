<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToFoodOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food_offers', function (Blueprint $table) {
            $table->date('pickup_date_from')->nullable();
            $table->date('pickup_date_to')->nullable();
            $table->timestamp('pickup_time_from')->nullable();
            $table->timestamp('pickup_time_to')->nullable();
            $table->dropColumn('pickup_time');
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
            $table->dropColumn('pickup_date_from');
            $table->dropColumn('pickup_date_to');
            $table->dropColumn('pickup_time_from');
            $table->dropColumn('pickup_time_to');
            $table->text('pickup_time');
        });
    }
}

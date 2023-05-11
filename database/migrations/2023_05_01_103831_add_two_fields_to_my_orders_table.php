<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFieldsToMyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_orders', function (Blueprint $table) {
            $table->longText('customer_pickup_time_from')->nullable();
            $table->longText('customer_pickup_time_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_orders', function (Blueprint $table) {
            $table->dropColumn('customer_pickup_time_from');
            $table->dropColumn('customer_pickup_time_to');
        });
    }
}

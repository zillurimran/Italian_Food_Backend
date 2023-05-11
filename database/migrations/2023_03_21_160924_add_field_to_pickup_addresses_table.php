<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToPickupAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickup_addresses', function (Blueprint $table) {
            $table->longText('opened_at')->nullable();
            $table->longText('closed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pickup_addresses', function (Blueprint $table) {
            $table->dropColumn('opened_at');
            $table->dropColumn('closed_at');

        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('package_id')->nullable();
            $table->integer('total_sms')->default(0);
            $table->integer('send_message')->default(0);
            $table->integer('remaining_message')->default(0);
            $table->float('amount')->default(0);
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('package_id');
            $table->dropColumn('total_sms');
            $table->dropColumn('send_message');
            $table->dropColumn('remaining_message');
            $table->dropColumn('amount');
            $table->dropColumn('status');
        });
    }
}

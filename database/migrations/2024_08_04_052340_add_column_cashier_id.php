<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCashierId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 1. add kolom cashier_id pada table charts untuk membedakan mana chart yang diorder 
         *    oleh masing-masing kasir.
         */
        Schema::table('charts', function (Blueprint $table) {
            $table->integer('cashier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charts', function (Blueprint $table) {
            //
        });
    }
}

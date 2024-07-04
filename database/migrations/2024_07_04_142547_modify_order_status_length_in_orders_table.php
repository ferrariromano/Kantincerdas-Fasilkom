<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrderStatusLengthInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('orderStatus', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert the column type back if necessary
            $table->string('orderStatus', 50)->change();
        });
    }
}

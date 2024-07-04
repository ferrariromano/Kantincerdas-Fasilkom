<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderStatusToOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->string('orderStatus')->default('Pending');
        });
    }

    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn('orderStatus');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('orderName');
            $table->string('orderPhone');
            $table->text('orderNotes')->nullable();
            $table->decimal('orderTotalAmounts', 8, 2);
            $table->enum('orderStatus', ['Uncompleted','Completed'])->default('uncompleted');
            $table->enum('orderPayment', ['tunai', 'non-tunai'])->default('tunai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('orders_user_id_foreign');
            $table->unsignedBigInteger('product_id')->index('orders_product_id_foreign');
            $table->string('size', 10)->nullable();
            $table->string('color', 10)->nullable();
            $table->integer('amount');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->integer('total_price')->nullable();
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

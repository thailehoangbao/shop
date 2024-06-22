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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('status');
            $table->longText('list');
            $table->text('token');
            $table->timestamps();
            $table->tinyInteger('notification')->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->integer('last_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

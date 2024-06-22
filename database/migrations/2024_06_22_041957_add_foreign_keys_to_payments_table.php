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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_user_id')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'payments_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('fk_user_id');
            $table->dropForeign('payments_ibfk_1');
        });
    }
};

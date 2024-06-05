<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // First, add the column without the foreign key constraint
            $table->unsignedBigInteger('user_id')->after('category_post_id')->nullable();
        });

        // Set a default user_id for existing posts (you can adjust the ID as needed)
        DB::table('posts')->update(['user_id' => 1]);

        Schema::table('posts', function (Blueprint $table) {
            // Then add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key constraint
            $table->dropColumn('user_id'); // Drop user_id column
        });
    }
};

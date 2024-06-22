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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('sub_title_1')->nullable();
            $table->text('content_1')->nullable();
            $table->text('thumb_1')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->text('content_2')->nullable();
            $table->text('thumb_2')->nullable();
            $table->string('sub_title_3')->nullable();
            $table->text('content_3')->nullable();
            $table->text('thumb_3')->nullable();
            $table->unsignedBigInteger('category_post_id')->index('posts_category_post_id_foreign');
            $table->unsignedBigInteger('user_id')->nullable()->index('posts_user_id_foreign');
            $table->text('link')->nullable();
            $table->text('video')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

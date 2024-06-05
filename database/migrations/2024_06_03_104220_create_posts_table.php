<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('sub_title_1', 255)->nullable();
            $table->text('content_1')->nullable();
            $table->text('thumb_1')->nullable();
            $table->string('sub_title_2', 255)->nullable();
            $table->text('content_2')->nullable();
            $table->text('thumb_2')->nullable();
            $table->string('sub_title_3', 255)->nullable();
            $table->text('content_3')->nullable();
            $table->text('thumb_3')->nullable();
            $table->unsignedBigInteger('category_post_id');
            $table->text('link')->nullable();
            $table->text('video')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('category_post_id')->references('id')->on('category_post')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};

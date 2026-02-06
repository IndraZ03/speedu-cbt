<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('exam_group_id');
            $table->tinyInteger('rating')->default(0)->comment('1-5 stars');
            $table->text('review')->nullable();
            $table->boolean('has_complaint')->default(false);
            $table->text('complaint')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_group_id')->references('id')->on('exam_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_reviews');
    }
};

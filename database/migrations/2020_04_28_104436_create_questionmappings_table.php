<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionmappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionmappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('question');
            $table->foreign('question')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedBigInteger('questionpaper');
            $table->foreign('questionpaper')->references('id')->on('questionpapers')->onDelete('cascade');
            $table->string('max_marks');
            $table->string('question_no');
            $table->string('difficulty_level');
            $table->string('section');
            $table->string('mapping_level');
            $table->string('co_mapping_level');
            $table->string('question_preference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionmappings');
    }
}

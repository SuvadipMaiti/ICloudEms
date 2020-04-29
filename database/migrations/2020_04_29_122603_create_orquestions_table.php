<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orquestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');      
            $table->unsignedBigInteger('questionpaper');
            $table->foreign('questionpaper')->references('id')->on('questionpapers')->onDelete('cascade');
            $table->string('questions');
            $table->string('question_no');
            $table->string('question_marks');
            $table->string('section');
            $table->string('mapping_level');
            $table->string('co_mapping_level');
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
        Schema::dropIfExists('orquestions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionpapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionpapers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');
            $table->string('name');
            $table->string('exam_type');
            $table->string('sub_exam');
            $table->string('section');
            $table->string('bloom');
            $table->longText('description');
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
        Schema::dropIfExists('questionpapers');
    }
}

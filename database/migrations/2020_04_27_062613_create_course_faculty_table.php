<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_faculty', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty');
            $table->foreign('faculty')->references('id')->on('faculties')->onDelete('cascade');
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('course_faculty');
    }
}

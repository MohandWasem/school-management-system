<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->bigInteger('Gender_id')->unsigned();
            $table->foreign('Gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->bigInteger('Nationality_id')->unsigned();
            $table->foreign('Nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->bigInteger('Blood_id')->unsigned();
            $table->foreign('Blood_id')->references('id')->on('bloods')->onDelete('cascade');
            $table->date('Date_Birth');
            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->unsignedBigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('Section_id');
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger('Parent_id')->unsigned();
            $table->foreign('Parent_id')->references('id')->on('my_parents')->onDelete('cascade');
            $table->string('academic_year');
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
        Schema::dropIfExists('students');
    }
}

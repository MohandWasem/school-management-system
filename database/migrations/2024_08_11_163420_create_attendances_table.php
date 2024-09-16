<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->unsignedBigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('Section_id');
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->unsignedBigInteger('Teacher_id');
            $table->foreign('Teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->date('Attendance_date');
            $table->boolean('Attendance_status');
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
        Schema::dropIfExists('attendances');
    }
}

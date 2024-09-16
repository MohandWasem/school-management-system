<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->decimal('amount',8,2);
            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->unsignedBigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->string('academic_year');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('fees');
    }
}

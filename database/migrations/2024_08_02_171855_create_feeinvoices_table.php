<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeinvoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->unsignedBigInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('fee_id');
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
            $table->decimal('amount',8,2);
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
        Schema::dropIfExists('feeinvoices');
    }
}

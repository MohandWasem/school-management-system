<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessingIdToStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('processing_id')->nullable();

            // إضافة المفتاح الخارجي وربطه بجدول processings
            $table->foreign('processing_id')
                  ->references('id')
                  ->on('processing_fees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->dropForeign(['processing_id']);
            // حذف العمود processing_id
            $table->dropColumn('processing_id');
        });
    }
}

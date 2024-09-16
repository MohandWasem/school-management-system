<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceiptIdToStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('receipt_id')->nullable();

            // إضافة المفتاح الخارجي وربطه بجدول receipts
            $table->foreign('receipt_id')
                  ->references('id')
                  ->on('receipt_students')
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
            $table->dropForeign(['receipt_id']);
            // حذف العمود receipt_id
            $table->dropColumn('receipt_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdToStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
             // إضافة العمود payment_id
             $table->unsignedBigInteger('payment_id')->nullable();

             // إضافة المفتاح الخارجي وربطه بجدول payments
             $table->foreign('payment_id')
                   ->references('id')
                   ->on('payment_students')
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
             // حذف المفتاح الخارجي
             $table->dropForeign(['payment_id']);
             // حذف العمود payment_id
             $table->dropColumn('payment_id');
        });
    }
}

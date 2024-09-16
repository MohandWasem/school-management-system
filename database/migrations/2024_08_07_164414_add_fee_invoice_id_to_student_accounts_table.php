<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeInvoiceIdToStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->bigInteger('fee_invoice_id')->unsigned();
            $table->foreign('fee_invoice_id')->references('id')->on('feeinvoices')->onDelete('cascade');
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
            $table->dropForeign(['fee_invoice_id']);
            $table->dropColumn('fee_invoice_id');
        });
    }
}

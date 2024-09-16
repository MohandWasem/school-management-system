<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveGradeIdAndClassroomIdFromStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            if (Schema::hasColumn('student_accounts', 'Grade_id')) {
                $table->dropForeign(['Grade_id']); // حذف المفتاح الخارجي إذا كان موجودًا
                $table->dropColumn('Grade_id');
            }

            if (Schema::hasColumn('student_accounts', 'Classroom_id')) {
                $table->dropForeign(['Classroom_id']); // حذف المفتاح الخارجي إذا كان موجودًا
                $table->dropColumn('Classroom_id');
            }
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
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('classroom_id')->nullable();

        });
    }
}

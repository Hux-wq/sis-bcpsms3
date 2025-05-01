<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentNameToUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upload_files', function (Blueprint $table) {
            $table->string('student_name')->nullable()->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upload_files', function (Blueprint $table) {
            $table->dropColumn('student_name');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_school_infos', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year')->nullable();
            $table->unsignedInteger('year_level');
            $table->string('department_code');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();


            $table->foreign('student_id') 
                  ->references('id')  
                  ->on('students')  
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_school_infos');
    }
};

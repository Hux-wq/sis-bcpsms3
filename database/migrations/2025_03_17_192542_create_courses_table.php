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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 20)->unique();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('department_id');
            $table->integer('credits');
            $table->integer('level')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

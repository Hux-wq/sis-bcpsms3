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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section');
            $table->unsignedBigInteger('adviser')->nullable();
            $table->unsignedInteger('year');
            $table->unsignedInteger('semester');
            $table->unsignedInteger('specialization')->nullable();
            $table->string('created_by')->default('system');
            $table->unsignedBigInteger('department_id')->nullable();
            

            $table->foreign('adviser') 
                  ->references('id')  
                  ->on('users')  
                  ->onDelete('cascade');

            $table->foreign('department_id') 
                  ->references('id')  
                  ->on('departments')  
                  ->onDelete('cascade');
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};

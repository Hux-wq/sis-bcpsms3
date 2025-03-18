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
        Schema::create('user_school_infos', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable();
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('section_id');
            $table->string('scholastic_type');
            $table->UnsignedBigInteger('current_year');
            $table->UnsignedBigInteger('current_year_level');

            $table->foreign('section_id') 
            ->references('id')  
            ->on('sections')  
            ->onDelete('cascade');

            $table->foreign('user_id') 
            ->references('id')  
            ->on('users')  
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_school_infos');
    }
};

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
        Schema::create('user_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_number');
            $table->string('email_address');
            $table->string('facebook');
            $table->unsignedBigInteger('user_id')->nullable(); 

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
        Schema::dropIfExists('user_contact_infos');
    }
};

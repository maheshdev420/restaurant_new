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
        Schema::create('users_models', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
            $table->string('email')->unique();  
            $table->string('password');
            $table->string('pro_img')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('terms')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_models');
    }
};

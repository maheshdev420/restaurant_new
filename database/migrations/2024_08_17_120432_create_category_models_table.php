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
        Schema::create('category_models', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->bigInteger('parent_id')->nullable();
            $table->string('category_slug');
            $table->text('category_icon')->nullable();
            $table->string('category_status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_models');
    }
};

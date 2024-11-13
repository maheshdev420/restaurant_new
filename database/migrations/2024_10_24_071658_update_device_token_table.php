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
        Schema::table('device_token', function (Blueprint $table) {
            // Drop the existing foreign key and column
            $table->dropForeign(['access_token']);
            $table->dropColumn('access_token');
            
            // Add new access_token_id column and foreign key
            $table->unsignedBigInteger('access_token_id')->after('device_token'); 
            $table->foreign('access_token_id')->references('id')->on('personal_access_tokens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_token', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['access_token_id']);
            $table->dropColumn('access_token_id');
            
            // Restore the access_token column and foreign key
            $table->string('access_token')->unique()->after('id');
            $table->foreign('access_token')->references('token')->on('personal_access_tokens')->onDelete('cascade');
        });
    }
};

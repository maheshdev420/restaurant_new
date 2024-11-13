<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users_models', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('status');
            $table->string('apple_id')->nullable()->after('google_id');
            $table->string('facebook_id')->nullable()->after('apple_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_models', function (Blueprint $table) {
            $table->dropColumn(['facebook_id', 'apple_id', 'google_id']);
        });
    }
};

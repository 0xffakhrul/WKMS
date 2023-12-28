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
        // Drop the existing foreign key constraint
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Add a new foreign key constraint with cascading delete
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint added in the "up" method
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Add back the original foreign key constraint
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};

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
        Schema::table('skill_swaps', function (Blueprint $table) {
            $table->index('status');
            $table->index('sender_id');
            $table->index('receiver_id');
            $table->index(['sender_id', 'status']);
            $table->index(['receiver_id', 'status']);
        });

        if (Schema::hasTable('messages')) {
            Schema::table('messages', function (Blueprint $table) {
                if (Schema::hasColumn('messages', 'is_read')) {
                    $table->index('is_read');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_swaps', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['sender_id']);
            $table->dropIndex(['receiver_id']);
            $table->dropIndex(['sender_id', 'status']);
            $table->dropIndex(['receiver_id', 'status']);
        });

        if (Schema::hasTable('messages')) {
            Schema::table('messages', function (Blueprint $table) {
                if (Schema::hasColumn('messages', 'is_read')) {
                    $table->dropIndex(['is_read']);
                }
            });
        }
    }
};

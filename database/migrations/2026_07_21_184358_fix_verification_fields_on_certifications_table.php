<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->enum('verification_status', [
                'pending',
                'verified',
                'rejected',
            ])->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();

            $table->text('rejection_reason')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);

            $table->dropColumn([
                'verification_status',
                'verified_by',
                'verified_at',
                'rejection_reason',
            ]);
        });
    }
};

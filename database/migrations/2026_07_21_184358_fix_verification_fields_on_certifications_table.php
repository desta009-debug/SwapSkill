<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            if (! Schema::hasColumn('certifications', 'verification_status')) {
                $table->enum('verification_status', [
                    'pending',
                    'verified',
                    'rejected',
                ])->default('pending');
            }

            if (! Schema::hasColumn('certifications', 'verified_by')) {
                $table->foreignId('verified_by')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('certifications', 'verified_at')) {
                $table->timestamp('verified_at')->nullable();
            }

            if (! Schema::hasColumn('certifications', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
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

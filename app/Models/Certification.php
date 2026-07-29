<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'organization',
        'issue_date',
        'certificate_url',
        'image_path',
        'verification_status',
        'verified_by',
        'verified_at',
        'rejection_reason',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'verified_at' => 'datetime',
    ];

    /**
     * User yang memiliki sertifikat.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Admin yang memverifikasi sertifikat.
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Status helper.
     */
    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isRejected(): bool
    {
        return $this->verification_status === 'rejected';
    }
}

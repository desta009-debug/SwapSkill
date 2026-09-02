<?php

namespace App\Services;

use App\Models\Certification;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class CertificateVerificationService
{
    /**
     * Approve certification.
     */
    public function approve(Certification $certification): Certification
    {
        if ($certification->verification_status !== 'pending') {
            throw new RuntimeException('Certificate has already been processed.');
        }

        $certification->update([
            'verification_status' => 'verified',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        return $certification->fresh();
    }

    /**
     * Reject certification.
     */
    public function reject(Certification $certification, string $reason): Certification
    {
        if ($certification->verification_status !== 'pending') {
            throw new RuntimeException('Certificate has already been processed.');
        }

        $certification->update([
            'verification_status' => 'rejected',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'rejection_reason' => $reason,
        ]);

        return $certification->fresh();
    }
}

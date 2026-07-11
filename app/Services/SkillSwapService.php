<?php

namespace App\Services;

use App\Models\SkillSwap;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class SkillSwapService
{
    public function hasActiveSwap(User $sender, int $receiverId): bool
    {
        return SkillSwap::query()
            ->whereIn('status', ['pending', 'accepted'])
            ->where(function ($query) use ($sender, $receiverId) {
                $query->where(function($q) use ($sender, $receiverId) {
                    $q->where('sender_id', $sender->id)
                      ->where('receiver_id', $receiverId);
                })
                ->orWhere(function($q) use ($sender, $receiverId) {
                    $q->where('sender_id', $receiverId)
                      ->where('receiver_id', $sender->id);
                });
            })
            ->exists();
    }

    public function createSwapRequest(User $sender, int $receiverId, ?string $message): SkillSwap
    {
        if ($sender->id === $receiverId) {
            throw new Exception('Tidak bisa mengirim request ke diri sendiri.');
        }

        if ($this->hasActiveSwap($sender, $receiverId)) {
            throw new Exception('Kalian sudah memiliki request swap yang masih aktif (pending/accepted).');
        }

        return SkillSwap::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'message' => $message,
            'status' => 'pending',
        ]);
    }

    public function acceptSwap(SkillSwap $skillSwap): bool
    {
        $updated = SkillSwap::where('id', $skillSwap->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'accepted',
                'accepted_at' => now(),
            ]);

        if (!$updated) {
            throw new Exception('Request ini tidak lagi pending atau sudah diproses.');
        }

        return true;
    }

    public function rejectSwap(SkillSwap $skillSwap): bool
    {
        $updated = SkillSwap::where('id', $skillSwap->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'rejected',
            ]);

        if (!$updated) {
            throw new Exception('Request ini tidak lagi pending atau sudah diproses.');
        }

        return true;
    }

    public function completeSwap(SkillSwap $skillSwap): bool
    {
        $updated = SkillSwap::where('id', $skillSwap->id)
            ->where('status', 'accepted')
            ->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

        if (!$updated) {
            throw new Exception('Hanya request yang sudah di-accept yang bisa diselesaikan.');
        }

        return true;
    }

    public function cancelSwap(SkillSwap $skillSwap): bool
    {
        $updated = SkillSwap::where('id', $skillSwap->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'cancelled',
            ]);

        if (!$updated) {
            throw new Exception('Request ini tidak lagi pending atau sudah diproses.');
        }

        return true;
    }
}

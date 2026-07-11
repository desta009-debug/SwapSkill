<?php

namespace App\Services;

use App\Models\SkillSwap;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    /**
     * Store a new message in the swap.
     */
    public function storeMessage(SkillSwap $skillSwap, int $senderId, string $messageContent): Message
    {
        return $skillSwap->messages()->create([
            'sender_id' => $senderId,
            'message' => $messageContent,
            'is_read' => false,
        ]);
    }

    /**
     * Mark all unread messages from partner as read.
     */
    public function markPartnerMessagesAsRead(SkillSwap $skillSwap, int $currentUserId): void
    {
        $skillSwap->messages()
            ->where('sender_id', '!=', $currentUserId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * Mark specific messages as read.
     */
    public function markMessagesAsRead(SkillSwap $skillSwap, array $messageIds, int $currentUserId): void
    {
        $skillSwap->messages()
            ->whereIn('id', $messageIds)
            ->where('sender_id', '!=', $currentUserId)
            ->update(['is_read' => true]);
    }

    /**
     * Get recent messages for a swap.
     */
    public function getRecentMessages(SkillSwap $skillSwap, int $limit = 50): Collection
    {
        return $skillSwap->messages()
            ->with('sender')
            ->latest()
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }

    /**
     * Get new messages since last ID.
     */
    public function getNewMessages(SkillSwap $skillSwap, int $lastId): Collection
    {
        return $skillSwap->messages()
            ->with('sender')
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}

<?php

namespace App\Policies;

use App\Models\SkillSwap;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillSwapPolicy
{
    use HandlesAuthorization;

    public function view(User $user, SkillSwap $skillSwap): bool
    {
        return $user->id === $skillSwap->sender_id || $user->id === $skillSwap->receiver_id;
    }

    public function accept(User $user, SkillSwap $skillSwap): bool
    {
        return $user->id === $skillSwap->receiver_id;
    }

    public function reject(User $user, SkillSwap $skillSwap): bool
    {
        return $user->id === $skillSwap->receiver_id;
    }

    public function complete(User $user, SkillSwap $skillSwap): bool
    {
        return $user->id === $skillSwap->sender_id || $user->id === $skillSwap->receiver_id;
    }

    public function cancel(User $user, SkillSwap $skillSwap): bool
    {
        return $user->id === $skillSwap->sender_id;
    }
}

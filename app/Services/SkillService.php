<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSkill;

class SkillService
{
    /**
     * Store user's offered and wanted skills.
     *
     * @param User $user
     * @param array $offers
     * @param array $wants
     * @param array $offerLevels
     * @param array $wantLevels
     * @return void
     */
    public function syncUserSkills(User $user, array $offers, array $wants, array $offerLevels, array $wantLevels): void
    {
        UserSkill::where('user_id', $user->id)->delete();

        foreach ($offers as $skillId) {
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skillId,
                'type' => 'offer',
                'level' => $offerLevels[$skillId],
            ]);
        }

        foreach ($wants as $skillId) {
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skillId,
                'type' => 'want',
                'level' => $wantLevels[$skillId],
            ]);
        }
    }
}

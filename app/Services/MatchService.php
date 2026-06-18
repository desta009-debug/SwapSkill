<?php

namespace App\Services;

use Illuminate\Support\Collection;

class MatchService
{
    public function calculateScore(
        Collection $skillsTheyCanTeachMe,
        Collection $skillsTheyWantFromMe,
        string $matchType
    ): int {
        $score = 0;

        $score += $skillsTheyCanTeachMe->count() * 10;

        $score += $skillsTheyWantFromMe->count() * 10;

        if ($matchType === 'Mutual Match') {
            $score += 100;
        }

        return $score;
    }

    public function levelRank(): array
    {
        return [
            'beginner' => 1,
            'intermediate' => 2,
            'advanced' => 3,
        ];
    }

    public function isLevelCompatible(
        ?string $offerLevel,
        ?string $wantedLevel
    ): bool {
        $levelRank = $this->levelRank();

        if (! isset(
            $levelRank[$offerLevel],
            $levelRank[$wantedLevel]
        )) {
            return false;
        }

        return $levelRank[$offerLevel]
            >= $levelRank[$wantedLevel];
    }
}

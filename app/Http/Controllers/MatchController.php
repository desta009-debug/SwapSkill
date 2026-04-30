<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        if (! $currentUser instanceof User) {
            abort(403);
        }

        $currentUser->load([
            'offeredSkills',
            'wantedSkills',
        ]);

        $myOfferedSkills = $currentUser->offeredSkills->keyBy('id');
        $myWantedSkills = $currentUser->wantedSkills->keyBy('id');

        if ($myOfferedSkills->isEmpty() && $myWantedSkills->isEmpty()) {
            return view('matches.index', [
                'matches' => collect(),
            ]);
        }

        $users = User::with([
            'offeredSkills',
            'wantedSkills',
        ])
            ->where('id', '!=', $currentUser->id)
            ->get();

        $matches = $users->map(function ($user) use ($myOfferedSkills, $myWantedSkills) {
            $theirOfferedSkills = $user->offeredSkills->keyBy('id');
            $theirWantedSkills = $user->wantedSkills->keyBy('id');

            $skillsTheyCanTeachMe = $theirOfferedSkills
                ->filter(function ($theirSkill, $skillId) use ($myWantedSkills) {
                    if (! $myWantedSkills->has($skillId)) {
                        return false;
                    }

                    $myWantedLevel = $myWantedSkills[$skillId]->pivot->level ?? null;
                    $theirOfferLevel = $theirSkill->pivot->level ?? null;

                    return $this->isLevelCompatible($theirOfferLevel, $myWantedLevel);
                })
                ->values();

            $skillsTheyWantFromMe = $theirWantedSkills
                ->filter(function ($theirSkill, $skillId) use ($myOfferedSkills) {
                    if (! $myOfferedSkills->has($skillId)) {
                        return false;
                    }

                    $myOfferLevel = $myOfferedSkills[$skillId]->pivot->level ?? null;
                    $theirWantedLevel = $theirSkill->pivot->level ?? null;

                    return $this->isLevelCompatible($myOfferLevel, $theirWantedLevel);
                })
                ->values();

            if ($skillsTheyCanTeachMe->isEmpty() && $skillsTheyWantFromMe->isEmpty()) {
                return null;
            }

            $matchType = $skillsTheyCanTeachMe->isNotEmpty() && $skillsTheyWantFromMe->isNotEmpty()
                ? 'Mutual Match'
                : 'Potential Match';

            return [
                'user' => $user,
                'skills_they_can_teach_me' => $skillsTheyCanTeachMe,
                'skills_they_want_from_me' => $skillsTheyWantFromMe,
                'match_type' => $matchType,
                'score' => $this->calculateScore(
                    $skillsTheyCanTeachMe,
                    $skillsTheyWantFromMe,
                    $matchType
                ),
            ];
        })
            ->filter()
            ->sortByDesc(fn ($match) => $match['score'])
            ->values();

        return view('matches.index', [
            'matches' => $matches,
        ]);
    }

    private function isLevelCompatible(?string $offerLevel, ?string $wantedLevel): bool
    {
        $levelRank = $this->levelRank();

        if (! isset($levelRank[$offerLevel], $levelRank[$wantedLevel])) {
            return false;
        }

        return $levelRank[$offerLevel] >= $levelRank[$wantedLevel];
    }

    private function calculateScore(
        Collection $skillsTheyCanTeachMe,
        Collection $skillsTheyWantFromMe,
        string $matchType
    ): int {
        $baseScore = $skillsTheyCanTeachMe->count() + $skillsTheyWantFromMe->count();

        if ($matchType === 'Mutual Match') {
            return 100 + $baseScore;
        }

        return 50 + $baseScore;
    }

    private function levelRank(): array
    {
        return [
            'beginner' => 1,
            'intermediate' => 2,
            'advanced' => 3,
        ];
    }
}
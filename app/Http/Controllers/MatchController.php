<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MatchService;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    private MatchService $matchService;

    public function __construct(
        MatchService $matchService
    ) {
        $this->matchService = $matchService;
    }
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
            ->withAvg('receivedRatings', 'rating')
            ->withCount('receivedRatings')
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

                    return $this->matchService->isLevelCompatible($theirOfferLevel, $myWantedLevel);
                })
                ->values();

            $skillsTheyWantFromMe = $theirWantedSkills
                ->filter(function ($theirSkill, $skillId) use ($myOfferedSkills) {
                    if (! $myOfferedSkills->has($skillId)) {
                        return false;
                    }

                    $myOfferLevel = $myOfferedSkills[$skillId]->pivot->level ?? null;
                    $theirWantedLevel = $theirSkill->pivot->level ?? null;

                    return $this->matchService->isLevelCompatible($myOfferLevel, $theirWantedLevel);
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
                'score' => $this->matchService->calculateScore(
                    $skillsTheyCanTeachMe,
                    $skillsTheyWantFromMe,
                    $matchType
                ),
                'explanation' => $this->matchService->generateExplanation(
                    $skillsTheyCanTeachMe,
                    $skillsTheyWantFromMe,
                    $matchType
                ),
            ];
        })
            ->filter()
            ->sortByDesc(fn($match) => $match['score'])
            ->values();

        return view('matches.index', [
            'matches' => $matches,
        ]);
    }
}

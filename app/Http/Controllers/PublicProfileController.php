<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ShowcaseService;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    private ShowcaseService $showcaseService;

    public function __construct(ShowcaseService $showcaseService)
    {
        $this->showcaseService = $showcaseService;
    }

    public function show(User $user)
    {
        $user->load([
            'portfolios' => function($q) {
                $q->orderBy('featured', 'desc')->latest();
            },
            'certifications' => function($q) {
                $q->latest('issue_date');
            },
            'offeredSkills',
            'wantedSkills'
        ]);
        
        $user->loadAvg('receivedRatings', 'rating');

        $achievements = $this->showcaseService->getAchievements($user);

        return view('profile.public', compact('user', 'achievements'));
    }
}

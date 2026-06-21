<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SkillSwap;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService)
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $user->loadAvg('receivedRatings', 'rating');
        $user->loadCount('receivedRatings');

        $offeredSkills = $user->offeredSkills()->get();
        $wantedSkills = $user->wantedSkills()->get();

        $totalSwaps = SkillSwap::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->count();

        $completedSwaps = SkillSwap::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'completed')
            ->count();

        $pendingRequests = SkillSwap::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'pending')
            ->count();

        $acceptedRequests = SkillSwap::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'accepted')
            ->count();

        $successRate = $totalSwaps > 0 ? round(($completedSwaps / $totalSwaps) * 100, 1) : 0;

        $totalPortfolios = $user->portfolios()->count();
        $totalPortfolioViews = $user->portfolios()->sum('views_count');

        return view('dashboard', array_merge(compact(
            'offeredSkills',
            'wantedSkills',
            'totalSwaps',
            'completedSwaps',
            'pendingRequests',
            'acceptedRequests',
            'successRate',
            'user',
            'totalPortfolios',
            'totalPortfolioViews'
        ), $dashboardService->communityInsights(
            mentorLimit: 5,
            skillLimit: 5,
            activityLimit: 5
        )));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $userStats = $dashboardService->userDashboardStats($user);
        $communityStats = $dashboardService->communityInsights(
            mentorLimit: 5,
            skillLimit: 5,
            activityLimit: 5
        );

        return view('dashboard', array_merge($userStats, $communityStats));
    }
}

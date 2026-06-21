<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function __construct(private readonly DashboardService $dashboardService)
    {
    }

    public function index(): View
    {
        return view('leaderboard.index', $this->dashboardService->communityInsights());
    }
}

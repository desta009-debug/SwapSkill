<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MatchService;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index()
    {
        $currentUser = Auth::user();

        if (! $currentUser instanceof User) {
            abort(403);
        }

        $currentUser->load(['offeredSkills', 'wantedSkills']);

        $matches = $this->matchService->getMatchesFor($currentUser);

        return view('matches.index', compact('matches'));
    }
}

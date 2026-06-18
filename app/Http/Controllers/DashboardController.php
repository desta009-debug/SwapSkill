<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $offeredSkills = $user->offeredSkills()->get();
        $wantedSkills = $user->wantedSkills()->get();

        return view('dashboard', compact(
            'offeredSkills',
            'wantedSkills'
        ));
        return view('dashboard');
    }
}

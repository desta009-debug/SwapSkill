<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Portfolio;
use App\Models\SkillSwap;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalCertificates' => Certification::count(),
            'pendingCertificates' => Certification::where('verification_status', 'pending')->count(),
            'verifiedCertificates' => Certification::where('verification_status', 'verified')->count(),
            'rejectedCertificates' => Certification::where('verification_status', 'rejected')->count(),
            'totalPortfolios' => Portfolio::count(),
            'totalSkillSwaps' => SkillSwap::count(),
        ]);
    }
}

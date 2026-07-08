<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Services\SkillService;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function __construct(protected SkillService $skillService)
    {
    }

    public function edit()
    {
        $user = Auth::user();

        $skills = Skill::orderBy('name')->get();

        $selectedOffers = $user->userSkills()
            ->where('type', 'offer')
            ->pluck('skill_id')
            ->toArray();

        $selectedWants = $user->userSkills()
            ->where('type', 'want')
            ->pluck('skill_id')
            ->toArray();

        $selectedOfferLevels = $user->userSkills()
            ->where('type', 'offer')
            ->pluck('level', 'skill_id')
            ->toArray();

        $selectedWantLevels = $user->userSkills()
            ->where('type', 'want')
            ->pluck('level', 'skill_id')
            ->toArray();

        return view('skills.edit', compact(
            'skills',
            'selectedOffers',
            'selectedWants',
            'selectedOfferLevels',
            'selectedWantLevels'
        ));
    }

    public function update(UpdateSkillRequest $request)
    {
        $this->skillService->syncUserSkills(
            $request->user(),
            $request->getOffers(),
            $request->getWants(),
            $request->getOfferLevels(),
            $request->getWantLevels()
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Profil skill berhasil diperbarui.');
    }
}
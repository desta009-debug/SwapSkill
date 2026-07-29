<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Services\SkillService;
use App\Services\ModerationService;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function __construct(
        protected SkillService $skillService,
        protected ModerationService $moderationService
    ) {}

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
        $hasProfanity = false;

        // Moderate optional custom skill names or text fields if submitted
        if ($request->filled('teaching_description') && $this->moderationService->contains($request->teaching_description)) {
            $request->merge(['teaching_description' => $this->moderationService->clean($request->teaching_description)]);
            $hasProfanity = true;
        }

        if ($request->filled('learning_goal') && $this->moderationService->contains($request->learning_goal)) {
            $request->merge(['learning_goal' => $this->moderationService->clean($request->learning_goal)]);
            $hasProfanity = true;
        }

        $this->skillService->syncUserSkills(
            $request->user(),
            $request->getOffers(),
            $request->getWants(),
            $request->getOfferLevels(),
            $request->getWantLevels()
        );

        $redirect = redirect()
            ->route('dashboard')
            ->with('success', 'Profil skill berhasil diperbarui.');

        if ($hasProfanity) {
            $redirect->with('warning', 'Peringatan Bahasa: Deskripsi skill atau tujuan belajar Anda mengandung kata yang dilarang dan telah difilter secara otomatis.');
        }

        return $redirect;
    }
}
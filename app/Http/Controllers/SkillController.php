<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SkillController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $offeredSkills = $user->offeredSkills()->get();
        $wantedSkills = $user->wantedSkills()->get();

        return view('dashboard', compact('offeredSkills', 'wantedSkills'));
    }

    public function edit()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

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

    public function update(Request $request)
    {
        $request->validate([
            'offers' => ['nullable', 'array'],
            'offers.*' => ['exists:skills,id'],

            'wants' => ['nullable', 'array'],
            'wants.*' => ['exists:skills,id'],

            'offer_levels' => ['nullable', 'array'],
            'want_levels' => ['nullable', 'array'],
        ]);

        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $offers = array_unique($request->input('offers', []));
        $wants = array_unique($request->input('wants', []));

        $offerLevels = $request->input('offer_levels', []);
        $wantLevels = $request->input('want_levels', []);

        $validLevels = ['beginner', 'intermediate', 'advanced'];

        $sameSkills = array_intersect($offers, $wants);

        if (! empty($sameSkills)) {
            throw ValidationException::withMessages([
                'skills' => 'Skill yang sama tidak boleh dipilih di Offer dan Want sekaligus.',
            ]);
        }

        foreach ($offers as $skillId) {
            if (
                ! isset($offerLevels[$skillId]) ||
                ! in_array($offerLevels[$skillId], $validLevels, true)
            ) {
                throw ValidationException::withMessages([
                    'offer_levels' => 'Semua skill Offer wajib punya level yang valid.',
                ]);
            }
        }

        foreach ($wants as $skillId) {
            if (
                ! isset($wantLevels[$skillId]) ||
                ! in_array($wantLevels[$skillId], $validLevels, true)
            ) {
                throw ValidationException::withMessages([
                    'want_levels' => 'Semua skill Want wajib punya level yang valid.',
                ]);
            }
        }

        UserSkill::where('user_id', $user->id)->delete();

        foreach ($offers as $skillId) {
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skillId,
                'type' => 'offer',
                'level' => $offerLevels[$skillId],
            ]);
        }

        foreach ($wants as $skillId) {
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skillId,
                'type' => 'want',
                'level' => $wantLevels[$skillId],
            ]);
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Profil skill berhasil diperbarui.');
    }
}
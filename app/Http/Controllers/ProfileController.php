<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserDeletionRequest;
use App\Services\UserService;
use App\Services\ModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected ModerationService $moderationService
    ) {}

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $hasProfanity = false;

        // Moderate name & bio if present
        if (isset($validated['name']) && $this->moderationService->contains($validated['name'])) {
            $validated['name'] = $this->moderationService->clean($validated['name']);
            $hasProfanity = true;
        }

        if (isset($validated['bio']) && $this->moderationService->contains($validated['bio'])) {
            $validated['bio'] = $this->moderationService->clean($validated['bio']);
            $hasProfanity = true;
        }

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $this->userService->uploadProfilePhoto(
                $user,
                $request->file('profile_photo')
            );
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $redirect = Redirect::route('profile.edit')->with('status', 'profile-updated');

        if ($hasProfanity) {
            $redirect->with('warning', 'Peringatan Bahasa: Konten profil Anda mengandung kata yang dilarang dan telah difilter secara otomatis.');
        }

        return $redirect;
    }

    public function destroy(UserDeletionRequest $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $this->userService->deleteProfilePhoto($user);

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
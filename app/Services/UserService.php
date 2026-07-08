<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Upload and update user's profile photo.
     *
     * @param User $user
     * @param UploadedFile $file
     * @return string
     */
    public function uploadProfilePhoto(User $user, UploadedFile $file): string
    {
        $this->deleteProfilePhoto($user);

        return $file->store('profile-photos', 'public');
    }

    /**
     * Delete user's profile photo if it exists.
     *
     * @param User $user
     * @return void
     */
    public function deleteProfilePhoto(User $user): void
    {
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }
    }
}

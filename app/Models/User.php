<?php

namespace App\Models;

use App\Models\Skill;
use App\Models\UserSkill;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone', 'profile_photo', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->withPivot('type', 'level')
            ->withTimestamps();
    }

    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function offeredSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->withPivot('type', 'level')
            ->wherePivot('type', 'offer')
            ->withTimestamps();
    }

    public function wantedSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->withPivot('type', 'level')
            ->wherePivot('type', 'want')
            ->withTimestamps();
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (! $this->phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (! str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return 'https://wa.me/' . $phone;
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=4F46E5&background=EEF2FF';
    }
    public function sentRequests(): HasMany
    {
        return $this->hasMany(
            SkillSwap::class,
            'sender_id'
        );
    }

    public function receivedRequests(): HasMany
    {
        return $this->hasMany(
            SkillSwap::class,
            'receiver_id'
        );
    }

    public function completedSentSwaps(): HasMany
    {
        return $this->sentRequests()->where('status', 'completed');
    }

    public function completedReceivedSwaps(): HasMany
    {
        return $this->receivedRequests()->where('status', 'completed');
    }

    public function receivedRatings()
    {
        return $this->hasMany(Rating::class, 'rated_user_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
    public function receivedRatingsForUser()
    {
        return $this->hasMany(
            Rating::class,
            'rated_user_id'
        );
    }

    public function givenRatings()
    {
        return $this->hasMany(
            Rating::class,
            'rater_id'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(
            Message::class,
            'sender_id'
        );
    }

}

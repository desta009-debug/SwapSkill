<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillSwap extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
        'message',
        'accepted_at',
        'completed_at',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'sender_id'
        );
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'receiver_id'
        );
    }
    protected function casts(): array
    {
        return [
            'accepted_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(
            Rating::class
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(
            Message::class
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModerationLog extends Model
{
    protected $fillable = [
        'user_id',
        'content_type',
        'matched_words',
        'original_content',
        'cleaned_content',
    ];

    protected $casts = [
        'matched_words' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

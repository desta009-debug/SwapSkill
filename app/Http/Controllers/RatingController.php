<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\SkillSwap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'skill_swap_id' => [
                'required',
                'exists:skill_swaps,id',
            ],
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],
            'review' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $skillSwap = SkillSwap::findOrFail(
            $request->skill_swap_id
        );

        if ($skillSwap->status !== 'completed') {
            return back()->with(
                'error',
                'Rating hanya dapat diberikan setelah swap selesai.'
            );
        }

        $currentUserId = Auth::id();

        if (
            $currentUserId !== $skillSwap->sender_id &&
            $currentUserId !== $skillSwap->receiver_id
        ) {
            abort(403);
        }

        $alreadyRated = Rating::query()
            ->where('skill_swap_id', $skillSwap->id)
            ->where('rater_id', $currentUserId)
            ->exists();

        if ($alreadyRated) {
            return back()->with(
                'error',
                'Anda sudah memberikan rating untuk swap ini.'
            );
        }

        $ratedUserId =
            $currentUserId === $skillSwap->sender_id
            ? $skillSwap->receiver_id
            : $skillSwap->sender_id;

        Rating::create([
            'skill_swap_id' => $skillSwap->id,
            'rater_id' => $currentUserId,
            'rated_user_id' => $ratedUserId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with(
            'success',
            'Rating berhasil diberikan.'
        );
    }
}

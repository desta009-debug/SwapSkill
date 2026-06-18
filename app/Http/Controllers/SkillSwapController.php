<?php

namespace App\Http\Controllers;

use App\Models\SkillSwap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillSwapController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => [
                'required',
                'exists:users,id',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $sender = Auth::user();

        if (! $sender instanceof User) {
            abort(403);
        }

        $receiverId = (int) $request->receiver_id;

        if ($sender->id === $receiverId) {
            return back()->with(
                'error',
                'Tidak bisa mengirim request ke diri sendiri.'
            );
        }

        $existingPending = SkillSwap::query()
            ->where('status', 'pending')
            ->where(function ($query) use ($sender, $receiverId) {
                $query->where([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiverId,
                ])
                    ->orWhere([
                        'sender_id' => $receiverId,
                        'receiver_id' => $sender->id,
                    ]);
            })
            ->exists();

        if ($existingPending) {
            return back()->with(
                'error',
                'Masih ada request pending.'
            );
        }

        SkillSwap::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Request berhasil dikirim.'
        );
    }

    public function index()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $incomingRequests = SkillSwap::with([
            'sender',
            'receiver',
        ])
            ->where('receiver_id', $user->id)
            ->latest()
            ->get();

        $outgoingRequests = SkillSwap::with([
            'sender',
            'receiver',
        ])
            ->where('sender_id', $user->id)
            ->latest()
            ->get();

        return view('swaps.index', compact(
            'incomingRequests',
            'outgoingRequests'
        ));
    }

    public function accept(SkillSwap $skillSwap)
    {
        if ($skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        $skillSwap->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return back()->with(
            'success',
            'Request diterima.'
        );
    }

    public function reject(SkillSwap $skillSwap)
    {
        if ($skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        $skillSwap->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Request ditolak.'
        );
    }

    public function complete(SkillSwap $skillSwap)
    {
        if (
            Auth::id() !== $skillSwap->sender_id &&
            Auth::id() !== $skillSwap->receiver_id
        ) {
            abort(403);
        }

        $skillSwap->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with(
            'success',
            'Skill swap berhasil diselesaikan.'
        );
    }
    public function history()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $completedSwaps = SkillSwap::with([
            'sender',
            'receiver',
        ])
            ->where('status', 'completed')
            ->where(function ($query) use ($user) {

                $query->where(
                    'sender_id',
                    $user->id
                )
                    ->orWhere(
                        'receiver_id',
                        $user->id
                    );
            })
            ->latest()
            ->get();

        return view(
            'swaps.history',
            compact('completedSwaps')
        );
    }
}

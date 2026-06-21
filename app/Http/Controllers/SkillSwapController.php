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
                $query->where(function($q) use ($sender, $receiverId) {
                    $q->where('sender_id', $sender->id)
                      ->where('receiver_id', $receiverId);
                })
                ->orWhere(function($q) use ($sender, $receiverId) {
                    $q->where('sender_id', $receiverId)
                      ->where('receiver_id', $sender->id);
                });
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
            ->where('status', 'pending')
            ->latest()
            ->get();

        $outgoingRequests = SkillSwap::with([
            'sender',
            'receiver',
        ])
            ->where('sender_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $activeSwaps = SkillSwap::with([
            'sender',
            'receiver',
        ])
            ->where(function($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'accepted')
            ->latest()
            ->get();

        return view('swaps.index', compact(
            'incomingRequests',
            'outgoingRequests',
            'activeSwaps'
        ));
    }

    public function accept(SkillSwap $skillSwap)
    {
        if ($skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        if ($skillSwap->status !== 'pending') {
            return back()->with('error', 'Request ini tidak lagi pending.');
        }

        $skillSwap->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return redirect()->route('messages.show', $skillSwap)->with(
            'success',
            'Request diterima. Selamat berdiskusi!'
        );
    }

    public function reject(SkillSwap $skillSwap)
    {
        if ($skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        if ($skillSwap->status !== 'pending') {
            return back()->with('error', 'Request ini tidak lagi pending.');
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

        if ($skillSwap->status !== 'accepted') {
            return back()->with('error', 'Hanya request yang sudah di-accept yang bisa diselesaikan.');
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
            'ratings' => function($q) use ($user) {
                $q->where('rater_id', $user->id);
            }
        ])
            ->whereIn('status', ['completed', 'rejected', 'cancelled', 'expired'])
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->latest()
            ->get();

        return view(
            'swaps.history',
            compact('completedSwaps')
        );
    }
}

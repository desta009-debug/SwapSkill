<?php

namespace App\Http\Controllers;

use App\Models\SkillSwap;
use App\Models\User;
use App\Http\Requests\StoreSkillSwapRequest;
use App\Services\SkillSwapService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SkillSwapController extends Controller
{
    use AuthorizesRequests;

    private SkillSwapService $skillSwapService;

    public function __construct(SkillSwapService $skillSwapService)
    {
        $this->skillSwapService = $skillSwapService;
    }

    public function store(StoreSkillSwapRequest $request)
    {
        $sender = Auth::user();

        if (! $sender instanceof User) {
            abort(403);
        }

        try {
            $this->skillSwapService->createSwapRequest(
                $sender,
                (int) $request->receiver_id,
                $request->message
            );

            return back()->with('success', 'Request berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $incomingRequests = SkillSwap::with(['sender', 'receiver'])
            ->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->paginate(15, ['*'], 'incoming_page');

        $outgoingRequests = SkillSwap::with(['sender', 'receiver'])
            ->where('sender_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->paginate(15, ['*'], 'outgoing_page');

        $activeSwaps = SkillSwap::with(['sender', 'receiver'])
            ->where(function($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'accepted')
            ->latest()
            ->paginate(15, ['*'], 'active_page');

        return view('swaps.index', compact(
            'incomingRequests',
            'outgoingRequests',
            'activeSwaps'
        ));
    }

    public function accept(SkillSwap $skillSwap)
    {
        $this->authorize('accept', $skillSwap);

        try {
            $this->skillSwapService->acceptSwap($skillSwap);
            return redirect()->route('messages.show', $skillSwap)->with(
                'success',
                'Request diterima. Selamat berdiskusi!'
            );
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(SkillSwap $skillSwap)
    {
        $this->authorize('reject', $skillSwap);

        try {
            $this->skillSwapService->rejectSwap($skillSwap);
            return back()->with('success', 'Request ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function complete(SkillSwap $skillSwap)
    {
        $this->authorize('complete', $skillSwap);

        try {
            $this->skillSwapService->completeSwap($skillSwap);
            return back()->with('success', 'Skill swap berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(SkillSwap $skillSwap)
    {
        $this->authorize('cancel', $skillSwap);

        try {
            $this->skillSwapService->cancelSwap($skillSwap);
            return back()->with('success', 'Request berhasil dibatalkan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
            ->paginate(15);

        return view('swaps.history', compact('completedSwaps'));
    }
}

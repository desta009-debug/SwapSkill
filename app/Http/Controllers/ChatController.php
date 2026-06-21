<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SkillSwap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the inbox.
     */
    public function index()
    {
        $user = Auth::user();

        // Get all active swaps for this user
        $activeSwaps = SkillSwap::with(['sender', 'receiver', 'messages' => function ($query) {
            $query->latest()->limit(1);
        }])
            ->where(function($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'accepted')
            ->orderBy('updated_at', 'desc')
            ->get();

        if ($activeSwaps->isEmpty()) {
            return view('swaps.chat', [
                'activeSwaps' => $activeSwaps,
                'skillSwap' => null,
                'partner' => null,
                'messages' => collect()
            ]);
        }

        // Redirect to the first active chat
        return redirect()->route('messages.show', $activeSwaps->first());
    }

    /**
     * Show the chat interface.
     */
    public function show(SkillSwap $skillSwap)
    {
        // Ensure the current user is a participant
        if ($skillSwap->sender_id !== Auth::id() && $skillSwap->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to chat.');
        }

        // Only allow chatting for accepted swaps
        if ($skillSwap->status !== 'accepted') {
            return redirect()->route('swaps.index')->with('error', 'Chat hanya tersedia untuk swap yang sudah diterima.');
        }

        // Mark unread messages from partner as read
        $skillSwap->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $partner = Auth::id() === $skillSwap->sender_id ? $skillSwap->receiver : $skillSwap->sender;
        $messages = $skillSwap->messages()->with('sender')->orderBy('created_at', 'asc')->get();

        // Fetch all active swaps for sidebar
        $user = Auth::user();
        $activeSwaps = SkillSwap::with(['sender', 'receiver', 'messages' => function ($query) {
            $query->latest();
        }])
            ->where(function($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->where('status', 'accepted')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('swaps.chat', compact('skillSwap', 'partner', 'messages', 'activeSwaps'));
    }

    /**
     * Store a new message.
     */
    public function store(Request $request, SkillSwap $skillSwap)
    {
        if ($skillSwap->sender_id !== Auth::id() && $skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $skillSwap->messages()->create([
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'is_read' => false,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ]);
        }

        return back();
    }

    /**
     * Fetch new messages for AJAX polling.
     */
    public function fetch(Request $request, SkillSwap $skillSwap)
    {
        if ($skillSwap->sender_id !== Auth::id() && $skillSwap->receiver_id !== Auth::id()) {
            abort(403);
        }

        $lastMessageId = $request->query('last_id', 0);

        $newMessages = $skillSwap->messages()
            ->with('sender')
            ->where('id', '>', $lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($newMessages->count() > 0) {
            // Mark fetched messages from partner as read
            $skillSwap->messages()
                ->whereIn('id', $newMessages->pluck('id'))
                ->where('sender_id', '!=', Auth::id())
                ->update(['is_read' => true]);
        }

        return response()->json($newMessages);
    }
}

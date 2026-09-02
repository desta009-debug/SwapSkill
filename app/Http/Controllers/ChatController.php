<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SkillSwap;
use App\Models\User;
use App\Http\Requests\StoreMessageRequest;
use App\Services\ChatService;
use App\Services\ModerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ChatController extends Controller
{
    use AuthorizesRequests;

    private ChatService $chatService;
    private ModerationService $moderationService;

    public function __construct(ChatService $chatService, ModerationService $moderationService)
    {
        $this->chatService = $chatService;
        $this->moderationService = $moderationService;
    }

    /**
     * Show the inbox.
     */
    public function index()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        // Get all active swaps for this user with latest message
        $activeSwaps = SkillSwap::with(['sender', 'receiver', 'latestMessage'])
            ->withCount(['messages as unread_count' => function ($query) use ($user) {
                $query->where('sender_id', '!=', $user->id)
                      ->where('is_read', false);
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
        $this->authorize('message', $skillSwap);

        // Mark unread messages from partner as read
        $this->chatService->markPartnerMessagesAsRead($skillSwap, Auth::id());

        $partner = Auth::id() === $skillSwap->sender_id ? $skillSwap->receiver : $skillSwap->sender;
        
        // Fetch recent messages (limited to 50 for initial load, reversed to show oldest first at top)
        $messages = $this->chatService->getRecentMessages($skillSwap, 50);

        // Fetch all active swaps for sidebar
        $user = Auth::user();
        $activeSwaps = SkillSwap::with(['sender', 'receiver', 'latestMessage'])
            ->withCount(['messages as unread_count' => function ($query) use ($user) {
                $query->where('sender_id', '!=', $user->id)
                      ->where('is_read', false);
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
     * Store a new message with profanity moderation.
     */
    public function store(StoreMessageRequest $request, SkillSwap $skillSwap)
    {
        $this->authorize('message', $skillSwap);

        $rawMessage = $request->message;
        $isFiltered = $this->moderationService->contains($rawMessage);
        $cleanedMessage = $this->moderationService->clean($rawMessage);

        $message = $this->chatService->storeMessage(
            $skillSwap, 
            Auth::id(), 
            $cleanedMessage
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'filtered' => $isFiltered,
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
        $this->authorize('message', $skillSwap);

        $lastMessageId = (int) $request->query('last_id', 0);

        $newMessages = $this->chatService->getNewMessages($skillSwap, $lastMessageId);

        if ($newMessages->isNotEmpty()) {
            // Mark fetched messages from partner as read
            $this->chatService->markMessagesAsRead(
                $skillSwap, 
                $newMessages->pluck('id')->toArray(), 
                Auth::id()
            );
        }

        return response()->json($newMessages);
    }
}

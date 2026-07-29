<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SkillSwap;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Completed Swap Messages
        $frontend = User::where('email', 'frontend-developer@swapskill.test')->first();
        $uiDesigner = User::where('email', 'ui-designer@swapskill.test')->first();

        if ($frontend && $uiDesigner) {
            $completedSwap = SkillSwap::where('sender_id', $frontend->id)
                ->where('receiver_id', $uiDesigner->id)
                ->where('status', 'completed')
                ->first();

            if ($completedSwap) {
                $messages = [
                    ['sender_id' => $uiDesigner->id, 'message' => 'Hey! Thanks for reaching out. Yes, I can definitely help with your UI design.', 'delay_days' => 12],
                    ['sender_id' => $frontend->id, 'message' => 'Awesome! My React project is an e-commerce site, and I need a sleek modern look.', 'delay_days' => 11],
                    ['sender_id' => $uiDesigner->id, 'message' => 'Sounds great. I have some Figma templates we can start with. How about the React help I need?', 'delay_days' => 10],
                    ['sender_id' => $frontend->id, 'message' => 'Of course! What exactly do you need help with in React?', 'delay_days' => 9],
                    ['sender_id' => $uiDesigner->id, 'message' => 'I am struggling with React Router and state management. Can we hop on a call this weekend?', 'delay_days' => 8],
                    ['sender_id' => $frontend->id, 'message' => 'Sure, Saturday at 10 AM works for me. I can walk you through Redux and React Router.', 'delay_days' => 7],
                    ['sender_id' => $uiDesigner->id, 'message' => 'Perfect! See you then.', 'delay_days' => 7],
                    ['sender_id' => $uiDesigner->id, 'message' => 'Thanks for the session today! The React Router makes so much sense now. I\'ve shared the Figma file with you.', 'delay_days' => 4],
                    ['sender_id' => $frontend->id, 'message' => 'Got it! The design looks fantastic. Thanks for the swap, it was a pleasure working with you.', 'delay_days' => 3],
                ];

                foreach ($messages as $msg) {
                    Message::firstOrCreate([
                        'skill_swap_id' => $completedSwap->id,
                        'sender_id' => $msg['sender_id'],
                        'message' => $msg['message'],
                        'is_read' => true,
                        'created_at' => Carbon::now()->subDays($msg['delay_days']),
                        'updated_at' => Carbon::now()->subDays($msg['delay_days']),
                    ]);
                }
            }
        }

        // 2. Accepted Swap Messages
        $backend = User::where('email', 'backend-developer@swapskill.test')->first();
        $fullstack = User::where('email', 'full-stack-developer@swapskill.test')->first();

        if ($backend && $fullstack) {
            $acceptedSwap = SkillSwap::where('sender_id', $backend->id)
                ->where('receiver_id', $fullstack->id)
                ->where('status', 'accepted')
                ->first();

            if ($acceptedSwap) {
                $messages = [
                    ['sender_id' => $fullstack->id, 'message' => 'Hello! I accept the swap. I am quite experienced with Vue but need to level up my Laravel skills.', 'delay_days' => 2],
                    ['sender_id' => $backend->id, 'message' => 'Great to connect! I\'ve been using Laravel for years, so I can definitely mentor you. I just need help setting up a Vue SPA.', 'delay_days' => 2],
                    ['sender_id' => $fullstack->id, 'message' => 'I can help with that. Are you using Vue 3 with Composition API?', 'delay_days' => 1],
                    ['sender_id' => $backend->id, 'message' => 'Yes, exactly. When are you free to chat?', 'delay_days' => 0],
                ];

                foreach ($messages as $msg) {
                    Message::firstOrCreate([
                        'skill_swap_id' => $acceptedSwap->id,
                        'sender_id' => $msg['sender_id'],
                        'message' => $msg['message'],
                        'is_read' => $msg['delay_days'] > 0 ? true : false,
                        'created_at' => Carbon::now()->subDays($msg['delay_days']),
                        'updated_at' => Carbon::now()->subDays($msg['delay_days']),
                    ]);
                }
            }
        }
    }
}

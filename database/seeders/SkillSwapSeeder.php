<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SkillSwap;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SkillSwapSeeder extends Seeder
{
    public function run(): void
    {
        $swaps = [
            // 1. Completed
            [
                'sender' => 'frontend-developer@swapskill.test',
                'receiver' => 'ui-designer@swapskill.test',
                'status' => 'completed',
                'message' => 'Hi! I see you need React help. I can help with that, and I need UI design for my project.',
                'created_at' => Carbon::now()->subDays(14),
                'accepted_at' => Carbon::now()->subDays(13),
                'completed_at' => Carbon::now()->subDays(2),
            ],
            // 1b. Completed (Backend <-> Frontend)
            [
                'sender' => 'backend-developer@swapskill.test',
                'receiver' => 'frontend-developer@swapskill.test',
                'status' => 'completed',
                'message' => 'Hey, I can build your APIs if you can help me with the React frontend.',
                'created_at' => Carbon::now()->subDays(30),
                'accepted_at' => Carbon::now()->subDays(29),
                'completed_at' => Carbon::now()->subDays(15),
            ],
            // 1c. Completed (UI Designer <-> Graphic Designer)
            [
                'sender' => 'ui-designer@swapskill.test',
                'receiver' => 'graphic-designer@swapskill.test',
                'status' => 'completed',
                'message' => 'I can do your web app UX if you can create some vector illustrations for me.',
                'created_at' => Carbon::now()->subDays(20),
                'accepted_at' => Carbon::now()->subDays(19),
                'completed_at' => Carbon::now()->subDays(5),
            ],
            // 1d. Completed (Full Stack <-> Backend)
            [
                'sender' => 'full-stack-developer@swapskill.test',
                'receiver' => 'backend-developer@swapskill.test',
                'status' => 'completed',
                'message' => 'I need some help optimizing SQL queries. I can teach you Vue.',
                'created_at' => Carbon::now()->subDays(45),
                'accepted_at' => Carbon::now()->subDays(44),
                'completed_at' => Carbon::now()->subDays(35),
            ],
            // 2. Accepted
            [
                'sender' => 'backend-developer@swapskill.test',
                'receiver' => 'full-stack-developer@swapskill.test',
                'status' => 'accepted',
                'message' => 'Hey, I can help you with Laravel if you can teach me some Vue.',
                'created_at' => Carbon::now()->subDays(3),
                'accepted_at' => Carbon::now()->subDays(3)->addHours(2),
                'completed_at' => null,
            ],
            // 3. Pending
            [
                'sender' => 'beginner-programmer@swapskill.test',
                'receiver' => 'laravel-mentor@swapskill.test',
                'status' => 'pending',
                'message' => 'Hello! Could you mentor me in Laravel? I can try to help you with some basic HTML tasks.',
                'created_at' => Carbon::now()->subHours(12),
                'accepted_at' => null,
                'completed_at' => null,
            ],
            // 4. Rejected
            [
                'sender' => 'graphic-designer@swapskill.test',
                'receiver' => 'digital-marketing-specialist@swapskill.test',
                'status' => 'rejected',
                'message' => 'Hi! I need help with Japanese, I can offer Photoshop skills.',
                'created_at' => Carbon::now()->subDays(7),
                'accepted_at' => null,
                'completed_at' => null,
            ],
            // 5. Cancelled
            [
                'sender' => 'design-mentor@swapskill.test',
                'receiver' => 'ui-designer@swapskill.test',
                'status' => 'cancelled',
                'message' => 'Hey, I\'d like to practice English, I can offer Figma mentoring.',
                'created_at' => Carbon::now()->subDays(5),
                'accepted_at' => null,
                'completed_at' => null,
            ],
        ];

        foreach ($swaps as $swapData) {
            $sender = User::where('email', $swapData['sender'])->first();
            $receiver = User::where('email', $swapData['receiver'])->first();

            if (!$sender || !$receiver) continue;

            SkillSwap::updateOrCreate(
                [
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                ],
                [
                    'status' => $swapData['status'],
                    'message' => $swapData['message'],
                    'created_at' => $swapData['created_at'],
                    'accepted_at' => $swapData['accepted_at'],
                    'completed_at' => $swapData['completed_at'],
                    'updated_at' => $swapData['created_at'],
                ]
            );
        }
    }
}

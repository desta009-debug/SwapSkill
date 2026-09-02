<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SkillSwap;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        // Only get completed swaps
        $completedSwaps = SkillSwap::where('status', 'completed')->with(['sender', 'receiver'])->get();

        foreach ($completedSwaps as $swap) {
            $senderEmail = $swap->sender->email;
            $receiverEmail = $swap->receiver->email;

            // Sender rating the receiver
            $this->createRating($swap, $swap->sender_id, $swap->receiver_id, $receiverEmail);

            // Receiver rating the sender
            $this->createRating($swap, $swap->receiver_id, $swap->sender_id, $senderEmail);
        }
    }

    private function createRating($swap, $raterId, $ratedUserId, $ratedUserEmail)
    {
        $ratingData = $this->getRatingDataForUser($ratedUserEmail);

        if ($ratingData) {
            Rating::updateOrCreate(
                [
                    'skill_swap_id' => $swap->id,
                    'rater_id' => $raterId,
                    'rated_user_id' => $ratedUserId,
                ],
                [
                    'rating' => $ratingData['score'],
                    'review' => $ratingData['review'],
                ]
            );
        }
    }

    private function getRatingDataForUser($email)
    {
        // 1. frontend-developer (Top tier - 5 stars)
        if ($email === 'frontend-developer@swapskill.test') {
            $reviews = [
                'Amazing frontend skills! Delivered the React components flawlessly.',
                'Very communicative and patient. The React setup was perfect.',
            ];
            return ['score' => 5, 'review' => $reviews[array_rand($reviews)]];
        }

        // 2. backend-developer (High tier - 4 to 5 stars)
        if ($email === 'backend-developer@swapskill.test') {
            $reviews = [
                'Great API design. Took a little time, but the code is very clean.',
                'Excellent Laravel mentor. Very helpful and knowledgeable.',
            ];
            $score = rand(4, 5);
            return ['score' => $score, 'review' => $reviews[array_rand($reviews)]];
        }

        // 3. ui-designer (Mid tier - 4 stars)
        if ($email === 'ui-designer@swapskill.test') {
            $reviews = [
                'Good design work, though some iterations were needed.',
                'Solid Figma templates. Met most of my expectations.',
            ];
            return ['score' => 4, 'review' => $reviews[array_rand($reviews)]];
        }

        // 4. graphic-designer (Average tier - 3 to 4 stars)
        if ($email === 'graphic-designer@swapskill.test') {
            $reviews = [
                'The illustrations were okay, but not exactly what I envisioned initially.',
                'Decent work, communication could be improved.',
            ];
            $score = rand(3, 4);
            return ['score' => $score, 'review' => $reviews[array_rand($reviews)]];
        }

        // Fallback for others
        return ['score' => 5, 'review' => 'Great experience working together!'];
    }
}

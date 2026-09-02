<?php

namespace Tests\Feature;

use App\Models\Rating;
use App\Models\SkillSwap;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingProfanityTest extends TestCase
{
    use RefreshDatabase;

    public function test_rating_comment_with_profanity_is_blocked(): void
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $skillSwap = SkillSwap::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($sender)->post(route('ratings.store'), [
            'skill_swap_id' => $skillSwap->id,
            'rating' => 5,
            'review' => 'Orangnya anjing banget pelayanannya',
        ]);

        $response->assertSessionHas('profanity_warning', 'Please communicate respectfully. Your message was automatically filtered.');
        $response->assertSessionHas('error', 'Komentar mengandung kata yang dilarang. Harap gunakan bahasa yang sopan.');
        $this->assertDatabaseMissing('ratings', [
            'skill_swap_id' => $skillSwap->id,
            'rater_id' => $sender->id,
        ]);
        $this->assertDatabaseHas('moderation_logs', [
            'user_id' => $sender->id,
            'content_type' => 'rating_review',
        ]);
    }

    public function test_clean_rating_comment_is_allowed(): void
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $skillSwap = SkillSwap::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($sender)->post(route('ratings.store'), [
            'skill_swap_id' => $skillSwap->id,
            'rating' => 5,
            'review' => 'Sangat bagus dan bermanfaat!',
        ]);

        $response->assertSessionHas('success', 'Rating berhasil diberikan.');
        $this->assertDatabaseHas('ratings', [
            'skill_swap_id' => $skillSwap->id,
            'rater_id' => $sender->id,
            'rating' => 5,
            'review' => 'Sangat bagus dan bermanfaat!',
        ]);
    }
}

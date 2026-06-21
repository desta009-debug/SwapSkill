<?php

namespace App\Services;

use App\Models\Rating;
use App\Models\Skill;
use App\Models\SkillSwap;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * @return array{
     *     total_users: int,
     *     total_skills: int,
     *     completed_swaps: int,
     *     average_rating: float,
     *     active_mentors: int
     * }
     */
    public function communityStatistics(): array
    {
        return [
            'total_users' => User::query()->count(),
            'total_skills' => Skill::query()->count(),
            'completed_swaps' => SkillSwap::query()->where('status', 'completed')->count(),
            'average_rating' => round((float) (Rating::query()->avg('rating') ?? 0), 1),
            'active_mentors' => User::query()
                ->where(function (Builder $query) {
                    $query->whereHas('completedSentSwaps')
                        ->orWhereHas('completedReceivedSwaps');
                })
                ->count(),
        ];
    }

    /**
     * Rank users by completed swap participation, then by average received rating.
     */
    public function topMentors(int $limit = 10): Collection
    {
        $completedParticipants = SkillSwap::query()
            ->selectRaw('sender_id as user_id')
            ->where('status', 'completed')
            ->unionAll(
                SkillSwap::query()
                    ->selectRaw('receiver_id as user_id')
                    ->where('status', 'completed')
            );

        $completedCounts = DB::query()
            ->fromSub($completedParticipants, 'completed_participants')
            ->selectRaw('user_id, COUNT(*) as completed_swaps_count')
            ->groupBy('user_id');

        $ratingStats = Rating::query()
            ->select('rated_user_id')
            ->selectRaw('AVG(rating) as average_rating')
            ->selectRaw('COUNT(*) as ratings_count')
            ->groupBy('rated_user_id');

        return User::query()
            ->joinSub($completedCounts, 'completed_swaps', function ($join) {
                $join->on('completed_swaps.user_id', '=', 'users.id');
            })
            ->leftJoinSub($ratingStats, 'rating_stats', function ($join) {
                $join->on('rating_stats.rated_user_id', '=', 'users.id');
            })
            ->select('users.*')
            ->selectRaw('completed_swaps.completed_swaps_count as completed_swaps_count')
            ->selectRaw('COALESCE(rating_stats.average_rating, 0) as average_rating')
            ->selectRaw('COALESCE(rating_stats.ratings_count, 0) as ratings_count')
            ->orderByDesc('completed_swaps_count')
            ->orderByDesc('average_rating')
            ->orderBy('users.name')
            ->limit($limit)
            ->get()
            ->values()
            ->each(function (User $mentor, int $index): void {
                $rank = $index + 1;

                $mentor->setAttribute('rank', $rank);
                $mentor->setAttribute('completed_swaps_count', (int) $mentor->getAttribute('completed_swaps_count'));
                $mentor->setAttribute('average_rating', round((float) $mentor->getAttribute('average_rating'), 1));
                $mentor->setAttribute('ratings_count', (int) $mentor->getAttribute('ratings_count'));
                $mentor->setAttribute('leaderboard_badge', $this->badgeForRank($rank));
            });
    }

    /**
     * Count distinct users so duplicate pivot rows cannot inflate a skill's rank.
     */
    public function topSkills(int $limit = 10): Collection
    {
        return Skill::query()
            ->select('skills.*')
            ->selectSub(
                UserSkill::query()
                    ->selectRaw('COUNT(DISTINCT user_id)')
                    ->whereColumn('skill_id', 'skills.id'),
                'users_count'
            )
            ->whereHas('userSkills')
            ->orderByDesc('users_count')
            ->orderBy('name')
            ->limit($limit)
            ->get()
            ->values()
            ->each(function (Skill $skill, int $index): void {
                $skill->setAttribute('rank', $index + 1);
                $skill->setAttribute('users_count', (int) $skill->getAttribute('users_count'));
            });
    }

    /**
     * Build one chronological feed from existing community records.
     */
    public function recentActivities(int $limit = 10): Collection
    {
        $completedSwaps = SkillSwap::query()
            ->with(['sender:id,name,profile_photo', 'receiver:id,name,profile_photo'])
            ->where('status', 'completed')
            ->latest('completed_at')
            ->limit($limit)
            ->get()
            ->filter(fn (SkillSwap $swap) => $swap->sender && $swap->receiver)
            ->map(fn (SkillSwap $swap) => [
                'id' => 'swap-'.$swap->id,
                'type' => 'swap',
                'message' => $swap->sender->name.' dan '.$swap->receiver->name.' menyelesaikan skill swap.',
                'occurred_at' => $swap->completed_at ?? $swap->updated_at,
                'user' => $swap->sender,
            ]);

        $ratings = Rating::query()
            ->with(['ratedUser:id,name,profile_photo'])
            ->latest()
            ->limit($limit)
            ->get()
            ->filter(fn (Rating $rating) => $rating->ratedUser)
            ->map(fn (Rating $rating) => [
                'id' => 'rating-'.$rating->id,
                'type' => 'rating',
                'message' => $rating->ratedUser->name.' menerima rating '.$rating->rating.' bintang.',
                'occurred_at' => $rating->created_at,
                'user' => $rating->ratedUser,
            ]);

        $newSkills = UserSkill::query()
            ->with(['user:id,name,profile_photo', 'skill:id,name'])
            ->latest()
            ->limit($limit)
            ->get()
            ->filter(fn (UserSkill $userSkill) => $userSkill->user && $userSkill->skill)
            ->map(fn (UserSkill $userSkill) => [
                'id' => 'skill-'.$userSkill->id,
                'type' => 'skill',
                'message' => $userSkill->user->name.' menambahkan skill '.$userSkill->skill->name.'.',
                'occurred_at' => $userSkill->created_at,
                'user' => $userSkill->user,
            ]);

        return $completedSwaps
            ->concat($ratings)
            ->concat($newSkills)
            ->sortByDesc(fn (array $activity) => $activity['occurred_at']->getTimestamp())
            ->take($limit)
            ->values();
    }

    /**
     * @return array{communityStatistics: array, topMentors: Collection, topSkills: Collection, recentActivities: Collection}
     */
    public function communityInsights(
        int $mentorLimit = 10,
        int $skillLimit = 10,
        int $activityLimit = 10
    ): array {
        return [
            'communityStatistics' => $this->communityStatistics(),
            'topMentors' => $this->topMentors($mentorLimit),
            'topSkills' => $this->topSkills($skillLimit),
            'recentActivities' => $this->recentActivities($activityLimit),
        ];
    }

    private function badgeForRank(int $rank): string
    {
        return match ($rank) {
            1 => 'Gold Mentor',
            2 => 'Silver Mentor',
            3 => 'Bronze Mentor',
            default => 'Top Mentor',
        };
    }
}

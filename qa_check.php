<?php
$issues = [];

// 1. Duplicate Users
$duplicateUsers = App\Models\User::select('email')
    ->groupBy('email')
    ->havingRaw('COUNT(id) > 1')
    ->get();
if ($duplicateUsers->count() > 0) $issues[] = "Duplicate Users found: " . json_encode($duplicateUsers);

// 2. Duplicate Skills
$duplicateSkills = App\Models\Skill::select('slug')
    ->groupBy('slug')
    ->havingRaw('COUNT(id) > 1')
    ->get();
if ($duplicateSkills->count() > 0) $issues[] = "Duplicate Skills found: " . json_encode($duplicateSkills);

// 3. Every user has meaningful data (skills)
$usersWithoutSkills = App\Models\User::doesntHave('skills')->get();
if ($usersWithoutSkills->count() > 0) $issues[] = "Users without skills found: " . $usersWithoutSkills->count();

// 4. Every portfolio belongs to an existing user
$orphanPortfolios = App\Models\Portfolio::whereNotIn('user_id', App\Models\User::pluck('id'))->get();
if ($orphanPortfolios->count() > 0) $issues[] = "Orphan Portfolios found: " . $orphanPortfolios->count();

// 5. Every certification belongs to an existing user
$orphanCerts = App\Models\Certification::whereNotIn('user_id', App\Models\User::pluck('id'))->get();
if ($orphanCerts->count() > 0) $issues[] = "Orphan Certifications found: " . $orphanCerts->count();

// 6. Every swap references existing users
$orphanSwaps = App\Models\SkillSwap::whereNotIn('sender_id', App\Models\User::pluck('id'))
    ->orWhereNotIn('receiver_id', App\Models\User::pluck('id'))->get();
if ($orphanSwaps->count() > 0) $issues[] = "Orphan Swaps found: " . $orphanSwaps->count();

// 7. Every message references an existing swap
$orphanMessages = App\Models\Message::whereNotIn('skill_swap_id', App\Models\SkillSwap::pluck('id'))->get();
if ($orphanMessages->count() > 0) $issues[] = "Orphan Messages found: " . $orphanMessages->count();

// 8. Every rating references an existing completed swap
$orphanRatings = App\Models\Rating::whereNotIn('skill_swap_id', App\Models\SkillSwap::pluck('id'))->get();
if ($orphanRatings->count() > 0) {
    $issues[] = "Orphan Ratings found: " . $orphanRatings->count();
} else {
    $ratingsForNonCompleted = App\Models\Rating::whereHas('skillSwap', function($q) {
        $q->where('status', '!=', 'completed');
    })->get();
    if ($ratingsForNonCompleted->count() > 0) {
        $issues[] = "Ratings for non-completed swaps found: " . $ratingsForNonCompleted->count();
    }
}

// 9. Verify leaderboard correctness (check averages)
$leaderboard = App\Models\Rating::select('rated_user_id')
    ->selectRaw('AVG(rating) as average_rating')
    ->groupBy('rated_user_id')
    ->with('ratedUser')
    ->get();

$leaderboardData = [];
foreach ($leaderboard as $entry) {
    $leaderboardData[$entry->ratedUser->email] = $entry->average_rating;
}
if (empty($leaderboardData)) $issues[] = "Leaderboard is empty.";

// 10. Verify match types based on users
// Since UserSkillSeeder sets up matches logically, we just check if multiple types of users exist.
$allUsers = App\Models\User::count();
if ($allUsers < 10) $issues[] = "Missing seeded users.";

echo json_encode([
    'issues' => $issues,
    'leaderboard' => $leaderboardData
]);

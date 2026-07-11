<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\SkillSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     UserSeeder::class,
        // ]);
        
        $this->command->info('Seeding Database...');
        $this->seedAll();
    }

    private function seedAll()
    {
        // 1. Create Skills
        $skillNames = [
            'Laravel', 'PHP', 'JavaScript', 'TypeScript', 'Vue.js', 'React', 'Node.js', 
            'Python', 'Java', 'C#', 'C++', 'Go', 'UI Design', 'UX Design', 'Figma', 
            'Photoshop', 'Illustrator', 'Excel', 'Power BI', 'Data Analysis', 
            'Public Speaking', 'English', 'Japanese', 'SEO', 'Content Writing', 
            'Photography', 'Video Editing', 'Networking', 'Cyber Security', 'DevOps'
        ];
        
        $skills = [];
        foreach ($skillNames as $name) {
            $slug = \Illuminate\Support\Str::slug($name);
            if ($name === 'C#') $slug = 'c-sharp';
            if ($name === 'C++') $slug = 'c-plus-plus';
            
            $skills[] = \App\Models\Skill::firstOrCreate([
                'name' => $name,
            ], [
                'slug' => $slug,
                'category' => 'Technology',
            ]);
        }
        $skills = collect($skills);

        // 2. Create Users
        $users = \App\Models\User::factory()->count(100)->create();

        // 3. Create User Skills, Portfolios, Certifications
        $levels = ['beginner', 'intermediate', 'advanced'];
        
        foreach ($users as $user) {
            $userSkills = $skills->random(rand(4, 8)); // Total 4-8 skills
            $offeredSkills = $userSkills->splice(0, rand(2, 4));
            $wantedSkills = $userSkills; // Remaining 2-4

            foreach ($offeredSkills as $skill) {
                $createdAt = fake()->dateTimeBetween('-3 months', 'now');
                $user->skills()->attach($skill->id, [
                    'type' => 'offer',
                    'level' => $levels[array_rand($levels)],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            foreach ($wantedSkills as $skill) {
                $createdAt = fake()->dateTimeBetween('-3 months', 'now');
                $user->skills()->attach($skill->id, [
                    'type' => 'want',
                    'level' => $levels[array_rand($levels)],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Portfolios
            $portfolioCount = rand(0, 3);
            for ($i = 0; $i < $portfolioCount; $i++) {
                $user->portfolios()->create([
                    'title' => fake()->sentence(3),
                    'description' => fake()->paragraph(),
                    'category' => 'Web Development',
                    'project_url' => fake()->url(),
                    'views_count' => rand(0, 100),
                    'status' => 'published',
                ]);
            }

            // Certifications
            $certCount = rand(0, 2);
            for ($i = 0; $i < $certCount; $i++) {
                $user->certifications()->create([
                    'name' => fake()->words(3, true),
                    'organization' => fake()->company(),
                    'issue_date' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
                ]);
            }
        }

        // 4. Create Skill Swaps
        // To respect business rules and match probability, we loop through users to create swaps.
        $statuses = [
            'pending' => 24, // 20%
            'accepted' => 36, // 30%
            'completed' => 36, // 30%
            'rejected' => 12, // 10%
            'cancelled' => 12, // 10%
        ];

        $totalSwaps = 120;
        $createdSwaps = 0;
        $activePairs = []; // sender_id-receiver_id to prevent duplicate active

        foreach ($statuses as $status => $count) {
            for ($i = 0; $i < $count; $i++) {
                $sender = $users->random();
                $receiver = $users->except($sender->id)->random();
                
                $pairKey1 = $sender->id . '-' . $receiver->id;
                $pairKey2 = $receiver->id . '-' . $sender->id;

                if (in_array($status, ['pending', 'accepted']) && (in_array($pairKey1, $activePairs) || in_array($pairKey2, $activePairs))) {
                    $i--; // retry
                    continue;
                }

                if (in_array($status, ['pending', 'accepted'])) {
                    $activePairs[] = $pairKey1;
                }

                $swap = \App\Models\SkillSwap::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'status' => $status,
                    'message' => fake()->sentence(),
                    'accepted_at' => in_array($status, ['accepted', 'completed']) ? fake()->dateTimeBetween('-2 months', '-1 months') : null,
                    'completed_at' => $status === 'completed' ? fake()->dateTimeBetween('-1 months', 'now') : null,
                    'created_at' => fake()->dateTimeBetween('-3 months', '-2 months'),
                    'updated_at' => now(),
                ]);

                // 5. Create Messages
                if ($status === 'accepted') {
                    $msgCount = rand(5, 20);
                    $currentSender = $sender;
                    for ($m = 0; $m < $msgCount; $m++) {
                        $swap->messages()->create([
                            'sender_id' => $currentSender->id,
                            'message' => fake()->sentence(),
                            'is_read' => true,
                            'created_at' => fake()->dateTimeBetween($swap->accepted_at, 'now'),
                        ]);
                        $currentSender = $currentSender->id === $sender->id ? $receiver : $sender;
                    }
                }

                // 6. Create Ratings
                if ($status === 'completed' && rand(1, 100) <= 80) { // 80% have ratings
                    // Rater 1
                    \App\Models\Rating::create([
                        'skill_swap_id' => $swap->id,
                        'rater_id' => $sender->id,
                        'rated_user_id' => $receiver->id,
                        'rating' => rand(3, 5),
                        'review' => fake()->sentence(),
                    ]);
                    
                    // Rater 2 (maybe)
                    if (rand(1, 100) <= 80) {
                        \App\Models\Rating::create([
                            'skill_swap_id' => $swap->id,
                            'rater_id' => $receiver->id,
                            'rated_user_id' => $sender->id,
                            'rating' => rand(3, 5),
                            'review' => fake()->sentence(),
                        ]);
                    }
                }
            }
        }
    }
}

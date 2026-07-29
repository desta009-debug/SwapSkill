<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;

class UserSkillSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = [
            // 1. Perfect Match (Frontend <-> UI Designer)
            'frontend-developer@swapskill.test' => [
                'offer' => ['react' => 'advanced', 'html' => 'advanced'],
                'want' => ['ui-design' => 'beginner'],
            ],
            'ui-designer@swapskill.test' => [
                'offer' => ['ui-design' => 'advanced', 'figma' => 'intermediate'],
                'want' => ['react' => 'beginner'],
            ],

            // 2. Partial Match (Backend <-> Full Stack)
            'backend-developer@swapskill.test' => [
                'offer' => ['laravel' => 'advanced', 'php' => 'advanced'],
                'want' => ['vue' => 'intermediate'],
            ],
            'full-stack-developer@swapskill.test' => [
                'offer' => ['vue' => 'advanced', 'react' => 'intermediate'],
                'want' => ['laravel' => 'advanced', 'python' => 'beginner'],
            ],

            // 3. One-way Match (Beginner -> Mentor)
            'beginner-programmer@swapskill.test' => [
                'offer' => ['html' => 'intermediate', 'css' => 'intermediate'],
                'want' => ['laravel' => 'beginner'],
            ],
            'laravel-mentor@swapskill.test' => [
                'offer' => ['laravel' => 'advanced', 'php' => 'advanced'],
                'want' => ['digital-marketing' => 'beginner', 'copywriting' => 'beginner'],
            ],

            // 4. No Match (Graphic Designer <-> Digital Marketing)
            'graphic-designer@swapskill.test' => [
                'offer' => ['photoshop' => 'advanced', 'illustrator' => 'advanced'],
                'want' => ['japanese' => 'beginner'],
            ],
            'digital-marketing-specialist@swapskill.test' => [
                'offer' => ['digital-marketing' => 'advanced', 'copywriting' => 'advanced'],
                'want' => ['python' => 'intermediate'],
            ],

            // 5. Others
            'design-mentor@swapskill.test' => [
                'offer' => ['figma' => 'advanced', 'ui-design' => 'advanced'],
                'want' => ['english-speaking' => 'beginner'],
            ],
            'administrator@swapskill.test' => [
                'offer' => ['public-speaking' => 'advanced'],
                'want' => ['japanese' => 'beginner'],
            ],
        ];

        foreach ($assignments as $email => $data) {
            $user = User::where('email', $email)->first();
            if (!$user) continue;

            foreach (['offer', 'want'] as $type) {
                if (!isset($data[$type])) continue;

                foreach ($data[$type] as $skillSlug => $level) {
                    $skill = Skill::where('slug', $skillSlug)->first();
                    if (!$skill) continue;

                    UserSkill::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'skill_id' => $skill->id,
                            'type' => $type,
                        ],
                        [
                            'level' => $level,
                        ]
                    );
                }
            }
        }
    }
}

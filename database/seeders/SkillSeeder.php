<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'Figma', 'category' => 'Design'],
            ['name' => 'UI Design', 'category' => 'Design'],
            ['name' => 'Canva', 'category' => 'Design'],
            ['name' => 'Excel', 'category' => 'Productivity'],
            ['name' => 'Public Speaking', 'category' => 'Communication'],
            ['name' => 'English Speaking', 'category' => 'Language'],
            ['name' => 'HTML', 'category' => 'Development'],
            ['name' => 'CSS', 'category' => 'Development'],
            ['name' => 'JavaScript', 'category' => 'Development'],
            ['name' => 'Video Editing', 'category' => 'Creative'],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(
                ['name' => $skill['name']],
                [
                    'slug' => Str::slug($skill['name']),
                    'category' => $skill['category'],
                ]
            );
        }
    }
}
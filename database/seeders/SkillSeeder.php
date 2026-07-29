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
            // Programming
            ['name' => 'HTML', 'category' => 'Programming'],
            ['name' => 'CSS', 'category' => 'Programming'],
            ['name' => 'JavaScript', 'category' => 'Programming'],
            ['name' => 'TypeScript', 'category' => 'Programming'],
            ['name' => 'PHP', 'category' => 'Programming'],
            ['name' => 'Laravel', 'category' => 'Programming'],
            ['name' => 'React', 'category' => 'Programming'],
            ['name' => 'Vue', 'category' => 'Programming'],
            ['name' => 'MySQL', 'category' => 'Programming'],
            ['name' => 'Python', 'category' => 'Programming'],
            
            // Design
            ['name' => 'Canva', 'category' => 'Design'],
            ['name' => 'Figma', 'category' => 'Design'],
            ['name' => 'Photoshop', 'category' => 'Design'],
            ['name' => 'Illustrator', 'category' => 'Design'],
            ['name' => 'UI Design', 'category' => 'Design'],
            
            // Language
            ['name' => 'English Speaking', 'category' => 'Language'],
            ['name' => 'Japanese', 'category' => 'Language'],
            ['name' => 'Public Speaking', 'category' => 'Language'],
            
            // Business
            ['name' => 'Digital Marketing', 'category' => 'Business'],
            ['name' => 'Copywriting', 'category' => 'Business'],
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
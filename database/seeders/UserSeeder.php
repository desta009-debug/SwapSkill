<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'Administrator',
            'Frontend Developer',
            'UI Designer',
            'Backend Developer',
            'Full Stack Developer',
            'Graphic Designer',
            'Beginner Programmer',
            'Laravel Mentor',
            'Design Mentor',
            'Digital Marketing Specialist',
        ];

        foreach ($users as $name) {
            $emailPrefix = Str::slug($name);
            User::updateOrCreate(
                ['email' => "{$emailPrefix}@swapskill.test"],
                [
                    'name' => $name,
                    'password' => '12345678',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}

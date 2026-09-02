<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SkillSeeder::class,
            UserSeeder::class,
            UserSkillSeeder::class,
            PortfolioSeeder::class,
            CertificationSeeder::class,
            SkillSwapSeeder::class,
            MessageSeeder::class,
            RatingSeeder::class,
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\User;

class ShowcaseService
{
    /**
     * Get user achievements dynamically.
     */
    public function getAchievements(User $user): array
    {
        $achievements = [];

        $portfoliosCount = $user->portfolios()->count();
        $totalViews = $user->portfolios()->sum('views_count');
        $featuredCount = $user->portfolios()->where('featured', true)->count();

        if ($portfoliosCount >= 1) {
            $achievements[] = [
                'name' => 'First Portfolio',
                'description' => 'Published the first project.',
                'icon' => '🌟',
                'color' => 'bg-amber-100 text-amber-600 border-amber-200'
            ];
        }

        if ($portfoliosCount >= 10) {
            $achievements[] = [
                'name' => 'Portfolio Master',
                'description' => 'Published 10 or more projects.',
                'icon' => '🏆',
                'color' => 'bg-purple-100 text-purple-600 border-purple-200'
            ];
        }

        if ($totalViews >= 100) {
            $achievements[] = [
                'name' => 'Most Viewed Project',
                'description' => 'Projects reached over 100 total views.',
                'icon' => '🔥',
                'color' => 'bg-rose-100 text-rose-600 border-rose-200'
            ];
        }

        if ($featuredCount >= 1) {
            $achievements[] = [
                'name' => 'Top Creator',
                'description' => 'Has at least one featured project.',
                'icon' => '💎',
                'color' => 'bg-emerald-100 text-emerald-600 border-emerald-200'
            ];
        }

        return $achievements;
    }

    /**
     * Generate AI recommendation insight for a portfolio.
     */
    public function generateRecommendation(Portfolio $portfolio, ?User $viewer = null): string
    {
        $techList = collect($portfolio->technologies)->implode(', ');
        $creator = $portfolio->user;

        $base = "This project demonstrates strong {$portfolio->category} skills";
        if ($techList) {
            $base .= " using {$techList}.";
        } else {
            $base .= ".";
        }

        if ($viewer && $viewer->id !== $creator->id) {
            $viewerWanted = $viewer->wantedSkills()->pluck('name')->map(fn($n) => strtolower($n))->toArray();
            $portfolioTech = collect($portfolio->technologies)->map(fn($n) => strtolower($n))->toArray();
            
            $intersect = array_intersect($viewerWanted, $portfolioTech);
            
            if (count($intersect) > 0) {
                $matched = implode(', ', $intersect);
                $base .= " This creator has experience that aligns with your learning goals, specifically in {$matched}.";
            } else {
                $base .= " This portfolio may be valuable if you are interested in exploring {$portfolio->category}.";
            }
        } else {
             $base .= " A valuable addition to the SwapSkill community showcase.";
        }

        return $base;
    }
}

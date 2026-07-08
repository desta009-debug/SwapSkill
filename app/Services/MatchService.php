<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MatchService
{
    public function getMatchesFor(User $currentUser): LengthAwarePaginator
    {
        $myOfferedSkills = $currentUser->offeredSkills->keyBy('id');
        $myWantedSkills = $currentUser->wantedSkills->keyBy('id');

        if ($myOfferedSkills->isEmpty() && $myWantedSkills->isEmpty()) {
            return new LengthAwarePaginator(collect(), 0, 15);
        }

        $users = User::with(['offeredSkills', 'wantedSkills'])
            ->withAvg('receivedRatings', 'rating')
            ->withCount('receivedRatings')
            ->where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($myOfferedSkills, $myWantedSkills) {
                if ($myWantedSkills->isNotEmpty()) {
                    $query->orWhereHas('offeredSkills', function ($q) use ($myWantedSkills) {
                        $q->where(function ($q2) use ($myWantedSkills) {
                            foreach ($myWantedSkills as $skillId => $skill) {
                                $myWantedLevel = $skill->pivot->level ?? 'beginner';
                                $validOfferLevels = $this->getValidLevelsForOffer($myWantedLevel);
                                $q2->orWhere(function ($q3) use ($skillId, $validOfferLevels) {
                                    $q3->where('skill_id', $skillId)
                                       ->whereIn('level', $validOfferLevels);
                                });
                            }
                        });
                    });
                }

                if ($myOfferedSkills->isNotEmpty()) {
                    $query->orWhereHas('wantedSkills', function ($q) use ($myOfferedSkills) {
                        $q->where(function ($q2) use ($myOfferedSkills) {
                            foreach ($myOfferedSkills as $skillId => $skill) {
                                $myOfferedLevel = $skill->pivot->level ?? 'beginner';
                                $validWantedLevels = $this->getValidLevelsForWant($myOfferedLevel);
                                $q2->orWhere(function ($q3) use ($skillId, $validWantedLevels) {
                                    $q3->where('skill_id', $skillId)
                                       ->whereIn('level', $validWantedLevels);
                                });
                            }
                        });
                    });
                }
            })
            ->get();

        $matches = $users->map(function ($user) use ($myOfferedSkills, $myWantedSkills) {
            $theirOfferedSkills = $user->offeredSkills->keyBy('id');
            $theirWantedSkills = $user->wantedSkills->keyBy('id');

            $skillsTheyCanTeachMe = $theirOfferedSkills->filter(function ($theirSkill, $skillId) use ($myWantedSkills) {
                if (!$myWantedSkills->has($skillId)) return false;
                $myWantedLevel = $myWantedSkills[$skillId]->pivot->level ?? null;
                $theirOfferLevel = $theirSkill->pivot->level ?? null;
                return $this->isLevelCompatible($theirOfferLevel, $myWantedLevel);
            })->values();

            $skillsTheyWantFromMe = $theirWantedSkills->filter(function ($theirSkill, $skillId) use ($myOfferedSkills) {
                if (!$myOfferedSkills->has($skillId)) return false;
                $myOfferLevel = $myOfferedSkills[$skillId]->pivot->level ?? null;
                $theirWantedLevel = $theirSkill->pivot->level ?? null;
                return $this->isLevelCompatible($myOfferLevel, $theirWantedLevel);
            })->values();

            $matchType = $skillsTheyCanTeachMe->isNotEmpty() && $skillsTheyWantFromMe->isNotEmpty()
                ? 'Mutual Match'
                : 'Potential Match';

            return [
                'user' => $user,
                'skills_they_can_teach_me' => $skillsTheyCanTeachMe,
                'skills_they_want_from_me' => $skillsTheyWantFromMe,
                'match_type' => $matchType,
                'score' => $this->calculateScore($skillsTheyCanTeachMe, $skillsTheyWantFromMe, $matchType),
                'explanation' => $this->generateExplanation($skillsTheyCanTeachMe, $skillsTheyWantFromMe, $matchType),
            ];
        })
        ->sortByDesc(fn($match) => $match['score'])
        ->values();

        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
        $perPage = 15;
        $itemsForCurrentPage = $matches->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $itemsForCurrentPage,
            $matches->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }

    private function getValidLevelsForOffer(string $wantedLevel): array
    {
        $levels = ['beginner', 'intermediate', 'advanced'];
        $startIndex = array_search($wantedLevel, $levels);
        return array_slice($levels, $startIndex !== false ? $startIndex : 0);
    }

    private function getValidLevelsForWant(string $offerLevel): array
    {
        $levels = ['beginner', 'intermediate', 'advanced'];
        $endIndex = array_search($offerLevel, $levels);
        return array_slice($levels, 0, $endIndex !== false ? $endIndex + 1 : count($levels));
    }

    public function calculateScore(
        Collection $skillsTheyCanTeachMe,
        Collection $skillsTheyWantFromMe,
        string $matchType
    ): int {
        $score = 0;

        $score += $skillsTheyCanTeachMe->count() * 10;
        $score += $skillsTheyWantFromMe->count() * 10;

        if ($matchType === 'Mutual Match') {
            $score += 100;
        }

        return $score;
    }

    public function levelRank(): array
    {
        return [
            'beginner' => 1,
            'intermediate' => 2,
            'advanced' => 3,
        ];
    }

    public function isLevelCompatible(
        ?string $offerLevel,
        ?string $wantedLevel
    ): bool {
        $levelRank = $this->levelRank();

        if (! isset(
            $levelRank[$offerLevel],
            $levelRank[$wantedLevel]
        )) {
            return false;
        }

        return $levelRank[$offerLevel] >= $levelRank[$wantedLevel];
    }

    public function generateExplanation(
        Collection $skillsTheyCanTeachMe,
        Collection $skillsTheyWantFromMe,
        string $matchType
    ): string {
        $offers = $skillsTheyCanTeachMe->isNotEmpty();
        $wants = $skillsTheyWantFromMe->isNotEmpty();

        $teachNames = $skillsTheyCanTeachMe->pluck('name')->implode(', ');
        $wantNames = $skillsTheyWantFromMe->pluck('name')->implode(', ');

        if ($offers && $wants) {
            $explanation = "Kecocokan yang sangat baik karena adanya peluang pertukaran skill. Kamu bisa mengajarkan {$wantNames} sambil belajar {$teachNames}.";
        } elseif ($offers) {
            $explanation = "Kecocokan yang bagus karena partner ini memiliki skill yang kamu cari. Mereka bisa membantumu belajar {$teachNames}.";
        } elseif ($wants) {
            $explanation = "Kecocokan yang potensial. Kamu bisa berkontribusi membantu pengguna ini dengan mengajarkan {$wantNames}, serta membangun koneksi yang berharga.";
        } else {
            return "Belum ada kecocokan skill secara langsung berdasarkan profilmu saat ini. Coba tambahkan lebih banyak skill yang kamu tawarkan atau butuhkan.";
        }

        return $explanation;
    }
}

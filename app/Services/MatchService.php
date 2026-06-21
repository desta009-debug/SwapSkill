<?php

namespace App\Services;

use Illuminate\Support\Collection;

class MatchService
{
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

        return $levelRank[$offerLevel]
            >= $levelRank[$wantedLevel];
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

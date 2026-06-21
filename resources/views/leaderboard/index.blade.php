<x-app-layout>
    <style>
        .leaderboard-page {
            position: relative;
            min-height: calc(100vh - 5rem);
            overflow: hidden;
            background:
                linear-gradient(125deg, rgba(81, 70, 229, 0.16), transparent 34%),
                linear-gradient(305deg, rgba(240, 111, 82, 0.16), transparent 32%),
                linear-gradient(180deg, #edf2f8 0%, #f8fafc 55%, #eef8f4 100%);
            isolation: isolate;
        }

        .leaderboard-page::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(23, 32, 51, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(23, 32, 51, 0.035) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(to bottom, black, transparent 88%);
            pointer-events: none;
        }

        .leaderboard-wrap {
            width: min(100% - 2rem, 1180px);
            margin-inline: auto;
            padding-block: 2rem 4rem;
        }

        .leaderboard-hero {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 2rem;
            align-items: center;
            overflow: hidden;
            margin-bottom: 2rem;
            padding: 2.2rem;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 8px;
            background: linear-gradient(112deg, rgba(22, 29, 67, 0.96), rgba(69, 56, 180, 0.86) 56%, rgba(23, 125, 105, 0.78));
            color: white;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.24), 0 30px 70px -34px rgba(39, 35, 116, 0.75);
        }

        .leaderboard-hero::before {
            content: "";
            position: absolute;
            inset: -80% -30%;
            background: linear-gradient(105deg, transparent 42%, rgba(255, 255, 255, 0.17) 49%, transparent 56%);
            transform: translateX(-36%);
            pointer-events: none;
        }

        .leaderboard-kicker {
            margin: 0;
            color: #ffb49f;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .leaderboard-title {
            max-width: 690px;
            margin: 0.45rem 0 0;
            font-family: 'Fraunces', serif;
            font-size: 3.8rem;
            line-height: 1;
            letter-spacing: 0;
        }

        .leaderboard-copy {
            max-width: 620px;
            margin: 0.9rem 0 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.82rem;
            line-height: 1.7;
        }

        .leaderboard-podium {
            display: flex;
            align-items: center;
            padding-right: 0.5rem;
        }

        .leaderboard-podium-avatar {
            width: 64px;
            height: 64px;
            margin-left: -0.7rem;
            border: 3px solid rgba(255, 255, 255, 0.76);
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 16px 30px -18px rgba(4, 9, 32, 0.9);
        }

        .leaderboard-podium-avatar:first-child {
            margin-left: 0;
        }

        @media (max-width: 760px) {
            .leaderboard-wrap {
                width: min(100% - 1rem, 1180px);
                padding-block: 1rem 2.5rem;
            }

            .leaderboard-hero {
                grid-template-columns: 1fr;
                padding: 1.4rem;
            }

            .leaderboard-title {
                font-size: 2.7rem;
            }
        }

        @media (max-width: 430px) {
            .leaderboard-title {
                font-size: 2.25rem;
            }

            .leaderboard-podium-avatar {
                width: 54px;
                height: 54px;
            }
        }
    </style>

    <div class="leaderboard-page">
        <div class="leaderboard-wrap">
            <header class="leaderboard-hero">
                <div>
                    <p class="leaderboard-kicker">Community leaderboard</p>
                    <h1 class="leaderboard-title">Belajar bersama, bertumbuh bersama.</h1>
                    <p class="leaderboard-copy">Peringkat dihitung dari jumlah swap yang selesai, kemudian rata-rata rating sebagai penentu berikutnya.</p>
                </div>

                @if($topMentors->isNotEmpty())
                    <div class="leaderboard-podium" aria-label="Tiga mentor teratas">
                        @foreach($topMentors->take(3) as $mentor)
                            <img
                                src="{{ $mentor->profile_photo_url }}"
                                alt="Peringkat {{ $mentor->rank }}, {{ $mentor->name }}"
                                class="leaderboard-podium-avatar"
                                title="{{ $mentor->leaderboard_badge }}: {{ $mentor->name }}"
                            >
                        @endforeach
                    </div>
                @endif
            </header>

            <x-community-insights
                :community-statistics="$communityStatistics"
                :top-mentors="$topMentors"
                :top-skills="$topSkills"
                :recent-activities="$recentActivities"
                heading="Leaderboard Komunitas"
                description="Top 10 mentor dan skill berdasarkan aktivitas nyata komunitas SwapSkill."
            />
        </div>
    </div>
</x-app-layout>

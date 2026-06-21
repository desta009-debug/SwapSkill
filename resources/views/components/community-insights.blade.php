@props([
    'communityStatistics',
    'topMentors',
    'topSkills',
    'recentActivities',
    'showAllLink' => false,
    'heading' => 'Community Insights',
    'description' => 'Lihat pertumbuhan komunitas, mentor paling aktif, dan skill yang sedang populer.',
])

@php
    $statistics = [
        ['key' => 'total_users', 'label' => 'Total Users', 'tone' => 'indigo'],
        ['key' => 'total_skills', 'label' => 'Total Skills', 'tone' => 'coral'],
        ['key' => 'completed_swaps', 'label' => 'Completed Swaps', 'tone' => 'mint'],
        ['key' => 'average_rating', 'label' => 'Average Rating', 'tone' => 'amber'],
        ['key' => 'active_mentors', 'label' => 'Active Mentors', 'tone' => 'rose'],
    ];
    $maxSkillUsers = max(1, (int) $topSkills->max('users_count'));
@endphp

@once
    <style>
        .community-insights {
            --ci-ink: #172033;
            --ci-muted: #687386;
            --ci-indigo: #5146e5;
            --ci-coral: #f06f52;
            --ci-mint: #1f9d78;
        }

        .ci-heading-row {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .ci-kicker {
            margin: 0;
            color: var(--ci-indigo);
            font-size: 0.67rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .ci-title {
            margin: 0.3rem 0 0;
            color: var(--ci-ink);
            font-family: 'Fraunces', serif;
            font-size: 2rem;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .ci-description {
            max-width: 650px;
            margin: 0.5rem 0 0;
            color: var(--ci-muted);
            font-size: 0.8rem;
            line-height: 1.65;
        }

        .ci-all-link {
            display: inline-flex;
            min-height: 42px;
            flex: 0 0 auto;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 0.85rem;
            border: 1px solid rgba(81, 70, 229, 0.17);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.58);
            color: var(--ci-indigo);
            font-size: 0.74rem;
            font-weight: 800;
            text-decoration: none;
            -webkit-backdrop-filter: blur(18px);
            backdrop-filter: blur(18px);
            transition: background 180ms ease, transform 180ms ease;
        }

        .ci-all-link:hover {
            background: white;
            transform: translateY(-2px);
        }

        .ci-stat-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .ci-stat-card,
        .ci-panel {
            border: 1px solid rgba(255, 255, 255, 0.82);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.58);
            -webkit-backdrop-filter: blur(24px) saturate(145%);
            backdrop-filter: blur(24px) saturate(145%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.94), 0 20px 50px -36px rgba(37, 44, 85, 0.58);
        }

        .ci-stat-card {
            position: relative;
            min-height: 126px;
            overflow: hidden;
            padding: 1rem;
        }

        .ci-stat-card::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 3px;
            background: var(--stat-color);
        }

        .ci-stat-card--indigo { --stat-color: #5146e5; --stat-soft: rgba(81, 70, 229, 0.1); }
        .ci-stat-card--coral { --stat-color: #f06f52; --stat-soft: rgba(240, 111, 82, 0.1); }
        .ci-stat-card--mint { --stat-color: #1f9d78; --stat-soft: rgba(31, 157, 120, 0.1); }
        .ci-stat-card--amber { --stat-color: #d39121; --stat-soft: rgba(211, 145, 33, 0.1); }
        .ci-stat-card--rose { --stat-color: #d94d6a; --stat-soft: rgba(217, 77, 106, 0.1); }

        .ci-stat-icon {
            display: grid;
            width: 34px;
            height: 34px;
            place-items: center;
            border-radius: 8px;
            background: var(--stat-soft);
            color: var(--stat-color);
        }

        .ci-stat-icon svg {
            width: 17px;
            height: 17px;
        }

        .ci-stat-value {
            margin: 0.8rem 0 0;
            color: var(--ci-ink);
            font-family: 'Fraunces', serif;
            font-size: 1.8rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: 0;
        }

        .ci-stat-label {
            margin: 0.35rem 0 0;
            color: var(--ci-muted);
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .ci-main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
            gap: 1rem;
            margin-top: 1rem;
            align-items: start;
        }

        .ci-side-stack {
            display: grid;
            gap: 1rem;
        }

        .ci-panel {
            overflow: hidden;
        }

        .ci-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 1rem 1.1rem;
            border-bottom: 1px solid rgba(99, 109, 133, 0.13);
            background: rgba(255, 255, 255, 0.25);
        }

        .ci-panel-kicker {
            margin: 0;
            color: var(--ci-indigo);
            font-size: 0.62rem;
            font-weight: 800;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        .ci-panel-title {
            margin: 0.22rem 0 0;
            color: var(--ci-ink);
            font-size: 0.95rem;
            font-weight: 800;
        }

        .ci-panel-icon {
            display: grid;
            width: 36px;
            height: 36px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(81, 70, 229, 0.15);
            border-radius: 8px;
            background: rgba(81, 70, 229, 0.08);
            color: var(--ci-indigo);
        }

        .ci-panel-icon svg {
            width: 18px;
            height: 18px;
        }

        .ci-mentor-list,
        .ci-skill-list,
        .ci-activity-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .ci-mentor-row {
            display: grid;
            grid-template-columns: 36px 46px minmax(0, 1fr) auto;
            gap: 0.7rem;
            align-items: center;
            min-height: 74px;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(99, 109, 133, 0.09);
            color: inherit;
            text-decoration: none;
            transition: background 180ms ease;
        }

        .ci-mentor-row:hover {
            background: rgba(255, 255, 255, 0.48);
        }

        .ci-mentor-list li:last-child .ci-mentor-row {
            border-bottom: 0;
        }

        .ci-rank {
            display: grid;
            width: 32px;
            height: 32px;
            place-items: center;
            border: 1px solid rgba(99, 109, 133, 0.14);
            border-radius: 8px;
            background: rgba(248, 250, 252, 0.74);
            color: #596377;
            font-size: 0.7rem;
            font-weight: 900;
        }

        .ci-rank--1 { border-color: rgba(211, 145, 33, 0.35); background: rgba(255, 238, 191, 0.74); color: #9a6811; }
        .ci-rank--2 { border-color: rgba(115, 128, 148, 0.28); background: rgba(231, 235, 241, 0.78); color: #5b6575; }
        .ci-rank--3 { border-color: rgba(179, 102, 61, 0.3); background: rgba(247, 220, 202, 0.74); color: #9a5432; }

        .ci-mentor-avatar,
        .ci-activity-avatar {
            border: 1px solid rgba(255, 255, 255, 0.88);
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 8px 18px -12px rgba(24, 31, 61, 0.72);
        }

        .ci-mentor-avatar {
            width: 44px;
            height: 44px;
        }

        .ci-mentor-copy {
            min-width: 0;
        }

        .ci-mentor-name {
            overflow: hidden;
            margin: 0;
            color: var(--ci-ink);
            font-size: 0.78rem;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .ci-mentor-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem 0.75rem;
            margin-top: 0.25rem;
            color: var(--ci-muted);
            font-size: 0.65rem;
            font-weight: 700;
        }

        .ci-rating {
            display: inline-flex;
            align-items: center;
            gap: 0.22rem;
            color: #b17613;
        }

        .ci-rating svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
        }

        .ci-mentor-badge {
            display: inline-flex;
            max-width: 100px;
            align-items: center;
            justify-content: center;
            padding: 0.38rem 0.55rem;
            border: 1px solid rgba(81, 70, 229, 0.14);
            border-radius: 999px;
            background: rgba(81, 70, 229, 0.08);
            color: var(--ci-indigo);
            font-size: 0.58rem;
            font-weight: 900;
            text-align: center;
            white-space: nowrap;
        }

        .ci-mentor-badge--1 { border-color: rgba(211, 145, 33, 0.3); background: rgba(255, 237, 183, 0.72); color: #93620e; }
        .ci-mentor-badge--2 { border-color: rgba(115, 128, 148, 0.25); background: rgba(229, 234, 240, 0.75); color: #586274; }
        .ci-mentor-badge--3 { border-color: rgba(179, 102, 61, 0.28); background: rgba(247, 218, 198, 0.72); color: #96502f; }

        .ci-skill-row {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid rgba(99, 109, 133, 0.09);
        }

        .ci-skill-list li:last-child .ci-skill-row {
            border-bottom: 0;
        }

        .ci-skill-line {
            display: grid;
            grid-template-columns: 28px minmax(0, 1fr) auto;
            gap: 0.55rem;
            align-items: center;
        }

        .ci-skill-rank {
            color: var(--ci-indigo);
            font-family: 'Fraunces', serif;
            font-size: 0.9rem;
            font-weight: 900;
        }

        .ci-skill-name {
            overflow: hidden;
            color: var(--ci-ink);
            font-size: 0.74rem;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .ci-skill-users {
            color: var(--ci-muted);
            font-size: 0.63rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .ci-skill-track {
            height: 4px;
            margin: 0.55rem 0 0 2.1rem;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(81, 70, 229, 0.08);
        }

        .ci-skill-progress {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--ci-indigo), var(--ci-coral));
        }

        .ci-activity-row {
            display: grid;
            grid-template-columns: 38px minmax(0, 1fr) auto;
            gap: 0.65rem;
            align-items: center;
            min-height: 64px;
            padding: 0.7rem 1rem;
            border-bottom: 1px solid rgba(99, 109, 133, 0.09);
        }

        .ci-activity-list li:last-child .ci-activity-row {
            border-bottom: 0;
        }

        .ci-activity-avatar {
            width: 36px;
            height: 36px;
        }

        .ci-activity-message {
            margin: 0;
            color: #414b5e;
            font-size: 0.69rem;
            font-weight: 700;
            line-height: 1.5;
        }

        .ci-activity-time {
            color: #929aaa;
            font-size: 0.58rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .ci-empty {
            padding: 2rem 1rem;
            color: var(--ci-muted);
            font-size: 0.74rem;
            text-align: center;
        }

        @media (max-width: 1000px) {
            .ci-stat-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .ci-main-grid {
                grid-template-columns: 1fr;
            }

            .ci-side-stack {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 700px) {
            .ci-heading-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .ci-stat-grid,
            .ci-side-stack {
                grid-template-columns: 1fr;
            }

            .ci-stat-card {
                min-height: 104px;
            }

            .ci-mentor-row {
                grid-template-columns: 32px 42px minmax(0, 1fr);
            }

            .ci-mentor-badge {
                grid-column: 3;
                justify-self: start;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .ci-all-link,
            .ci-mentor-row {
                transition: none !important;
            }
        }
    </style>
@endonce

<section class="community-insights" aria-labelledby="community-insights-heading">
    <div class="ci-heading-row">
        <div>
            <p class="ci-kicker">Komunitas SwapSkill</p>
            <h2 id="community-insights-heading" class="ci-title">{{ $heading }}</h2>
            <p class="ci-description">{{ $description }}</p>
        </div>

        @if($showAllLink)
            <a href="{{ route('leaderboard.index') }}" class="ci-all-link">
                Lihat leaderboard
                <svg aria-hidden="true" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>
        @endif
    </div>

    <div class="ci-stat-grid">
        @foreach($statistics as $statistic)
            <article class="ci-stat-card ci-stat-card--{{ $statistic['tone'] }}">
                <span class="ci-stat-icon" aria-hidden="true">
                    @switch($statistic['key'])
                        @case('total_users')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.1 9.1 0 0 0 3.74-.48 3 3 0 0 0-4.68-2.72m.94 3.2v-.01c0-1.16-.3-2.25-.82-3.2m.82 3.21v.13A12.3 12.3 0 0 1 12 20.25c-2.17 0-4.2-.56-5.96-1.54v-.13a6 6 0 0 1 11.14-3.07M15 7.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                            @break
                        @case('total_skills')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.57 3.75H6.75A2.25 2.25 0 0 0 4.5 6v13.5h15V6a2.25 2.25 0 0 0-2.25-2.25h-2.82M9.57 3.75a2.25 2.25 0 0 1 4.86 0M9.57 3.75A2.25 2.25 0 0 0 12 6a2.25 2.25 0 0 0 2.43-2.25M9 12.75l2.25 2.25L15 9.75" /></svg>
                            @break
                        @case('completed_swaps')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            @break
                        @case('average_rating')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m11.48 3.5-2.2 4.45-4.91.71 3.55 3.46-.84 4.89 4.4-2.31 4.39 2.31-.84-4.89 3.55-3.46-4.9-.71-2.2-4.45Z" /></svg>
                            @break
                        @default
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.38c0-.62-.25-1.22-.7-1.66l-.28-.29a7.5 7.5 0 1 0-7.04 0l-.29.29c-.44.44-.69 1.04-.69 1.66v3.38" /></svg>
                    @endswitch
                </span>
                <p class="ci-stat-value">
                    {{ $statistic['key'] === 'average_rating'
                        ? number_format($communityStatistics[$statistic['key']], 1)
                        : number_format($communityStatistics[$statistic['key']]) }}
                </p>
                <p class="ci-stat-label">{{ $statistic['label'] }}</p>
            </article>
        @endforeach
    </div>

    <div class="ci-main-grid">
        <article class="ci-panel">
            <header class="ci-panel-header">
                <div>
                    <p class="ci-panel-kicker">Peringkat komunitas</p>
                    <h3 class="ci-panel-title">Top Mentors</h3>
                </div>
                <span class="ci-panel-icon" aria-hidden="true">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.38c0-.62-.25-1.22-.7-1.66l-.28-.29a7.5 7.5 0 1 0-7.04 0l-.29.29c-.44.44-.69 1.04-.69 1.66v3.38" /></svg>
                </span>
            </header>

            @if($topMentors->isNotEmpty())
                <ol class="ci-mentor-list">
                    @foreach($topMentors as $mentor)
                        <li>
                            <a href="{{ route('user.show', $mentor) }}" class="ci-mentor-row">
                                <span class="ci-rank ci-rank--{{ min($mentor->rank, 3) }}">#{{ $mentor->rank }}</span>
                                <img src="{{ $mentor->profile_photo_url }}" alt="Foto profil {{ $mentor->name }}" class="ci-mentor-avatar">
                                <div class="ci-mentor-copy">
                                    <p class="ci-mentor-name">{{ $mentor->name }}</p>
                                    <div class="ci-mentor-meta">
                                        <span>{{ number_format($mentor->completed_swaps_count) }} swaps</span>
                                        <span class="ci-rating">
                                            <svg aria-hidden="true" viewBox="0 0 24 24"><path d="m12 2.5 2.94 5.96 6.58.96-4.76 4.64 1.12 6.55L12 17.52l-5.88 3.09 1.12-6.55-4.76-4.64 6.58-.96L12 2.5Z" /></svg>
                                            {{ number_format($mentor->average_rating, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <span class="ci-mentor-badge ci-mentor-badge--{{ min($mentor->rank, 3) }}">{{ $mentor->leaderboard_badge }}</span>
                            </a>
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="ci-empty">Belum ada mentor dengan swap yang selesai.</p>
            @endif
        </article>

        <div class="ci-side-stack">
            <article class="ci-panel">
                <header class="ci-panel-header">
                    <div>
                        <p class="ci-panel-kicker">Paling diminati</p>
                        <h3 class="ci-panel-title">Top Skills</h3>
                    </div>
                    <span class="ci-panel-icon" aria-hidden="true">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0L6 21m9.75-4.5L18 21M8.25 12l2.25-2.25 1.5 1.5L15.75 7.5" /></svg>
                    </span>
                </header>

                @if($topSkills->isNotEmpty())
                    <ol class="ci-skill-list">
                        @foreach($topSkills as $skill)
                            <li class="ci-skill-row">
                                <div class="ci-skill-line">
                                    <span class="ci-skill-rank">{{ $skill->rank }}.</span>
                                    <span class="ci-skill-name">{{ $skill->name }}</span>
                                    <span class="ci-skill-users">{{ number_format($skill->users_count) }} users</span>
                                </div>
                                <div class="ci-skill-track" aria-hidden="true">
                                    <div class="ci-skill-progress" style="width: {{ max(6, ($skill->users_count / $maxSkillUsers) * 100) }}%"></div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="ci-empty">Belum ada data skill komunitas.</p>
                @endif
            </article>

            <article class="ci-panel">
                <header class="ci-panel-header">
                    <div>
                        <p class="ci-panel-kicker">Terbaru</p>
                        <h3 class="ci-panel-title">Community Activity</h3>
                    </div>
                    <span class="ci-panel-icon" aria-hidden="true">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.13A9 9 0 1 0 5.64 6.7L3 9.34m0-6v6h6M12 7.5V12l3 1.5" /></svg>
                    </span>
                </header>

                @if($recentActivities->isNotEmpty())
                    <ol class="ci-activity-list">
                        @foreach($recentActivities as $activity)
                            <li class="ci-activity-row">
                                <img src="{{ $activity['user']->profile_photo_url }}" alt="" class="ci-activity-avatar">
                                <p class="ci-activity-message">{{ $activity['message'] }}</p>
                                <time class="ci-activity-time" datetime="{{ $activity['occurred_at']->toIso8601String() }}">
                                    {{ $activity['occurred_at']->format('d M, H:i') }}
                                </time>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="ci-empty">Aktivitas komunitas akan tampil di sini.</p>
                @endif
            </article>
        </div>
    </div>
</section>

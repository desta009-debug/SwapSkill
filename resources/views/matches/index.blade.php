<x-app-layout>
    <x-slot name="header">
        <div class="py-2">
            <p class="text-xs font-bold uppercase tracking-[0.3em]" style="color:#F68048;">SwapSkill</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900" style="font-family:'Syne',sans-serif;">Kecocokan Skill</h2>
            <p class="mt-1 text-sm text-slate-400">Temukan orang yang cocok dengan tujuan belajarmu.</p>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --tu-navy:       #0D1A63;
            --tu-mid:        #1A2CA3;
            --tu-blue:       #2845D6;
            --tu-orange:     #F68048;
            --tu-orange-dim: rgba(246,128,72,0.10);
            --tu-blue-dim:   rgba(40,69,214,0.08);
        }

       .tu-page { font-family: 'Poppins', sans-serif;
            background: var(--tu-navy);
            color: #0F172A;
        }
        .tu-syne { font-family: 'Syne', sans-serif;
    
            color: #f7f8f9;
        
        }

        /* ── GRID BG ── */
        .tu-grid-bg {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        /* ── HERO ── */
        .tu-hero {
            background: var(--tu-navy);
            position: relative; overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(13,26,99,0.25);
        }
        .tu-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 55% 55% at 85% -5%, rgba(40,69,214,0.38) 0%, transparent 60%),
                radial-gradient(ellipse 35% 40% at -5% 105%, rgba(246,128,72,0.20) 0%, transparent 55%);
            pointer-events: none;
        }

        .tu-hero-stat {
            border-left: 3px solid var(--tu-orange);
            padding-left: 1rem;
        }
        .tu-hero-stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 2.25rem; font-weight: 800;
            color: #fff; line-height: 1;
        }
        .tu-hero-stat-label { font-size: 0.72rem; color: rgba(255,255,255,0.45); margin-top: 6px; line-height: 1.4; }

        .tu-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(40,69,214,0.2), transparent);
        }

        /* ── TOAST ── */
        .tu-toast {
            border-radius: 12px;
            border: 1.5px solid rgba(40,69,214,0.2);
            background: rgba(40,69,214,0.06);
            color: var(--tu-mid);
            padding: 12px 18px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* ── MATCH CARD ── */
        .tu-match-card {
            background: #fff;
            border: 1.5px solid #E4E7F5;
            border-radius: 22px;
            overflow: hidden;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
            position: relative;
        }
        .tu-match-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(13,26,99,0.10);
            border-color: rgba(40,69,214,0.25);
        }

        /* ── CARD HEADER ── */
        .tu-card-header {
            background: var(--tu-navy);
            padding: 20px 22px;
            position: relative; overflow: hidden;
        }
        .tu-card-header::after {
            content: '';
            position: absolute; right: -24px; top: -24px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(246,128,72,0.10);
            pointer-events: none;
        }
        .tu-avatar {
            width: 52px; height: 52px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.15);
            flex-shrink: 0;
        }
        .tu-badge-mutual {
            background: rgba(246,128,72,0.15);
            border: 1px solid rgba(246,128,72,0.3);
            color: var(--tu-orange);
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
        }
        .tu-badge-potential {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.65);
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* ── CARD BODY ── */
        .tu-card-body { padding: 22px; }

        .tu-skill-block {
            border-radius: 14px;
            border: 1.5px solid;
            padding: 16px;
        }
        .tu-skill-block-teach {
            background: rgba(40,69,214,0.04);
            border-color: rgba(40,69,214,0.14);
        }
        .tu-skill-block-want {
            background: rgba(246,128,72,0.04);
            border-color: rgba(246,128,72,0.16);
        }
        .tu-skill-block-reason {
            background: #FAFBFF;
            border-color: #E4E7F5;
        }

        .tu-block-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            display: flex; align-items: center; gap: 7px;
            margin-bottom: 12px;
        }
        .tu-block-dot {
            width: 7px; height: 7px;
            border-radius: 2px;
            flex-shrink: 0;
        }

        .tu-skill-chip {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 11px;
            border-radius: 7px;
            font-size: 0.78rem; font-weight: 600;
            transition: transform 0.12s;
        }
        .tu-skill-chip:hover { transform: translateY(-1px); }
        .tu-skill-chip-teach {
            background: rgba(40,69,214,0.07);
            border: 1.5px solid rgba(40,69,214,0.18);
            color: var(--tu-mid);
        }
        .tu-skill-chip-want {
            background: rgba(246,128,72,0.07);
            border: 1.5px solid rgba(246,128,72,0.22);
            color: #BF511A;
        }
        .tu-chip-level {
            font-size: 0.6rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            padding: 2px 5px; border-radius: 4px;
            background: rgba(255,255,255,0.7);
        }
        .tu-chip-level-teach { color: var(--tu-blue); }
        .tu-chip-level-want  { color: var(--tu-orange); }

        .tu-empty-chip {
            font-size: 0.8rem; color: #94A3B8;
            border: 1.5px dashed #D5D9EF;
            border-radius: 10px;
            padding: 10px 14px;
        }

        /* ── REASON BOX ── */
        .tu-reason-item {
            display: flex; gap: 10px; align-items: flex-start;
        }
        .tu-reason-icon {
            width: 22px; height: 22px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 1px;
        }
        .tu-reason-icon svg { width: 12px; height: 12px; }

        /* ── WA BUTTON ── */
        .tu-btn-wa {
            display: inline-flex; align-items: center; gap: 8px;
            background: #16A34A;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.82rem;
            padding: 10px 18px; border-radius: 10px;
            transition: background 0.2s, transform 0.15s;
        }
        .tu-btn-wa:hover { background: #15803D; transform: translateY(-1px); }
        .tu-btn-wa svg { width: 16px; height: 16px; }

        .tu-btn-wa-disabled {
            display: inline-flex; align-items: center; gap: 8px;
            background: #F1F5F9;
            color: #94A3B8;
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.82rem;
            padding: 10px 18px; border-radius: 10px;
            cursor: not-allowed;
        }

        .tu-btn-outline {
            display: inline-flex; align-items: center;
            color: var(--tu-blue);
            border: 1.5px solid rgba(40,69,214,0.25);
            background: transparent;
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.82rem;
            padding: 10px 18px; border-radius: 10px;
            transition: background 0.2s, border-color 0.2s;
        }
        .tu-btn-outline:hover { background: rgba(40,69,214,0.05); border-color: var(--tu-blue); }

        .tu-btn-primary {
            display: inline-flex; align-items: center;
            background: var(--tu-orange); color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.82rem;
            padding: 10px 18px; border-radius: 10px;
            transition: background 0.2s;
        }
        .tu-btn-primary:hover { background: #e36930; }

        /* ── EMPTY STATE ── */
        .tu-empty-state {
            background: var(--tu-navy);
            border-radius: 22px;
            padding: 60px 40px;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .tu-empty-state::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 60% at 50% 0%, rgba(40,69,214,0.4) 0%, transparent 70%);
            pointer-events: none;
        }
        .tu-count-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(246,128,72,0.12);
            border: 1px solid rgba(246,128,72,0.25);
            color: var(--tu-orange);
            font-family: 'Syne', sans-serif;
            font-weight: 700; font-size: 0.7rem;
            text-transform: uppercase; letter-spacing: 0.12em;
            padding: 4px 10px; border-radius: 6px;
        }
    </style>

    <div class="tu-page py-8">
        <div class="mx-auto max-w-7xl space-y-7 px-4 sm:px-6 lg:px-8">

            {{-- ── TOAST ── --}}
            @if (session('success'))
                <div class="tu-toast">{{ session('success') }}</div>
            @endif

            {{-- ════════════ HERO ════════════ --}}
            <section class="tu-hero">
                <div class="tu-grid-bg"></div>

                <div class="relative grid gap-0 lg:grid-cols-[1.25fr_0.85fr] lg:items-stretch">

                    {{-- LEFT --}}
                    <div class="p-8 lg:p-10">
                        <span class="tu-count-pill">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                            Smart Matching
                        </span>

                        <h1 class="tu-syne mt-5 text-4xl font-extrabold tracking-tight text-white leading-tight sm:text-5xl">
                            Temukan partner<br>yang melengkapi<br>skill kamu<span style="color:var(--tu-orange);">.</span>
                        </h1>

                        <p class="mt-4 max-w-lg text-sm leading-7" style="color:rgba(255,255,255,0.55);">
                            SwapSkill membandingkan skill dan level kemampuan secara dua arah —
                            bukan cuma relevan secara topik, tapi masuk akal secara kemampuan.
                        </p>

                        <div class="mt-7 flex flex-wrap gap-3">
                            <a href="{{ route('skills.edit') }}" class="tu-btn-primary">Perbarui Skill</a>
                            <a href="{{ route('dashboard') }}" style="display:inline-flex;align-items:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.75);border:1.5px solid rgba(255,255,255,0.1);font-family:'Syne',sans-serif;font-weight:700;font-size:0.82rem;padding:10px 18px;border-radius:10px;transition:background 0.2s;">
                                Lihat Dashboard
                            </a>
                        </div>
                    </div>

                    {{-- RIGHT — STATS --}}
                    <div class="flex flex-col justify-center gap-5 border-l border-white/8 p-8 lg:p-10">
                        <div class="tu-hero-stat">
                            <div class="tu-hero-stat-num">{{ $matches->count() }}</div>
                            <p class="tu-hero-stat-label">Total match<br>ditemukan</p>
                        </div>
                        <div class="tu-hero-stat">
                            <div class="tu-hero-stat-num">{{ $matches->where('match_type','Mutual Match')->count() }}</div>
                            <p class="tu-hero-stat-label">Match mutual<br>(2 arah)</p>
                        </div>
                        <div class="tu-hero-stat">
                            <div class="tu-hero-stat-num">{{ $matches->where('match_type','Potential Match')->count() }}</div>
                            <p class="tu-hero-stat-label">Match potensial<br>(1 arah)</p>
                        </div>

                        <div class="tu-divider my-1"></div>

                        <div class="rounded-[12px] border border-white/8 bg-white/5 px-4 py-3">
                            <p class="tu-syne text-xs font-bold uppercase tracking-[0.15em]" style="color:var(--tu-orange);">Logika Match</p>
                            <p class="mt-1.5 text-sm font-semibold text-white">Skill + Level</p>
                            <p class="mt-1 text-xs leading-5" style="color:rgba(255,255,255,0.4);">Level offer harus memenuhi atau melebihi level yang dibutuhkan.</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ════════════ MATCH CARDS ════════════ --}}
            @if ($matches->count())
                <section class="grid gap-6 xl:grid-cols-2">
                    @foreach ($matches as $match)
                        <article class="tu-match-card">

                            {{-- CARD HEADER --}}
                            <div class="tu-card-header">
                                <div class="relative flex items-start justify-between gap-4">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <img
                                            src="{{ $match['user']->profile_photo_url }}"
                                            alt="{{ $match['user']->name }}"
                                            class="tu-avatar"
                                        >
                                        <div class="min-w-0">
                                            <p class="text-[10px] font-semibold uppercase tracking-[0.2em]" style="color:rgba(255,255,255,0.4);">Yang Cocok Sama Kamu</p>
                                            <h3 class="tu-syne mt-1 text-xl font-extrabold text-white truncate leading-tight">
                                                {{ $match['user']->name }}
                                            </h3>
                                            <p class="mt-0.5 text-xs truncate" style="color:rgba(255,255,255,0.45);">
                                                {{ $match['user']->email }}
                                            </p>
                                            @if (!empty($match['user']->phone))
                                                <p class="mt-0.5 text-xs" style="color:rgba(255,255,255,0.35);">
                                                    WA: {{ $match['user']->phone }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="shrink-0 mt-1">
                                        @if ($match['match_type'] === 'Mutual Match')
                                            <span class="tu-badge-mutual">Mutual</span>
                                        @else
                                            <span class="tu-badge-potential">Potensial</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- CARD BODY --}}
                            <div class="tu-card-body space-y-4">

                                {{-- SKILL YANG DIA BISA AJARKAN --}}
                                <div class="tu-skill-block tu-skill-block-teach">
                                    <div class="tu-block-label" style="color:var(--tu-mid);">
                                        <span class="tu-block-dot" style="background:var(--tu-blue);"></span>
                                        Bisa dia ajarkan ke kamu
                                        <span class="ml-auto text-[10px] font-bold" style="color:var(--tu-blue);background:rgba(40,69,214,0.08);border:1px solid rgba(40,69,214,0.15);padding:2px 8px;border-radius:5px;">
                                            {{ $match['skills_they_can_teach_me']->count() }}
                                        </span>
                                    </div>

                                    @if ($match['skills_they_can_teach_me']->count())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($match['skills_they_can_teach_me'] as $skill)
                                                <span class="tu-skill-chip tu-skill-chip-teach">
                                                    {{ $skill->name }}
                                                    <span class="tu-chip-level tu-chip-level-teach">{{ $skill->pivot->level }}</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="tu-empty-chip">Belum ada kecocokan langsung untuk diajarkan ke kamu.</p>
                                    @endif
                                </div>

                                {{-- SKILL YANG DIA CARI DARI KAMU --}}
                                <div class="tu-skill-block tu-skill-block-want">
                                    <div class="tu-block-label" style="color:#BF511A;">
                                        <span class="tu-block-dot" style="background:var(--tu-orange);"></span>
                                        Dia cari dari kamu
                                        <span class="ml-auto text-[10px] font-bold" style="color:var(--tu-orange);background:rgba(246,128,72,0.08);border:1px solid rgba(246,128,72,0.2);padding:2px 8px;border-radius:5px;">
                                            {{ $match['skills_they_want_from_me']->count() }}
                                        </span>
                                    </div>

                                    @if ($match['skills_they_want_from_me']->count())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($match['skills_they_want_from_me'] as $skill)
                                                <span class="tu-skill-chip tu-skill-chip-want">
                                                    {{ $skill->name }}
                                                    <span class="tu-chip-level tu-chip-level-want">{{ $skill->pivot->level }}</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="tu-empty-chip">Dia belum membutuhkan skill yang kamu tawarkan.</p>
                                    @endif
                                </div>

                                {{-- KENAPA MATCH INI COCOK --}}
                                <div class="tu-skill-block tu-skill-block-reason">
                                    <div class="mb-3 flex items-center justify-between gap-3">
                                        <p class="tu-syne text-xs font-bold text-slate-700 uppercase tracking-[0.15em]">Kenapa ini cocok</p>
                                        @if ($match['match_type'] === 'Mutual Match')
                                            <span style="background:rgba(246,128,72,0.1);border:1px solid rgba(246,128,72,0.22);color:var(--tu-orange);font-family:'Syne',sans-serif;font-weight:700;font-size:0.65rem;padding:3px 9px;border-radius:5px;text-transform:uppercase;letter-spacing:0.1em;">
                                                2 Arah
                                            </span>
                                        @else
                                            <span style="background:rgba(40,69,214,0.06);border:1px solid rgba(40,69,214,0.15);color:var(--tu-mid);font-family:'Syne',sans-serif;font-weight:700;font-size:0.65rem;padding:3px 9px;border-radius:5px;text-transform:uppercase;letter-spacing:0.1em;">
                                                1 Arah
                                            </span>
                                        @endif
                                    </div>

                                    <div class="space-y-3">
                                        @if ($match['skills_they_can_teach_me']->count())
                                            <div class="space-y-2">
                                                @foreach ($match['skills_they_can_teach_me'] as $skill)
                                                    <div class="tu-reason-item">
                                                        <div class="tu-reason-icon" style="background:rgba(40,69,214,0.08);">
                                                            <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M2 6h8M6 2l4 4-4 4" stroke="#2845D6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <p class="text-xs leading-5 text-slate-600">
                                                            <span class="font-bold text-slate-900">{{ $skill->name }}</span>
                                                            level <span class="font-bold text-slate-900">{{ ucfirst($skill->pivot->level) }}</span>
                                                            — cocok dengan target belajarmu.
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        @if ($match['skills_they_can_teach_me']->count() && $match['skills_they_want_from_me']->count())
                                            <div style="height:1px;background:linear-gradient(90deg,transparent,#E4E7F5,transparent);"></div>
                                        @endif

                                        @if ($match['skills_they_want_from_me']->count())
                                            <div class="space-y-2">
                                                @foreach ($match['skills_they_want_from_me'] as $skill)
                                                    <div class="tu-reason-item">
                                                        <div class="tu-reason-icon" style="background:rgba(246,128,72,0.08);">
                                                            <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10 6H2M6 10 2 6l4-4" stroke="#F68048" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <p class="text-xs leading-5 text-slate-600">
                                                            Dia butuh <span class="font-bold text-slate-900">{{ $skill->name }}</span>
                                                            level <span class="font-bold text-slate-900">{{ ucfirst($skill->pivot->level) }}</span>
                                                            — dan profilmu cocok untuk itu.
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- CTA --}}
                                <div class="pt-1">
                                    @if ($match['user']->whatsapp_link)
                                        <a href="{{ $match['user']->whatsapp_link }}" target="_blank" class="tu-btn-wa">
                                            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            Chat via WhatsApp
                                        </a>
                                    @else
                                        <span class="tu-btn-wa-disabled">
                                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            WhatsApp tidak tersedia
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </article>
                    @endforeach
                </section>

            @else
                {{-- ════ EMPTY STATE ════ --}}
                <section class="tu-empty-state">
                    <div class="tu-grid-bg"></div>
                    <div class="relative">
                        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-[18px]" style="background:rgba(246,128,72,0.12);border:1.5px solid rgba(246,128,72,0.2);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="#F68048" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                            </svg>
                        </div>

                        <h3 class="tu-syne text-2xl font-extrabold text-white">Belum ada match ditemukan</h3>

                        <p class="mx-auto mt-3 max-w-md text-sm leading-7" style="color:rgba(255,255,255,0.45);">
                            Lengkapi profil skill kamu dengan jenis skill dan levelnya — sistem butuh data itu untuk menemukan kecocokan yang akurat.
                        </p>

                        <div class="mt-7 flex flex-wrap justify-center gap-3">
                            <a href="{{ route('skills.edit') }}" class="tu-btn-primary">Perbarui Skill Saya</a>
                            <a href="{{ route('dashboard') }}" class="tu-btn-outline" style="color:rgba(255,255,255,0.7);border-color:rgba(255,255,255,0.15);background:rgba(255,255,255,0.05);">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
</x-app-layout>
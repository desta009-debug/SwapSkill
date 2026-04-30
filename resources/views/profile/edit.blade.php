<x-app-layout>
    <x-slot name="header">
        <div class="py-2">
            <p class="text-xs font-bold uppercase tracking-[0.3em]" style="color:#F68048;font-family:'Syne',sans-serif;">SwapSkill</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900" style="font-family:'Syne',sans-serif;">Profil Saya</h2>
            <p class="mt-1 text-sm text-slate-400">Kelola informasi akun, keamanan, dan foto profil kamu.</p>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --tu-navy:   #0D1A63;
            --tu-mid:    #1A2CA3;
            --tu-blue:   #2845D6;
            --tu-orange: #F68048;
        }

        .tu-page { font-family: 'Instrument Sans', sans-serif; background: #F4F5FA; min-height: 100vh; }
        .tu-syne { font-family: 'Syne', sans-serif; }

        .tu-grid-bg {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        .tu-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(40,69,214,0.15), transparent);
        }

        /* ══════════════════════════════
           HERO BANNER
        ══════════════════════════════ */
        .tu-profile-hero {
            background: var(--tu-navy);
            border-radius: 24px;
            position: relative; overflow: hidden;
            box-shadow: 0 24px 80px rgba(13,26,99,0.25);
        }
        .tu-profile-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 55% 70% at 90% -10%, rgba(40,69,214,0.4) 0%, transparent 60%),
                radial-gradient(ellipse 40% 45% at -5% 110%, rgba(246,128,72,0.18) 0%, transparent 55%);
            pointer-events: none;
        }
        .tu-avatar-ring {
            width: 80px; height: 80px;
            border-radius: 18px;
            border: 2px solid rgba(255,255,255,0.2);
            object-fit: cover;
            flex-shrink: 0;
        }
        .tu-hero-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(246,128,72,0.12);
            border: 1px solid rgba(246,128,72,0.25);
            color: var(--tu-orange);
            font-family: 'Syne', sans-serif; font-weight: 700;
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.2em;
            padding: 4px 10px; border-radius: 6px;
        }
        .tu-hero-stat {
            border-left: 3px solid var(--tu-orange);
            padding-left: 14px;
        }

        /* ══════════════════════════════
           SECTION CARDS
        ══════════════════════════════ */
        .tu-card {
            background: #fff;
            border: 1.5px solid #E4E7F5;
            border-radius: 22px;
            overflow: hidden;
        }
        .tu-card-header {
            padding: 20px 26px;
            border-bottom: 1.5px solid #F0F2FA;
            display: flex; align-items: center; justify-content: space-between; gap: 12px;
        }
        .tu-card-header-info { background: linear-gradient(135deg, var(--tu-navy) 0%, var(--tu-mid) 100%); border-bottom: none; }
        .tu-card-header-pw   { background: linear-gradient(135deg, #1A3A2C 0%, #16A34A 100%); border-bottom: none; }
        .tu-card-header-del  { background: linear-gradient(135deg, #3A1A1A 0%, #DC2626 100%); border-bottom: none; }
        .tu-card-body        { padding: 26px; }

        /* ══════════════════════════════
           PARTIAL OVERRIDES
           Scoped under .tu-partial-scope
           Targets Jetstream / Breeze default classes
        ══════════════════════════════ */

        /* Labels */
        .tu-partial-scope label,
        .tu-partial-scope .block.font-medium {
            font-family: 'Instrument Sans', sans-serif !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            color: #475569 !important;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        /* Inputs & Textareas */
        .tu-partial-scope input[type="text"],
        .tu-partial-scope input[type="email"],
        .tu-partial-scope input[type="password"],
        .tu-partial-scope input[type="tel"],
        .tu-partial-scope textarea,
        .tu-partial-scope select {
            font-family: 'Instrument Sans', sans-serif !important;
            font-size: 0.88rem !important;
            border: 1.5px solid #E4E7F5 !important;
            border-radius: 10px !important;
            padding: 10px 14px !important;
            background: #FAFBFF !important;
            color: #0F172A !important;
            box-shadow: none !important;
            transition: border-color 0.2s, box-shadow 0.2s !important;
            outline: none !important;
            width: 100%;
        }
        .tu-partial-scope input:focus,
        .tu-partial-scope textarea:focus,
        .tu-partial-scope select:focus {
            border-color: var(--tu-blue) !important;
            box-shadow: 0 0 0 3px rgba(40,69,214,0.1) !important;
            background: #fff !important;
        }
        .tu-partial-scope-danger input:focus,
        .tu-partial-scope-danger textarea:focus {
            border-color: #DC2626 !important;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.1) !important;
        }

        /* Primary buttons */
        .tu-partial-scope button[type="submit"],
        .tu-partial-scope .tu-submit {
            font-family: 'Syne', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.85rem !important;
            background: var(--tu-orange) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 10px 22px !important;
            cursor: pointer !important;
            transition: background 0.2s, transform 0.15s !important;
            box-shadow: none !important;
        }
        .tu-partial-scope button[type="submit"]:hover { background: #e36930 !important; transform: translateY(-1px) !important; }

        /* Password page save button — keep green */
        .tu-partial-scope-pw button[type="submit"] {
            background: #16A34A !important;
        }
        .tu-partial-scope-pw button[type="submit"]:hover { background: #15803D !important; }

        /* Delete button */
        .tu-partial-scope-danger button[type="submit"],
        .tu-partial-scope-danger .tu-delete-btn {
            background: #DC2626 !important;
        }
        .tu-partial-scope-danger button[type="submit"]:hover { background: #B91C1C !important; }

        /* Cancel / secondary */
        .tu-partial-scope button[type="button"],
        .tu-partial-scope a.tu-cancel {
            font-family: 'Syne', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.82rem !important;
            background: transparent !important;
            color: #64748B !important;
            border: 1.5px solid #E4E7F5 !important;
            border-radius: 10px !important;
            padding: 10px 18px !important;
            cursor: pointer !important;
            transition: background 0.2s, border-color 0.2s !important;
        }
        .tu-partial-scope button[type="button"]:hover { background: #F8FAFC !important; border-color: #CBD5E1 !important; }

        /* Error messages */
        .tu-partial-scope .text-red-600,
        .tu-partial-scope .text-rose-600,
        .tu-partial-scope [class*="text-red"],
        .tu-partial-scope [class*="text-rose"] {
            font-size: 0.75rem !important;
            color: #DC2626 !important;
            margin-top: 4px;
        }

        /* Success / saved indicator */
        .tu-partial-scope .text-sm.text-gray-600,
        .tu-partial-scope .text-sm.text-green-600 {
            font-size: 0.78rem !important;
            color: #16A34A !important;
        }

        /* Photo upload area */
        .tu-partial-scope input[type="file"] {
            font-size: 0.78rem !important;
            border: 1.5px dashed #D5D9EF !important;
            border-radius: 10px !important;
            padding: 10px 14px !important;
            background: #FAFBFF !important;
            cursor: pointer !important;
        }

        /* Section titles inside partials */
        .tu-partial-scope h2,
        .tu-partial-scope .text-lg.font-medium,
        .tu-partial-scope .text-xl.font-semibold {
            font-family: 'Syne', sans-serif !important;
            font-size: 1rem !important;
            font-weight: 800 !important;
            color: #0F172A !important;
            display: none; /* hidden — we use our own card header */
        }

        /* Description text inside partials */
        .tu-partial-scope p.text-sm,
        .tu-partial-scope .text-sm.text-gray-600 {
            font-size: 0.8rem !important;
            color: #94A3B8 !important;
            line-height: 1.6 !important;
        }

        /* Remove default card/section chrome from Jetstream */
        .tu-partial-scope .p-4,
        .tu-partial-scope .sm\:p-8 {
            padding: 0 !important;
        }
        .tu-partial-scope .bg-white,
        .tu-partial-scope .shadow,
        .tu-partial-scope .sm\:rounded-lg {
            background: transparent !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }
        .tu-partial-scope [class*="max-w-xl"] {
            max-width: 100% !important;
        }
    </style>

    <div class="tu-page py-8">
        <div class="mx-auto max-w-7xl space-y-7 px-4 sm:px-6 lg:px-8">

            {{-- ════════════ HERO ════════════ --}}
            <section class="tu-profile-hero">
                <div class="tu-grid-bg"></div>
                <div class="relative grid gap-0 lg:grid-cols-[1fr_auto] lg:items-center">
                    <div class="flex flex-col gap-6 p-8 sm:flex-row sm:items-center lg:p-10">
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            alt="{{ auth()->user()->name }}"
                            class="tu-avatar-ring"
                        >
                        <div>
                            <span class="tu-hero-pill">
                                <span style="width:6px;height:6px;border-radius:2px;background:currentColor;display:inline-block;"></span>
                                Akun Aktif
                            </span>
                            <h1 class="tu-syne mt-3 text-3xl font-extrabold text-white sm:text-4xl">
                                {{ auth()->user()->name }}<span style="color:var(--tu-orange);">.</span>
                            </h1>
                            <p class="mt-1 text-sm" style="color:rgba(255,255,255,0.5);">{{ auth()->user()->email }}</p>
                            @if (auth()->user()->phone)
                                <p class="mt-0.5 text-xs" style="color:rgba(255,255,255,0.35);">WA: {{ auth()->user()->phone }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-8 border-l border-white/8 px-10 py-8">
                        <div class="tu-hero-stat">
                            <p class="tu-syne text-3xl font-extrabold text-white">3</p>
                            <p class="mt-1 text-xs leading-5" style="color:rgba(255,255,255,0.4);">Bagian<br>Profil</p>
                        </div>
                        <div class="tu-hero-stat">
                            <a href="{{ route('matches.index') }}" class="tu-syne text-sm font-bold" style="color:var(--tu-orange);">Lihat Matches →</a>
                            <p class="mt-1.5 text-xs leading-5" style="color:rgba(255,255,255,0.4);">Profil lengkap =<br>match lebih akurat</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ════════════ GRID ════════════ --}}
            <div class="grid gap-7 xl:grid-cols-[1.35fr_0.95fr]">

                {{-- ── LEFT ── --}}
                <div class="space-y-7">

                    {{-- UPDATE PROFILE INFO --}}
                    <div class="tu-card">
                        <div class="tu-card-header tu-card-header-info">
                            <div>
                                <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:rgba(255,255,255,0.45);">Informasi Akun</p>
                                <h3 class="tu-syne mt-1 text-xl font-extrabold text-white">Update Profil</h3>
                                <p class="mt-0.5 text-xs" style="color:rgba(255,255,255,0.45);">Nama, email, nomor WhatsApp, dan foto profil kamu.</p>
                            </div>
                            <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.6)" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="tu-card-body tu-partial-scope">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                </div>

                {{-- ── RIGHT ── --}}
                <div class="space-y-7">

                    {{-- UPDATE PASSWORD --}}
                    <div class="tu-card">
                        <div class="tu-card-header tu-card-header-pw">
                            <div>
                                <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:rgba(255,255,255,0.45);">Keamanan</p>
                                <h3 class="tu-syne mt-1 text-xl font-extrabold text-white">Update Password</h3>
                                <p class="mt-0.5 text-xs" style="color:rgba(255,255,255,0.45);">Pastikan password kamu kuat dan aman.</p>
                            </div>
                            <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.6)" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="tu-card-body tu-partial-scope tu-partial-scope-pw">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- DELETE ACCOUNT --}}
                    <div class="tu-card" style="border-color:rgba(220,38,38,0.2);">
                        <div class="tu-card-header tu-card-header-del">
                            <div>
                                <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:rgba(255,255,255,0.45);">Danger Zone</p>
                                <h3 class="tu-syne mt-1 text-xl font-extrabold text-white">Hapus Akun</h3>
                                <p class="mt-0.5 text-xs" style="color:rgba(255,255,255,0.45);">Aksi ini permanen dan tidak bisa dibatalkan.</p>
                            </div>
                            <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.6)" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                        </div>
                        <div class="tu-card-body tu-partial-scope tu-partial-scope-danger">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
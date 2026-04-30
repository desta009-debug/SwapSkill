<x-app-layout>
    @php
        $offerCount = $offeredSkills->count();
        $wantCount  = $wantedSkills->count();

        $profileCompletion  = 0;
        $profileCompletion += $offerCount > 0 ? 40 : 0;
        $profileCompletion += $wantCount  > 0 ? 40 : 0;
        $profileCompletion += filled(auth()->user()->phone) ? 20 : 0;

        $nextAction = 'Lengkapi skill dan mulai cari partner belajar.';
        if ($offerCount > 0 && $wantCount > 0) {
            $nextAction = 'Profilmu sudah siap — saatnya eksplor halaman match.';
        } elseif ($offerCount > 0 || $wantCount > 0) {
            $nextAction = 'Tinggal lengkapi sisi skill yang kosong biar match makin akurat.';
        }
    @endphp

    <x-slot name="header">
        <div class="py-2">
            <p style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.35em;color:#F68048;font-family:'Syne',sans-serif;">SwapSkill</p>
            <h2 style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:#0D1A63;letter-spacing:-0.01em;margin-top:4px;">Dashboard</h2>
            <p style="font-size:13px;color:#8A96BB;margin-top:4px;">Lihat ringkasan skill, progres, dan peluang match terbaru kamu.</p>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        *,*::before,*::after{box-sizing:border-box;}

        :root{
            --navy:#0D1A63;
            --mid:#1A2CA3;
            --blue:#2845D6;
            --orange:#F68048;
            --orange-dim:rgba(246,128,72,0.11);
            --blue-dim:rgba(40,69,214,0.09);
            --border:#E3E6F4;
        }

        .d-root{
            font-family:'DM Sans',sans-serif;
            background:#EFF1FA;
            min-height:100vh;
            padding:32px 0 56px;
        }
        .d-wrap{max-width:1280px;margin:0 auto;padding:0 24px;}

        .d-grid{
            display:grid;
            grid-template-columns:1.3fr 0.95fr;
            gap:22px;
        }
        @media(max-width:1024px){.d-grid{grid-template-columns:1fr;}}

        .d-col{display:flex;flex-direction:column;gap:18px;}

        /* ── HERO ── */
        .d-hero{
            background:var(--navy);
            border-radius:28px;
            position:relative;
            overflow:hidden;
            box-shadow:0 24px 72px rgba(13,26,99,0.22);
        }
        .d-glow-1{
            position:absolute;pointer-events:none;
            width:480px;height:480px;top:-180px;right:-100px;border-radius:50%;
            background:radial-gradient(circle,rgba(40,69,214,0.38) 0%,transparent 70%);
        }
        .d-glow-2{
            position:absolute;pointer-events:none;
            width:260px;height:260px;bottom:-100px;left:40px;border-radius:50%;
            background:radial-gradient(circle,rgba(246,128,72,0.14) 0%,transparent 70%);
        }
        .d-grid-bg{
            position:absolute;inset:0;pointer-events:none;
            background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);
            background-size:52px 52px;
        }
        .d-hero-inner{
            position:relative;
            display:flex;
            gap:36px;
            align-items:flex-start;
            justify-content:space-between;
            padding:44px 48px 48px;
        }
        @media(max-width:860px){.d-hero-inner{flex-direction:column;padding:30px 24px;}}

        .d-welcome-pill{
            display:inline-flex;align-items:center;gap:8px;
            background:rgba(246,128,72,0.14);border:1px solid rgba(246,128,72,0.28);
            color:#F68048;font-family:'Syne',sans-serif;font-size:10px;font-weight:700;
            letter-spacing:0.28em;text-transform:uppercase;border-radius:100px;padding:5px 14px;
        }
        .d-dot{width:6px;height:6px;border-radius:50%;background:#F68048;animation:dpulse 2s ease-in-out infinite;}
        @keyframes dpulse{0%,100%{opacity:1}50%{opacity:0.3}}

        .d-name{
            font-family:'Syne',sans-serif;
            font-size:clamp(2rem,3.8vw,3.4rem);
            font-weight:800;color:#fff;line-height:1.05;
            letter-spacing:-0.02em;margin:18px 0 0;
        }
        .d-name .acc{color:#F68048;}

        .d-desc{font-size:14px;line-height:1.8;color:rgba(255,255,255,0.52);margin:14px 0 0;max-width:420px;}

        .d-btns{display:flex;flex-wrap:wrap;gap:10px;margin:24px 0 0;}

        .d-btn-o{
            background:#F68048;color:#fff;font-family:'Syne',sans-serif;font-weight:700;
            font-size:13px;border-radius:12px;padding:11px 22px;display:inline-block;
            text-decoration:none;transition:background .18s,transform .12s;
        }
        .d-btn-o:hover{background:#E46530;transform:translateY(-1px);}

        .d-btn-g{
            background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.78);
            border:1px solid rgba(255,255,255,0.12);font-family:'Syne',sans-serif;font-weight:700;
            font-size:13px;border-radius:12px;padding:11px 22px;display:inline-block;
            text-decoration:none;transition:background .18s;
        }
        .d-btn-g:hover{background:rgba(255,255,255,0.13);}

        /* stat cards inside hero */
        .d-stat-grid{
            display:grid;grid-template-columns:repeat(2,1fr);gap:10px;
            min-width:210px;flex-shrink:0;
        }
        @media(max-width:860px){.d-stat-grid{grid-template-columns:repeat(3,1fr);min-width:unset;width:100%;}}

        .d-stat{
            background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.10);
            border-radius:18px;padding:18px 16px;
        }
        .d-stat-l{font-size:11px;font-weight:600;color:rgba(255,255,255,0.5);line-height:1.4;}
        .d-stat-n{font-family:'Syne',sans-serif;font-size:2.2rem;font-weight:800;color:#fff;line-height:1;margin:8px 0 6px;}
        .d-stat-n .u{font-size:1.2rem;color:rgba(255,255,255,0.5);}
        .d-stat-h{font-size:11px;color:rgba(255,255,255,0.35);line-height:1.45;}

        /* ── WHITE CARDS ── */
        .d-card{background:#fff;border:1.5px solid var(--border);border-radius:24px;overflow:hidden;}

        .d-ch{padding:22px 28px;}
        .d-ch-navy{background:var(--navy);}
        .d-ch-warm{background:linear-gradient(135deg,#7B2810 0%,#F68048 100%);}
        .d-ch-mid{background:var(--mid);}

        .d-eyebrow{font-family:'Syne',sans-serif;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;color:rgba(255,255,255,0.4);}
        .d-ch-row{display:flex;align-items:flex-end;justify-content:space-between;gap:12px;margin-top:4px;}
        .d-ch-title{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#fff;line-height:1.15;}
        .d-pill-o{background:rgba(246,128,72,0.2);border:1px solid rgba(246,128,72,0.3);color:#F68048;font-family:'Syne',sans-serif;font-weight:700;font-size:12px;padding:4px 12px;border-radius:8px;flex-shrink:0;}
        .d-pill-w{background:rgba(255,255,255,0.18);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:12px;padding:4px 12px;border-radius:8px;flex-shrink:0;}

        .d-body{padding:24px 28px;}
        .d-hint{font-size:12px;color:#9DAABB;margin-bottom:16px;}

        .d-tag{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;font-size:13px;font-weight:600;transition:transform .12s;}
        .d-tag:hover{transform:translateY(-1px);}
        .d-tag-o{background:var(--blue-dim);border:1.5px solid rgba(40,69,214,0.14);color:var(--mid);}
        .d-tag-w{background:var(--orange-dim);border:1.5px solid rgba(246,128,72,0.2);color:#C4561F;}
        .d-lv{font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;padding:2px 6px;border-radius:5px;background:rgba(255,255,255,0.8);}
        .d-lv-o{color:var(--blue);}
        .d-lv-w{color:var(--orange);}

        .d-empty{border:1.5px dashed #D5DAEE;border-radius:14px;padding:28px;text-align:center;color:#A0ACCC;font-size:13px;}

        .d-btn-out{display:block;text-align:center;border:1.5px solid rgba(40,69,214,0.22);color:var(--blue);font-family:'Syne',sans-serif;font-weight:700;font-size:13px;border-radius:12px;padding:10px;margin-top:18px;text-decoration:none;transition:background .16s,border-color .16s;}
        .d-btn-out:hover{background:var(--blue-dim);border-color:var(--blue);}

        .d-btn-out-w{display:block;text-align:center;border:1.5px solid rgba(246,128,72,0.26);color:#C4561F;background:rgba(246,128,72,0.06);font-family:'Syne',sans-serif;font-weight:700;font-size:13px;border-radius:12px;padding:10px;margin-top:18px;text-decoration:none;transition:background .16s;}
        .d-btn-out-w:hover{background:rgba(246,128,72,0.13);}

        /* ── PROFILE CARD ── */
        .d-pu{display:flex;align-items:center;gap:16px;padding:22px 28px;}
        .d-pu img{width:64px;height:64px;border-radius:16px;object-fit:cover;border:2px solid rgba(6, 42, 169, 0.25);flex-shrink:0;}
        .d-pu-name{font-family:'Syne',sans-serif;font-size:17px;font-weight:800;color:#2b06e7;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .d-pu-meta{font-size:12px;color:rgba(10, 17, 161, 0.6);margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}

        .d-prog-box{margin:0 28px 24px;background:rgba(20, 8, 239, 0.07);border:1px solid rgba(4, 17, 193, 0.12);border-radius:16px;padding:18px 20px;}
        .d-prog-top{display:flex;align-items:center;justify-content:space-between;}
        .d-prog-lbl{font-size:12px;color:rgba(12, 60, 218, 0.6);font-weight:500;}
        .d-improve{background:rgba(246,128,72,0.15);border:1px solid rgba(8, 169, 5, 0.35);color:#07f117;font-size:9px;font-weight:700;letter-spacing:.2em;text-transform:uppercase;padding:3px 9px;border-radius:6px;}
        .d-prog-pct{font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:#0f60ad;margin:6px 0 10px;}
        .d-bar{height:5px;background:rgba(5, 39, 141, 0.12);border-radius:99px;overflow:hidden;}
        .d-bar-f{height:100%;background:linear-gradient(90deg,#087520,#07f74b);border-radius:99px;transition:width .7s cubic-bezier(.34,1.56,.64,1);}
        .d-prog-hint{font-size:11px;color:rgba(12, 38, 165, 0.5);line-height:1.5;margin-top:8px;}

        .d-pact{padding:0 28px 28px;display:flex;flex-direction:column;gap:8px;}
        .d-btn-wh{display:block;text-align:center;background:#fff;color:var(--navy);font-family:'Syne',sans-serif;font-weight:700;font-size:13px;border-radius:12px;padding:11px;text-decoration:none;transition:background .16s;}
        .d-btn-wh:hover{background:#EEF1FF;}
        .d-btn-ob{display:block;text-align:center;background:#F68048;color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:13px;border-radius:12px;padding:11px;text-decoration:none;transition:background .16s;}
        .d-btn-ob:hover{background:#E46530;}

        /* next move */
        .d-next{background:var(--navy);border-radius:24px;padding:28px;position:relative;overflow:hidden;box-shadow:0 16px 48px rgba(13,26,99,0.18);}
        .d-next::before{content:'';position:absolute;right:-60px;bottom:-60px;width:220px;height:220px;border-radius:50%;background:rgba(40,69,214,0.22);pointer-events:none;}
        .d-next::after{content:'';position:absolute;left:-30px;top:-30px;width:140px;height:140px;border-radius:50%;background:rgba(246,128,72,0.08);pointer-events:none;}
        .d-next-ey{font-family:'Syne',sans-serif;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.3em;color:#F68048;position:relative;z-index:1;}
        .d-next-t{font-family:'Syne',sans-serif;font-size:22px;font-weight:800;color:#fff;line-height:1.2;margin:10px 0 0;position:relative;z-index:1;}
        .d-next-d{font-size:12.5px;color:rgba(255,255,255,0.42);line-height:1.65;margin:10px 0 0;position:relative;z-index:1;}
        .d-div{height:1px;background:linear-gradient(90deg,transparent,rgba(40,69,214,0.3),transparent);margin:20px 0;position:relative;z-index:1;}
        .d-steps{display:flex;flex-direction:column;gap:14px;position:relative;z-index:1;}
        .d-step{display:flex;gap:12px;align-items:flex-start;}
        .d-step-n{font-family:'Syne',sans-serif;font-size:10px;font-weight:800;color:#F68048;background:rgba(246,128,72,0.12);border:1px solid rgba(246,128,72,0.2);width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .d-step-t{font-size:12.5px;color:rgba(255,255,255,0.52);line-height:1.55;margin-top:3px;}
        .d-next-cta{display:block;text-align:center;background:#F68048;color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:13px;border-radius:12px;padding:12px;margin-top:24px;text-decoration:none;position:relative;z-index:1;transition:background .16s;}
        .d-next-cta:hover{background:#E46530;}

        /* quick action strip */
        .d-qa{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
        @media(max-width:640px){.d-qa{grid-template-columns:1fr;}}

        .d-qa-c{background:#fff;border:1.5px solid var(--border);border-radius:20px;padding:20px;text-decoration:none;display:block;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s,border-color .2s;}
        .d-qa-c::after{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--qa,#2845D6);transform:scaleX(0);transform-origin:left;transition:transform .22s;}
        .d-qa-c:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(13,26,99,0.10);border-color:transparent;}
        .d-qa-c:hover::after{transform:scaleX(1);}
        .d-qa-icon{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;}
        .d-qa-t{font-family:'Syne',sans-serif;font-size:15px;font-weight:800;color:#0D1A63;margin:12px 0 0;}
        .d-qa-d{font-size:12px;color:#8A96BB;line-height:1.55;margin:5px 0 0;}
        .d-qa-ar{display:inline-flex;align-items:center;gap:5px;font-family:'Syne',sans-serif;font-weight:700;font-size:11.5px;margin:12px 0 0;transition:gap .2s;}
        .d-qa-c:hover .d-qa-ar{gap:10px;}
    </style>

    <div class="d-root">
        <div class="d-wrap">
            <div class="d-grid">

                {{-- ══ LEFT ══ --}}
                <div class="d-col">

                    {{-- HERO --}}
                    <section class="d-hero">
                        <div class="d-glow-1"></div>
                        <div class="d-glow-2"></div>
                        <div class="d-grid-bg"></div>
                        <div class="d-hero-inner">
                            <div style="max-width:440px;">
                                <span class="d-welcome-pill"><span class="d-dot"></span>Selamat datang kembali</span>
                                <h1 class="d-name">Hai, {{ auth()->user()->name }}<span class="acc"> .</span></h1>
                                <p class="d-desc">
                                    SwapSkill mencocokkan skill yang bisa kamu ajarkan dengan skill yang ingin dipelajari pengguna lain.
                                    Lengkapi profil dan update skill supaya hasil match makin relevan dan akurat.
                                </p>
                                <div class="d-btns">
                                    <a href="{{ route('skills.edit') }}" class="d-btn-o">Update Skill</a>
                                    <a href="{{ route('matches.index') }}" class="d-btn-g">Lihat Matches</a>
                                    <a href="{{ route('profile.edit') }}" class="d-btn-g">Kelola Profil</a>
                                </div>
                            </div>
                            <div class="d-stat-grid">
                                <div class="d-stat">
                                    <p class="d-stat-l">Skill<br>Ditawarkan</p>
                                    <p class="d-stat-n">{{ $offerCount }}</p>
                                    <p class="d-stat-h">Skill yang bisa kamu ajarkan</p>
                                </div>
                                <div class="d-stat">
                                    <p class="d-stat-l">Skill<br>Dipelajari</p>
                                    <p class="d-stat-n">{{ $wantCount }}</p>
                                    <p class="d-stat-h">Skill yang ingin kamu kuasai</p>
                                </div>
                                <div class="d-stat" style="grid-column:span 2;">
                                    <p class="d-stat-l">Profil Lengkap</p>
                                    <p class="d-stat-n">{{ $profileCompletion }}<span class="u">%</span></p>
                                    <p class="d-stat-h">{{ $nextAction }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- QUICK ACTIONS --}}
                    <div class="d-qa">
                        <a href="{{ route('skills.edit') }}" class="d-qa-c" style="--qa:#2845D6;">
                            <div class="d-qa-icon" style="background:rgba(40,69,214,0.09);color:#2845D6;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <h3 class="d-qa-t">Update Skill</h3>
                            <p class="d-qa-d">Perbarui skill offer dan target belajar kamu.</p>
                            <span class="d-qa-ar" style="color:#2845D6;">Buka editor <span>→</span></span>
                        </a>
                        <a href="{{ route('matches.index') }}" class="d-qa-c" style="--qa:#F68048;">
                            <div class="d-qa-icon" style="background:rgba(246,128,72,0.10);color:#F68048;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a4 4 0 110-8 4 4 0 010 8z"/></svg>
                            </div>
                            <h3 class="d-qa-t">Cari Match</h3>
                            <p class="d-qa-d">Lihat siapa yang cocok dengan skill kamu.</p>
                            <span class="d-qa-ar" style="color:#F68048;">Lihat matches <span>→</span></span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="d-qa-c" style="--qa:#1A2CA3;">
                            <div class="d-qa-icon" style="background:rgba(26,44,163,0.09);color:#1A2CA3;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h3 class="d-qa-t">Rapikan Profil</h3>
                            <p class="d-qa-d">Foto & kontak yang lengkap bikin partner yakin.</p>
                            <span class="d-qa-ar" style="color:#1A2CA3;">Edit profil <span>→</span></span>
                        </a>
                    </div>

                    {{-- SKILL OFFER --}}
                    <section class="d-card">
                        <div class="d-ch d-ch-navy">
                            <p class="d-eyebrow">Skill saya</p>
                            <div class="d-ch-row">
                                <h3 class="d-ch-title">Skill yang bisa<br>saya ajarkan</h3>
                                <span class="d-pill-o">{{ $offerCount }} skill</span>
                            </div>
                        </div>
                        <div class="d-body">
                            <p class="d-hint">Skill ini dipakai sistem untuk mencari orang yang cocok belajar dari kamu.</p>
                            @if ($offeredSkills->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                                    @foreach ($offeredSkills as $skill)
                                        <span class="d-tag d-tag-o">
                                            {{ $skill->name }}
                                            @if ($skill->pivot?->level)
                                                <span class="d-lv d-lv-o">{{ $skill->pivot->level }}</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="d-empty">Kamu belum menambahkan skill yang bisa diajarkan.</div>
                            @endif
                            <a href="{{ route('skills.edit') }}" class="d-btn-out">+ Tambah Skill</a>
                        </div>
                    </section>

                    {{-- SKILL WANT --}}
                    <section class="d-card">
                        <div class="d-ch d-ch-warm">
                            <p class="d-eyebrow">Target belajar</p>
                            <div class="d-ch-row">
                                <h3 class="d-ch-title">Skill yang ingin<br>saya pelajari</h3>
                                <span class="d-pill-w">{{ $wantCount }} skill</span>
                            </div>
                        </div>
                        <div class="d-body">
                            <p class="d-hint">Skill ini dipakai untuk mencari pengguna yang bisa mendukung tujuan belajarmu.</p>
                            @if ($wantedSkills->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                                    @foreach ($wantedSkills as $skill)
                                        <span class="d-tag d-tag-w">
                                            {{ $skill->name }}
                                            @if ($skill->pivot?->level)
                                                <span class="d-lv d-lv-w">{{ $skill->pivot->level }}</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="d-empty">Kamu belum menambahkan skill yang ingin dipelajari.</div>
                            @endif
                            <a href="{{ route('skills.edit') }}" class="d-btn-out-w">+ Tambah Target</a>
                        </div>
                    </section>

                </div>

                {{-- ══ RIGHT ══ --}}
                <div class="d-col">

                    {{-- PROFILE CARD --}}
                    <section class="d-card">
                        <div class="d-ch d-ch-mid" style="padding-bottom:0;">
                            <p class="d-eyebrow">Akun aktif</p>
                            <h3 class="d-ch-title" style="margin-bottom:20px;">Profil Saya</h3>
                        </div>
                        <div class="d-pu">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                            <div style="min-width:0;">
                                <p class="d-pu-name">{{ auth()->user()->name }}</p>
                                <p class="d-pu-meta">{{ auth()->user()->email }}</p>
                                <p class="d-pu-meta">{{ auth()->user()->phone ?: 'Nomor WhatsApp belum diisi' }}</p>
                            </div>
                        </div>
                        <div class="d-prog-box">
                            <div class="d-prog-top">
                                <p class="d-prog-lbl">Progress profil</p>
                                <span class="d-improve">{{ $profileCompletion >= 80 ? 'Good' : 'Improve' }}</span>
                            </div>
                            <p class="d-prog-pct">{{ $profileCompletion }}%</p>
                            <div class="d-bar"><div class="d-bar-f" style="width:{{ $profileCompletion }}%;"></div></div>
                            <p class="d-prog-hint">{{ $nextAction }}</p>
                        </div>
                        <div class="d-pact">
                            <a href="{{ route('profile.edit') }}" class="d-btn-wh">Kelola Profil</a>
                            <a href="{{ route('skills.edit') }}" class="d-btn-ob">Edit Skill Saya</a>
                        </div>
                    </section>

                    {{-- NEXT MOVE --}}
                    <section class="d-next">
                        <p class="d-next-ey">Next move</p>
                        <h3 class="d-next-t">Perbesar peluang<br>match kamu</h3>
                        <p class="d-next-d">
                            Semakin lengkap profil dan skill kamu, semakin bagus sistem membaca kecocokan dengan pengguna lain.
                        </p>
                        <div class="d-div"></div>
                        <div class="d-steps">
                            <div class="d-step">
                                <div class="d-step-n">01</div>
                                <p class="d-step-t">Tambahkan skill offer dan want dengan level yang sesuai.</p>
                            </div>
                            <div class="d-step">
                                <div class="d-step-n">02</div>
                                <p class="d-step-t">Lengkapi foto profil dan nomor WhatsApp aktif.</p>
                            </div>
                            <div class="d-step">
                                <div class="d-step-n">03</div>
                                <p class="d-step-t">Cek halaman matches untuk menemukan partner belajar.</p>
                            </div>
                        </div>
                        <a href="{{ route('matches.index') }}" class="d-next-cta">Buka Halaman Matches</a>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
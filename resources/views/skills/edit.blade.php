<x-app-layout>
    <x-slot name="header">
        <div class="py-2">
            <p class="text-xs font-bold uppercase tracking-[0.3em]" style="color:#F68048;font-family:'Syne',sans-serif;">SwapSkill</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900" style="font-family:'Syne',sans-serif;">Edit Skill Saya</h2>
            <p class="mt-1 text-sm text-slate-400">Atur skill yang bisa kamu ajarkan dan yang ingin kamu pelajari.</p>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --tu-navy:       #0D1A63;
            --tu-mid:        #1A2CA3;
            --tu-blue:       #2845D6;
            --tu-orange:     #F68048;
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
            border-radius: 24px;
            position: relative; overflow: hidden;
            box-shadow: 0 24px 80px rgba(13,26,99,0.25);
        }
        .tu-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 55% 60% at 90% -10%, rgba(40,69,214,0.4) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at -5% 110%, rgba(246,128,72,0.18) 0%, transparent 55%);
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

        .tu-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(40,69,214,0.2), transparent);
        }

        /* ── ERROR ALERT ── */
        .tu-error {
            border-radius: 14px;
            border: 1.5px solid rgba(220,38,38,0.2);
            background: rgba(220,38,38,0.05);
            padding: 16px 20px;
            color: #B91C1C;
        }

        /* ── SECTION CARD ── */
        .tu-section-card {
            background: #fff;
            border: 1.5px solid #E4E7F5;
            border-radius: 22px;
            overflow: hidden;
        }

        /* ── SECTION HEADER ── */
        .tu-section-header-offer {
            background: linear-gradient(135deg, var(--tu-navy) 0%, var(--tu-mid) 100%);
            padding: 22px 26px;
        }
        .tu-section-header-want {
            background: linear-gradient(135deg, #7B2810 0%, var(--tu-orange) 100%);
            padding: 22px 26px;
        }

        /* ── SKILL ROW ── */
        .tu-skill-row {
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px; padding: 13px 16px;
            border-radius: 12px;
            border: 1.5px solid #E8EAF3;
            background: #FAFBFF;
            transition: border-color 0.2s, background 0.2s, transform 0.15s;
            cursor: pointer;
            position: relative;
        }
        .tu-skill-row:hover {
            border-color: rgba(40,69,214,0.25);
            background: rgba(40,69,214,0.03);
        }
        .tu-skill-row.is-checked-offer {
            border-color: rgba(40,69,214,0.35);
            background: rgba(40,69,214,0.05);
        }
        .tu-skill-row.is-checked-want {
            border-color: rgba(246,128,72,0.35);
            background: rgba(246,128,72,0.05);
        }
        .tu-skill-row.is-disabled {
            opacity: 0.45;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* custom checkbox */
        .tu-checkbox {
            -webkit-appearance: none;
            appearance: none;
            width: 18px; height: 18px;
            border-radius: 5px;
            border: 2px solid #CBD5E1;
            background: #fff;
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
            transition: border-color 0.15s, background 0.15s;
        }
        .tu-checkbox:checked {
            border-color: var(--check-color, var(--tu-blue));
            background: var(--check-color, var(--tu-blue));
        }
        .tu-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 4px; top: 1px;
            width: 6px; height: 10px;
            border: 2px solid #fff;
            border-top: none; border-left: none;
            transform: rotate(42deg);
        }
        .tu-checkbox-offer { --check-color: var(--tu-blue); }
        .tu-checkbox-want  { --check-color: var(--tu-orange); }

        /* level select */
        .tu-level-select {
            -webkit-appearance: none;
            appearance: none;
            border: 1.5px solid #E4E7F5;
            border-radius: 8px;
            padding: 7px 32px 7px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            font-family: 'Instrument Sans', sans-serif;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            color: #475569;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
            min-width: 130px;
        }
        .tu-level-select:not(:disabled):focus {
            border-color: var(--tu-blue);
            box-shadow: 0 0 0 3px rgba(40,69,214,0.1);
        }
        .tu-level-select:disabled {
            background-color: #F8FAFC;
            color: #CBD5E1;
            cursor: not-allowed;
            border-color: #F1F5F9;
        }
        .tu-level-select-want:not(:disabled):focus {
            border-color: var(--tu-orange);
            box-shadow: 0 0 0 3px rgba(246,128,72,0.1);
        }

        /* ── SAVE STRIP ── */
        .tu-save-strip {
            background: var(--tu-navy);
            border-radius: 20px;
            position: relative; overflow: hidden;
            box-shadow: 0 16px 50px rgba(13,26,99,0.2);
        }
        .tu-save-strip::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 50% 80% at 100% 50%, rgba(40,69,214,0.3) 0%, transparent 60%);
            pointer-events: none;
        }

        /* ── BUTTONS ── */
        .tu-btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--tu-orange); color: #fff;
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.85rem;
            padding: 11px 22px; border-radius: 10px;
            border: none; cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }
        .tu-btn-primary:hover { background: #e36930; transform: translateY(-1px); }

        .tu-btn-ghost {
            display: inline-flex; align-items: center;
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.75);
            border: 1.5px solid rgba(255,255,255,0.12);
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.85rem;
            padding: 11px 22px; border-radius: 10px;
            transition: background 0.2s;
        }
        .tu-btn-ghost:hover { background: rgba(255,255,255,0.12); }

        .tu-btn-cancel {
            display: inline-flex; align-items: center;
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.6);
            border: 1.5px solid rgba(255,255,255,0.1);
            font-family: 'Syne', sans-serif; font-weight: 600; font-size: 0.82rem;
            padding: 10px 18px; border-radius: 10px;
            transition: background 0.2s;
        }
        .tu-btn-cancel:hover { background: rgba(255,255,255,0.1); }

        /* ── RULE BOX ── */
        .tu-rule-box {
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 16px 18px;
        }

        /* ── COUNT PILL ── */
        .tu-count-badge-offer {
            background: rgba(40,69,214,0.1);
            border: 1px solid rgba(40,69,214,0.2);
            color: var(--tu-blue);
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.72rem;
            padding: 4px 12px; border-radius: 6px;
        }
        .tu-count-badge-want {
            background: rgba(246,128,72,0.1);
            border: 1px solid rgba(246,128,72,0.25);
            color: var(--tu-orange);
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.72rem;
            padding: 4px 12px; border-radius: 6px;
        }

        /* live counter animation */
        .tu-counter-num {
            display: inline-block;
            transition: transform 0.25s cubic-bezier(0.34,1.56,0.64,1), opacity 0.2s;
        }
        .tu-counter-num.bump { transform: scale(1.3); }
    </style>

    <div class="tu-page py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('skills.update') }}" class="space-y-7">
                @csrf

                {{-- ── ERROR ── --}}
                @if ($errors->any())
                    <div class="tu-error">
                        <p class="tu-syne font-bold text-sm">Ada yang perlu diperbaiki:</p>
                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ════════════ HERO ════════════ --}}
                <section class="tu-hero">
                    <div class="tu-grid-bg"></div>

                    <div class="relative grid gap-0 lg:grid-cols-[1.2fr_0.8fr] lg:items-stretch">

                        {{-- LEFT --}}
                        <div class="p-8 lg:p-10">
                            <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(246,128,72,0.12);border:1px solid rgba(246,128,72,0.25);color:var(--tu-orange);font-family:'Syne',sans-serif;font-weight:700;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.2em;padding:4px 10px;border-radius:6px;">
                                <span style="width:6px;height:6px;border-radius:2px;background:currentColor;display:inline-block;"></span>
                                Skill Setup
                            </span>

                            <h1 class="tu-syne mt-5 text-4xl font-extrabold tracking-tight text-white leading-tight sm:text-5xl">
                                Bangun profil skill<br>yang lebih akurat<span style="color:var(--tu-orange);">.</span>
                            </h1>

                            <p class="mt-4 max-w-lg text-sm leading-7" style="color:rgba(255,255,255,0.55);">
                                SwapSkill membaca arah skill dan level kemampuanmu untuk menghasilkan match yang relevan.
                                Pilih skill offer dan want, lalu tentukan levelnya.
                            </p>

                            <div class="mt-7 flex flex-wrap gap-3">
                                <a href="{{ route('matches.index') }}" class="tu-btn-ghost">Lihat Matches</a>
                                <a href="{{ route('dashboard') }}" class="tu-btn-ghost">Dashboard</a>
                            </div>
                        </div>

                        {{-- RIGHT — STATS --}}
                        <div class="flex flex-col justify-center gap-5 border-l border-white/8 p-8 lg:p-10">
                            <div class="tu-hero-stat">
                                <div class="tu-hero-stat-num">
                                    <span id="hero-offer-count" class="tu-counter-num">{{ count($selectedOffers ?? []) }}</span>
                                </div>
                                <p class="mt-1.5 text-xs leading-5" style="color:rgba(255,255,255,0.45);">Skill<br>Ditawarkan</p>
                            </div>
                            <div class="tu-hero-stat">
                                <div class="tu-hero-stat-num">
                                    <span id="hero-want-count" class="tu-counter-num">{{ count($selectedWants ?? []) }}</span>
                                </div>
                                <p class="mt-1.5 text-xs leading-5" style="color:rgba(255,255,255,0.45);">Target<br>Belajar</p>
                            </div>

                            <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(40,69,214,0.2),transparent);"></div>

                            <div class="tu-rule-box">
                                <p class="tu-syne text-xs font-bold uppercase tracking-[0.15em]" style="color:var(--tu-orange);">Aturan Penting</p>
                                <p class="mt-2 text-xs leading-5" style="color:rgba(255,255,255,0.45);">
                                    Satu skill tidak bisa dipilih sekaligus di <span style="color:#fff;font-weight:600;">Offer</span> dan <span style="color:#fff;font-weight:600;">Want</span> — biar match-nya tetap masuk akal.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ════════════ OFFER + WANT ════════════ --}}
                <div class="grid gap-7 xl:grid-cols-2">

                    {{-- ── OFFER ── --}}
                    <div class="tu-section-card">
                        <div class="tu-section-header-offer">
                            <div class="flex items-end justify-between gap-3">
                                <div>
                                    <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:rgba(255,255,255,0.45);">Skill Offer</p>
                                    <h3 class="tu-syne mt-1.5 text-xl font-extrabold text-white leading-tight">
                                        Bisa Saya Ajarkan
                                    </h3>
                                    <p class="mt-1 text-xs" style="color:rgba(255,255,255,0.5);">Pilih skill yang kamu kuasai dan tentukan levelnya.</p>
                                </div>
                                <span class="tu-count-badge-offer" id="offer-badge">
                                    <span id="offer-count">{{ count($selectedOffers ?? []) }}</span> dipilih
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2.5 p-5">
                            @foreach ($skills as $skill)
                                @php $isOffer = in_array($skill->id, $selectedOffers ?? []); @endphp
                                <label
                                    class="tu-skill-row offer-skill-item {{ $isOffer ? 'is-checked-offer' : '' }}"
                                    data-skill-id="{{ $skill->id }}"
                                >
                                    <div class="flex items-center gap-3 min-w-0">
                                        <input
                                            type="checkbox"
                                            name="offers[]"
                                            value="{{ $skill->id }}"
                                            class="tu-checkbox tu-checkbox-offer offer-checkbox"
                                            {{ $isOffer ? 'checked' : '' }}
                                        >
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $skill->name }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Siap bantu orang lain belajar ini</p>
                                        </div>
                                    </div>

                                    <select
                                        name="offer_levels[{{ $skill->id }}]"
                                        class="tu-level-select offer-level"
                                        {{ $isOffer ? '' : 'disabled' }}
                                        onclick="event.preventDefault();"
                                    >
                                        <option value="" disabled hidden {{ empty($selectedOfferLevels[$skill->id] ?? '') ? 'selected' : '' }}>Level</option>
                                        <option value="beginner"     {{ (($selectedOfferLevels[$skill->id] ?? '') === 'beginner')     ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ (($selectedOfferLevels[$skill->id] ?? '') === 'intermediate') ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced"     {{ (($selectedOfferLevels[$skill->id] ?? '') === 'advanced')     ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── WANT ── --}}
                    <div class="tu-section-card">
                        <div class="tu-section-header-want">
                            <div class="flex items-end justify-between gap-3">
                                <div>
                                    <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:rgba(255,255,255,0.45);">Skill Want</p>
                                    <h3 class="tu-syne mt-1.5 text-xl font-extrabold text-white leading-tight">
                                        Ingin Saya Pelajari
                                    </h3>
                                    <p class="mt-1 text-xs" style="color:rgba(255,255,255,0.5);">Pilih skill yang jadi target belajarmu dan levelnya.</p>
                                </div>
                                <span class="tu-count-badge-want" id="want-badge">
                                    <span id="want-count">{{ count($selectedWants ?? []) }}</span> dipilih
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2.5 p-5">
                            @foreach ($skills as $skill)
                                @php $isWant = in_array($skill->id, $selectedWants ?? []); @endphp
                                <label
                                    class="tu-skill-row want-skill-item {{ $isWant ? 'is-checked-want' : '' }}"
                                    data-skill-id="{{ $skill->id }}"
                                >
                                    <div class="flex items-center gap-3 min-w-0">
                                        <input
                                            type="checkbox"
                                            name="wants[]"
                                            value="{{ $skill->id }}"
                                            class="tu-checkbox tu-checkbox-want want-checkbox"
                                            {{ $isWant ? 'checked' : '' }}
                                        >
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $skill->name }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Jadi target belajar berikutnya</p>
                                        </div>
                                    </div>

                                    <select
                                        name="want_levels[{{ $skill->id }}]"
                                        class="tu-level-select tu-level-select-want want-level"
                                        {{ $isWant ? '' : 'disabled' }}
                                        onclick="event.preventDefault();"
                                    >
                                        <option value="" disabled hidden {{ empty($selectedWantLevels[$skill->id] ?? '') ? 'selected' : '' }}>Level</option>
                                        <option value="beginner"     {{ (($selectedWantLevels[$skill->id] ?? '') === 'beginner')     ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ (($selectedWantLevels[$skill->id] ?? '') === 'intermediate') ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced"     {{ (($selectedWantLevels[$skill->id] ?? '') === 'advanced')     ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ════════════ SAVE STRIP ════════════ --}}
                <section class="tu-save-strip">
                    <div class="tu-grid-bg"></div>
                    <div class="relative flex flex-col gap-5 p-7 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="tu-syne text-[10px] font-bold uppercase tracking-[0.25em]" style="color:var(--tu-orange);">Final Step</p>
                            <h3 class="tu-syne mt-2 text-2xl font-extrabold text-white">Simpan profil skill kamu</h3>
                            <p class="mt-1.5 text-sm" style="color:rgba(255,255,255,0.45);">
                                Setelah disimpan, SwapSkill akan pakai data ini untuk menghitung kecocokan skill dan level.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('dashboard') }}" class="tu-btn-cancel">Batal</a>
                            <button type="submit" class="tu-btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Skill Saya
                            </button>
                        </div>
                    </div>
                </section>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const offerCheckboxes = document.querySelectorAll('.offer-checkbox');
            const wantCheckboxes  = document.querySelectorAll('.want-checkbox');

            // ── live counters ──
            function bumpCounter(el) {
                el.classList.remove('bump');
                void el.offsetWidth; // reflow
                el.classList.add('bump');
                setTimeout(() => el.classList.remove('bump'), 300);
            }

            function updateCounters() {
                const oc = [...offerCheckboxes].filter(c => c.checked).length;
                const wc = [...wantCheckboxes].filter(c => c.checked).length;

                const oEl = document.getElementById('offer-count');
                const wEl = document.getElementById('want-count');
                const hOEl = document.getElementById('hero-offer-count');
                const hWEl = document.getElementById('hero-want-count');

                if (oEl.textContent != oc) { oEl.textContent = oc; bumpCounter(oEl); hOEl.textContent = oc; bumpCounter(hOEl); }
                if (wEl.textContent != wc) { wEl.textContent = wc; bumpCounter(wEl); hWEl.textContent = wc; bumpCounter(hWEl); }
            }

            // ── row visual state ──
            function setOfferRowState(checkbox) {
                const row = checkbox.closest('.offer-skill-item');
                const sel = row.querySelector('.offer-level');
                if (checkbox.checked) {
                    sel.disabled = false;
                    row.classList.add('is-checked-offer');
                    row.classList.remove('is-disabled');
                } else {
                    sel.disabled = true;
                    sel.selectedIndex = 0;
                    row.classList.remove('is-checked-offer');
                }
            }

            function setWantRowState(checkbox) {
                const row = checkbox.closest('.want-skill-item');
                const sel = row.querySelector('.want-level');
                if (checkbox.checked) {
                    sel.disabled = false;
                    row.classList.add('is-checked-want');
                    row.classList.remove('is-disabled');
                } else {
                    sel.disabled = true;
                    sel.selectedIndex = 0;
                    row.classList.remove('is-checked-want');
                }
            }

            // ── mutual exclusion ──
            function syncAll() {
                const checkedOffers = [...offerCheckboxes].filter(c => c.checked).map(c => c.value);
                const checkedWants  = [...wantCheckboxes].filter(c => c.checked).map(c => c.value);

                offerCheckboxes.forEach(cb => {
                    const row = cb.closest('.offer-skill-item');
                    const sel = row.querySelector('.offer-level');
                    if (checkedWants.includes(cb.value) && !cb.checked) {
                        cb.disabled = true;
                        sel.disabled = true;
                        row.classList.add('is-disabled');
                        row.classList.remove('is-checked-offer');
                    } else {
                        cb.disabled = false;
                        row.classList.remove('is-disabled');
                        setOfferRowState(cb);
                    }
                });

                wantCheckboxes.forEach(cb => {
                    const row = cb.closest('.want-skill-item');
                    const sel = row.querySelector('.want-level');
                    if (checkedOffers.includes(cb.value) && !cb.checked) {
                        cb.disabled = true;
                        sel.disabled = true;
                        row.classList.add('is-disabled');
                        row.classList.remove('is-checked-want');
                    } else {
                        cb.disabled = false;
                        row.classList.remove('is-disabled');
                        setWantRowState(cb);
                    }
                });

                updateCounters();
            }

            // ── prevent label-select conflict ──
            document.querySelectorAll('.tu-level-select').forEach(sel => {
                sel.addEventListener('click', e => e.stopPropagation());
                sel.addEventListener('mousedown', e => e.stopPropagation());
            });

            offerCheckboxes.forEach(cb => cb.addEventListener('change', syncAll));
            wantCheckboxes.forEach(cb  => cb.addEventListener('change', syncAll));

            // ── init ──
            syncAll();
        });
    </script>
</x-app-layout>
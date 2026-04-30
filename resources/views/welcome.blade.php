<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwapSkill — Tukar Skill. Naik Level.</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,700;9..144,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-fraunces {
            font-family: 'Fraunces', serif;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gradient-to-b from-slate-50 via-white to-slate-100 text-slate-900">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="SwapSkill Logo"
                    class="h-11 w-11 rounded-2xl object-cover shadow-sm ring-1 ring-slate-200"
                >

                <div>
                    <p class="text-xl font-extrabold tracking-tight text-slate-900">SwapSkill</p>
                    <p class="text-xs text-slate-500">Tukar skill. Naik level.</p>
                </div>
            </a>

            <nav class="hidden items-center gap-8 md:flex">
                <a href="#cara-kerja" class="text-sm font-semibold text-slate-600 transition hover:text-[#2845D6]">
                    Cara Kerja
                </a>

                <a href="#manfaat" class="text-sm font-semibold text-slate-600 transition hover:text-[#2845D6]">
                    Manfaat
                </a>

                <a href="#contoh-skill" class="text-sm font-semibold text-slate-600 transition hover:text-[#2845D6]">
                    Contoh Skill
                </a>
            </nav>

            <!-- Desktop Auth Button -->
            <div class="hidden items-center gap-3 md:flex">
                @if (Route::has('login'))
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center rounded-2xl px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-95"
                            style="background: linear-gradient(to right, #1A2CA3, #F68048);"
                        >
                            Dashboard →
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Masuk
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center rounded-2xl px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-95"
                                style="background: linear-gradient(to right, #1A2CA3, #F68048);"
                            >
                                Daftar Gratis
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <button
                id="menuButton"
                type="button"
                class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white p-3 text-slate-700 shadow-sm md:hidden"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white md:hidden">
            <div class="space-y-3 px-4 py-4">
                <a href="#cara-kerja" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Cara Kerja
                </a>

                <a href="#manfaat" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Manfaat
                </a>

                <a href="#contoh-skill" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Contoh Skill
                </a>

                <div class="flex flex-col gap-3 pt-2">
                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold text-white"
                                style="background: linear-gradient(to right, #1A2CA3, #F68048);"
                            >
                                Dashboard →
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700"
                            >
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold text-white"
                                    style="background: linear-gradient(to right, #1A2CA3, #F68048);"
                                >
                                    Daftar Gratis
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="relative overflow-hidden py-20 text-white" style="background: linear-gradient(to bottom right, #0D1A63, #1A2CA3, #2845D6);">
        <div class="absolute inset-0" style="background: radial-gradient(circle at top right, rgba(40,69,214,0.35), transparent 28%), radial-gradient(circle at bottom left, rgba(246,128,72,0.2), transparent 24%);"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] reveal" style="border: 1px solid rgba(246,128,72,0.3); background: rgba(255,255,255,0.1); color: #F68048;">
                    <span class="h-2 w-2 rounded-full" style="background-color: #F68048;"></span>
                    Platform pertukaran skill mahasiswa
                </span>

                <h1 class="font-fraunces mt-6 text-5xl font-black leading-tight tracking-tight sm:text-6xl reveal">
                    Ajarkan yang kamu
                    <span style="background: linear-gradient(to right, #F68048, #ffaa7a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">kuasai,</span>
                    <br>
                    pelajari yang kamu
                    <span style="background: linear-gradient(to right, #F68048, #ffaa7a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">butuhkan.</span>
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 reveal">
                    SwapSkill membantu mahasiswa saling bertukar skill secara langsung.
                    Kamu bisa mengajarkan skill yang kamu kuasai, lalu belajar skill baru dari orang lain
                    tanpa harus bergantung pada kursus berbayar.
                </p>

                <!-- Hero CTA -->
                <div class="mt-8 flex flex-wrap gap-3 reveal">
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:opacity-95"
                            style="background: linear-gradient(to right, #1A2CA3, #F68048); box-shadow: 0 10px 30px rgba(246,128,72,0.3);"
                        >
                            Buka Dashboard →
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:opacity-95"
                                style="background: linear-gradient(to right, #1A2CA3, #F68048); box-shadow: 0 10px 30px rgba(246,128,72,0.3);"
                            >
                                Mulai Sekarang →
                            </a>
                        @endif

                        @if (Route::has('login'))
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);"
                            >
                                Saya Sudah Punya Akun
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="mt-8 flex flex-wrap gap-3 reveal">
                    <span class="rounded-full px-4 py-2 text-xs font-medium text-slate-300" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">Figma</span>
                    <span class="rounded-full px-4 py-2 text-xs font-medium text-slate-300" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">Excel</span>
                    <span class="rounded-full px-4 py-2 text-xs font-medium text-slate-300" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">Canva</span>
                    <span class="rounded-full px-4 py-2 text-xs font-medium text-slate-300" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">HTML</span>
                    <span class="rounded-full px-4 py-2 text-xs font-medium text-slate-300" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">Public Speaking</span>
                </div>
            </div>

            <div class="reveal">
                <div class="rounded-[32px] p-6 shadow-2xl backdrop-blur-xl" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-3xl p-5" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">
                                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full text-white" style="background-color: #2845D6;">A</span>
                                Pengguna A
                            </div>

                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Bisa mengajar</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(40,69,214,0.2); color: #a5b4fc;">Canva</span>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(40,69,214,0.2); color: #a5b4fc;">English</span>
                            </div>

                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Ingin belajar</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(246,128,72,0.2); color: #fdba74;">Figma</span>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(246,128,72,0.2); color: #fdba74;">Excel</span>
                            </div>
                        </div>

                        <div class="rounded-3xl p-5" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">
                                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full text-white" style="background-color: #F68048;">B</span>
                                Pengguna B
                            </div>

                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Bisa mengajar</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(40,69,214,0.2); color: #a5b4fc;">Figma</span>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(40,69,214,0.2); color: #a5b4fc;">Excel</span>
                            </div>

                            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Ingin belajar</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(246,128,72,0.2); color: #fdba74;">Canva</span>
                            </div>
                        </div>
                    </div>

                    <div class="my-4 flex justify-center">
                        <span class="rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="border: 1px solid rgba(52,211,153,0.3); background: rgba(52,211,153,0.1); color: #6ee7b7;">
                            ⇄ Match ditemukan
                        </span>
                    </div>

                    <div class="rounded-2xl p-4" style="border: 1px solid rgba(52,211,153,0.2); background: rgba(52,211,153,0.1);">
                        <p class="text-xs font-bold uppercase tracking-[0.15em]" style="color: #6ee7b7;">Match Mutual</p>
                        <p class="mt-2 text-sm leading-6" style="color: #a7f3d0;">
                            Keduanya bisa saling mengajarkan skill yang dibutuhkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-0 px-4 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div class="border-b border-slate-200 px-4 py-8 sm:border-r lg:border-b-0 reveal">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Model Belajar</p>
                <h3 class="font-fraunces mt-3 text-4xl font-black" style="color: #2845D6;">2 Arah</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Belajar dan mengajar berjalan bersamaan.</p>
            </div>

            <div class="border-b border-slate-200 px-4 py-8 lg:border-b-0 lg:border-r reveal">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Cara Belajar</p>
                <h3 class="font-fraunces mt-3 text-4xl font-black text-slate-900">Kolaboratif</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Belajar lewat interaksi langsung dengan orang lain.</p>
            </div>

            <div class="border-b border-slate-200 px-4 py-8 sm:border-r lg:border-b-0 lg:border-r reveal">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Biaya Belajar</p>
                <h3 class="font-fraunces mt-3 text-4xl font-black text-slate-900">Lebih Ringan</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Skill kamu bisa jadi nilai tukar.</p>
            </div>

            <div class="px-4 py-8 reveal">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Fokus Platform</p>
                <h3 class="font-fraunces mt-3 text-4xl font-black text-slate-900">Skill Nyata</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Cocok untuk mahasiswa yang ingin terus berkembang.</p>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section id="cara-kerja" class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl reveal">
                <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="background: rgba(40,69,214,0.08); color: #2845D6;">
                    Cara kerja
                </span>

                <h2 class="font-fraunces mt-5 text-4xl font-black leading-tight tracking-tight text-slate-900 sm:text-5xl">
                    Alur sederhana untuk belajar lewat pertukaran skill.
                </h2>

                <p class="mt-5 text-base leading-8 text-slate-500">
                    SwapSkill dibuat supaya proses belajar terasa simpel. Isi skill yang kamu punya,
                    tentukan skill yang ingin dipelajari, lalu temukan partner yang cocok.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <div class="reveal rounded-[28px] border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl text-lg font-black text-white" style="background: linear-gradient(to right, #1A2CA3, #F68048);">
                        1
                    </div>

                    <h3 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900">Isi profil skill</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Masukkan skill yang bisa kamu ajarkan dan skill yang ingin kamu pelajari.
                    </p>
                </div>

                <div class="reveal rounded-[28px] border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl text-lg font-black text-white" style="background: linear-gradient(to right, #1A2CA3, #F68048);">
                        2
                    </div>

                    <h3 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900">Temukan match</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        SwapSkill mencocokkan profilmu dengan pengguna lain berdasarkan skill dan level kemampuan.
                    </p>
                </div>

                <div class="reveal rounded-[28px] border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl text-lg font-black text-white" style="background: linear-gradient(to right, #1A2CA3, #F68048);">
                        3
                    </div>

                    <h3 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900">Hubungi dan mulai belajar</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Setelah match ditemukan, kamu bisa langsung lanjut komunikasi lewat WhatsApp.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Manfaat -->
    <section id="manfaat" class="pb-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl reveal">
                <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="background: rgba(40,69,214,0.08); color: #2845D6;">
                    Manfaat
                </span>

                <h2 class="font-fraunces mt-5 text-4xl font-black leading-tight tracking-tight text-slate-900 sm:text-5xl">
                    Kenapa SwapSkill berguna?
                </h2>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-2">
                <div class="reveal overflow-hidden rounded-[32px] p-8" style="border: 1px solid rgba(40,69,214,0.15); background: linear-gradient(to bottom right, rgba(26,44,163,0.06), rgba(13,26,99,0.04));">
                    <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="background: rgba(40,69,214,0.1); color: #1A2CA3;">
                        Untuk yang ingin belajar
                    </span>

                    <h3 class="font-fraunces mt-5 text-3xl font-black leading-tight" style="color: #0D1A63;">
                        Belajar skill baru dengan cara yang lebih terjangkau.
                    </h3>

                    <ul class="mt-6 space-y-4">
                        <li class="flex gap-3 text-sm leading-7" style="color: #1A2CA3;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #2845D6;">✓</span>
                            Skill yang kamu punya bisa jadi jalan untuk belajar skill baru.
                        </li>

                        <li class="flex gap-3 text-sm leading-7" style="color: #1A2CA3;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #2845D6;">✓</span>
                            Belajar terasa lebih aktif karena dilakukan langsung dengan orang lain.
                        </li>

                        <li class="flex gap-3 text-sm leading-7" style="color: #1A2CA3;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #2845D6;">✓</span>
                            Cocok untuk mahasiswa yang ingin berkembang tanpa biaya besar.
                        </li>
                    </ul>
                </div>

                <div class="reveal overflow-hidden rounded-[32px] p-8" style="border: 1px solid rgba(246,128,72,0.2); background: linear-gradient(to bottom right, rgba(246,128,72,0.07), rgba(246,128,72,0.03));">
                    <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="background: rgba(246,128,72,0.15); color: #c85e1e;">
                        Untuk yang ingin mengajar
                    </span>

                    <h3 class="font-fraunces mt-5 text-3xl font-black leading-tight" style="color: #7c2d12;">
                        Bagikan skillmu dan jadikan itu nilai nyata.
                    </h3>

                    <ul class="mt-6 space-y-4">
                        <li class="flex gap-3 text-sm leading-7" style="color: #92400e;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #F68048;">✓</span>
                            Mengajar orang lain membantu kamu makin paham dengan skill yang dimiliki.
                        </li>

                        <li class="flex gap-3 text-sm leading-7" style="color: #92400e;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #F68048;">✓</span>
                            Profilmu terlihat lebih aktif dan lebih meyakinkan.
                        </li>

                        <li class="flex gap-3 text-sm leading-7" style="color: #92400e;">
                            <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white" style="background-color: #F68048;">✓</span>
                            Kamu tetap bisa belajar hal baru sambil membantu orang lain.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contoh Skill -->
    <section id="contoh-skill" class="pb-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl reveal">
                <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.15em]" style="background: rgba(40,69,214,0.08); color: #2845D6;">
                    Contoh tukar skill
                </span>

                <h2 class="font-fraunces mt-5 text-4xl font-black leading-tight tracking-tight text-slate-900 sm:text-5xl">
                    Contoh pertukaran skill di SwapSkill.
                </h2>
            </div>

            <div class="mt-12 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="reveal rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Contoh Tukar Skill</p>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-extrabold" style="color: #2845D6;">Canva</span>
                        <span class="text-slate-300">⇄</span>
                        <span class="text-sm font-extrabold" style="color: #F68048;">Excel</span>
                    </div>

                    <p class="mt-3 text-sm leading-7 text-slate-500">Skill desain ditukar dengan skill pengolahan data.</p>
                </div>

                <div class="reveal rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Contoh Tukar Skill</p>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-extrabold" style="color: #2845D6;">Figma</span>
                        <span class="text-slate-300">⇄</span>
                        <span class="text-sm font-extrabold" style="color: #F68048;">English Speaking</span>
                    </div>

                    <p class="mt-3 text-sm leading-7 text-slate-500">Desain produk bertemu kemampuan komunikasi.</p>
                </div>

                <div class="reveal rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Contoh Tukar Skill</p>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-extrabold" style="color: #2845D6;">HTML</span>
                        <span class="text-slate-300">⇄</span>
                        <span class="text-sm font-extrabold" style="color: #F68048;">Public Speaking</span>
                    </div>

                    <p class="mt-3 text-sm leading-7 text-slate-500">Skill teknis dilengkapi dengan skill presentasi.</p>
                </div>

                <div class="reveal rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Contoh Tukar Skill</p>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-extrabold" style="color: #2845D6;">UI Design</span>
                        <span class="text-slate-300">⇄</span>
                        <span class="text-sm font-extrabold" style="color: #F68048;">Video Editing</span>
                    </div>

                    <p class="mt-3 text-sm leading-7 text-slate-500">Visual design dipadukan dengan storytelling video.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="pb-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal relative overflow-hidden rounded-[36px] p-10 text-white shadow-2xl sm:p-14" style="background: linear-gradient(to bottom right, #0D1A63, #1A2CA3, #2845D6);">
                <div class="absolute inset-0 opacity-20" style="background: radial-gradient(circle at bottom right, #F68048, transparent 40%);"></div>

                <div class="relative grid items-center gap-8 lg:grid-cols-[1fr_auto]">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.15em]" style="color: #F68048;">Siap mulai?</p>

                        <h2 class="font-fraunces mt-5 text-4xl font-black leading-tight tracking-tight sm:text-5xl">
                            Mulai tukar skill dan naik level bersama SwapSkill.
                        </h2>

                        <p class="mt-5 max-w-2xl text-sm leading-8 text-slate-300">
                            Daftar sekarang, isi profil skillmu, dan temukan orang yang bisa belajar bareng denganmu.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white"
                                style="background: linear-gradient(to right, #2845D6, #F68048); box-shadow: 0 10px 30px rgba(246,128,72,0.3);"
                            >
                                Buka Dashboard →
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white"
                                    style="background: linear-gradient(to right, #2845D6, #F68048); box-shadow: 0 10px 30px rgba(246,128,72,0.3);"
                                >
                                    Daftar Gratis →
                                </a>
                            @endif

                            @if (Route::has('login'))
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center rounded-2xl px-6 py-3.5 text-sm font-semibold text-white"
                                    style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);"
                                >
                                    Masuk
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-8">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="SwapSkill Logo"
                    class="h-8 w-8 rounded-xl object-cover"
                >

                <p class="text-sm font-extrabold text-slate-900">SwapSkill</p>
                <p class="text-sm text-slate-400">— Tukar skill. Naik level.</p>
            </div>

            <p class="text-sm text-slate-400">© {{ date('Y') }} SwapSkill. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script>
        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        const reveals = document.querySelectorAll('.reveal');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        reveals.forEach((el) => observer.observe(el));
    </script>

</body>
</html>
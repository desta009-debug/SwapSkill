<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwapSkill - Bursa Tukar Keahlian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #101A30;
            --bg-soft: #15223E;
            --ink: #F5F7FA;
            --muted: #98A4B5;
            --accent: #2FD4C4;
            --accent-2: #F2B134;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-strong: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.14);
        }

        body {
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        .font-mono-tix {
            font-family: 'IBM Plex Mono', ui-monospace, monospace;
            font-weight: 700;
        }

        .glass {
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }

        .glass-strong {
            background: var(--glass-strong);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
        }

        .inset-highlight {
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.16), 0 30px 60px -25px rgba(0, 0, 0, 0.65);
        }

        .glow {
            background:
                radial-gradient(ellipse 70% 60% at 80% 20%, rgba(47, 212, 196, 0.30) 0%, transparent 65%),
                radial-gradient(ellipse 55% 55% at 20% 80%, rgba(242, 177, 52, 0.20) 0%, transparent 60%);
        }

        .dot-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 26px 26px;
        }
    </style>
</head>

<body class="antialiased font-sans text-[#F5F7FA] selection:bg-[#2FD4C4]/30 selection:text-[#F5F7FA]">

    <nav class="fixed w-full z-50 glass border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}"
                        alt="SwapSkill Logo" class="w-10 h-10 rounded-xl object-cover border border-white/15">
                    <span class="font-display font-bold text-xl tracking-tight">Swap<span
                            class="text-[#2FD4C4]">Skill</span></span>
                </div>
                <div
                    class="hidden md:flex space-x-8 items-center font-mono-tix text-xs uppercase tracking-widest text-[#98A4B5]">
                    <a href="#fitur" class="hover:text-[#2FD4C4] transition">Fitur</a>
                    <a href="#cara-kerja" class="hover:text-[#2FD4C4] transition">Cara Kerja</a>
                    <a href="#testimoni" class="hover:text-[#2FD4C4] transition">Testimoni</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-mono-tix text-xs uppercase tracking-widest font-bold hover:text-[#2FD4C4] transition">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline font-mono-tix text-xs uppercase tracking-widest text-[#98A4B5] hover:text-[#F5F7FA] transition">Log
                        in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="font-mono-tix text-xs uppercase tracking-widest font-bold px-5 py-2.5 rounded-xl bg-gradient-to-br from-[#F2B134] to-[#2FD4C4] text-[#06241F] shadow-lg shadow-[#2FD4C4]/30 hover:brightness-110 transition transform hover:-translate-y-0.5">Gabung
                        Gratis</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 dot-grid pointer-events-none"></div>
            <div
                class="absolute -top-48 left-1/2 -translate-x-1/2 w-[760px] h-[760px] glow blur-3xl pointer-events-none">
            </div>

            <div
                class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid gap-14 lg:grid-cols-[1.05fr_0.95fr] items-center">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-2 font-mono-tix text-xs uppercase tracking-widest text-[#2FD4C4]">
                        <span class="w-2 h-2 rounded-full bg-[#2FD4C4] animate-pulse"></span>
                        Live Exchange — Real-time
                    </div>

                    <h1
                        class="font-display font-bold text-5xl md:text-6xl xl:text-[64px] leading-[1.08] tracking-tight">
                        Tempat skill <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2FD4C4] to-[#F2B134]">bertemu skill</span>, bukan sekadar listing.
                    </h1>

                    <p class="max-w-xl text-lg text-[#98A4B5] leading-relaxed">
                        SwapSkill menghubungkan kamu dengan orang yang punya skill yang kamu butuhkan — dan butuh skill
                        yang kamu punya. Tanpa biaya, tanpa drama, langsung match.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-7 py-4 rounded-xl bg-gradient-to-br from-[#F2B134] to-[#2FD4C4] text-[#06241F] font-bold text-sm shadow-lg shadow-[#2FD4C4]/30 hover:brightness-110 transition transform hover:-translate-y-0.5">
                            Mulai Sekarang
                        </a>
                        <a href="#cara-kerja"
                            class="inline-flex items-center justify-center px-7 py-4 rounded-xl glass text-[#F5F7FA] font-semibold text-sm hover:bg-white/10 transition">
                            Lihat Cara Kerja
                        </a>
                    </div>

                    <div class="glass rounded-2xl p-5">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-white/10 font-mono-tix text-center sm:text-left">
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold">5.000+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#98A4B5] mt-1">Pengguna Aktif
                                </p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold">10.200+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#98A4B5] mt-1">Match Sukses
                                </p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold">500+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#98A4B5] mt-1">Kategori Skill
                                </p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold">Rp0</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#98A4B5] mt-1">Biaya Selamanya</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-strong inset-highlight rounded-2xl overflow-hidden max-w-md mx-auto lg:mx-0 w-full">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-white/10">
                        <span class="w-3 h-3 rounded-full bg-[#FF5F57]"></span>
                        <span class="w-3 h-3 rounded-full bg-[#FEBC2E]"></span>
                        <span class="w-3 h-3 rounded-full bg-[#28C840]"></span>
                        <span
                            class="ml-3 font-mono-tix text-[11px] text-white/40 uppercase tracking-widest">live-exchange.feed</span>
                    </div>
                    <div class="p-4 space-y-3">
                        <div
                            class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#2FD4C4]/15 text-[#2FD4C4] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#2FD4C4]/30">
                                    UX</div>
                                <div>
                                    <p class="text-sm font-semibold">UI/UX <span class="text-white/30">⇄</span> Public
                                        Speaking</p>
                                    <p class="text-[11px] text-white/40 font-mono-tix">Dian &amp; Bagas — baru saja</p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#28C840]"></span>
                        </div>
                        <div
                            class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#F2B134]/15 text-[#F2B134] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#F2B134]/30">
                                    XL</div>
                                <div>
                                    <p class="text-sm font-semibold">Excel <span class="text-white/30">⇄</span>
                                        Fotografi Produk</p>
                                    <p class="text-[11px] text-white/40 font-mono-tix">Sinta &amp; Reza — 4 menit lalu
                                    </p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#28C840]"></span>
                        </div>
                        <div
                            class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-white/10 text-[#2FD4C4] flex items-center justify-center font-mono-tix text-xs font-bold border border-white/15">
                                    DV</div>
                                <div>
                                    <p class="text-sm font-semibold">Laravel <span class="text-white/30">⇄</span>
                                        Copywriting</p>
                                    <p class="text-[11px] text-white/40 font-mono-tix">Rafi &amp; Putri — 12 menit lalu
                                    </p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#FEBC2E]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="relative py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#2FD4C4]">Fitur</p>
                    <h2 class="mt-3 font-display font-bold text-3xl md:text-4xl">Dibangun buat orang yang serius
                        belajar.</h2>
                    <p class="mt-4 text-[#98A4B5] leading-relaxed">Tiga komponen inti yang bikin proses tukar skill
                        terasa rapi dan bisa dipertanggungjawabkan.</p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <div class="glass rounded-2xl p-8 hover:border-[#2FD4C4]/40 transition">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#2FD4C4]/15 text-[#2FD4C4] border border-[#2FD4C4]/30 font-mono-tix font-bold text-sm">
                            MT</div>
                        <h3 class="mt-6 text-xl font-display font-bold">Match yang relevan</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Sistem nyocokin kamu sama orang yang
                            skill-nya saling melengkapi, bukan asal tebak dari kata kunci.</p>
                    </div>
                    <div class="glass rounded-2xl p-8 hover:border-[#F2B134]/40 transition">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#F2B134]/15 text-[#F2B134] border border-[#F2B134]/30 font-mono-tix font-bold text-sm">
                            PF</div>
                        <h3 class="mt-6 text-xl font-display font-bold">Portofolio yang kebukti</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Setiap swap yang kelar otomatis nambah rekam
                            jejak di profilmu, lengkap dengan review dari partner belajar.</p>
                    </div>
                    <div class="glass rounded-2xl p-8 hover:border-white/30 transition">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 text-[#F5F7FA] border border-white/15 font-mono-tix font-bold text-sm">
                            DK</div>
                        <h3 class="mt-6 text-xl font-display font-bold">Obrolan tanpa drama</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Nego waktu, materi, sampai ekspektasi
                            langsung di chat. Nggak perlu nunggu admin approve dulu.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cara-kerja" class="relative py-24 border-y border-white/10 bg-[#15223E]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#F2B134]">Cara Kerja</p>
                    <h2 class="mt-3 font-display font-bold text-3xl md:text-4xl">Tiga langkah, selesai.</h2>
                </div>

                <div class="mt-14 grid gap-10 lg:grid-cols-3 relative">
                    <div
                        class="hidden lg:block absolute top-6 left-[16.5%] right-[16.5%] border-t border-dashed border-white/15 z-0">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold">
                            01</div>
                        <h3 class="mt-5 text-xl font-display font-bold">Pajang skill-mu</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Tulis apa yang kamu kuasai dan apa yang lagi
                            kamu kejar. Makin spesifik, makin gampang ketemu jodoh belajar.</p>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold">
                            02</div>
                        <h3 class="mt-5 text-xl font-display font-bold">Cocokin &amp; negoin</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Susuri profil yang ada, cek rating, terus
                            mulai obrolan buat nentuin jadwal dan format swap-nya.</p>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold">
                            03</div>
                        <h3 class="mt-5 text-xl font-display font-bold">Eksekusi &amp; kasih rating</h3>
                        <p class="mt-3 text-[#98A4B5] leading-relaxed">Jalanin sesi swap-nya, kelar itu saling
                            kasih review biar kepercayaan komunitasnya makin kebangun.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimoni" class="relative py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#2FD4C4]">Testimoni</p>
                    <h2 class="mt-3 font-display font-bold text-3xl md:text-4xl">Kata mereka yang udah coba.</h2>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed">"Biasanya nyari mentor itu ribet dan mahal. Di sini saya nuker jasa
                            desain sama kelas public speaking, dua-duanya untung."</p>
                        <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#2FD4C4]/15 text-[#2FD4C4] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#2FD4C4]/30">
                                    D</div>
                                <div>
                                    <p class="font-semibold text-sm">Dian</p>
                                    <p class="text-xs text-[#98A4B5]">UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#F2B134]">★★★★★</p>
                        </div>
                    </div>
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed">"Match-nya kerasa pas. Saya ajarin Laravel, partner saya ajarin saya
                            copywriting buat dokumentasi teknis."</p>
                        <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#F2B134]/15 text-[#F2B134] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#F2B134]/30">
                                    R</div>
                                <div>
                                    <p class="font-semibold text-sm">Rafi</p>
                                    <p class="text-xs text-[#98A4B5]">Backend Developer</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#F2B134]">★★★★★</p>
                        </div>
                    </div>
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed">"Nggak nyangka komunitasnya seaktif ini. Dalam seminggu udah dapat
                            tiga partner swap yang serius."</p>
                        <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-white/10 text-[#F5F7FA] flex items-center justify-center font-mono-tix text-xs font-bold border border-white/15">
                                    A</div>
                                <div>
                                    <p class="font-semibold text-sm">Arif</p>
                                    <p class="text-xs text-[#98A4B5]">Product Manager</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#F2B134]">★★★★★</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative py-24 overflow-hidden">
            <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[640px] h-[640px] glow blur-3xl pointer-events-none">
            </div>
            <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="glass-strong inset-highlight rounded-2xl p-10 md:p-14 text-center">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#2FD4C4]">Siap mulai?</p>
                    <h2 class="mt-4 font-display font-bold text-3xl md:text-4xl">Skill-mu berharga. Mulai tuker
                        sekarang.</h2>
                    <p class="mt-4 text-[#98A4B5] leading-relaxed">Bikin profil dalam 5 menit, posting skill
                        pertamamu, dan tunggu partner belajar pertama nyamperin.</p>
                    <a href="{{ route('register') }}"
                        class="mt-8 inline-flex items-center justify-center px-8 py-4 rounded-xl bg-gradient-to-br from-[#F2B134] to-[#2FD4C4] text-[#06241F] font-bold text-sm shadow-lg shadow-[#2FD4C4]/30 hover:brightness-110 transition transform hover:-translate-y-0.5">
                        Daftar Sekarang, 100% Gratis
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-white/10 py-8">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="font-mono-tix text-xs text-[#98A4B5] uppercase tracking-widest text-center sm:text-left">
                SwapSkill &copy; {{ date('Y') }} — Bursa tukar keahlian.</p>
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}"
                    alt="SwapSkill Logo" class="w-7 h-7 rounded-lg object-cover border border-white/15">
                <span class="font-display font-bold">Swap<span class="text-[#2FD4C4]">Skill</span></span>
            </div>
        </div>
    </footer>

</body>

</html>
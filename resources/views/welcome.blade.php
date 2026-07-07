<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwapSkill - Bursa Tukar Keahlian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,700;9..144,900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f8fafc;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #4f46e5;
            --secondary: #f97316;
            --border: rgba(15, 23, 42, 0.10);
            --shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Fraunces', serif;
            font-weight: 900;
        }

        .font-mono-tix {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            letter-spacing: 0.08em;
        }

        .glass {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .glass-strong {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .soft-ring {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75), 0 18px 40px rgba(79, 70, 229, 0.08);
        }

        .dot-grid {
            background-image: radial-gradient(rgba(79, 70, 229, 0.08) 1px, transparent 1px);
            background-size: 26px 26px;
        }

        .hero-glow {
            background:
                radial-gradient(ellipse 65% 55% at 20% 20%, rgba(79, 70, 229, 0.14) 0%, transparent 65%),
                radial-gradient(ellipse 55% 50% at 80% 30%, rgba(249, 115, 22, 0.11) 0%, transparent 60%);
        }
    </style>
</head>

<body class="antialiased font-sans text-[#0f172a] selection:bg-[#4f46e5]/20 selection:text-[#0f172a]">

    <nav class="fixed w-full z-50 glass border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}"
                        alt="SwapSkill Logo" class="w-10 h-10 rounded-xl object-cover border border-slate-200">
                    <span class="font-display text-xl tracking-tight text-[#0f172a]">Swap<span class="text-[#4f46e5]">Skill</span></span>
                </div>
                <div class="hidden md:flex space-x-8 items-center font-mono-tix text-xs uppercase tracking-widest text-[#64748b]">
                    <a href="#fitur" class="hover:text-[#4f46e5] transition">Fitur</a>
                    <a href="#cara-kerja" class="hover:text-[#4f46e5] transition">Cara Kerja</a>
                    <a href="#testimoni" class="hover:text-[#4f46e5] transition">Testimoni</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="font-mono-tix text-xs uppercase tracking-widest font-bold hover:text-[#4f46e5] transition">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="hidden sm:inline font-mono-tix text-xs uppercase tracking-widest text-[#64748b] hover:text-[#0f172a] transition">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-mono-tix text-xs uppercase tracking-widest font-bold px-5 py-2.5 rounded-xl bg-gradient-to-br from-[#4f46e5] to-[#f97316] text-white shadow-lg shadow-[#4f46e5]/20 hover:brightness-110 transition transform hover:-translate-y-0.5">Gabung Gratis</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 dot-grid pointer-events-none opacity-70"></div>
            <div class="absolute -top-48 left-1/2 -translate-x-1/2 w-[760px] h-[760px] hero-glow blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid gap-14 lg:grid-cols-[1.05fr_0.95fr] items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 font-mono-tix text-xs uppercase tracking-widest text-[#4f46e5]">
                        <span class="w-2 h-2 rounded-full bg-[#4f46e5] animate-pulse"></span>
                        Live Exchange — Real-time
                    </div>

                    <h1 class="font-display text-5xl md:text-6xl xl:text-[64px] leading-[1.05] tracking-tight text-[#0f172a] max-w-2xl">
                        Tempat skill <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4f46e5] to-[#f97316]">bertemu skill</span>, bukan sekadar listing.
                    </h1>

                    <p class="max-w-xl text-lg text-[#64748b] leading-relaxed">
                        SwapSkill menghubungkan kamu dengan orang yang punya skill yang kamu butuhkan — dan butuh skill yang kamu punya. Tanpa biaya, tanpa drama, langsung match.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-7 py-4 rounded-xl bg-gradient-to-br from-[#4f46e5] to-[#f97316] text-white font-bold text-sm shadow-lg shadow-[#4f46e5]/20 hover:brightness-110 transition transform hover:-translate-y-0.5">
                            Mulai Sekarang
                        </a>
                        <a href="#cara-kerja" class="inline-flex items-center justify-center px-7 py-4 rounded-xl glass text-[#0f172a] font-semibold text-sm hover:bg-slate-50 transition">
                            Lihat Cara Kerja
                        </a>
                    </div>

                    <div class="glass rounded-2xl p-5">
                        <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-slate-200 font-mono-tix text-center sm:text-left">
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold text-[#0f172a]">5.000+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#64748b] mt-1">Pengguna Aktif</p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold text-[#0f172a]">10.200+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#64748b] mt-1">Match Sukses</p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold text-[#0f172a]">500+</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#64748b] mt-1">Kategori Skill</p>
                            </div>
                            <div class="px-2 sm:px-4">
                                <p class="text-2xl font-bold text-[#0f172a]">Rp0</p>
                                <p class="text-[10px] uppercase tracking-widest text-[#64748b] mt-1">Biaya Selamanya</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-strong soft-ring rounded-2xl overflow-hidden max-w-md mx-auto lg:mx-0 w-full">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-200 bg-white/70">
                        <span class="w-3 h-3 rounded-full bg-[#ef4444]"></span>
                        <span class="w-3 h-3 rounded-full bg-[#eab308]"></span>
                        <span class="w-3 h-3 rounded-full bg-[#22c55e]"></span>
                        <span class="ml-3 font-mono-tix text-[11px] text-slate-400 uppercase tracking-widest">live-exchange.feed</span>
                    </div>
                    <div class="p-4 space-y-3 bg-white/60">
                        <div class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#4f46e5]/12 text-[#4f46e5] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#4f46e5]/20">UX</div>
                                <div>
                                    <p class="text-sm font-semibold text-[#0f172a]">UI/UX <span class="text-slate-300">⇄</span> Public Speaking</p>
                                    <p class="text-[11px] text-[#64748b] font-mono-tix">Dian &amp; Bagas — baru saja</p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#22c55e]"></span>
                        </div>
                        <div class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#f97316]/12 text-[#f97316] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#f97316]/20">XL</div>
                                <div>
                                    <p class="text-sm font-semibold text-[#0f172a]">Excel <span class="text-slate-300">⇄</span> Fotografi Produk</p>
                                    <p class="text-[11px] text-[#64748b] font-mono-tix">Sinta &amp; Reza — 4 menit lalu</p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#22c55e]"></span>
                        </div>
                        <div class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl bg-white border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-slate-100 text-[#4f46e5] flex items-center justify-center font-mono-tix text-xs font-bold border border-slate-200">DV</div>
                                <div>
                                    <p class="text-sm font-semibold text-[#0f172a]">Laravel <span class="text-slate-300">⇄</span> Copywriting</p>
                                    <p class="text-[11px] text-[#64748b] font-mono-tix">Rafi &amp; Putri — 12 menit lalu</p>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-[#eab308]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="relative py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#4f46e5]">Fitur</p>
                    <h2 class="mt-3 font-display text-3xl md:text-4xl text-[#0f172a]">Dibangun buat orang yang serius belajar.</h2>
                    <p class="mt-4 text-[#64748b] leading-relaxed">Tiga komponen inti yang bikin proses tukar skill terasa rapi dan bisa dipertanggungjawabkan.</p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <div class="glass rounded-2xl p-8 hover:border-[#4f46e5]/30 transition">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#4f46e5]/12 text-[#4f46e5] border border-[#4f46e5]/20 font-mono-tix font-bold text-sm">MT</div>
                        <h3 class="mt-6 text-xl font-display text-[#0f172a]">Match yang relevan</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Sistem nyocokin kamu sama orang yang skill-nya saling melengkapi, bukan asal tebak dari kata kunci.</p>
                    </div>
                    <div class="glass rounded-2xl p-8 hover:border-[#f97316]/30 transition">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#f97316]/12 text-[#f97316] border border-[#f97316]/20 font-mono-tix font-bold text-sm">PF</div>
                        <h3 class="mt-6 text-xl font-display text-[#0f172a]">Portofolio yang kebukti</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Setiap swap yang kelar otomatis nambah rekam jejak di profilmu, lengkap dengan review dari partner belajar.</p>
                    </div>
                    <div class="glass rounded-2xl p-8 hover:border-slate-300 transition">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-slate-100 text-[#0f172a] border border-slate-200 font-mono-tix font-bold text-sm">DK</div>
                        <h3 class="mt-6 text-xl font-display text-[#0f172a]">Obrolan tanpa drama</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Nego waktu, materi, sampai ekspektasi langsung di chat. Nggak perlu nunggu admin approve dulu.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cara-kerja" class="relative py-24 border-y border-slate-200 bg-[#f1f5f9]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#f97316]">Cara Kerja</p>
                    <h2 class="mt-3 font-display text-3xl md:text-4xl text-[#0f172a]">Tiga langkah, selesai.</h2>
                </div>

                <div class="mt-14 grid gap-10 lg:grid-cols-3 relative">
                    <div class="hidden lg:block absolute top-6 left-[16.5%] right-[16.5%] border-t border-dashed border-slate-300 z-0"></div>

                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold text-[#0f172a] bg-white">01</div>
                        <h3 class="mt-5 text-xl font-display text-[#0f172a]">Pajang skill-mu</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Tulis apa yang kamu kuasai dan apa yang lagi kamu kejar. Makin spesifik, makin gampang ketemu jodoh belajar.</p>
                    </div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold text-[#0f172a] bg-white">02</div>
                        <h3 class="mt-5 text-xl font-display text-[#0f172a]">Cocokin &amp; negoin</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Susuri profil yang ada, cek rating, terus mulai obrolan buat nentuin jadwal dan format swap-nya.</p>
                    </div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center glass font-mono-tix font-bold text-[#0f172a] bg-white">03</div>
                        <h3 class="mt-5 text-xl font-display text-[#0f172a]">Eksekusi &amp; kasih rating</h3>
                        <p class="mt-3 text-[#64748b] leading-relaxed">Jalanin sesi swap-nya, kelar itu saling kasih review biar kepercayaan komunitasnya makin kebangun.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimoni" class="relative py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#4f46e5]">Testimoni</p>
                    <h2 class="mt-3 font-display text-3xl md:text-4xl text-[#0f172a]">Kata mereka yang udah coba.</h2>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed text-[#0f172a]">"Biasanya nyari mentor itu ribet dan mahal. Di sini saya nuker jasa desain sama kelas public speaking, dua-duanya untung."</p>
                        <div class="mt-5 pt-4 border-t border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#4f46e5]/12 text-[#4f46e5] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#4f46e5]/20">D</div>
                                <div>
                                    <p class="font-semibold text-sm text-[#0f172a]">Dian</p>
                                    <p class="text-xs text-[#64748b]">UI/UX Designer</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#f97316]">★★★★★</p>
                        </div>
                    </div>
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed text-[#0f172a]">"Match-nya kerasa pas. Saya ajarin Laravel, partner saya ajarin saya copywriting buat dokumentasi teknis."</p>
                        <div class="mt-5 pt-4 border-t border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#f97316]/12 text-[#f97316] flex items-center justify-center font-mono-tix text-xs font-bold border border-[#f97316]/20">R</div>
                                <div>
                                    <p class="font-semibold text-sm text-[#0f172a]">Rafi</p>
                                    <p class="text-xs text-[#64748b]">Backend Developer</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#f97316]">★★★★★</p>
                        </div>
                    </div>
                    <div class="glass rounded-2xl p-6">
                        <p class="leading-relaxed text-[#0f172a]">"Nggak nyangka komunitasnya seaktif ini. Dalam seminggu udah dapat tiga partner swap yang serius."</p>
                        <div class="mt-5 pt-4 border-t border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-slate-200 text-[#0f172a] flex items-center justify-center font-mono-tix text-xs font-bold border border-slate-300">A</div>
                                <div>
                                    <p class="font-semibold text-sm text-[#0f172a]">Arif</p>
                                    <p class="text-xs text-[#64748b]">Product Manager</p>
                                </div>
                            </div>
                            <p class="font-mono-tix text-sm text-[#f97316]">★★★★★</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative py-24 overflow-hidden">
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[640px] h-[640px] hero-glow blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="glass-strong soft-ring rounded-2xl p-10 md:p-14 text-center">
                    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#4f46e5]">Siap mulai?</p>
                    <h2 class="mt-4 font-display text-3xl md:text-4xl text-[#0f172a]">Skill-mu berharga. Mulai tuker sekarang.</h2>
                    <p class="mt-4 text-[#64748b] leading-relaxed">Bikin profil dalam 5 menit, posting skill pertamamu, dan tunggu partner belajar pertama nyamperin.</p>
                    <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-8 py-4 rounded-xl bg-gradient-to-br from-[#4f46e5] to-[#f97316] text-white font-bold text-sm shadow-lg shadow-[#4f46e5]/20 hover:brightness-110 transition transform hover:-translate-y-0.5">
                        Daftar Sekarang, 100% Gratis
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 py-8 bg-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="font-mono-tix text-xs text-[#64748b] uppercase tracking-widest text-center sm:text-left">
                SwapSkill &copy; {{ date('Y') }} — Bursa tukar keahlian.</p>
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}"
                    alt="SwapSkill Logo" class="w-7 h-7 rounded-lg object-cover border border-slate-200">
                <span class="font-display text-[#0f172a]">Swap<span class="text-[#4f46e5]">Skill</span></span>
            </div>
        </div>
    </footer>

</body>

</html>

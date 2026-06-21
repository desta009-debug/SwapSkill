<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwapSkill - Platform Tukar Keahlian Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,700;9..144,900&display=swap" rel="stylesheet">
</head>
<body class="antialiased font-sans text-[#0F172A] selection:bg-[#F97316]/30 selection:text-[#0F172A] bg-gradient-to-b from-[#F8FAFC] via-[#EFF6FF] to-[#FFFBF7] overflow-x-hidden">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-xl border-b border-white/20 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo" class="w-10 h-10 rounded-xl object-cover shadow-sm border border-[#E2E8F0]">
                    <span class="font-fraunces font-black text-2xl tracking-tight text-[#0F172A]">Swap<span class="text-[#F97316]">Skill</span></span>
                </div>
                <div class="hidden md:flex space-x-8 items-center font-bold text-sm text-[#475569]">
                    <a href="#features" class="hover:text-[#4F46E5] transition">Fitur</a>
                    <a href="#how-it-works" class="hover:text-[#4F46E5] transition">Cara Kerja</a>
                    <a href="#testimonials" class="hover:text-[#4F46E5] transition">Testimoni</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-bold text-sm text-[#0F172A] hover:text-[#4F46E5] transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-sm text-[#0F172A] hover:text-[#4F46E5] transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-bold text-sm px-5 py-2.5 rounded-xl bg-[#0F172A] text-white hover:bg-[#4F46E5] transition shadow-lg hover:shadow-[#4F46E5]/30 transform hover:-translate-y-0.5">Mulai Gratis</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="relative overflow-hidden pt-24">
        <div class="absolute -left-24 top-24 w-72 h-72 rounded-full bg-[#4F46E5]/15 blur-3xl"></div>
        <div class="absolute right-0 top-40 w-96 h-96 rounded-full bg-[#F97316]/15 blur-3xl"></div>
        <div class="absolute left-1/2 top-[35rem] w-96 h-96 rounded-full bg-[#10B981]/15 blur-3xl"></div>

        <section class="relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto grid gap-10 lg:grid-cols-[1.05fr_0.95fr] items-center max-w-7xl">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-md border border-white/60 text-[#4F46E5] text-sm font-bold uppercase tracking-wider shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#F97316] animate-pulse"></span>
                        Bangun Skill, Dapatkan Partner
                    </div>

                    <h1 class="text-5xl md:text-6xl xl:text-7xl font-black tracking-tight text-[#0F172A] leading-tight">
                        Tukar keahlianmu dan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4F46E5] to-[#F97316]">kembangkan portofolio</span> bersama komunitas.
                    </h1>

                    <p class="max-w-2xl text-lg md:text-xl text-[#475569] leading-relaxed font-medium">
                        SwapSkill mempermudah kamu mencari partner belajar, berbagi skill, dan menciptakan kolaborasi nyata tanpa biaya.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-gradient-to-r from-[#4F46E5] to-[#4338CA] text-white font-bold text-base shadow-xl shadow-[#4F46E5]/30 hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300">
                            Mulai Sekarang
                        </a>
                        <a href="#how-it-works" class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-white/90 backdrop-blur-md border border-[#E2E8F0] text-[#0F172A] font-bold text-base hover:bg-white hover:shadow-md transition-all duration-300">
                            Pelajari Cara Kerja
                        </a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10">
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/60 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                            <p class="text-3xl font-fraunces font-black text-[#4F46E5]">5K+</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-[#64748B] mt-3">Pengguna</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/60 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                            <p class="text-3xl font-fraunces font-black text-[#F97316]">10K+</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-[#64748B] mt-3">Match Sukses</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/60 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                            <p class="text-3xl font-fraunces font-black text-[#10B981]">500+</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-[#64748B] mt-3">Kategori Skill</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/60 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                            <p class="text-3xl font-fraunces font-black text-[#0F172A]">100%</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-[#64748B] mt-3">Gratis</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[40px] bg-white/85 backdrop-blur-xl border border-white/60 shadow-[0_25px_80px_rgba(15,23,42,0.14)] p-10">
                        <p class="text-sm uppercase tracking-[0.24em] font-bold text-[#4F46E5] mb-4">Skill Marketplace</p>
                        <h2 class="text-3xl font-black text-[#0F172A] leading-tight">Terhubung dengan partner belajar yang tepat.</h2>
                        <p class="mt-4 text-[#64748B]">Jelajahi tawaran skill dan temukan orang yang ingin belajar hal yang kamu kuasai.</p>
                        <div class="mt-6 grid gap-4">
                            <div class="flex items-center gap-3 p-4 rounded-3xl bg-[#eef2ff]/80 border border-[#c7d2fe]/60 shadow-sm">
                                <div class="w-12 h-12 rounded-2xl bg-[#4F46E5]/10 text-[#4F46E5] flex items-center justify-center text-lg font-black">A</div>
                                <div>
                                    <p class="font-bold text-[#0F172A]">Cari Mentor</p>
                                    <p class="text-sm text-[#64748B]">Temukan partner belajar berdasarkan skill dan tujuanmu.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-4 rounded-3xl bg-[#ffedd5]/80 border border-[#fed7aa]/60 shadow-sm">
                                <div class="w-12 h-12 rounded-2xl bg-[#F97316]/10 text-[#F97316] flex items-center justify-center text-lg font-black">B</div>
                                <div>
                                    <p class="font-bold text-[#0F172A]">Tawarkan Keahlian</p>
                                    <p class="text-sm text-[#64748B]">Bangun reputasi lewat project dan portfolio nyata.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-4 rounded-3xl bg-[#ecfdf5]/80 border border-[#bbf7d0]/60 shadow-sm">
                                <div class="w-12 h-12 rounded-2xl bg-[#10B981]/10 text-[#10B981] flex items-center justify-center text-lg font-black">C</div>
                                <div>
                                    <p class="font-bold text-[#0F172A]">Mulai Diskusi</p>
                                    <p class="text-sm text-[#64748B]">Lakukan percakapan awal dan atur swap skill dengan mudah.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[40px] bg-gradient-to-br from-[#4F46E5]/10 via-white/80 to-[#F97316]/10 border border-white/60 backdrop-blur-xl shadow-[0_20px_60px_rgba(79,70,229,0.12)] p-10">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.24em] text-[#475569]">Komunitas</p>
                                <h3 class="mt-3 text-2xl font-black text-[#0F172A]">Rasakan dukungan langsung.</h3>
                            </div>
                            <span class="inline-flex items-center justify-center rounded-full bg-[#4F46E5]/10 text-[#4F46E5] px-4 py-2 text-sm font-bold">Top Rated</span>
                        </div>
                        <p class="mt-5 text-[#64748B]">Bergabung dengan komunitas yang saling bantu belajar dan memberikan feedback profesional.</p>
                        <div class="mt-6 grid gap-3">
                            <div class="rounded-3xl bg-white/90 p-4 border border-white/80 shadow-sm">
                                <p class="text-sm text-[#0F172A] font-bold">“SwapSkill membuat proses belajar lebih fokus dan tepat sasaran.”</p>
                                <p class="mt-3 text-xs text-[#64748B] uppercase tracking-[0.18em]">Dian, UI/UX Designer</p>
                            </div>
                            <div class="rounded-3xl bg-white/90 p-4 border border-white/80 shadow-sm">
                                <p class="text-sm text-[#0F172A] font-bold">“Koneksi mentor dan kolaborasi skill jadi lebih mudah.”</p>
                                <p class="mt-3 text-xs text-[#64748B] uppercase tracking-[0.18em]">Rafi, Backend Developer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="relative mt-24 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mx-auto max-w-2xl">
                    <p class="text-sm uppercase tracking-[0.24em] text-[#475569] font-bold">Fitur Unggulan</p>
                    <h2 class="mt-4 text-4xl font-black text-[#0F172A]">Semua tools yang kamu butuhkan untuk belajar dan berbagi.</h2>
                    <p class="mt-4 text-[#64748B] leading-relaxed">Mulai dari pencocokan skill hingga manajemen portfolio, semua dirancang agar pengalamanmu jadi lebih lancar dan efektif.</p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <div class="rounded-[28px] bg-white/85 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#4F46E5]/10 text-[#4F46E5] mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-[#0F172A]">Match pintar</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Algoritma cerdas membantu menemukan partner yang paling sesuai dengan skill dan tujuanmu.</p>
                    </div>
                    <div class="rounded-[28px] bg-white/85 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#F97316]/10 text-[#F97316] mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 2c-2.485 0-4.5 2.015-4.5 4.5V19h9v-4.5C16.5 12.015 14.485 10 12 10z" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-[#0F172A]">Portfolio kuat</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Simpan semua hasil kerja dan review di satu profil yang mudah dibagikan.</p>
                    </div>
                    <div class="rounded-[28px] bg-white/85 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#10B981]/10 text-[#10B981] mb-6 shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m-8 4h4m-4-8h8M6 18h12" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-[#0F172A]">Diskusi langsung</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Mulai percakapan dan rencanakan swap skill tanpa hambatan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="relative pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mx-auto max-w-2xl">
                    <p class="text-sm uppercase tracking-[0.24em] text-[#475569] font-bold">Bagaimana Cara Kerja</p>
                    <h2 class="mt-4 text-4xl font-black text-[#0F172A]">3 langkah mudah untuk mulai swap skill.</h2>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <div class="rounded-[28px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#4F46E5]/10 text-[#4F46E5] mb-6 font-black">1</div>
                        <h3 class="text-xl font-black text-[#0F172A]">Isi profil skill</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Tambahkan skill yang bisa diajarkan dan yang ingin dipelajari untuk hasil match terbaik.</p>
                    </div>
                    <div class="rounded-[28px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#F97316]/10 text-[#F97316] mb-6 font-black">2</div>
                        <h3 class="text-xl font-black text-[#0F172A]">Pilih partner cocok</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Jelajahi profil, lihat rating, dan pilih partner yang paling sesuai.</p>
                    </div>
                    <div class="rounded-[28px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#10B981]/10 text-[#10B981] mb-6 font-black">3</div>
                        <h3 class="text-xl font-black text-[#0F172A]">Mulai swap</h3>
                        <p class="mt-3 text-[#64748B] leading-relaxed">Lakukan swap skill, dapatkan feedback, dan perluas jaringan belajarmu.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="relative pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mx-auto max-w-2xl">
                    <p class="text-sm uppercase tracking-[0.24em] text-[#475569] font-bold">Testimoni</p>
                    <h2 class="mt-4 text-4xl font-black text-[#0F172A]">Dengar dari member yang sudah berhasil.</h2>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <div class="rounded-[32px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#4F46E5]/10 text-[#4F46E5] flex items-center justify-center font-black">D</div>
                            <div>
                                <p class="font-bold text-[#0F172A]">Dian</p>
                                <p class="text-sm text-[#64748B]">UI/UX Designer</p>
                            </div>
                        </div>
                        <p class="mt-6 text-[#475569] leading-relaxed">“SwapSkill membantu saya belajar cepat dan menemukan mentor yang benar-benar relevan.”</p>
                    </div>
                    <div class="rounded-[32px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#F97316]/10 text-[#F97316] flex items-center justify-center font-black">R</div>
                            <div>
                                <p class="font-bold text-[#0F172A]">Rafi</p>
                                <p class="text-sm text-[#64748B]">Backend Developer</p>
                            </div>
                        </div>
                        <p class="mt-6 text-[#475569] leading-relaxed">“Koneksi mentor dan proses swap skill jadi jauh lebih mudah.”</p>
                    </div>
                    <div class="rounded-[32px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#10B981]/10 text-[#10B981] flex items-center justify-center font-black">A</div>
                            <div>
                                <p class="font-bold text-[#0F172A]">Arif</p>
                                <p class="text-sm text-[#64748B]">Product Manager</p>
                            </div>
                        </div>
                        <p class="mt-6 text-[#475569] leading-relaxed">“Platform ini membantu saya menemukan mentor dan menukar skill tanpa ribet.”</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative pb-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-[32px] bg-white/90 backdrop-blur-xl border border-white/60 shadow-[0_30px_90px_rgba(15,23,42,0.08)] p-10 text-center">
                    <p class="text-sm uppercase tracking-[0.24em] text-[#4F46E5] font-bold">Siap mulai?</p>
                    <h2 class="mt-4 text-4xl font-black text-[#0F172A]">Bergabung dengan SwapSkill sekarang dan mulai tukar keahlian.</h2>
                    <p class="mt-4 text-[#64748B] leading-relaxed">Buat profil dan temukan partner belajar pertama kamu dalam hitungan menit.</p>
                    <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-10 py-4 rounded-3xl bg-gradient-to-r from-[#4F46E5] to-[#4338CA] text-white font-bold text-base shadow-xl shadow-[#4F46E5]/30 hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300">
                        Mulai Gratis
                    </a>
                </div>
            </div>
        </section>
    </main>

</body>
</html>

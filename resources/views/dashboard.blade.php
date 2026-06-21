<x-app-layout>
    @php
        $offerCount = $offeredSkills->count();
        $wantCount = $wantedSkills->count();

        $certCount = auth()->user()->certifications()->count();

        $profileCompletion = 0;
        $profileCompletion += $offerCount > 0 ? 25 : 0;
        $profileCompletion += $wantCount > 0 ? 25 : 0;
        $profileCompletion += $totalPortfolios > 0 ? 25 : 0;
        $profileCompletion += $certCount > 0 ? 25 : 0;

        if ($profileCompletion == 100) {
            $nextAction = 'Profilmu sempurna! Kredibilitasmu di Profil Publik sudah maksimal.';
        } elseif ($offerCount > 0 && $wantCount > 0) {
            $nextAction = 'Tambahkan portofolio atau sertifikasi untuk meningkatkan kredibilitas profil publikmu.';
        } elseif ($offerCount > 0 || $wantCount > 0) {
            $nextAction = 'Lengkapi sisi skill yang kosong agar profil publikmu makin menarik.';
        } else {
            $nextAction = 'Mulai dengan menambahkan skill yang bisa diajarkan & ingin dipelajari.';
        }
    @endphp

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8 relative">
        
        {{-- Background Elements for Glassmorphism --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#4F46E5]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#F97316]/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        {{-- HERO SECTION (Glassmorphism) --}}
        <div class="bg-gradient-to-br from-[#4F46E5] to-[#1E1B4B] rounded-[32px] shadow-[0_8px_30px_rgb(79,70,229,0.2)] p-8 sm:p-10 relative overflow-hidden text-white border border-white/10">
            <div class="absolute inset-0 opacity-30" style="background: radial-gradient(circle at top right, rgba(249,115,22,0.4), transparent 50%);"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="flex-1">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/20 bg-white/10 backdrop-blur-md text-[#F97316] text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-[#F97316] animate-pulse shadow-[0_0_8px_#F97316]"></span>
                        Selamat datang kembali
                    </span>
                    <h1 class="font-fraunces text-4xl sm:text-5xl font-black tracking-tight text-white drop-shadow-md">
                        Hai, {{ auth()->user()->name }}<span class="text-[#F97316]">.</span>
                    </h1>
                    <p class="mt-4 text-white/80 text-base max-w-2xl leading-relaxed font-medium">
                        SwapSkill mencocokkan skill yang bisa kamu ajarkan dengan skill yang ingin dipelajari pengguna lain. Lengkapi profil dan update skill supaya hasil match makin relevan dan akurat.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('skills.edit') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-sm font-bold rounded-2xl text-white bg-gradient-to-r from-[#F97316] to-[#EA580C] hover:opacity-90 transition-all duration-300 shadow-lg shadow-[#F97316]/40 transform hover:-translate-y-0.5">
                            Update Skill
                        </a>
                        <a href="{{ route('matches.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-white/30 text-sm font-bold rounded-2xl text-white bg-white/10 hover:bg-white/20 transition-all duration-300 backdrop-blur-md shadow-sm">
                            Lihat Matches
                        </a>
                    </div>
                </div>
                
                <div class="flex gap-4 w-full md:w-auto">
                    <div class="bg-white/10 rounded-[24px] p-6 border border-white/20 flex-1 md:w-40 flex flex-col justify-center text-center backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
                        <p class="text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Skill<br>Ditawarkan</p>
                        <p class="font-fraunces text-5xl font-black text-white drop-shadow-md">{{ $offerCount }}</p>
                    </div>
                    <div class="bg-white/10 rounded-[24px] p-6 border border-white/20 flex-1 md:w-40 flex flex-col justify-center text-center backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
                        <p class="text-xs font-bold text-white/70 uppercase tracking-wider mb-2">Skill<br>Dipelajari</p>
                        <p class="font-fraunces text-5xl font-black text-[#F97316] drop-shadow-md">{{ $wantCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            {{-- MAIN CONTENT (LEFT COLUMN) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- QUICK ACTIONS --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('skills.edit') }}" class="group bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] p-6 hover:shadow-lg hover:border-[#4F46E5]/40 transition-all duration-300 block">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#4F46E5]/10 to-[#4F46E5]/5 text-[#4F46E5] rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="font-fraunces text-xl font-bold text-[#0F172A]">Update Skill</h3>
                        <p class="text-sm text-[#64748B] mt-2 leading-relaxed">Perbarui skill offer dan target belajar kamu.</p>
                        <p class="text-sm font-bold text-[#4F46E5] mt-4 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Buka editor <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></p>
                    </a>
                    
                    <a href="{{ route('matches.index') }}" class="group bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] p-6 hover:shadow-lg hover:border-[#10B981]/40 transition-all duration-300 block">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#10B981]/10 to-[#10B981]/5 text-[#10B981] rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a4 4 0 110-8 4 4 0 010 8z" />
                            </svg>
                        </div>
                        <h3 class="font-fraunces text-xl font-bold text-[#0F172A]">Cari Match</h3>
                        <p class="text-sm text-[#64748B] mt-2 leading-relaxed">Lihat siapa yang cocok dengan skill kamu.</p>
                        <p class="text-sm font-bold text-[#10B981] mt-4 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Lihat matches <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></p>
                    </a>
                </div>

                {{-- STATISTICS --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] overflow-hidden">
                    <div class="p-8">
                        <h3 class="font-fraunces text-2xl font-bold text-[#0F172A] mb-8">Statistik Swap Kamu</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mt-8">
                            <div class="bg-slate-50/80 rounded-[20px] p-5 text-center border border-slate-200/60 shadow-sm">
                                <p class="text-[10px] font-bold text-[#64748B] uppercase tracking-widest">Total Swaps</p>
                                <p class="font-fraunces text-3xl font-black text-[#0F172A] mt-2">{{ $totalSwaps }}</p>
                            </div>
                            <div class="bg-emerald-50/80 rounded-[20px] p-5 text-center border border-emerald-200/60 shadow-sm">
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Completed</p>
                                <p class="font-fraunces text-3xl font-black text-emerald-600 mt-2">{{ $completedSwaps }}</p>
                            </div>
                            <div class="bg-purple-50/80 rounded-[20px] p-5 text-center border border-purple-200/60 shadow-sm">
                                <p class="text-[10px] font-bold text-purple-600 uppercase tracking-widest">Portofolio</p>
                                <p class="font-fraunces text-3xl font-black text-purple-600 mt-2">{{ $totalPortfolios }}</p>
                            </div>
                            <div class="bg-amber-50/80 rounded-[20px] p-5 text-center border border-amber-200/60 shadow-sm">
                                <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Dilihat</p>
                                <p class="font-fraunces text-3xl font-black text-amber-600 mt-2">{{ $totalPortfolioViews }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-8 bg-gradient-to-r from-[#4F46E5]/5 to-[#F97316]/5 rounded-[20px] p-6 flex items-center justify-between border border-[#4F46E5]/10 shadow-sm">
                            <div>
                                <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Tingkat Kesuksesan</p>
                                <p class="font-fraunces text-3xl font-black text-[#4F46E5] mt-1 drop-shadow-sm">{{ $successRate }}%</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Rata-rata Rating <span class="lowercase normal-case">({{ $user->received_ratings_count ?? 0 }} ulasan)</span></p>
                                <p class="font-fraunces text-3xl font-black text-[#F97316] mt-1 drop-shadow-sm">⭐ {{ number_format($user->received_ratings_avg_rating ?? 0, 1) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SKILLS LIST --}}
                <div class="grid sm:grid-cols-2 gap-8">
                    {{-- OFFER --}}
                    <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] p-8">
                        <h3 class="font-fraunces text-xl font-bold text-[#0F172A] mb-6 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#4F46E5] shadow-[0_0_8px_#4F46E5]"></span> Bisa Saya Ajarkan
                        </h3>
                        @if ($offeredSkills->isNotEmpty())
                            <div class="flex flex-wrap gap-2.5">
                                @foreach ($offeredSkills as $skill)
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-[#4F46E5]/10 text-[#4F46E5] border border-[#4F46E5]/20 shadow-sm">
                                        {{ $skill->name }}
                                        @if ($skill->pivot?->level)
                                            <span class="ml-2.5 px-2 py-0.5 bg-[#4F46E5]/20 rounded-md text-[10px] font-black uppercase tracking-wider">{{ $skill->pivot->level }}</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 border-2 border-dashed border-[#E2E8F0] rounded-[20px] bg-slate-50/50">
                                <p class="text-sm font-medium text-[#64748B]">Belum ada skill yang ditawarkan.</p>
                            </div>
                        @endif
                    </div>

                    {{-- WANT --}}
                    <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] p-8">
                        <h3 class="font-fraunces text-xl font-bold text-[#0F172A] mb-6 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#F97316] shadow-[0_0_8px_#F97316]"></span> Ingin Dipelajari
                        </h3>
                        @if ($wantedSkills->isNotEmpty())
                            <div class="flex flex-wrap gap-2.5">
                                @foreach ($wantedSkills as $skill)
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-[#F97316]/10 text-[#EA580C] border border-[#F97316]/20 shadow-sm">
                                        {{ $skill->name }}
                                        @if ($skill->pivot?->level)
                                            <span class="ml-2.5 px-2 py-0.5 bg-[#F97316]/20 rounded-md text-[10px] font-black uppercase tracking-wider">{{ $skill->pivot->level }}</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 border-2 border-dashed border-[#E2E8F0] rounded-[20px] bg-slate-50/50">
                                <p class="text-sm font-medium text-[#64748B]">Belum ada target belajar.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- SIDEBAR (RIGHT COLUMN) --}}
            <div class="space-y-8">
                
                {{-- PROFILE WIDGET --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] overflow-hidden">
                    <div class="p-6 bg-slate-50/50 border-b border-[#E2E8F0]">
                        <div class="flex items-center gap-4">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile" class="w-16 h-16 rounded-[20px] object-cover border-2 border-white shadow-md">
                            <div class="min-w-0">
                                <h3 class="font-fraunces text-xl font-bold text-[#0F172A] truncate">{{ auth()->user()->name }}</h3>
                                <p class="text-sm font-medium text-[#64748B] truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-6">
                            <div class="flex items-center gap-5">
                                <div class="relative w-16 h-16 flex-shrink-0">
                                    <svg class="w-16 h-16 transform -rotate-90 filter drop-shadow-sm">
                                        <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="6" fill="transparent" class="text-slate-200" />
                                        <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="6" fill="transparent" stroke-dasharray="175" stroke-dashoffset="{{ 175 - (175 * $profileCompletion / 100) }}" class="transition-all duration-1000 {{ $profileCompletion >= 80 ? 'text-[#10B981]' : 'text-[#F97316]' }}" stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-black {{ $profileCompletion >= 80 ? 'text-[#10B981]' : 'text-[#F97316]' }}">{{ $profileCompletion }}%</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-sm font-black text-[#0F172A] block uppercase tracking-wide">Progress Profil</span>
                                    <span class="text-xs font-medium text-[#64748B] mt-1 block">Selesaikan profil untuk match lebih baik</span>
                                </div>
                            </div>
                            <div class="mt-5 p-4 rounded-[16px] bg-[#4F46E5]/5 border border-[#4F46E5]/10">
                                <p class="text-xs font-semibold text-[#4F46E5] leading-relaxed">{{ $nextAction }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}" class="w-full block text-center px-4 py-3 border border-[#E2E8F0] shadow-sm text-sm font-bold rounded-xl text-[#0F172A] bg-white hover:bg-slate-50 transition-all hover:shadow-md">
                                Kelola Profil
                            </a>
                        </div>
                    </div>
                </div>

                {{-- NEXT MOVE --}}
                <div class="bg-gradient-to-br from-[#1E1B4B] to-[#4F46E5] rounded-[24px] shadow-lg p-8 text-white relative overflow-hidden border border-white/10">
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full bg-white/5 blur-xl"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 rounded-full bg-[#F97316]/20 blur-xl"></div>
                    
                    <div class="relative z-10">
                        <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-[#F97316] mb-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            Tips Sukses
                        </span>
                        <h3 class="font-fraunces text-2xl font-black mt-2 mb-6 drop-shadow-sm">Perbesar peluang match kamu</h3>
                        
                        <ul class="space-y-5">
                            <li class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-sm font-black border border-white/20 shadow-sm text-[#F97316]">1</div>
                                <p class="text-sm text-white/80 font-medium leading-relaxed">Tambahkan skill yang ditawarkan dan dipelajari dengan spesifik.</p>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-sm font-black border border-white/20 shadow-sm text-[#F97316]">2</div>
                                <p class="text-sm text-white/80 font-medium leading-relaxed">Unggah portofolio project dan sertifikasi untuk meningkatkan kredibilitas Profil Publikmu.</p>
                            </li>
                        </ul>
                        
                        <a href="{{ route('matches.index') }}" class="mt-8 block w-full text-center px-4 py-3.5 bg-white text-[#4F46E5] text-sm font-black rounded-xl hover:bg-slate-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Cari Partner Sekarang
                        </a>
                    </div>
                </div>

            </div>
            
        </div>

        <x-community-insights
            :community-statistics="$communityStatistics"
            :top-mentors="$topMentors"
            :top-skills="$topSkills"
            :recent-activities="$recentActivities"
            :show-all-link="true"
        />
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8 relative">

        {{-- Background Elements for Glassmorphism --}}
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-[#10B981]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute top-40 right-20 w-[300px] h-[300px] bg-[#4F46E5]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#E2E8F0] pb-6">
            <div>
                <h1 class="font-fraunces text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight">
                    Cari Partner <span class="text-[#10B981]">Match.</span>
                </h1>
                <p class="mt-2 text-sm sm:text-base text-[#64748B] max-w-2xl font-medium">Temukan partner yang bisa mengajarkan skill yang kamu butuhkan dan sebaliknya.</p>
            </div>
            
            <a href="{{ route('skills.edit') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/80 backdrop-blur-md border border-[#E2E8F0] shadow-sm text-sm font-bold rounded-xl text-[#0F172A] hover:bg-slate-50 hover:border-[#4F46E5]/30 transition-all hover:-translate-y-0.5">
                <svg class="w-4 h-4 text-[#4F46E5]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Perbarui Skill Kamu
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 p-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(count($matches) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($matches as $match)
                    <div class="group bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] hover:shadow-lg hover:border-[#4F46E5]/30 transition-all duration-300 flex flex-col overflow-hidden relative">
                        
                        {{-- Card Header --}}
                        <div class="p-6 border-b border-[#E2E8F0] bg-slate-50/50 relative">
                            {{-- Match Percentage Badge --}}
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider {{ $match['match_type'] === 'Mutual Match' ? 'bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20 shadow-[0_0_10px_rgba(16,185,129,0.2)]' : 'bg-[#4F46E5]/10 text-[#4F46E5] border border-[#4F46E5]/20 shadow-[0_0_10px_rgba(79,70,229,0.2)]' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    {{ $match['match_type'] }}
                                </span>
                            </div>

                            <div class="flex items-start gap-4 pr-20">
                                <img src="{{ $match['user']->profile_photo_url }}" alt="{{ $match['user']->name }}" class="w-14 h-14 rounded-[16px] object-cover shadow-sm border-2 border-white">
                                <div>
                                    <h3 class="font-fraunces text-lg font-bold text-[#0F172A] leading-tight group-hover:text-[#4F46E5] transition-colors">{{ $match['user']->name }}</h3>
                                    <div class="flex items-center gap-1 mt-1.5 text-xs font-bold text-[#F97316]">
                                        ⭐ {{ number_format($match['user']->received_ratings_avg_rating ?? 0, 1) }}
                                        <span class="text-[#64748B] font-medium ml-1">({{ $match['user']->received_ratings_count ?? 0 }} ulasan)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Card Body --}}
                        <div class="p-6 flex-1 space-y-6 bg-white/40">
                            
                            {{-- Matching Wants --}}
                            <div>
                                <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span> Dia ingin belajar
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($match['skills_they_want_from_me'] as $want)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20 shadow-sm">
                                            {{ $want->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Matching Offers --}}
                            <div>
                                <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#F97316]"></span> Dia bisa mengajarkan
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($match['skills_they_can_teach_me'] as $offer)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-[#F97316]/10 text-[#EA580C] border border-[#F97316]/20 shadow-sm">
                                            {{ $offer->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            
                            {{-- User Insight --}}
                            @if(isset($match['explanation']) && $match['explanation'])
                                <div class="mt-4 p-4 rounded-xl bg-gradient-to-br from-indigo-50/50 to-purple-50/50 border border-indigo-100/50">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 p-1.5 rounded-lg bg-indigo-100/80 text-indigo-600">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-indigo-900 uppercase tracking-wider mb-1">User Insight</p>
                                            <p class="text-sm text-slate-700 leading-relaxed font-medium">
                                                {{ $match['explanation'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        
                        {{-- Card Footer --}}
                        <div class="p-4 border-t border-[#E2E8F0] bg-slate-50/50">
                            <form action="{{ route('swap.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $match['user']->id }}">
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-[#4F46E5] to-[#4338CA] hover:opacity-90 shadow-lg shadow-[#4F46E5]/30 transition-all transform group-hover:scale-[1.02]">
                                    Kirim Request Swap
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white/80 backdrop-blur-xl rounded-[32px] shadow-sm border border-[#E2E8F0] p-12 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-slate-100 rounded-full blur-3xl -z-10"></div>
                <svg class="mx-auto h-20 w-20 text-[#64748B]/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="mt-6 font-fraunces text-2xl font-bold text-[#0F172A]">Belum ada Match</h3>
                <p class="mt-3 text-[#64748B] text-base max-w-md mx-auto">
                    Kami belum menemukan pengguna yang cocok dengan profil kamu saat ini. Coba tambahkan lebih banyak skill untuk memperbesar peluang.
                </p>
                <div class="mt-8">
                    <a href="{{ route('skills.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#F97316] to-[#EA580C] text-white text-sm font-bold rounded-2xl hover:opacity-90 transition-all shadow-lg shadow-[#F97316]/30">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Tambah Skill Baru
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>

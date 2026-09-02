<div class="lg:col-span-1 space-y-8">
    {{-- SECTION 1: PROFILE HERO --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 text-center relative overflow-hidden transition-all duration-300 hover:shadow-xl">
        {{-- Cover Banner --}}
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600">
            <div class="absolute inset-0 bg-white/10 backdrop-blur-[2px]"></div>
        </div>

        {{-- Avatar --}}
        <div class="relative z-10 mt-10 mb-4">
            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                class="w-28 h-28 rounded-full object-cover ring-4 ring-white shadow-xl mx-auto transition-transform duration-300 hover:scale-105">
        </div>

        {{-- Profile Details --}}
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">{{ $user->name }}</h1>
        <p class="text-xs font-semibold text-slate-400 mt-1 mb-3 flex items-center justify-center gap-1">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            {{ $user->email }}
        </p>

        {{-- Rating Badge & Member Since --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="flex items-center gap-1 text-amber-500 bg-amber-50/80 py-1.5 px-3 rounded-xl border border-amber-200/60 shadow-xs">
                <svg class="w-4 h-4 fill-amber-400" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="font-black text-xs text-slate-800">{{ number_format($user->received_ratings_avg_rating ?? 0, 1) }}</span>
                <span class="text-slate-400 text-[11px]">({{ $user->receivedRatings->count() }})</span>
            </div>
            <span class="text-[11px] font-semibold text-slate-400 bg-slate-100/80 px-2.5 py-1.5 rounded-xl">
                Member sejak {{ $user->created_at ? $user->created_at->format('M Y') : '-' }}
            </span>
        </div>

        {{-- Primary CTA --}}
        @if(Auth::id() !== $user->id)
        <div class="space-y-2">
            <a href="{{ route('matches.index') }}"
                class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-black rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg shadow-indigo-500/25 flex items-center justify-center gap-2 group hover:-translate-y-0.5">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                Start Skill Swap
            </a>
        </div>
        @endif
    </div>

    {{-- SECTION 2: QUICK STATS --}}
    <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 space-y-3">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Quick Stats</h3>
        <div class="grid grid-cols-2 gap-2.5">
            <div class="p-3 rounded-2xl bg-indigo-50/60 border border-indigo-100/60 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center shrink-0 shadow-xs font-black">
                    💼
                </div>
                <div>
                    <span class="block text-base font-black text-slate-800">{{ $user->portfolios->count() }}</span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider">Projects</span>
                </div>
            </div>

            <div class="p-3 rounded-2xl bg-purple-50/60 border border-purple-100/60 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-xs font-black">
                    🎓
                </div>
                <div>
                    <span class="block text-base font-black text-slate-800">{{ $user->offeredSkills->count() }}</span>
                    <span class="text-[10px] font-bold text-purple-600 uppercase tracking-wider">Can Teach</span>
                </div>
            </div>

            <div class="p-3 rounded-2xl bg-orange-50/60 border border-orange-100/60 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-orange-500 text-white flex items-center justify-center shrink-0 shadow-xs font-black">
                    🎯
                </div>
                <div>
                    <span class="block text-base font-black text-slate-800">{{ $user->wantedSkills->count() }}</span>
                    <span class="text-[10px] font-bold text-orange-600 uppercase tracking-wider">Want Learn</span>
                </div>
            </div>

            <div class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-100/60 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-xs font-black">
                    🏅
                </div>
                <div>
                    <span class="block text-base font-black text-slate-800">{{ $user->certifications->count() }}</span>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Certs</span>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 3: SKILLS (2-Column Layout inside Sidebar) --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="text-base">🟣</span>
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-wider">Skills I Can Teach</h3>
            </div>
            <p class="text-[11px] text-slate-400 font-medium mb-3">Keahlian utama yang dapat diajarkan</p>
            <div class="flex flex-wrap gap-2">
                @forelse($user->offeredSkills as $skill)
                <span class="px-3.5 py-2 bg-indigo-50/80 text-indigo-700 text-xs font-bold rounded-xl border border-indigo-100/80 hover:bg-indigo-100 transition-colors flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $skill->name }}
                </span>
                @empty
                <x-empty-state title="Belum ada skill ditawarkan." description="" variant="compact">
                    <x-slot:icon>
                        <svg class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </x-slot:icon>
                </x-empty-state>
                @endforelse
            </div>
        </div>

        <div class="pt-5 border-t border-slate-100">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-base">🟠</span>
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-wider">Skills I Want To Learn</h3>
            </div>
            <p class="text-[11px] text-slate-400 font-medium mb-3">Topik yang ingin dipelajari lewat swap</p>
            <div class="flex flex-wrap gap-2">
                @forelse($user->wantedSkills as $skill)
                <span class="px-3.5 py-2 bg-orange-50/80 text-orange-700 text-xs font-bold rounded-xl border border-orange-100/80 hover:bg-orange-100 transition-colors flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    {{ $skill->name }}
                </span>
                @empty
                <x-empty-state title="Belum ada skill yang ingin dipelajari." description="" variant="compact">
                    <x-slot:icon>
                        <svg class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </x-slot:icon>
                </x-empty-state>
                @endforelse
            </div>
        </div>
    </div>

    {{-- SECTION 6: ACHIEVEMENTS --}}
    @if(count($achievements) > 0)
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-lg">🏆</span>
            <div>
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-wider">Achievements</h3>
                <p class="text-[11px] text-slate-400 font-medium">Lencana pencapaian di SwapSkill</p>
            </div>
        </div>
        <div class="space-y-3">
            @foreach($achievements as $achievement)
            <div class="flex items-start gap-3 p-3.5 rounded-2xl border {{ $achievement['color'] }} bg-opacity-10 hover:shadow-xs transition-all duration-300">
                <div class="text-2xl p-1 bg-white rounded-xl shadow-xs shrink-0">{{ $achievement['icon'] }}</div>
                <div>
                    <h4 class="text-xs font-black text-slate-800">{{ $achievement['name'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5 leading-snug">{{ $achievement['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('portfolio.index') }}" class="p-2 bg-white/20 text-white rounded-xl hover:bg-white/30 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-fraunces text-2xl font-black text-white">Detail Portofolio</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Thumbnail --}}
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-[#E2E8F0]">
                        @if($portfolio->thumbnail)
                            <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full aspect-[16/9] object-cover">
                        @else
                            <div class="w-full aspect-[16/9] flex items-center justify-center bg-slate-100">
                                <svg class="w-24 h-24 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Title & Info --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-[#E2E8F0]">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-orange-100 text-[#F97316] text-xs font-black rounded-md mb-3">{{ $portfolio->category }}</span>
                                <h1 class="font-fraunces text-3xl font-black text-slate-800">{{ $portfolio->title }}</h1>
                            </div>
                            @can('update', $portfolio)
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('portfolio.edit', $portfolio) }}" class="p-2 bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('portfolio.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus portofolio ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-100 text-rose-600 rounded-xl hover:bg-rose-200 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>

                        <div class="prose max-w-none text-slate-600">
                            {!! nl2br(e($portfolio->description)) !!}
                        </div>

                        {{-- Technologies --}}
                        @if(!empty($portfolio->technologies))
                            <div class="mt-8 pt-8 border-t border-slate-100">
                                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-4">Teknologi yang Digunakan</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($portfolio->technologies as $tech)
                                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-sm font-bold rounded-lg border border-slate-200">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Links --}}
                        <div class="mt-8 pt-8 border-t border-slate-100 flex flex-wrap gap-4">
                            @if($portfolio->project_url)
                                <a href="{{ $portfolio->project_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    Kunjungi Project
                                </a>
                            @endif
                            @if($portfolio->github_url)
                                <a href="{{ $portfolio->github_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 text-slate-700 text-sm font-bold rounded-xl hover:bg-slate-200 transition-colors border border-slate-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                                    Repository Github
                                </a>
                            @endif
                            @if($portfolio->demo_url)
                                <a href="{{ $portfolio->demo_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-50 text-blue-600 text-sm font-bold rounded-xl hover:bg-blue-100 transition-colors border border-blue-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Live Demo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    
                    {{-- Creator Profile --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0]">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-6">Dibuat Oleh</h3>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <a href="{{ route('user.show', $portfolio->user) }}">
                                <img src="{{ $portfolio->user->profile_photo_url }}" alt="{{ $portfolio->user->name }}" class="w-16 h-16 rounded-2xl object-cover ring-2 ring-slate-100 shadow-sm">
                            </a>
                            <div>
                                <a href="{{ route('user.show', $portfolio->user) }}" class="text-lg font-black text-slate-800 hover:text-[#4F46E5] transition-colors">{{ $portfolio->user->name }}</a>
                                <div class="flex items-center gap-1 text-amber-500 mt-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="font-bold text-sm">{{ number_format($portfolio->user->received_ratings_avg_rating ?? 0, 1) }}</span>
                                    <span class="text-slate-400 text-xs">({{ $portfolio->user->receivedRatings->count() }} ulasan)</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            @if($portfolio->user->offeredSkills->count() > 0)
                                <div>
                                    <p class="text-xs font-bold text-slate-500 mb-2">Bisa Mengajarkan:</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($portfolio->user->offeredSkills->take(3) as $skill)
                                            <span class="px-2 py-1 bg-indigo-50 text-[#4F46E5] text-xs font-bold rounded-md">{{ $skill->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(Auth::id() !== $portfolio->user_id)
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('matches.index') }}" class="flex items-center justify-center gap-2 p-3 bg-[#4F46E5] text-white text-sm font-bold rounded-xl hover:bg-[#4338CA] transition-colors shadow-lg shadow-indigo-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                    Ajak Swap
                                </a>
                                <a href="{{ route('user.show', $portfolio->user) }}" class="flex items-center justify-center gap-2 p-3 bg-slate-100 text-slate-700 text-sm font-bold rounded-xl hover:bg-slate-200 transition-colors">
                                    Lihat Profil
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- AI Insight --}}
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-6 shadow-lg shadow-indigo-500/20 text-white relative overflow-hidden">
                        <!-- Decorative shapes -->
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white/10 blur-2xl"></div>
                        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-pink-500/20 blur-xl"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h3 class="font-black text-sm uppercase tracking-wider text-white/90">AI Insight</h3>
                            </div>
                            <p class="text-white/90 leading-relaxed font-medium text-sm">
                                {{ $aiRecommendation }}
                            </p>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0] flex justify-between items-center">
                        <div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-wider mb-1">Total Dilihat</p>
                            <p class="font-fraunces text-2xl font-black text-slate-800">{{ number_format($portfolio->views_count) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

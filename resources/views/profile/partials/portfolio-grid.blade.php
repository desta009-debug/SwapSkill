<div class="lg:col-span-3 space-y-8">
    {{-- SECTION 5: PORTFOLIO SHOWCASE --}}
    <div>
        <div class="flex items-center justify-between mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl">💼</span>
                    <h2 class="font-fraunces text-2xl font-black text-slate-800">Project Portfolio</h2>
                </div>
                <p class="text-xs font-semibold text-slate-400 mt-1">Real-world projects and software applications built by this member</p>
            </div>
            @if(Auth::id() === $user->id)
            <a href="{{ route('portfolio.create') }}"
                class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-500/25 hover:scale-105 transition-all duration-300 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Project
            </a>
            @endif
        </div>

        @if($user->portfolios->isEmpty())
        <x-empty-state title="Belum Ada Portofolio"
            description="Tunjukkan keahlianmu lewat project nyata dan bangun kredibilitas di komunitas SwapSkill."
            variant="large">
            <x-slot:icon>
                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </x-slot:icon>
        </x-empty-state>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($user->portfolios as $portfolio)
            <div
                class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                <a href="{{ route('portfolio.show', $portfolio) }}"
                    class="relative aspect-video block overflow-hidden bg-slate-100">
                    @if($portfolio->thumbnail)
                    <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div
                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50/80 via-purple-50/50 to-blue-50/80">
                        <svg class="w-12 h-12 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    @endif
                    @if($portfolio->featured)
                    <div
                        class="absolute top-3 right-3 bg-gradient-to-r from-amber-400 to-amber-500 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-xl shadow-lg shadow-amber-500/30 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Featured
                    </div>
                    @endif
                </a>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="mb-2">
                        <span class="inline-block px-2.5 py-1 bg-orange-50 text-orange-600 text-[10px] font-extrabold rounded-lg uppercase tracking-wider border border-orange-100/60 mb-1.5">
                            {{ $portfolio->category }}
                        </span>
                        <a href="{{ route('portfolio.show', $portfolio) }}" class="block">
                            <h3 class="text-base font-black text-slate-800 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                                {{ $portfolio->title }}
                            </h3>
                        </a>
                    </div>

                    <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('portfolio.show', $portfolio) }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center gap-1">
                            Visit Project
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- SECTION 4: VERIFIED CERTIFICATIONS --}}
    @include('profile.partials.certifications')

    {{-- SECTION 7: REVIEWS (Future Ready Placeholder) --}}
    <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm text-center relative overflow-hidden">
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="text-xl">⭐</span>
            <h3 class="font-fraunces text-xl font-black text-slate-800">Community Reviews</h3>
        </div>
        <p class="text-xs text-slate-400 max-w-md mx-auto mb-4">Feedback and reviews from members who completed skill swaps with {{ $user->name }}.</p>

        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-full text-xs font-bold text-slate-500 border border-slate-200">
            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
            Feature Coming Soon
        </div>
    </div>
</div>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-fraunces text-3xl font-black text-white flex items-center gap-3">
                    <div class="p-2.5 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    Talent Showcase
                </h2>
                <p class="mt-2 text-sm text-white/70 font-medium">Jelajahi karya dan portofolio terbaik dari komunitas SwapSkill.</p>
            </div>
            <a href="{{ route('portfolio.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-[#4F46E5] font-bold rounded-xl shadow-xl hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Tambah Portofolio
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Search & Filters --}}
            <div class="mb-8 bg-white rounded-2xl shadow-sm border border-[#E2E8F0] p-4">
                <form action="{{ route('portfolio.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari project, teknologi, atau deskripsi..." class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3 text-sm">
                    </div>
                    <div class="md:w-48">
                        <select name="category" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3 text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:w-48">
                        <select name="sort" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3 text-sm">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="most_viewed" {{ request('sort') == 'most_viewed' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                            <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Kreator Terbaik</option>
                        </select>
                    </div>
                    <label class="flex items-center gap-2 px-2 text-sm font-bold text-slate-600">
                        <input type="checkbox" name="featured" value="1" {{ request('featured') ? 'checked' : '' }} class="rounded border-slate-300 text-[#4F46E5] focus:ring-[#4F46E5]">
                        Featured
                    </label>
                    <button type="submit" class="px-6 py-3 bg-[#4F46E5] text-white font-bold rounded-xl shadow-md hover:bg-[#4338CA] transition-colors">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'category', 'sort', 'featured']))
                        <a href="{{ route('portfolio.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-colors text-center">Reset</a>
                    @endif
                </form>
            </div>

            {{-- Grid Gallery --}}
            @if($portfolios->isEmpty())
                <div class="bg-white rounded-3xl border border-[#E2E8F0] p-16 text-center shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2 font-fraunces">Belum Ada Portofolio</h3>
                    <p class="text-slate-500 max-w-md mx-auto mb-8 font-medium">Jadilah yang pertama untuk memamerkan keahlianmu. Tunjukkan kemampuanmu lewat project nyata dan bangun kredibilitas di komunitas SwapSkill.</p>
                    <a href="{{ route('portfolio.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#4F46E5] text-white font-bold rounded-xl shadow-xl hover:scale-105 transition-all">
                        Buat Portofolio Pertama
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($portfolios as $portfolio)
                        <div class="bg-white rounded-2xl overflow-hidden border border-[#E2E8F0] shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col">
                            {{-- Thumbnail --}}
                            <a href="{{ route('portfolio.show', $portfolio) }}" class="relative aspect-video block overflow-hidden bg-slate-100">
                                @if($portfolio->thumbnail)
                                    <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50">
                                        <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                {{-- Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                @if($portfolio->featured)
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-amber-400 to-amber-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-1 rounded-md shadow-lg shadow-amber-500/30 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        Featured
                                    </div>
                                @endif
                            </a>

                            {{-- Content --}}
                            <div class="p-4 flex flex-col flex-grow">
                                <a href="{{ route('portfolio.show', $portfolio) }}" class="block mb-1">
                                    <h3 class="text-base font-black text-slate-800 line-clamp-1 group-hover:text-[#4F46E5] transition-colors">{{ $portfolio->title }}</h3>
                                </a>
                                <p class="text-xs font-bold text-[#F97316] mb-3">{{ $portfolio->category }}</p>
                                
                                <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100">
                                    <a href="{{ route('user.show', $portfolio->user) }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                                        <img src="{{ $portfolio->user->profile_photo_url }}" alt="{{ $portfolio->user->name }}" class="w-6 h-6 rounded-md object-cover ring-1 ring-slate-200">
                                        <span class="text-xs font-bold text-slate-600 line-clamp-1">{{ $portfolio->user->name }}</span>
                                    </a>
                                    <div class="flex items-center gap-1 text-slate-400 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        {{ $portfolio->views_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $portfolios->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

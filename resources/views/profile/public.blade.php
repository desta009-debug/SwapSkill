<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                {{-- Left Sidebar: Profile Info & Achievements --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0] text-center relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-[#4F46E5] to-purple-600"></div>
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover ring-4 ring-white shadow-lg mx-auto relative z-10 mt-6 mb-4">
                        <h1 class="text-xl font-black text-slate-800">{{ $user->name }}</h1>
                        <p class="text-sm font-bold text-slate-500 mb-4">{{ $user->email }}</p>
                        
                        <div class="flex items-center justify-center gap-1 text-amber-500 bg-amber-50 py-2 px-4 rounded-xl inline-flex mx-auto border border-amber-100">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="font-black">{{ number_format($user->received_ratings_avg_rating ?? 0, 1) }}</span>
                            <span class="text-amber-700/60 text-xs ml-1">({{ $user->receivedRatings->count() }} ulasan)</span>
                        </div>

                        @if(Auth::id() !== $user->id)
                            <div class="mt-6 flex flex-col gap-2">
                                <a href="{{ route('matches.index') }}" class="w-full py-3 bg-[#4F46E5] text-white text-sm font-bold rounded-xl hover:bg-[#4338CA] transition-colors shadow-lg shadow-indigo-500/30">
                                    Ajak Swap
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Achievements --}}
                    @if(count($achievements) > 0)
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0]">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-4">Achievements</h3>
                            <div class="space-y-3">
                                @foreach($achievements as $achievement)
                                    <div class="flex items-start gap-3 p-3 rounded-xl border {{ $achievement['color'] }} bg-opacity-20">
                                        <div class="text-2xl">{{ $achievement['icon'] }}</div>
                                        <div>
                                            <h4 class="text-sm font-bold">{{ $achievement['name'] }}</h4>
                                            <p class="text-xs opacity-80 mt-0.5">{{ $achievement['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Skills Info --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0]">
                        <div class="mb-6">
                            <h3 class="text-sm font-black text-[#4F46E5] uppercase tracking-wider mb-3">Bisa Mengajarkan</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($user->offeredSkills as $skill)
                                    <span class="px-3 py-1.5 bg-indigo-50 text-[#4F46E5] text-xs font-bold rounded-lg border border-indigo-100">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-slate-400 text-xs italic">Belum ada skill yang ditawarkan.</span>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-[#F97316] uppercase tracking-wider mb-3">Ingin Mempelajari</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($user->wantedSkills as $skill)
                                    <span class="px-3 py-1.5 bg-orange-50 text-[#F97316] text-xs font-bold rounded-lg border border-orange-100">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-slate-400 text-xs italic">Belum ada skill yang ingin dipelajari.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Certifications --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E2E8F0]">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Sertifikasi</h3>
                            @if(Auth::id() === $user->id)
                                <button onclick="document.getElementById('cert-modal').classList.remove('hidden')" class="p-1.5 bg-indigo-50 text-[#4F46E5] rounded-lg hover:bg-indigo-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            @endif
                        </div>
                        <div class="space-y-4">
                            @forelse($user->certifications as $cert)
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 relative group">
                                    @if(Auth::id() === $user->id)
                                        <form action="{{ route('certifications.destroy', $cert) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus sertifikasi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-rose-100 text-rose-600 rounded-lg hover:bg-rose-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                    <h4 class="text-sm font-black text-slate-800">{{ $cert->name }}</h4>
                                    <p class="text-xs font-bold text-slate-500 mt-1">{{ $cert->organization }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider">Diterbitkan: {{ $cert->issue_date->format('M Y') }}</p>
                                    @if($cert->certificate_url)
                                        <a href="{{ $cert->certificate_url }}" target="_blank" class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#4F46E5] hover:underline">
                                            Lihat Kredensial <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-slate-500 italic text-center py-4">Belum ada sertifikasi yang ditambahkan.</p>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- Right Content: Portfolios --}}
                <div class="lg:col-span-3">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-fraunces text-2xl font-black text-slate-800">Portofolio Project</h2>
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('portfolio.create') }}" class="px-4 py-2 bg-[#4F46E5] text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/30 hover:scale-105 transition-all">
                                Tambah Project
                            </a>
                        @endif
                    </div>

                    @if($user->portfolios->isEmpty())
                        <div class="bg-white rounded-3xl border border-[#E2E8F0] p-16 text-center shadow-sm">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 mb-2 font-fraunces">Belum Ada Portofolio</h3>
                            <p class="text-slate-500 max-w-sm mx-auto font-medium">Tunjukkan keahlianmu lewat project nyata dan bangun kredibilitas di komunitas SwapSkill.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($user->portfolios as $portfolio)
                                <div class="bg-white rounded-2xl overflow-hidden border border-[#E2E8F0] shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col">
                                    <a href="{{ route('portfolio.show', $portfolio) }}" class="relative aspect-video block overflow-hidden bg-slate-100">
                                        @if($portfolio->thumbnail)
                                            <img src="{{ Storage::url($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50">
                                                <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        @if($portfolio->featured)
                                            <div class="absolute top-3 right-3 bg-gradient-to-r from-amber-400 to-amber-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-1 rounded-md shadow-lg shadow-amber-500/30 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                Featured
                                            </div>
                                        @endif
                                    </a>
                                    <div class="p-4 flex flex-col flex-grow">
                                        <a href="{{ route('portfolio.show', $portfolio) }}" class="block mb-1">
                                            <h3 class="text-base font-black text-slate-800 line-clamp-1 group-hover:text-[#4F46E5] transition-colors">{{ $portfolio->title }}</h3>
                                        </a>
                                        <p class="text-xs font-bold text-[#F97316] mb-3">{{ $portfolio->category }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @if(Auth::id() === $user->id)
    {{-- Add Certification Modal --}}
    <div id="cert-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="document.getElementById('cert-modal').classList.add('hidden')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl">
            <h3 class="font-fraunces text-2xl font-black text-slate-800 mb-6">Tambah Sertifikasi</h3>
            <form action="{{ route('certifications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Nama Sertifikasi</label>
                    <input type="text" name="name" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Penerbit / Organisasi</label>
                    <input type="text" name="organization" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Tanggal Terbit</label>
                    <input type="date" name="issue_date" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">URL Kredensial (Opsional)</label>
                    <input type="url" name="certificate_url" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Gambar Sertifikat (Opsional)</label>
                    <input type="file" name="image_path" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
                </div>
                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('cert-modal').classList.add('hidden')" class="px-6 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-[#4F46E5] text-white font-bold rounded-xl shadow-lg hover:bg-[#4338CA]">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</x-app-layout>

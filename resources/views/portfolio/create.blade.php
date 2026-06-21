<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('portfolio.index') }}" class="p-2 bg-white/20 text-white rounded-xl hover:bg-white/30 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-fraunces text-2xl font-black text-white">Tambah Portofolio</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-[#E2E8F0]">
                
                <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-2">Judul Project <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="Contoh: Aplikasi Manajemen Keuangan">
                        @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-black text-slate-700 mb-2">Kategori <span class="text-rose-500">*</span></label>
                            <select name="category" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-black text-slate-700 mb-2">Teknologi (Pisahkan dengan koma)</label>
                            <input type="text" name="technologies" value="{{ old('technologies') }}" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="Contoh: Laravel, Vue, Tailwind">
                            @error('technologies') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-2">Deskripsi Project <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="5" required class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="Ceritakan tentang project ini, masalah apa yang diselesaikan, dan bagaimana proses pembuatannya.">{{ old('description') }}</textarea>
                        @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-black text-slate-700 mb-2">URL Project</label>
                            <input type="url" name="project_url" value="{{ old('project_url') }}" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="https://...">
                            @error('project_url') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-black text-slate-700 mb-2">URL Github</label>
                            <input type="url" name="github_url" value="{{ old('github_url') }}" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="https://github.com/...">
                            @error('github_url') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-black text-slate-700 mb-2">URL Live Demo</label>
                            <input type="url" name="demo_url" value="{{ old('demo_url') }}" class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3" placeholder="https://...">
                            @error('demo_url') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-2">Thumbnail Project (Opsional)</label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB. Rasio terbaik 16:9.</p>
                        @error('thumbnail') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-amber-50 rounded-xl border border-amber-100">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded border-amber-300 text-amber-500 focus:ring-amber-500 w-5 h-5">
                        <label for="featured" class="text-sm font-bold text-amber-800">Tandai sebagai Featured Project</label>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="px-8 py-4 bg-[#4F46E5] text-white font-black rounded-xl shadow-xl shadow-indigo-500/30 hover:scale-105 transition-all">
                            Simpan Portofolio
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

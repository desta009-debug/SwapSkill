<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">

        {{-- Background Elements for Glassmorphism --}}
        <div
            class="absolute top-0 left-20 w-[400px] h-[400px] bg-[#4F46E5]/10 rounded-full blur-3xl -z-10 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-20 w-[300px] h-[300px] bg-[#F97316]/10 rounded-full blur-3xl -z-10 pointer-events-none">
        </div>

        {{-- Header Section --}}
        <div class="mb-10 text-center">
            <h1 class="font-fraunces text-4xl sm:text-5xl font-black text-[#0F172A] tracking-tight">
                Kelola <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-[#4F46E5] to-[#F97316]">Keahlianmu</span>
            </h1>
            <p class="mt-4 text-sm sm:text-base text-[#64748B] max-w-xl mx-auto font-medium">Pilih apa yang bisa kamu
                ajarkan dan apa yang ingin kamu pelajari. Sistem kami akan mencocokkanmu dengan partner yang tepat.</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 p-4 rounded-xl mb-8 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <ul class="list-disc pl-5 text-sm font-medium text-red-800">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('skills.update') }}" method="POST" x-data="{
            offers: {{ json_encode(array_map('strval', $selectedOffers)) }},
            wants: {{ json_encode(array_map('strval', $selectedWants)) }}
        }">
            @csrf

            <div class="grid lg:grid-cols-2 gap-8">

                {{-- OFFER CARD --}}
                <div
                    class="bg-white/80 backdrop-blur-xl rounded-[32px] shadow-sm overflow-hidden border border-[#E2E8F0] relative group hover:border-[#4F46E5]/40 transition-all duration-300">
                    <div class="absolute top-0 left-0 w-full h-2.5 bg-gradient-to-r from-[#4F46E5] to-[#4338CA]"></div>
                    <div class="p-8 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#4F46E5]/10 flex items-center justify-center text-[#4F46E5] shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-fraunces text-2xl font-black text-[#0F172A]">Bisa Saya Ajarkan</h2>
                                <p class="text-sm font-medium text-[#64748B] mt-1">Pilih skill yang Anda kuasai</p>
                            </div>
                        </div>

                        <div class="space-y-4 flex-1">
                            @foreach($skills as $skill)
                            <div class="border border-[#E2E8F0] rounded-[20px] p-4 transition-all duration-200 bg-white"
                                :class="{ 'border-[#4F46E5]/60 shadow-[0_4px_20px_rgb(79,70,229,0.1)] ring-1 ring-[#4F46E5]/20 bg-[#4F46E5]/5': offers.includes('{{ $skill->id }}'), 'opacity-50 bg-slate-50 grayscale': wants.includes('{{ $skill->id }}') }">
                                <label class="flex items-start gap-4 cursor-pointer"
                                    :class="{ 'cursor-not-allowed': wants.includes('{{ $skill->id }}') }">
                                    <div class="flex-shrink-0 mt-1">
                                        <input type="checkbox" name="offers[]" value="{{ $skill->id }}" x-model="offers"
                                            :disabled="wants.includes('{{ $skill->id }}')"
                                            class="w-5 h-5 text-[#4F46E5] border-[#E2E8F0] rounded focus:ring-[#4F46E5] transition disabled:opacity-50 disabled:cursor-not-allowed">
                                    </div>
                                    <div class="flex-1">
                                        <span class="block text-base font-bold text-[#0F172A] transition-colors"
                                            :class="{ 'text-[#4F46E5]': offers.includes('{{ $skill->id }}') }">
                                            {{ $skill->name }}
                                        </span>

                                        <div class="mt-4" x-show="offers.includes('{{ $skill->id }}')" x-collapse
                                            x-cloak>
                                            <select name="offer_levels[{{ $skill->id }}]"
                                                class="block w-full border-[#E2E8F0] rounded-xl shadow-sm focus:border-[#4F46E5] focus:ring-[#4F46E5] text-sm bg-white font-medium text-[#0F172A]"
                                                :required="offers.includes('{{ $skill->id }}')"
                                                :disabled="wants.includes('{{ $skill->id }}')">
                                                <option value="">-- Seberapa mahir Anda? --</option>
                                                <option value="beginner" {{ ($selectedOfferLevels[$skill->id] ?? '') ===
                                                    'beginner' ? 'selected' : '' }}>Pemula (Beginner)</option>
                                                <option value="intermediate" {{ ($selectedOfferLevels[$skill->id] ?? '')
                                                    === 'intermediate' ? 'selected' : '' }}>Menengah (Intermediate)
                                                </option>
                                                <option value="advanced" {{ ($selectedOfferLevels[$skill->id] ?? '') ===
                                                    'advanced' ? 'selected' : '' }}>Ahli (Advanced)</option>
                                            </select>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- WANT CARD --}}
                <div
                    class="bg-white/80 backdrop-blur-xl rounded-[32px] shadow-sm overflow-hidden border border-[#E2E8F0] relative group hover:border-[#F97316]/40 transition-all duration-300">
                    <div class="absolute top-0 left-0 w-full h-2.5 bg-gradient-to-r from-[#F97316] to-[#EA580C]"></div>
                    <div class="p-8 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#F97316]/10 flex items-center justify-center text-[#F97316] shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-fraunces text-2xl font-black text-[#0F172A]">Ingin Dipelajari</h2>
                                <p class="text-sm font-medium text-[#64748B] mt-1">Pilih skill yang Anda butuhkan</p>
                            </div>
                        </div>

                        <div class="space-y-4 flex-1">
                            @foreach($skills as $skill)
                            <div class="border border-[#E2E8F0] rounded-[20px] p-4 transition-all duration-200 bg-white"
                                :class="{ 'border-[#F97316]/60 shadow-[0_4px_20px_rgb(249,115,22,0.1)] ring-1 ring-[#F97316]/20 bg-[#F97316]/5': wants.includes('{{ $skill->id }}'), 'opacity-50 bg-slate-50 grayscale': offers.includes('{{ $skill->id }}') }">
                                <label class="flex items-start gap-4 cursor-pointer"
                                    :class="{ 'cursor-not-allowed': offers.includes('{{ $skill->id }}') }">
                                    <div class="flex-shrink-0 mt-1">
                                        <input type="checkbox" name="wants[]" value="{{ $skill->id }}" x-model="wants"
                                            :disabled="offers.includes('{{ $skill->id }}')"
                                            class="w-5 h-5 text-[#F97316] border-[#E2E8F0] rounded focus:ring-[#F97316] transition disabled:opacity-50 disabled:cursor-not-allowed">
                                    </div>
                                    <div class="flex-1">
                                        <span class="block text-base font-bold text-[#0F172A] transition-colors"
                                            :class="{ 'text-[#EA580C]': wants.includes('{{ $skill->id }}') }">
                                            {{ $skill->name }}
                                        </span>

                                        <div class="mt-4" x-show="wants.includes('{{ $skill->id }}')" x-collapse
                                            x-cloak>
                                            <select name="want_levels[{{ $skill->id }}]"
                                                class="block w-full border-[#E2E8F0] rounded-xl shadow-sm focus:border-[#F97316] focus:ring-[#F97316] text-sm bg-white font-medium text-[#0F172A]"
                                                :required="wants.includes('{{ $skill->id }}')"
                                                :disabled="offers.includes('{{ $skill->id }}')">
                                                <option value="">-- Target Level Anda? --</option>
                                                <option value="beginner" {{ ($selectedWantLevels[$skill->id] ?? '') ===
                                                    'beginner' ? 'selected' : '' }}>Mulai dari Nol (Beginner)</option>
                                                <option value="intermediate" {{ ($selectedWantLevels[$skill->id] ?? '')
                                                    === 'intermediate' ? 'selected' : '' }}>Ingin Lebih Mahir
                                                    (Intermediate)</option>
                                                <option value="advanced" {{ ($selectedWantLevels[$skill->id] ?? '') ===
                                                    'advanced' ? 'selected' : '' }}>Level Profesional (Advanced)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-12 flex justify-center pb-8">
                <button type="submit"
                    class="bg-gradient-to-r from-[#4F46E5] to-[#4338CA] text-white px-12 py-4 rounded-2xl text-base font-black tracking-wide shadow-xl shadow-[#4F46E5]/30 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
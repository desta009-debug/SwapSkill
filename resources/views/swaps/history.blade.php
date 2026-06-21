<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8 relative">

        {{-- Background Elements for Glassmorphism --}}
        <div class="absolute top-20 right-10 w-[300px] h-[300px] bg-[#F97316]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-10 w-[400px] h-[400px] bg-[#4F46E5]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#E2E8F0] pb-6">
            <div>
                <h1 class="font-fraunces text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight">
                    Riwayat <span class="text-[#F97316]">Swap.</span>
                </h1>
                <p class="mt-2 text-sm sm:text-base text-[#64748B] max-w-2xl font-medium">Lihat kembali perjalanan barter skill kamu, beri rating, dan pelajari pengalaman barumu.</p>
            </div>
            
            <a href="{{ route('swaps.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/80 backdrop-blur-md border border-[#E2E8F0] shadow-sm text-sm font-bold rounded-xl text-[#0F172A] hover:bg-slate-50 hover:border-[#F97316]/30 transition-all hover:-translate-y-0.5">
                <svg class="w-4 h-4 text-[#F97316]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Request
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

        <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] overflow-hidden relative">
            <div class="p-8">
                @if($completedSwaps->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-[#E2E8F0]">
                            <svg class="w-12 h-12 text-[#64748B]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="font-fraunces text-2xl font-bold text-[#0F172A]">Belum ada riwayat</h3>
                        <p class="mt-3 text-[#64748B] max-w-md mx-auto">Riwayat swap yang sudah selesai atau ditolak akan muncul di sini.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($completedSwaps as $swap)
                            @php
                                $partner = $swap->sender_id === auth()->id() ? $swap->receiver : $swap->sender;
                                $isCompleted = $swap->status === 'completed';
                                $isRejected = $swap->status === 'rejected';
                            @endphp
                            
                            <div class="border border-[#E2E8F0] rounded-[24px] bg-white hover:shadow-md transition-all flex flex-col md:flex-row overflow-hidden group">
                                
                                {{-- Kiri: Detail Swap --}}
                                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $partner->profile_photo_url }}" alt="{{ $partner->name }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm border border-[#E2E8F0]">
                                                <div>
                                                    <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider mb-1">Partner Swap</p>
                                                    <p class="font-fraunces text-xl font-bold text-[#0F172A]">{{ $partner->name }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                @if($isCompleted)
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                                        Selesai
                                                    </span>
                                                @elseif($isRejected)
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-red-50 text-red-600 border border-red-100">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm text-[#64748B] flex items-center gap-2 mt-4">
                                            <svg class="w-4 h-4 text-[#4F46E5]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Diperbarui: {{ $swap->updated_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- Kanan: Form Rating (Hanya jika Completed) --}}
                                <div class="bg-slate-50/80 p-6 md:w-1/3 border-t md:border-t-0 md:border-l border-[#E2E8F0] flex flex-col justify-center">
                                    @if($isCompleted)
                                        @php
                                            $existingRating = \App\Models\Rating::where('skill_swap_id', $swap->id)
                                                ->where('rater_id', auth()->id())
                                                ->first();
                                        @endphp
                                        
                                        @if($existingRating)
                                            <div class="text-center">
                                                <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider mb-2">Penilaian Kamu</p>
                                                <div class="flex justify-center text-[#F97316] text-xl gap-1 mb-3">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $existingRating->rating)
                                                            ★
                                                        @else
                                                            <span class="text-slate-300">★</span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                @if($existingRating->review)
                                                    <p class="text-sm text-[#0F172A] italic bg-white p-3 rounded-xl border border-[#E2E8F0] shadow-sm">"{{ $existingRating->review }}"</p>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                <p class="text-sm font-bold text-[#0F172A] mb-4 text-center">Beri Penilaian untuk {{ $partner->name }}</p>
                                                <form action="{{ route('ratings.store') }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    <input type="hidden" name="skill_swap_id" value="{{ $swap->id }}">
                                                    
                                                    <div class="flex justify-center gap-2 flex-row-reverse" x-data="{ hover: 0, rating: 0 }">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $swap->id }}_{{ $i }}" class="hidden" x-model="rating">
                                                            <label for="star{{ $swap->id }}_{{ $i }}" 
                                                                class="cursor-pointer text-3xl transition-colors"
                                                                :class="hover >= {{ $i }} || rating >= {{ $i }} ? 'text-[#F97316]' : 'text-slate-200'"
                                                                @mouseover="hover = {{ $i }}"
                                                                @mouseleave="hover = 0">
                                                                ★
                                                            </label>
                                                        @endfor
                                                    </div>
                                                    
                                                    <textarea name="review" rows="2" class="w-full text-sm border-[#E2E8F0] rounded-xl focus:ring-[#4F46E5] focus:border-[#4F46E5] placeholder-[#64748B]" placeholder="Tulis ulasan pengalaman belajarmu..."></textarea>
                                                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-[#4F46E5] to-[#4338CA] text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all shadow-sm">Kirim Penilaian</button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <div class="h-full flex items-center justify-center text-center">
                                            <p class="text-sm text-[#64748B] italic">Swap tidak selesai, tidak dapat memberikan penilaian.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

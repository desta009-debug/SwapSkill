<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8 relative">

        {{-- Background Elements for Glassmorphism --}}
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-[#4F46E5]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-[#F97316]/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#E2E8F0] pb-6">
            <div>
                <h1 class="font-fraunces text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight">
                    Swap <span class="text-[#4F46E5]">Requests.</span>
                </h1>
                <p class="mt-2 text-sm sm:text-base text-[#64748B] max-w-2xl font-medium">Kelola permintaan tukar skill yang masuk, keluar, maupun yang sedang berjalan.</p>
            </div>
            
            <a href="{{ route('swaps.history') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/80 backdrop-blur-md border border-[#E2E8F0] shadow-sm text-sm font-bold rounded-xl text-[#0F172A] hover:bg-slate-50 hover:border-[#4F46E5]/30 transition-all hover:-translate-y-0.5">
                <svg class="w-4 h-4 text-[#4F46E5]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Riwayat Swap
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: INCOMING & OUTGOING --}}
            <div class="space-y-8">
                
                {{-- INCOMING REQUESTS --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] overflow-hidden">
                    <div class="p-6 border-b border-[#E2E8F0] bg-slate-50/50 flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-orange-100 text-orange-600 font-bold shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                        </span>
                        <h2 class="font-fraunces text-xl font-bold text-[#0F172A]">Request Masuk <span class="text-[#64748B] text-base font-medium">({{ $incomingRequests->count() }})</span></h2>
                    </div>
                    
                    <div class="p-6">
                        @if($incomingRequests->isEmpty())
                            <div class="text-center py-8 border-2 border-dashed border-[#E2E8F0] rounded-[16px] bg-white/50">
                                <p class="text-sm font-medium text-[#64748B]">Belum ada request masuk.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($incomingRequests as $request)
                                    <div class="border border-[#E2E8F0] rounded-[20px] p-5 bg-white hover:border-[#4F46E5]/30 hover:shadow-md transition-all">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $request->sender->profile_photo_url }}" alt="{{ $request->sender->name }}" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                                <div>
                                                    <p class="font-bold text-[#0F172A]">{{ $request->sender->name }}</p>
                                                    <p class="text-xs text-[#64748B] font-medium">{{ $request->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-black uppercase tracking-wider">Menunggu</span>
                                        </div>
                                        
                                        <div class="mt-4 flex gap-2">
                                            <form action="{{ route('swaps.accept', $request) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full px-4 py-2 bg-[#10B981] text-white text-sm font-bold rounded-xl hover:bg-[#059669] transition-colors shadow-sm">Terima</button>
                                            </form>
                                            <form action="{{ route('swaps.reject', $request) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full px-4 py-2 bg-white border border-[#E2E8F0] text-red-600 text-sm font-bold rounded-xl hover:bg-red-50 hover:border-red-200 transition-colors">Tolak</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- OUTGOING REQUESTS --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-[24px] shadow-sm border border-[#E2E8F0] overflow-hidden">
                    <div class="p-6 border-b border-[#E2E8F0] bg-slate-50/50 flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-100 text-[#4F46E5] font-bold shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                        </span>
                        <h2 class="font-fraunces text-xl font-bold text-[#0F172A]">Request Terkirim <span class="text-[#64748B] text-base font-medium">({{ $outgoingRequests->count() }})</span></h2>
                    </div>
                    
                    <div class="p-6">
                        @if($outgoingRequests->isEmpty())
                            <div class="text-center py-8 border-2 border-dashed border-[#E2E8F0] rounded-[16px] bg-white/50">
                                <p class="text-sm font-medium text-[#64748B]">Kamu belum mengirim request ke siapapun.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($outgoingRequests as $request)
                                    <div class="border border-[#E2E8F0] rounded-[20px] p-5 bg-white hover:border-[#4F46E5]/30 hover:shadow-sm transition-all">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $request->receiver->profile_photo_url }}" alt="{{ $request->receiver->name }}" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                                <div>
                                                    <p class="font-bold text-[#0F172A]">Ke: {{ $request->receiver->name }}</p>
                                                    <p class="text-xs text-[#64748B] font-medium">{{ $request->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 bg-slate-100 text-[#64748B] rounded-lg text-xs font-black uppercase tracking-wider">Menunggu Balasan</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: ACTIVE SWAPS --}}
            <div>
                <div class="bg-gradient-to-br from-[#4F46E5] to-[#1E1B4B] rounded-[24px] shadow-xl p-1 overflow-hidden relative">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNGRkZGRkYiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] opacity-50 pointer-events-none"></div>
                    
                    <div class="bg-white/95 backdrop-blur-xl rounded-[22px] h-full">
                        <div class="p-6 border-b border-[#E2E8F0] flex items-center gap-3 bg-white/50 rounded-t-[22px]">
                            <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#10B981]/10 text-[#10B981] font-bold shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </span>
                            <h2 class="font-fraunces text-xl font-bold text-[#0F172A]">Swap Aktif <span class="text-[#64748B] text-base font-medium">({{ $activeSwaps->count() }})</span></h2>
                        </div>
                        
                        <div class="p-6">
                            @if($activeSwaps->isEmpty())
                                <div class="text-center py-10 border-2 border-dashed border-[#E2E8F0] rounded-[16px] bg-slate-50/50">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-[#64748B]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                    </div>
                                    <p class="text-sm font-medium text-[#64748B]">Belum ada swap yang aktif.</p>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach($activeSwaps as $swap)
                                        @php
                                            $partner = $swap->sender_id === auth()->id() ? $swap->receiver : $swap->sender;
                                        @endphp
                                        <div class="border border-[#E2E8F0] rounded-[20px] p-5 bg-white hover:border-[#4F46E5]/30 hover:shadow-md transition-all">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $partner->profile_photo_url }}" alt="{{ $partner->name }}" class="w-12 h-12 rounded-xl object-cover shadow-sm ring-2 ring-white">
                                                    <div>
                                                        <p class="font-bold text-[#0F172A]">{{ $partner->name }}</p>
                                                        <p class="text-xs text-[#64748B] font-medium flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5 text-[#10B981]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                            Aktif sejak {{ $swap->updated_at->format('d M Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-5 space-y-3">
                                                <a href="{{ route('messages.show', $swap) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] text-[#0F172A] text-sm font-bold rounded-xl hover:bg-white hover:border-[#4F46E5]/30 hover:text-[#4F46E5] transition-all shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                                    Buka Ruang Chat
                                                </a>
                                                
                                                <form action="{{ route('swaps.complete', $swap) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-r from-[#F97316] to-[#EA580C] text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-[#F97316]/30 flex items-center justify-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

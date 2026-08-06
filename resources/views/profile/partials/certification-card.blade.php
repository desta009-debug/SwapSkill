@if($cert->verification_status === 'verified')
<div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col cursor-pointer relative"
    onclick="openCertificateModal(this)"
    data-name="{{ $cert->name }}"
    data-org="{{ $cert->organization }}"
    data-date="{{ $cert->issue_date ? $cert->issue_date->format('d F Y') : '' }}"
    data-status="{{ $cert->verification_status }}"
    data-url="{{ $cert->certificate_url }}"
    data-image="{{ $cert->image_path ? Storage::url($cert->image_path) : '' }}"
    data-reason="{{ $cert->rejection_reason }}">

    @if(Auth::id() === $user->id)
    <form action="{{ route('certifications.destroy', $cert) }}" method="POST"
        class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity z-20"
        onsubmit="return confirm('Hapus sertifikasi ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="event.stopPropagation()"
            class="p-2 bg-white/90 text-rose-600 rounded-xl hover:bg-rose-100 transition-colors shadow-md backdrop-blur-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </form>
    @endif

    {{-- Top Preview Area (Image or Placeholder) --}}
    <div class="relative aspect-video block overflow-hidden bg-slate-100">
        @if($cert->image_path)
        <img src="{{ Storage::url($cert->image_path) }}" alt="{{ $cert->name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50/80 via-teal-50/60 to-indigo-50/80 group-hover:scale-105 transition-transform duration-500">
            <div class="w-14 h-14 rounded-2xl bg-emerald-600/10 border border-emerald-200/60 flex items-center justify-center text-emerald-600 text-2xl shadow-xs">
                📜
            </div>
            <span class="text-[11px] font-bold text-slate-400 mt-2">Verified Credential</span>
        </div>
        @endif

        {{-- Verified Badge --}}
        <div class="absolute top-3 left-3 z-10">
            <span class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-500/90 backdrop-blur-xs px-3 py-1 text-[11px] font-extrabold text-white shadow-lg shadow-emerald-500/20">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Verified
            </span>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="p-5 flex flex-col flex-grow">
        <div class="mb-3">
            <span class="inline-block text-[11px] font-bold text-indigo-600 uppercase tracking-wider mb-1">
                {{ $cert->organization }}
            </span>
            <h3 class="text-base font-black text-slate-800 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                {{ $cert->name }}
            </h3>
            @if($cert->issue_date)
            <p class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Terbit: {{ $cert->issue_date->format('d F Y') }}
            </p>
            @endif
        </div>

        {{-- Footer Actions --}}
        <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
            @if($cert->certificate_url)
            <a href="{{ $cert->certificate_url }}" target="_blank" onclick="event.stopPropagation()"
                class="text-xs font-bold text-slate-500 hover:text-indigo-600 hover:underline flex items-center gap-1">
                🔗 Kredensial
            </a>
            @else
            <span></span>
            @endif

            <span class="text-xs font-bold text-indigo-600 group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                View Details
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </span>
        </div>
    </div>
</div>
@endif

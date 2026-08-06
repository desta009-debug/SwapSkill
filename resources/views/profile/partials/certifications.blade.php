<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <div class="flex items-center gap-2">
                <span class="text-2xl">🏅</span>
                <h2 class="font-fraunces text-2xl font-black text-slate-800">Verified Certifications</h2>
            </div>
            <p class="text-xs font-semibold text-slate-400 mt-1">Professional certifications earned by this member</p>
        </div>
        @if(Auth::id() === $user->id)
        <button onclick="document.getElementById('cert-modal').classList.remove('hidden')"
            class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-500/25 hover:scale-105 transition-all duration-300 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Sertifikasi
        </button>
        @endif
    </div>

    @if($user->certifications->where('verification_status', 'verified')->isEmpty())
    <x-empty-state title="Belum ada sertifikasi yang ditambahkan." description="" variant="large">
        <x-slot:icon>
            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </x-slot:icon>
    </x-empty-state>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($user->certifications as $cert)
            @include('profile.partials.certification-card', ['cert' => $cert])
        @endforeach
    </div>
    @endif
</div>

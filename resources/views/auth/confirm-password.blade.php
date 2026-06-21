<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Password - SwapSkill</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-linear-to-br from-[#0b1020] via-[#151a33] to-[#1e1b4b] text-white">
    <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto grid min-h-[92vh] max-w-5xl overflow-hidden rounded-[28px] border border-white/10 bg-white/5 shadow-[0_20px_80px_rgba(76,29,149,0.28)] backdrop-blur-xl lg:grid-cols-2">
            <div class="relative hidden overflow-hidden bg-linear-to-br from-[#0f172a] via-[#1e1b4b] to-[#312e81] p-8 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="absolute inset-0 opacity-30">
                    <div class="absolute -left-10 top-10 h-36 w-36 rounded-full bg-violet-500 blur-3xl"></div>
                    <div class="absolute bottom-10 right-10 h-44 w-44 rounded-full bg-fuchsia-500 blur-3xl"></div>
                </div>

                <div class="relative z-10">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                        <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo" class="h-12 w-12 rounded-2xl object-cover ring-1 ring-white/20 shadow-lg">
                        <div>
                            <h1 class="text-xl font-extrabold tracking-tight">SwapSkill</h1>
                            <p class="text-sm text-white/60">Tukar skill. Naik level.</p>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 max-w-md">
                    <span class="inline-flex rounded-full border border-violet-400/30 bg-white/10 px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-violet-200">
                        Keamanan akun
                    </span>

                    <h2 class="mt-5 text-4xl font-extrabold leading-tight tracking-tight">
                        Konfirmasi password
                        <span class="bg-linear-to-r from-violet-300 to-fuchsia-300 bg-clip-text text-transparent">
                            sebelum lanjut.
                        </span>
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-white/70">
                        Masukkan password saat ini untuk mengakses area penting dengan aman.
                    </p>

                    <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-sm text-white/60">Keamanan</p>
                        <h3 class="mt-1 text-base font-bold text-white">Verifikasi identitas</h3>
                        <p class="mt-2 text-sm leading-6 text-white/55">
                            Pastikan hanya kamu yang bisa lanjut ke proses ini.
                        </p>
                    </div>
                </div>

                <div class="relative z-10 text-sm text-white/40">
                    © {{ date('Y') }} SwapSkill. Semua hak dilindungi.
                </div>
            </div>

            <div class="flex items-center justify-center bg-white/5 p-6 sm:p-8">
                <div class="w-full max-w-md">
                    <div class="mb-6 flex flex-col items-center text-center lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3">
                            <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo" class="h-14 w-14 rounded-2xl object-cover shadow-md">
                            <div>
                                <h1 class="text-2xl font-extrabold text-white">SwapSkill</h1>
                                <p class="text-sm text-white/60">Tukar skill. Naik level.</p>
                            </div>
                        </a>
                    </div>

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-violet-300">Konfirmasi password</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-white">Masukkan password kamu</h2>
                        <p class="mt-2 text-sm leading-6 text-white/55">
                            Ini adalah langkah keamanan tambahan sebelum kamu melanjutkan.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="password" class="mb-2 block text-xs font-medium uppercase tracking-widest text-white/50">Password Saat Ini</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password" autofocus placeholder="Masukkan password kamu"
                                class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white placeholder-white/25 outline-none transition focus:border-violet-400 focus:bg-violet-400/10 focus:ring-4 focus:ring-violet-500/15">
                            @error('password')
                                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-linear-to-r from-violet-600 to-fuchsia-500 px-5 py-3 text-sm font-bold text-white shadow-[0_10px_30px_rgba(139,92,246,0.35)] transition hover:-translate-y-0.5 hover:opacity-95 active:scale-[0.99]">
                            Konfirmasi Sekarang →
                        </button>
                    </form>

                    <div class="mt-6 border-t border-white/10 pt-5 text-center">
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-white/45 transition hover:text-white/70">
                            ← Kembali ke dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
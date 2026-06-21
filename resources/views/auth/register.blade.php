<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SwapSkill</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen text-white" style="background: linear-gradient(to bottom right, #0D1A63, #1A2CA3, #2845D6);">
    <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto grid min-h-[92vh] max-w-5xl overflow-hidden rounded-[28px] shadow-[0_20px_80px_rgba(40,69,214,0.35)] backdrop-blur-xl lg:grid-cols-2" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
            
            <!-- Left Panel -->
            <div class="relative hidden overflow-hidden p-8 text-white lg:flex lg:flex-col lg:justify-between" style="background: linear-gradient(to bottom right, #0D1A63, #1A2CA3, #2845D6);">
                <div class="absolute inset-0 opacity-30">
                    <div class="absolute -left-10 top-10 h-36 w-36 rounded-full blur-3xl" style="background-color: #2845D6;"></div>
                    <div class="absolute bottom-10 right-10 h-44 w-44 rounded-full blur-3xl" style="background-color: #F68048;"></div>
                </div>

                <div class="relative z-10">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                        <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo" class="h-12 w-12 rounded-2xl object-cover shadow-lg" style="ring: 1px solid rgba(255,255,255,0.2);">
                        <div>
                            <h1 class="text-xl font-extrabold tracking-tight">SwapSkill</h1>
                            <p class="text-sm" style="color: rgba(255,255,255,0.6);">Tukar skill. Naik level.</p>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 max-w-md">
                    <span class="inline-flex rounded-full px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.2em]" style="border: 1px solid rgba(246,128,72,0.4); background: rgba(255,255,255,0.1); color: #F68048;">
                        Mulai perjalananmu
                    </span>

                    <h2 class="mt-5 text-4xl font-extrabold leading-tight tracking-tight">
                        Buat akun dan mulai
                        <span style="background: linear-gradient(to right, #F68048, #ffaa7a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            tukar skill.
                        </span>
                    </h2>

                    <p class="mt-4 text-sm leading-7" style="color: rgba(255,255,255,0.7);">
                        Tawarkan skill yang kamu kuasai, pilih skill yang ingin dipelajari, lalu terhubung langsung dengan partner belajar yang cocok.
                    </p>

                    <div class="mt-6 rounded-2xl p-4" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                        <p class="text-sm" style="color: rgba(255,255,255,0.6);">Nilai utama</p>
                        <h3 class="mt-1 text-base font-bold text-white">Belajar lebih terjangkau</h3>
                        <p class="mt-2 text-sm leading-6" style="color: rgba(255,255,255,0.55);">
                            Skill yang kamu punya bisa jadi jalan untuk belajar skill baru.
                        </p>
                    </div>
                </div>

                <div class="relative z-10 text-sm" style="color: rgba(255,255,255,0.4);">
                    © {{ date('Y') }} SwapSkill. Semua hak dilindungi.
                </div>
            </div>

            <!-- Right Panel -->
            <div class="flex items-center justify-center p-6 sm:p-8" style="background: rgba(255,255,255,0.05);">
                <div class="w-full max-w-md">
                    <div class="mb-6 flex flex-col items-center text-center lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3">
                            <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo" class="h-14 w-14 rounded-2xl object-cover shadow-md">
                            <div>
                                <h1 class="text-2xl font-extrabold text-white">SwapSkill</h1>
                                <p class="text-sm" style="color: rgba(255,255,255,0.6);">Tukar skill. Naik level.</p>
                            </div>
                        </a>
                    </div>

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: #F68048;">Buat akun</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-white">Daftar ke SwapSkill</h2>
                        <p class="mt-2 text-sm leading-6" style="color: rgba(255,255,255,0.55);">
                            Lengkapi data dirimu untuk mulai mencari partner belajar yang cocok.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="name" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Nama</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama kamu"
                                class="w-full rounded-2xl px-4 py-3 text-sm text-white outline-none transition"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1); placeholder-color: rgba(255,255,255,0.25);"
                                onfocus="this.style.borderColor='#F68048'; this.style.background='rgba(246,128,72,0.1)'; this.style.boxShadow='0 0 0 4px rgba(246,128,72,0.15)';"
                                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.1)'; this.style.boxShadow='none';">
                            @error('name')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com"
                                class="w-full rounded-2xl px-4 py-3 text-sm text-white outline-none transition"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1);"
                                onfocus="this.style.borderColor='#F68048'; this.style.background='rgba(246,128,72,0.1)'; this.style.boxShadow='0 0 0 4px rgba(246,128,72,0.15)';"
                                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.1)'; this.style.boxShadow='none';">
                            @error('email')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Nomor WhatsApp</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="Contoh: 081234567890"
                                class="w-full rounded-2xl px-4 py-3 text-sm text-white outline-none transition"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1);"
                                onfocus="this.style.borderColor='#F68048'; this.style.background='rgba(246,128,72,0.1)'; this.style.boxShadow='0 0 0 4px rgba(246,128,72,0.15)';"
                                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.1)'; this.style.boxShadow='none';">
                            @error('phone')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Profil -->
                        <div>
                            <label for="profile_photo" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Foto Profil</label>
                            <input id="profile_photo" type="file" name="profile_photo" accept="image/*"
                                class="block w-full rounded-2xl px-4 py-3 text-sm text-white"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1);">
                            @error('profile_photo')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat password"
                                class="w-full rounded-2xl px-4 py-3 text-sm text-white outline-none transition"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1);"
                                onfocus="this.style.borderColor='#F68048'; this.style.background='rgba(246,128,72,0.1)'; this.style.boxShadow='0 0 0 4px rgba(246,128,72,0.15)';"
                                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.1)'; this.style.boxShadow='none';">
                            @error('password')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-xs font-medium uppercase tracking-widest" style="color: rgba(255,255,255,0.5);">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                                class="w-full rounded-2xl px-4 py-3 text-sm text-white outline-none transition"
                                style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.1);"
                                onfocus="this.style.borderColor='#F68048'; this.style.background='rgba(246,128,72,0.1)'; this.style.boxShadow='0 0 0 4px rgba(246,128,72,0.15)';"
                                onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.1)'; this.style.boxShadow='none';">
                            @error('password_confirmation')
                                <p class="mt-2 text-sm" style="color: #fca5a5;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl px-5 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:opacity-95 active:scale-[0.99]"
                            style="background: linear-gradient(to right, #1A2CA3, #F68048); box-shadow: 0 10px 30px rgba(246,128,72,0.35);">
                            Daftar Sekarang →
                        </button>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="text-sm" style="color: rgba(255,255,255,0.5);">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-semibold transition hover:opacity-80" style="color: #F68048;">Masuk di sini</a>
                        </p>
                    </div>

                    <div class="mt-6 pt-5 text-center" style="border-top: 1px solid rgba(255,255,255,0.1);">
                        <a href="{{ url('/') }}" class="text-sm font-medium transition hover:opacity-70" style="color: rgba(255,255,255,0.45);">
                            ← Kembali ke landing page
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<section class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">
    <div class="bg-linear-to-r from-slate-950 via-violet-950 to-slate-900 px-8 py-8 text-white">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-5">
                <img
                    src="{{ $user->profile_photo_url }}"
                    alt="{{ $user->name }}"
                    class="h-24 w-24 rounded-3xl object-cover ring-4 ring-white/10"
                >

                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-200">
                        Profil pengguna
                    </p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight">
                        Informasi akun
                    </h2>
                    <p class="mt-2 max-w-2xl text-sm leading-7 text-white/65">
                        Update nama, email, nomor WhatsApp, dan foto profil agar profilmu lebih meyakinkan saat muncul di halaman match.
                    </p>
                </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-sm text-white/75">
                <p class="font-semibold text-white">Preview akun</p>
                <p class="mt-1">{{ $user->email }}</p>
                <p class="mt-1">{{ $user->phone ?: 'Nomor belum diisi' }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('patch')

        <div class="grid gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="profile_photo" class="mb-2 block text-sm font-semibold text-slate-700">
                    Foto Profil
                </label>

                <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-5 sm:flex-row sm:items-center">
                    <img
                        src="{{ $user->profile_photo_url }}"
                        alt="{{ $user->name }}"
                        class="h-20 w-20 rounded-2xl object-cover"
                    >

                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-700">
                            Upload foto yang clean dan jelas.
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            Ini akan tampil langsung di halaman match.
                        </p>
                    </div>

                    <input
                        id="profile_photo"
                        name="profile_photo"
                        type="file"
                        accept="image/*"
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-violet-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-violet-700 sm:max-w-xs"
                    >
                </div>

                @error('profile_photo')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                    Nama
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
                >
                @error('name')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700">
                    Nomor WhatsApp
                </label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone', $user->phone) }}"
                    autocomplete="tel"
                    placeholder="Contoh: 081234567890"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
                >
                @error('phone')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                    Email
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
                >
                @error('email')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4">
                        <p class="text-sm text-amber-700">
                            Email kamu belum diverifikasi.
                            <button
                                form="send-verification"
                                class="ml-1 font-semibold underline transition hover:text-amber-800"
                            >
                                Kirim ulang email verifikasi
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-emerald-600">
                                Link verifikasi baru sudah dikirim.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-8 flex flex-wrap items-center gap-4">
            <button
                type="submit"
                class="inline-flex items-center rounded-2xl bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-700"
            >
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-600"
                >
                    Profil berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>
</section>
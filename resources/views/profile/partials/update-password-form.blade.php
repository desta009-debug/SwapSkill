<section class="rounded-[28px] border border-emerald-100 bg-white p-8 shadow-sm">
    <header>
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-500">
            Keamanan akun
        </p>
        <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
            Ubah kata sandi
        </h2>
        <p class="mt-3 text-sm leading-7 text-slate-500">
            Gunakan kata sandi yang kuat agar akunmu tetap aman.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="mb-2 block text-sm font-semibold text-slate-700">
                Kata Sandi Saat Ini
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            >
            @if ($errors->updatePassword->get('current_password'))
                <p class="mt-2 text-sm text-rose-500">
                    {{ $errors->updatePassword->first('current_password') }}
                </p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="mb-2 block text-sm font-semibold text-slate-700">
                Kata Sandi Baru
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            >
            @if ($errors->updatePassword->get('password'))
                <p class="mt-2 text-sm text-rose-500">
                    {{ $errors->updatePassword->first('password') }}
                </p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                Konfirmasi Kata Sandi Baru
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-sm text-slate-800 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            >
            @if ($errors->updatePassword->get('password_confirmation'))
                <p class="mt-2 text-sm text-rose-500">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </p>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button
                type="submit"
                class="inline-flex items-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
            >
                Ubah Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-600"
                >
                    Kata sandi berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
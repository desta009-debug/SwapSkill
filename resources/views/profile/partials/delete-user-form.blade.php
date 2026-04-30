<section class="rounded-[28px] border border-rose-100 bg-white p-8 shadow-sm">
    <header>
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-rose-400">
            Zona berisiko
        </p>
        <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
            Hapus akun
        </h2>
        <p class="mt-3 text-sm leading-7 text-slate-500">
            Setelah akun dihapus, semua data dan resource yang terkait akan ikut terhapus permanen.
            Pastikan kamu benar-benar yakin sebelum melanjutkan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="mt-8 inline-flex items-center rounded-2xl bg-rose-500 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-600"
    >
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" maxWidth="2xl">
        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
            @csrf
            @method('delete')

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-rose-400">
                    Konfirmasi penghapusan
                </p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                    Yakin ingin menghapus akun?
                </h2>

                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Setelah akun dihapus, semua data akan hilang permanen. Masukkan kata sandimu untuk
                    mengonfirmasi bahwa kamu benar-benar ingin menghapus akun ini.
                </p>
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                    Kata sandi
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-100"
                    placeholder="Masukkan kata sandi"
                >

                @if ($errors->userDeletion->get('password'))
                    <p class="mt-2 text-sm text-rose-500">
                        {{ $errors->userDeletion->first('password') }}
                    </p>
                @endif
            </div>

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close-modal', 'confirm-user-deletion')"
                    class="rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-2xl bg-rose-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-600"
                >
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
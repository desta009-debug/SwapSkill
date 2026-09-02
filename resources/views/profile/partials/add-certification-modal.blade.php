@if(Auth::id() === $user->id)
<div id="cert-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('cert-modal').classList.add('hidden')"></div>
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl z-10">
        <h3 class="font-fraunces text-2xl font-black text-slate-800 mb-6">Tambah Sertifikasi</h3>
        <form action="{{ route('certifications.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Nama Sertifikasi</label>
                <input type="text" name="name" required
                    class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Penerbit / Organisasi</label>
                <input type="text" name="organization" required
                    class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Tanggal Terbit</label>
                <input type="date" name="issue_date" required
                    class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">URL Kredensial (Opsional)</label>
                <input type="url" name="certificate_url"
                    class="w-full rounded-xl border-[#E2E8F0] focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5]/20 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Gambar Sertifikat (Opsional)</label>
                <input type="file" name="image_path" accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('cert-modal').classList.add('hidden')"
                    class="px-6 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200">Batal</button>
                <button type="submit"
                    class="px-6 py-3 bg-[#4F46E5] text-white font-bold rounded-xl shadow-lg hover:bg-[#4338CA]">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endif

<div id="certificate-detail-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeCertificateModal()"></div>

    <div class="absolute left-1/2 top-1/2 w-full max-w-xl -translate-x-1/2 -translate-y-1/2 rounded-3xl bg-white p-6 shadow-2xl z-10">
        <div class="flex items-center justify-between border-b pb-4 mb-4">
            <h3 class="text-xl font-black text-slate-800">Detail Sertifikat</h3>
            <button type="button" onclick="closeCertificateModal()" class="text-slate-400 hover:text-slate-600 font-bold p-1">
                ✕
            </button>
        </div>

        <div id="certificate-detail-content" class="space-y-4">
            <div id="cert-image-container" class="hidden overflow-hidden rounded-2xl border border-slate-100 max-h-64 flex items-center justify-center bg-slate-50">
                <img id="cert-image" src="" alt="Sertifikat" class="w-full h-full object-contain">
            </div>

            <div>
                <div class="flex items-start justify-between gap-3">
                    <h3 id="cert-name" class="text-lg font-black text-slate-800"></h3>
                    <div id="cert-status"></div>
                </div>
                <p id="cert-org" class="text-sm font-bold text-indigo-600 mt-1"></p>
                <p id="cert-date" class="text-xs text-slate-500 mt-0.5"></p>
            </div>

            <div id="cert-url-container" class="hidden">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">URL Kredensial</p>
                <a id="cert-url" href="" target="_blank" class="text-sm font-bold text-indigo-600 hover:underline break-all"></a>
            </div>

            <div id="cert-reason-container" class="hidden p-3 bg-red-50 rounded-xl border border-red-100">
                <p class="text-xs font-bold text-red-700 uppercase tracking-wider mb-1">Alasan Penolakan</p>
                <p id="cert-reason" class="text-xs text-red-600"></p>
            </div>
        </div>
    </div>
</div>

<script>
    function createStatusBadge(status) {
        const s = (status || 'pending').toLowerCase();
        switch (s) {
            case 'verified':
                return `<span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-[10px] font-bold text-green-700">🟢 Verified</span>`;
            case 'rejected':
                return `<span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-[10px] font-bold text-red-700">🔴 Rejected</span>`;
            default:
                return `<span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-[10px] font-bold text-yellow-700">🟡 Pending Review</span>`;
        }
    }

    function openCertificateModal(card) {
        if (!card || !card.dataset) return;

        const name = card.dataset.name || '';
        const org = card.dataset.org || '';
        const date = card.dataset.date || '';
        const status = card.dataset.status || 'pending';
        const url = card.dataset.url || '';
        const image = card.dataset.image || '';
        const reason = card.dataset.reason || '';

        document.getElementById('cert-name').textContent = name;
        document.getElementById('cert-org').textContent = org;
        document.getElementById('cert-date').textContent = date;
        document.getElementById('cert-status').innerHTML = createStatusBadge(status);

        // Handle Image
        const imgContainer = document.getElementById('cert-image-container');
        const imgElem = document.getElementById('cert-image');
        if (image) {
            imgElem.src = image;
            imgContainer.classList.remove('hidden');
        } else {
            imgElem.src = '';
            imgContainer.classList.add('hidden');
        }

        // Handle URL
        const urlContainer = document.getElementById('cert-url-container');
        const urlElem = document.getElementById('cert-url');
        if (url) {
            urlElem.href = url;
            urlElem.textContent = url;
            urlContainer.classList.remove('hidden');
        } else {
            urlElem.href = '#';
            urlElem.textContent = '';
            urlContainer.classList.add('hidden');
        }

        // Handle Rejection Reason
        const reasonContainer = document.getElementById('cert-reason-container');
        const reasonElem = document.getElementById('cert-reason');
        if (reason) {
            reasonElem.textContent = reason;
            reasonContainer.classList.remove('hidden');
        } else {
            reasonElem.textContent = '';
            reasonContainer.classList.add('hidden');
        }

        document.getElementById('certificate-detail-modal').classList.remove('hidden');
    }

    function closeCertificateModal() {
        document.getElementById('certificate-detail-modal').classList.add('hidden');
    }
</script>

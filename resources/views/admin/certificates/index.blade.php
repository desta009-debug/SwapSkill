@extends('admin.layouts.app')

@section('title', 'Certificate Verification')

@section('content')

<div class="space-y-8">

    {{-- ========================= --}}
    {{-- Page Header --}}
    {{-- ========================= --}}
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">

        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Certificate Verification
            </h1>

            <p class="mt-2 text-slate-500">
                Review and verify submitted user certificates.
            </p>
        </div>

    </div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Pending --}}
        <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-6">

            <p class="text-sm font-medium text-yellow-700">
                Pending
            </p>

            <h2 class="mt-3 text-3xl font-bold text-yellow-900">
                {{ $stats['pending'] }}
            </h2>

        </div>

        {{-- Verified --}}
        <div class="rounded-2xl border border-green-200 bg-green-50 p-6">

            <p class="text-sm font-medium text-green-700">
                Verified
            </p>

            <h2 class="mt-3 text-3xl font-bold text-green-900">
                {{ $stats['verified'] }}
            </h2>

        </div>

        {{-- Rejected --}}
        <div class="rounded-2xl border border-red-200 bg-red-50 p-6">

            <p class="text-sm font-medium text-red-700">
                Rejected
            </p>

            <h2 class="mt-3 text-3xl font-bold text-red-900">
                {{ $stats['rejected'] }}
            </h2>

        </div>

        {{-- Total --}}
        <div class="rounded-2xl border border-indigo-200 bg-indigo-50 p-6">

            <p class="text-sm font-medium text-indigo-700">
                Total Certificates
            </p>

            <h2 class="mt-3 text-3xl font-bold text-indigo-900">
                {{ $stats['total'] }}
            </h2>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- Search & Filter --}}
    {{-- ========================= --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="GET" action="{{ route('admin.certificates.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-12">

            {{-- Search --}}
            <div class="md:col-span-6">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Search
                </label>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search certificate, organization, or user..."
                    class="h-11 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            </div>

            {{-- Status --}}
            <div class="md:col-span-3">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Status
                </label>

                <select name="status"
                    class="h-11 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    <option value="">All</option>

                    <option value="pending" @selected(request('status')=='pending' )>
                        Pending
                    </option>

                    <option value="verified" @selected(request('status')=='verified' )>
                        Verified
                    </option>

                    <option value="rejected" @selected(request('status')=='rejected' )>
                        Rejected
                    </option>

                </select>

            </div>

            {{-- Buttons --}}
            <div class="flex items-end gap-3 md:col-span-3">

                <button type="submit"
                    class="h-11 rounded-xl bg-indigo-600 px-6 text-sm font-medium text-white transition hover:bg-indigo-700">

                    Search

                </button>

                <a href="{{ route('admin.certificates.index') }}"
                    class="flex h-11 items-center rounded-xl border border-slate-300 px-6 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                    Reset

                </a>

            </div>

        </form>

    </div>

    {{-- ========================= --}}
    {{-- Certificate Table --}}
    {{-- ========================= --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            @php
            function sortDirection($column, $sort, $direction)
            {
            if ($sort === $column) {
            return $direction === 'asc' ? 'desc' : 'asc';
            }

            return 'asc';
            }
            @endphp

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">
                    <tr>

                        {{-- User --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <a href="{{ route('admin.certificates.index', array_merge(request()->query(), [
                        'sort' => 'user',
                        'direction' => sortDirection('user', $sort, $direction),
                    ])) }}" class="inline-flex items-center gap-1 hover:text-indigo-600">

                                User

                                @if($sort === 'user')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @endif

                            </a>
                        </th>

                        {{-- Certificate --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <a href="{{ route('admin.certificates.index', array_merge(request()->query(), [
                        'sort' => 'certificate',
                        'direction' => sortDirection('certificate', $sort, $direction),
                    ])) }}" class="inline-flex items-center gap-1 hover:text-indigo-600">

                                Certificate

                                @if($sort === 'certificate')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @endif

                            </a>
                        </th>

                        {{-- Organization --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <a href="{{ route('admin.certificates.index', array_merge(request()->query(), [
                        'sort' => 'organization',
                        'direction' => sortDirection('organization', $sort, $direction),
                    ])) }}" class="inline-flex items-center gap-1 hover:text-indigo-600">

                                Organization

                                @if($sort === 'organization')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @endif

                            </a>
                        </th>

                        {{-- Issue Date --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <a href="{{ route('admin.certificates.index', array_merge(request()->query(), [
                        'sort' => 'issue_date',
                        'direction' => sortDirection('issue_date', $sort, $direction),
                    ])) }}" class="inline-flex items-center gap-1 hover:text-indigo-600">

                                Issue Date

                                @if($sort === 'issue_date')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @endif

                            </a>
                        </th>

                        {{-- Status --}}
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        {{-- Action --}}
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($certifications as $certificate)

                    <tr class="transition hover:bg-slate-50">

                        {{-- User --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">

                                    {{ strtoupper(substr($certificate->user->name, 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-medium text-slate-900">
                                        {{ $certificate->user->name }}
                                    </p>

                                    <p class="text-sm text-slate-500">
                                        User ID #{{ $certificate->user->id }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- Certificate --}}
                        <td class="px-6 py-4">

                            <div>

                                <p class="font-semibold text-slate-900">
                                    {{ $certificate->name }}
                                </p>

                                @if($certificate->certificate_url)

                                <a href="{{ $certificate->certificate_url }}" target="_blank"
                                    class="mt-1 inline-block text-sm text-indigo-600 hover:text-indigo-700">

                                    Credential URL

                                </a>

                                @endif

                            </div>

                        </td>

                        {{-- Organization --}}
                        <td class="px-6 py-4 text-slate-600">

                            {{ $certificate->organization }}

                        </td>

                        {{-- Issue Date --}}
                        <td class="px-6 py-4 text-slate-600">

                            {{ \Carbon\Carbon::parse($certificate->issue_date)->format('d M Y') }}

                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @php
                            $status = strtolower($certificate->verification_status ?? 'pending');
                            @endphp

                            @if($status === 'verified')

                            <span
                                class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                🟢 Verified

                            </span>

                            @elseif($status === 'rejected')

                            <span
                                class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                🔴 Rejected

                            </span>

                            @else

                            <span
                                class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                                🟡 Pending

                            </span>

                            @endif

                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <button type="button"
                                class="open-certificate-modal inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                                data-user="{{ $certificate->user->name }}" data-certificate="{{ $certificate->name }}"
                                data-organization="{{ $certificate->organization }}"
                                data-date="{{ \Carbon\Carbon::parse($certificate->issue_date)->format('d M Y') }}"
                                data-status="{{ ucfirst($certificate->verification_status) }}"
                                data-url="{{ $certificate->certificate_url }}"
                                data-image="{{ $certificate->image_path ? Storage::url($certificate->image_path) : '' }}"
                                data-approve="{{ route('admin.certificates.approve', $certificate) }}"
                                data-reject="{{ route('admin.certificates.reject', $certificate) }}">

                                👁 View

                            </button>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="py-16 text-center">

                                <div class="text-5xl">

                                    📄

                                </div>

                                <h3 class="mt-4 text-lg font-semibold text-slate-800">

                                    No certificates found

                                </h3>

                                <p class="mt-2 text-slate-500">

                                    Try changing the search keyword or filter.

                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($certifications->hasPages())

        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">

            {{ $certifications->links() }}

        </div>

        @endif

    </div>

</div>
{{-- ================================= --}}
{{-- Certificate Preview Modal --}}
{{-- ================================= --}}

<div id="certificateModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-6">

    <div class="flex max-h-[90vh] w-full max-w-4xl flex-col rounded-2xl bg-white shadow-2xl">

        <div class="flex items-center justify-between border-b px-6 py-4">

            <h2 class="text-xl font-bold">
                Certificate Detail
            </h2>

            <button id="closeModal" class="text-2xl text-slate-500 hover:text-slate-800">

                &times;

            </button>

        </div>

        <div class="flex-1 overflow-y-auto p-6 space-y-6">


            <div class="grid grid-cols-2 gap-6">

                <div>

                    <p class="text-sm text-slate-500">
                        User
                    </p>

                    <p id="modalUser" class="font-semibold">
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Status
                    </p>

                    <span id="modalStatus" class="inline-flex rounded-full px-3 py-1 text-sm font-semibold">
                    </span>
                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Certificate
                    </p>

                    <p id="modalCertificate" class="font-semibold">
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Organization
                    </p>

                    <p id="modalOrganization" class="font-semibold">
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Issue Date
                    </p>

                    <p id="modalDate" class="font-semibold">
                    </p>

                </div>

            </div>

            <div>
                <div>

                    {{-- Preview Image --}}
                    <div id="imageContainer" class="hidden">

                        <p class="mb-3 text-sm text-slate-500">
                            Certificate Preview
                        </p>

                        <div class="rounded-2xl border border-slate-200 bg-slate-100 p-6">

                            <div class="flex justify-center">

                                <div class="flex justify-center">

                                    <img id="modalImage" src="" alt="Certificate Preview"
                                        class="max-h-64 w-auto rounded-lg border border-slate-200 object-contain shadow">

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Credential URL --}}
                    <div>

                        <p class="mb-3 text-sm text-slate-500">
                            Certificate
                        </p>

                        <div class="flex justify-center rounded-xl border border-slate-200 bg-slate-50 p-4">

                            <a id="modalUrl" target="_blank" class="font-medium text-indigo-600 hover:underline">

                                Open Credential

                            </a>

                        </div>

                    </div>

                </div>


            </div>

        </div>

        <div class="flex justify-end gap-3 border-t bg-slate-50 px-6 py-4">

            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit" class="rounded-xl bg-red-600 px-5 py-2 text-white transition hover:bg-red-700">
                    Reject
                </button>
            </form>

            <form id="approveForm" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit"
                    class="rounded-xl bg-green-600 px-5 py-2 text-white transition hover:bg-green-700">
                    Approve
                </button>
            </form>

        </div>

    </div>

</div>
<script>

    const modal = document.getElementById('certificateModal');

    const closeBtn = document.getElementById('closeModal');

    document.querySelectorAll('.open-certificate-modal').forEach(button => {

        button.addEventListener('click', () => {

            document.getElementById('modalUser').textContent =
                button.dataset.user;

            document.getElementById('modalCertificate').textContent =
                button.dataset.certificate;

            document.getElementById('modalOrganization').textContent =
                button.dataset.organization;

            document.getElementById('modalDate').textContent =
                button.dataset.date;

            const badge = document.getElementById('modalStatus');

            badge.textContent = button.dataset.status;

            badge.className = 'inline-flex rounded-full px-3 py-1 text-sm font-semibold';

            switch (button.dataset.status.toLowerCase()) {

                case 'verified':

                    badge.classList.add(
                        'bg-green-100',
                        'text-green-700'
                    );

                    break;

                case 'rejected':

                    badge.classList.add(
                        'bg-red-100',
                        'text-red-700'
                    );

                    break;

                default:

                    badge.classList.add(
                        'bg-yellow-100',
                        'text-yellow-700'
                    );

            }

            const url = document.getElementById('modalUrl');
            const image = document.getElementById('modalImage');
            const imageContainer = document.getElementById('imageContainer');

            // Preview gambar
            if (button.dataset.image) {

                image.src = button.dataset.image;
                imageContainer.classList.remove('hidden');

            } else {

                image.src = '';
                imageContainer.classList.add('hidden');

            }

            // Credential URL
            if (button.dataset.url) {

                url.href = button.dataset.url;
                url.textContent = 'Open Credential';
                url.parentElement.classList.remove('hidden');

            } else {

                url.removeAttribute('href');
                url.textContent = 'No Credential URL';
                url.parentElement.classList.add('hidden');

            }
            document.getElementById('approveForm').action =
                button.dataset.approve;


            document.getElementById('rejectForm').action =
                button.dataset.reject;

            document.querySelectorAll('.reject-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Reject Certificate?',
                        text: 'This certificate will be rejected.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Reject',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#DC2626',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            modal.classList.remove('hidden');

            modal.classList.add('flex');

            setTimeout(() => {

                modal.classList.remove('opacity-0');

            }, 10);

        });

    });

    closeBtn.addEventListener('click', () => {

        modal.classList.add('opacity-0');

        setTimeout(() => {

            modal.classList.remove('flex');

            modal.classList.add('hidden');

        }, 200);

    });

    modal.addEventListener('click', (e) => {

        if (e.target === modal) {

            modal.classList.remove('flex');

            modal.classList.add('hidden');

        }

    });

</script>


@endsection
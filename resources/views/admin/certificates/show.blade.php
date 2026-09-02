@extends('admin.layouts.app')

@section('title', 'Certificate Detail')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-900">
                Certificate Detail
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Review certificate before approving or rejecting.
            </p>

        </div>

        <a href="{{ route('admin.certificates.index') }}"
            class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
            ← Back
        </a>

    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- LEFT --}}
        <div class="space-y-6 xl:col-span-2">

            {{-- Certificate Information --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-4">

                    <h2 class="font-semibold text-slate-900">
                        Certificate Information
                    </h2>

                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            Certificate Name
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $certification->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            Organization
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $certification->organization }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            Owner
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $certification->user->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            Issue Date
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ \Carbon\Carbon::parse($certification->issue_date)->format('d F Y') }}
                        </p>

                    </div>

                    <div class="md:col-span-2">

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            Credential URL
                        </p>

                         if($certification->certificate_url)

                        <div class="mt-3 flex flex-wrap gap-3">

                            <a href="{{ $certification->certificate_url }}" target="_blank"
                                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                Open Credential URL
                            </a>

                            <span class="break-all text-sm text-slate-500">
                                {{ $certification->certificate_url }}
                            </span>

                        </div>

                        @else

                        <p class="mt-2 text-sm text-slate-400">
                            No credential URL available.
                        </p>

                        @endif

                    </div>

                </div>

            </div>
            {{-- Certificate Preview --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">

                    <h2 class="font-semibold text-slate-900">
                        Certificate Preview
                    </h2>

                    @if($certification->certificate_url)
                    <a href="{{ $certification->certificate_url }}" target="_blank"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                        Open Original →
                    </a>
                    @endif

                </div>

                <div class="p-6">

                    @if($certification->image_path)

                    <img src="{{ asset('storage/' . $certification->image_path) }}" alt="Certificate"
                        class="w-full rounded-xl border border-slate-200 shadow-sm">

                    @else

                    <div
                        class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-300 py-20">

                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-14 w-14 text-slate-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4-4a2 2 0 012.828 0L16 17m-2-2l1-1a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                        <p class="font-medium text-slate-500">
                            No certificate image uploaded
                        </p>

                        @if($certification->certificate_url)

                        <a href="{{ $certification->certificate_url }}" target="_blank"
                            class="mt-4 rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                            Open Credential URL
                        </a>

                        @endif

                    </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="space-y-6">

            @php
            $status = strtolower($certification->verification_status ?? 'pending');
            @endphp

            {{-- Verification Status --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-4">

                    <h2 class="font-semibold text-slate-900">
                        Verification
                    </h2>

                </div>

                <div class="space-y-5 p-6">

                    @if($status === 'verified')

                    <span class="inline-flex rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                        Verified
                    </span>

                    @elseif($status === 'rejected')

                    <span class="inline-flex rounded-full bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">
                        Rejected
                    </span>

                    @else

                    <span
                        class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700">
                        Pending Review
                    </span>

                    @endif

                    @if($status !== 'pending')

                    <div class="space-y-4 rounded-lg bg-slate-50 p-4">

                        <div>

                            <p class="text-xs uppercase text-slate-500">
                                Verified By
                            </p>

                            <p class="mt-1 font-medium text-slate-900">
                                {{ optional($certification->verifier)->name ?? '-' }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-500">
                                Verified At
                            </p>

                            <p class="mt-1 font-medium text-slate-900">
                                {{ optional($certification->verified_at)?->format('d M Y H:i') ?? '-' }}
                            </p>

                        </div>

                        @if($status === 'rejected')

                        <div>

                            <p class="text-xs uppercase text-slate-500">
                                Rejection Reason
                            </p>

                            <div class="mt-2 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                                {{ $certification->rejection_reason }}
                            </div>

                        </div>

                        @endif

                    </div>

                    @endif
                    @if($status === 'pending')

                    {{-- Approve Modal --}}
                    <div x-data="{ approveModal: false }">

                        <button type="button" @click="approveModal = true"
                            class="w-full rounded-lg bg-green-600 py-3 font-medium text-white transition hover:bg-green-700">
                            Approve Certificate
                        </button>

                        <div x-show="approveModal" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                            style="display: none;">

                            <div @click.away="approveModal = false"
                                class="w-full max-w-md rounded-xl bg-white shadow-xl">

                                <div class="border-b px-6 py-4">

                                    <h3 class="text-lg font-semibold text-slate-900">
                                        Confirm Approval
                                    </h3>

                                </div>

                                <div class="px-6 py-5">

                                    <p class="text-slate-600">
                                        Are you sure you want to approve this certificate?
                                    </p>

                                    <p class="mt-2 text-sm text-slate-500">
                                        This action will mark the certificate as <strong>Verified</strong>.
                                    </p>

                                </div>

                                <div class="flex justify-end gap-3 border-t px-6 py-4">

                                    <button type="button" @click="approveModal = false"
                                        class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-slate-50">
                                        Cancel
                                    </button>

                                    <form action="{{ route('admin.certificates.approve', $certification) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="rounded-lg bg-green-600 px-5 py-2 font-medium text-white hover:bg-green-700">
                                            Approve
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Reject Modal --}}
                    <div x-data="{ rejectModal: false }" class="mt-4">

                        <button type="button" @click="rejectModal = true"
                            class="w-full rounded-lg bg-red-600 py-3 font-medium text-white transition hover:bg-red-700">
                            Reject Certificate
                        </button>

                        <div x-show="rejectModal" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                            style="display: none;">

                            <div @click.away="rejectModal = false"
                                class="w-full max-w-lg rounded-xl bg-white shadow-xl">

                                <form action="{{ route('admin.certificates.reject', $certification) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="border-b px-6 py-4">

                                        <h3 class="text-lg font-semibold text-slate-900">
                                            Reject Certificate
                                        </h3>

                                    </div>

                                    <div class="space-y-4 px-6 py-5">

                                        <p class="text-slate-600">
                                            Please provide the reason for rejecting this certificate.
                                        </p>

                                        <textarea name="reason" rows="5" required
                                            placeholder="Write the rejection reason..."
                                            class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200"></textarea>

                                    </div>

                                    <div class="flex justify-end gap-3 border-t px-6 py-4">

                                        <button type="button" @click="rejectModal = false"
                                            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-slate-50">
                                            Cancel
                                        </button>

                                        <button type="submit"
                                            class="rounded-lg bg-red-600 px-5 py-2 font-medium text-white hover:bg-red-700">
                                            Reject
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
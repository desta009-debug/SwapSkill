@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Admin Dashboard
</h1>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white rounded-xl p-6 shadow">

        <h3 class="text-slate-500">
            Total Users
        </h3>

        <p class="text-3xl font-bold mt-2">
            {{ $totalUsers }}
        </p>

    </div>

    <div class="bg-white rounded-xl p-6 shadow">

        <h3 class="text-slate-500">
            Pending Certificates
        </h3>

        <p class="text-3xl font-bold text-yellow-500 mt-2">
            {{ $pendingCertificates }}
        </p>

    </div>

    <div class="bg-white rounded-xl p-6 shadow">

        <h3 class="text-slate-500">
            Verified
        </h3>

        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $verifiedCertificates }}
        </p>

    </div>

    <div class="bg-white rounded-xl p-6 shadow">

        <h3 class="text-slate-500">
            Rejected
        </h3>

        <p class="text-3xl font-bold text-red-600 mt-2">
            {{ $rejectedCertificates }}
        </p>

    </div>

</div>

@endsection
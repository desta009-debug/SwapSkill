<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Panel') - SwapSkill</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex">

    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col">

        @include('admin.partials.topbar')

        <main class="flex-1 p-8">

            @include('admin.partials.breadcrumb')

            @include('admin.partials.flash')

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>
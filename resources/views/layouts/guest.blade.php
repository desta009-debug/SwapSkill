<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SwapSkill') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-linear-to-br from-[#0b1020] via-[#151a33] to-[#1e1b4b] text-white antialiased">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute -left-10 top-10 h-40 w-40 rounded-full bg-violet-500 blur-3xl"></div>
            <div class="absolute bottom-10 right-10 h-52 w-52 rounded-full bg-fuchsia-500 blur-3xl"></div>
        </div>

        <div class="relative z-10 flex min-h-screen flex-col">
            <header class="px-4 py-5 sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-7xl items-center justify-between">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                        <img
                            src="{{ asset('images/logo.jpg') }}"
                            alt="SwapSkill Logo"
                            class="h-11 w-11 rounded-2xl object-cover ring-1 ring-white/20 shadow-lg"
                        >

                        <div>
                            <p class="text-xl font-extrabold tracking-tight text-white">SwapSkill</p>
                            <p class="text-xs text-white/60">Tukar skill. Naik level.</p>
                        </div>
                    </a>

                    <a
                        href="{{ url('/') }}"
                        class="inline-flex items-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white/80 transition hover:bg-white/10 hover:text-white"
                    >
                        Kembali ke Landing Page
                    </a>
                </div>
            </header>

            <main class="flex flex-1 items-center justify-center px-4 py-6 sm:px-6 lg:px-8">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
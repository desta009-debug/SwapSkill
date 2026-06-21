@php
$pendingIncomingRequestsCount = \App\Models\SkillSwap::where('receiver_id', auth()->id())
->where('status', 'pending')
->count();

$unreadMessagesCount = \App\Models\Message::whereHas('skillSwap', function($query) {
$query->where('status', 'accepted')
->where(function($q) {
$q->where('sender_id', auth()->id())
->orWhere('receiver_id', auth()->id());
});
})
->where('sender_id', '!=', auth()->id())
->where('is_read', false)
->count();
@endphp

{{-- =========================================================
LIQUID GLASS MATERIAL SYSTEM
Hanya didefinisikan sekali walaupun partial ini di-@include
berkali-kali dalam satu request.
========================================================= --}}
@once
<style>
    .lg-surface {
        position: relative;
        /* Tinted glass: tetap blur & translucent, tapi dasarnya dibekali
           warna brand indigo/ungu supaya teks putih selalu kontras,
           apapun warna konten di belakang nav (light theme/dark theme). */
        background: linear-gradient(135deg, rgba(79, 70, 229, .60), rgba(30, 27, 75, .82) 55%, rgba(124, 58, 237, .55));
        -webkit-backdrop-filter: blur(24px) saturate(160%);
        backdrop-filter: blur(24px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, .18);
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .35),
            inset 0 -1px 14px rgba(0, 0, 0, .25),
            0 18px 40px -16px rgba(10, 8, 30, .55),
            0 2px 10px rgba(10, 8, 30, .25);
    }

    .lg-surface::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        background: linear-gradient(115deg, transparent 25%, rgba(255, 255, 255, .35) 45%, transparent 65%);
        background-size: 250% 250%;
        background-position: 140% 0%;
        mix-blend-mode: overlay;
        opacity: .9;
        transition: background-position 1.4s cubic-bezier(.22, 1, .36, 1);
    }

    .lg-surface:hover::before {
        background-position: -40% 0%;
    }

    .lg-surface-light {
        background: linear-gradient(160deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .74));
        -webkit-backdrop-filter: blur(30px) saturate(160%);
        backdrop-filter: blur(30px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, .75);
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .9),
            0 24px 48px -20px rgba(30, 27, 75, .45),
            0 4px 16px rgba(30, 27, 75, .18);
    }

    .lg-pill {
        transition: transform .35s cubic-bezier(.22, 1, .36, 1), background-color .35s ease, color .35s ease, box-shadow .35s ease;
    }

    .lg-pill:hover {
        transform: translateY(-1px);
    }

    .lg-cta {
        background: linear-gradient(135deg, rgba(249, 115, 22, .95), rgba(234, 88, 12, .95));
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .5),
            inset 0 -2px 6px rgba(124, 45, 18, .35),
            0 12px 24px -8px rgba(249, 115, 22, .55);
        transition: transform .35s cubic-bezier(.22, 1, .36, 1), box-shadow .35s ease;
    }

    .lg-cta:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .6),
            inset 0 -2px 6px rgba(124, 45, 18, .35),
            0 16px 32px -8px rgba(249, 115, 22, .7);
    }

    .lg-badge {
        background: linear-gradient(160deg, #FB923C, #F97316);
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, .6), 0 2px 6px rgba(249, 115, 22, .5);
    }

    .lg-icon-btn {
        transition: transform .3s cubic-bezier(.22, 1, .36, 1), background-color .3s ease;
    }

    .lg-icon-btn:active {
        transform: scale(.92);
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    @media (prefers-reduced-motion: reduce) {

        .lg-surface::before,
        .lg-pill,
        .lg-cta,
        .lg-icon-btn {
            transition: none !important;
        }
    }
</style>
@endonce

{{-- Wrapper sticky: memberi "ruang melayang" supaya nav terlihat sebagai
kapsul kaca yang mengambang, bukan bar penuh menempel ke tepi layar --}}
<nav x-data="{ open: false, profileMenu: false }" class="sticky top-3 z-50 px-3 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">

        {{-- ============ MAIN GLASS CAPSULE ============ --}}
        <div class="lg-surface flex h-16 items-center justify-between rounded-full px-3 sm:px-5 lg:px-6">

            <div class="flex items-center gap-3 lg:gap-6 flex-1 min-w-0">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill"
                        class="h-9 w-9 rounded-xl object-cover ring-1 ring-white/40 shadow-[0_2px_8px_rgba(0,0,0,.25)]">
                    <div class="hidden sm:block">
                        <p
                            class="font-fraunces text-lg font-black text-white leading-none tracking-wide drop-shadow-sm">
                            Swap<span class="text-[#FDBA74]">Skill</span></p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex md:items-center md:gap-1 flex-1 overflow-x-auto no-scrollbar min-w-0 py-2">
                    <a href="{{ route('dashboard') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold {{ request()->routeIs('dashboard') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">Dashboard</a>
                    <a href="{{ route('skills.edit') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold {{ request()->routeIs('skills.*') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">My
                        Skills</a>
                    <a href="{{ route('matches.index') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold {{ request()->routeIs('matches.*') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">Matches</a>
                    <a href="{{ route('leaderboard.index') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold {{ request()->routeIs('leaderboard.*') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">Leaderboard</a>
                    {{-- Talent Showcase --}}
                    <a href="{{ route('portfolio.index') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold flex items-center gap-2 {{ request()->routeIs('portfolio.*') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">
                        Showcase
                    </a>
                    <a href="{{ route('swaps.index') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold flex items-center gap-2 {{ request()->routeIs('swaps.index') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">
                        Swaps
                        @if($pendingIncomingRequestsCount > 0)
                        <span
                            class="lg-badge flex h-5 items-center justify-center rounded-full text-white px-2.5 text-[10px] font-black">{{
                            $pendingIncomingRequestsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('swaps.history') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold {{ request()->routeIs('swaps.history') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">History</a>
                    <a href="{{ route('messages.index') }}"
                        class="lg-pill shrink-0 whitespace-nowrap px-3.5 py-2 rounded-full text-sm font-bold flex items-center gap-2 {{ request()->routeIs('messages.*') ? 'bg-white/90 text-[#4338CA] shadow-[inset_0_1px_0_rgba(255,255,255,.8),0_8px_20px_-8px_rgba(79,70,229,.7)]' : 'text-white/75 hover:text-white hover:bg-white/10' }}">
                        Messages
                        @if($unreadMessagesCount > 0)
                        <span
                            class="lg-badge flex h-5 items-center justify-center rounded-full text-white px-2.5 text-[10px] font-black">{{
                            $unreadMessagesCount }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Desktop Right -->
            <div class="hidden md:flex md:items-center md:gap-3 shrink-0">

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button type="button" x-on:click="profileMenu = !profileMenu"
                        class="lg-icon-btn flex items-center gap-3 rounded-full border border-white/25 bg-white/10 p-1.5 pr-4 hover:bg-white/20">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                            class="h-8 w-8 rounded-full object-cover ring-1 ring-white/50">
                        <div class="text-left">
                            <p class="text-xs font-bold text-white leading-tight truncate max-w-[100px]">{{
                                auth()->user()->name }}</p>
                            <p class="text-[10px] text-white/60 truncate max-w-[100px] font-medium">{{
                                auth()->user()->email }}</p>
                        </div>
                        <svg class="h-4 w-4 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="profileMenu"
                        x-transition:enter="transition ease-[cubic-bezier(0.32,0.72,0,1)] duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                        x-on:click.outside="profileMenu = false"
                        class="lg-surface-light absolute right-0 mt-3 w-56 origin-top-right rounded-3xl p-2"
                        style="display: none;">
                        <div class="px-3 py-2 mb-2 border-b border-slate-900/10">
                            <p class="text-xs font-bold text-[#64748B] uppercase tracking-wider">Akun Saya</p>
                        </div>
                        <x-dropdown-link :href="route('user.show', Auth::user())"
                            class="font-bold text-slate-700 rounded-2xl hover:text-indigo-600 hover:bg-indigo-500/10 transition-colors">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Publik
                            </div>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')"
                            class="font-bold text-slate-700 rounded-2xl hover:text-indigo-600 hover:bg-indigo-500/10 transition-colors">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan Akun
                            </div>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center gap-3 rounded-2xl px-3 py-2.5 text-sm font-bold text-red-600 transition hover:bg-red-500/10 hover:text-red-700">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar Aplikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" x-on:click="open = !open"
                    class="lg-icon-btn inline-flex items-center justify-center rounded-full p-2.5 text-white/80 bg-white/5 hover:bg-white/15 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" style="display:none;" />
                    </svg>
                </button>
            </div>
        </div>
        {{-- ============ /MAIN GLASS CAPSULE ============ --}}

        <!-- Mobile Menu: kartu kaca terpisah, melayang di bawah kapsul utama -->
        <div x-show="open" x-transition:enter="transition ease-[cubic-bezier(0.32,0.72,0,1)] duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" class="lg-surface-light mt-3 rounded-3xl md:hidden"
            style="display:none;">
            <div class="space-y-1 px-4 pb-4 pt-4">
                <!-- Mobile User Profile -->
                <div class="mb-6 flex items-center gap-4 rounded-2xl bg-white/60 border border-white/70 p-4">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                        class="h-12 w-12 rounded-xl object-cover ring-2 ring-white shadow-sm">
                    <div>
                        <p class="text-base font-black text-[#0F172A]">{{ auth()->user()->name }}</p>
                        <p class="text-xs font-medium text-[#64748B]">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Dashboard</a>
                    <a href="{{ route('skills.edit') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('skills.*') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">My
                        Skills</a>
                    <a href="{{ route('matches.index') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('matches.*') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Matches</a>
                    <a href="{{ route('leaderboard.index') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('leaderboard.*') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Leaderboard</a>
                    <a href="{{ route('portfolio.index') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('portfolio.*') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Showcase</a>
                    <a href="{{ route('swaps.index') }}"
                        class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('swaps.index') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">
                        Swaps
                        @if($pendingIncomingRequestsCount > 0)
                        <span
                            class="lg-badge flex h-5 items-center justify-center rounded-full text-white px-2.5 text-[10px] font-black">{{
                            $pendingIncomingRequestsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('swaps.history') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('swaps.history') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">History</a>
                    <a href="{{ route('messages.index') }}"
                        class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('messages.*') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">
                        Messages
                        @if($unreadMessagesCount > 0)
                        <span
                            class="lg-badge flex h-5 items-center justify-center rounded-full text-white px-2.5 text-[10px] font-black">{{
                            $unreadMessagesCount }}</span>
                        @endif
                    </a>

                    <!-- Profile Links for Mobile -->
                    <div class="my-2 border-t border-slate-900/10"></div>
                    <a href="{{ route('user.show', Auth::user()) }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('user.show') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Profil Publik</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('profile.edit') ? 'bg-[#4F46E5] text-white shadow-md shadow-[#4F46E5]/30' : 'text-[#64748B] hover:bg-slate-900/5 hover:text-[#0F172A]' }}">Pengaturan Akun</a>
                </div>

                <div class="mt-6 border-t border-slate-900/10 pt-6 space-y-3">
                    <a href="{{ route('matches.index') }}"
                        class="lg-cta block w-full rounded-2xl py-3 text-center text-sm font-bold text-white">Cari
                        Match Sekarang</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full rounded-2xl border border-red-200 bg-red-50 py-3 text-center text-sm font-bold text-red-600 hover:bg-red-100 hover:text-red-700 transition-all">Keluar
                            Aplikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
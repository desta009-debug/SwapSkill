<nav x-data="{ open: false, profileMenu: false }" style="
    position: relative;
    z-index: 9999;
    background: rgba(13,26,99,0.96);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    font-family: 'DM Sans', sans-serif;
">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        .tu-nav-link {
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 10px;
            color: rgba(255,255,255,0.55);
            transition: background 0.18s, color 0.18s;
            display: inline-block;
            text-decoration: none;
            letter-spacing: 0.01em;
        }
        .tu-nav-link:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.9);
        }
        .tu-nav-link-active {
            background: rgba(40,69,214,0.30);
            color: #fff;
            border: 1px solid rgba(40,69,214,0.35);
        }
        .tu-nav-link-active:hover {
            background: rgba(40,69,214,0.38);
            color: #fff;
        }

        .tu-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #F68048;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 13px;
            border-radius: 11px;
            padding: 9px 20px;
            letter-spacing: 0.01em;
            transition: background 0.18s, transform 0.12s;
            text-decoration: none;
        }
        .tu-cta-btn:hover { background: #E46530; transform: translateY(-1px); }

        .tu-profile-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 12px;
            padding: 6px 12px 6px 6px;
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s;
        }
        .tu-profile-trigger:hover {
            background: rgba(255,255,255,0.10);
            border-color: rgba(255,255,255,0.16);
        }

        .tu-profile-avatar {
            width: 36px; height: 36px;
            border-radius: 9px;
            object-fit: cover;
            border: 1.5px solid rgba(255,255,255,0.12);
            flex-shrink: 0;
        }

        .tu-profile-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }
        .tu-profile-email {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }

        .tu-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 220px;
            background: #0D1A63;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.4);
            z-index: 99999;
        }
        .tu-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.7);
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }
        .tu-dropdown-item:hover {
            background: rgba(40,69,214,0.25);
            color: #fff;
        }
        .tu-dropdown-item-danger {
            color: #F87171;
        }
        .tu-dropdown-item-danger:hover {
            background: rgba(248,113,113,0.10);
            color: #FCA5A5;
        }
        .tu-dropdown-divider {
            height: 1px;
            background: rgba(255,255,255,0.07);
            margin: 6px 4px;
        }

        /* Mobile */
        .tu-mobile-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 10px;
            cursor: pointer;
            color: rgba(255,255,255,0.7);
        }
        @media (max-width: 768px) {
            .tu-desktop-nav { display: none !important; }
            .tu-desktop-right { display: none !important; }
            .tu-mobile-toggle { display: flex !important; }
        }
        @media (min-width: 769px) {
            .tu-mobile-menu { display: none !important; }
        }

        .tu-mobile-menu {
            border-top: 1px solid rgba(255,255,255,0.07);
            background: #0D1A63;
            padding: 16px;
        }
        .tu-mobile-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 12px;
        }
        .tu-mobile-avatar {
            width: 44px; height: 44px;
            border-radius: 11px;
            object-fit: cover;
            border: 1.5px solid rgba(255,255,255,0.12);
            flex-shrink: 0;
        }
        .tu-mobile-nav-link {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            padding: 11px 16px;
            border-radius: 11px;
            margin-bottom: 4px;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }
        .tu-mobile-nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }
        .tu-mobile-nav-link-active {
            background: rgba(40,69,214,0.28);
            color: #fff;
            border: 1px solid rgba(40,69,214,0.30);
        }
        .tu-mobile-cta {
            display: block;
            text-align: center;
            background: #F68048;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            border-radius: 11px;
            padding: 12px;
            margin-top: 8px;
            text-decoration: none;
            transition: background 0.18s;
        }
        .tu-mobile-cta:hover { background: #E46530; }
        .tu-mobile-logout {
            display: block;
            width: 100%;
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
            color: #F87171;
            background: rgba(248,113,113,0.08);
            border: 1px solid rgba(248,113,113,0.18);
            border-radius: 11px;
            padding: 11px;
            margin-top: 6px;
            cursor: pointer;
            transition: background 0.15s;
        }
        .tu-mobile-logout:hover { background: rgba(248,113,113,0.14); }

        /* Logo text */
        .tu-logo-name {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.01em;
        }
        .tu-logo-sub {
            font-size: 11px;
            color: rgba(255,255,255,0.38);
            margin-top: 1px;
            font-weight: 400;
        }
        .tu-logo-img {
            width: 44px; height: 44px;
            border-radius: 12px;
            object-fit: cover;
            border: 1.5px solid rgba(255,255,255,0.12);
        }
        .tu-logo-dot {
            color: #F68048;
        }
    </style>

    <div style="max-width:1280px; margin:0 auto; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; height:72px;">

            {{-- ── LEFT ── --}}
            <div style="display:flex; align-items:center; gap:32px;">
                <a href="{{ route('dashboard') }}" style="display:flex; align-items:center; gap:14px; text-decoration:none;">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SwapSkill Logo" class="tu-logo-img">
                    <div class="hidden sm:block">
                        <p class="tu-logo-name">Swap<span class="tu-logo-dot">Skill</span></p>
                        <p class="tu-logo-sub">Tukar skill. Naik level.</p>
                    </div>
                </a>

                <div class="tu-desktop-nav" style="display:flex; align-items:center; gap:4px;">
                    <a href="{{ route('dashboard') }}"
                       class="tu-nav-link {{ request()->routeIs('dashboard') ? 'tu-nav-link-active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('matches.index') }}"
                       class="tu-nav-link {{ request()->routeIs('matches.*') ? 'tu-nav-link-active' : '' }}">
                        Matches
                    </a>
                    <a href="{{ route('skills.edit') }}"
                       class="tu-nav-link {{ request()->routeIs('skills.*') ? 'tu-nav-link-active' : '' }}">
                        My Skills
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="tu-nav-link {{ request()->routeIs('profile.*') ? 'tu-nav-link-active' : '' }}">
                        Profile
                    </a>
                </div>
            </div>

            {{-- ── RIGHT DESKTOP ── --}}
            <div class="tu-desktop-right" style="display:flex; align-items:center; gap:12px;">
                <a href="{{ route('matches.index') }}" class="tu-cta-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a4 4 0 110-8 4 4 0 010 8z"/>
                    </svg>
                    Cari Match
                </a>

                <div style="position:relative; z-index:9999;">
                    <button type="button" x-on:click="profileMenu = !profileMenu" class="tu-profile-trigger">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="tu-profile-avatar">
                        <div style="text-align:left;">
                            <p class="tu-profile-name">{{ auth()->user()->name }}</p>
                            <p class="tu-profile-email">{{ auth()->user()->email }}</p>
                        </div>
                        <svg style="width:14px; height:14px; color:rgba(255,255,255,0.35); margin-left:2px; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="profileMenu"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-on:click.outside="profileMenu = false"
                        class="tu-dropdown"
                        style="display:none;"
                    >
                        <a href="{{ route('skills.edit') }}" class="tu-dropdown-item">
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Edit Skill
                        </a>
                        <a href="{{ route('matches.index') }}" class="tu-dropdown-item">
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a4 4 0 110-8 4 4 0 010 8z"/>
                            </svg>
                            Lihat Matches
                        </a>
                        <div class="tu-dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="tu-dropdown-item tu-dropdown-item-danger" style="width:100%; border:none; background:none; cursor:pointer; font-family:'DM Sans',sans-serif;">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── MOBILE TOGGLE ── --}}
            <button type="button" x-on:click="open = !open" class="tu-mobile-toggle">
                <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display:none;"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- ── MOBILE MENU ── --}}
    <div x-show="open" x-transition class="tu-mobile-menu" style="display:none;">

        <div class="tu-mobile-user-card">
            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="tu-mobile-avatar">
            <div style="min-width:0;">
                <p style="font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    {{ auth()->user()->name }}
                </p>
                <p style="font-size:12px; color:rgba(255,255,255,0.4); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-top:2px;">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="tu-mobile-nav-link {{ request()->routeIs('dashboard') ? 'tu-mobile-nav-link-active' : '' }}">Dashboard</a>
        <a href="{{ route('matches.index') }}" class="tu-mobile-nav-link {{ request()->routeIs('matches.*') ? 'tu-mobile-nav-link-active' : '' }}">Matches</a>
        <a href="{{ route('skills.edit') }}" class="tu-mobile-nav-link {{ request()->routeIs('skills.*') ? 'tu-mobile-nav-link-active' : '' }}">My Skills</a>
        <a href="{{ route('profile.edit') }}" class="tu-mobile-nav-link {{ request()->routeIs('profile.*') ? 'tu-mobile-nav-link-active' : '' }}">Profile</a>

        <a href="{{ route('matches.index') }}" class="tu-mobile-cta">Cari Match</a>

        <form method="POST" action="{{ route('logout') }}" style="margin-top:6px;">
            @csrf
            <button type="submit" class="tu-mobile-logout">Logout</button>
        </form>

    </div>
</nav>
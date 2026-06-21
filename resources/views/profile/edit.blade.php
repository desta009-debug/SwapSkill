<x-app-layout>
    <style>
        :root {
            --profile-ink: #172033;
            --profile-muted: #687386;
            --profile-indigo: #5146e5;
            --profile-coral: #f06f52;
            --profile-mint: #1f9d78;
            --profile-danger: #d94d5c;
        }

        .profile-page {
            position: relative;
            min-height: calc(100vh - 5.5rem);
            overflow: hidden;
            background:
                linear-gradient(125deg, rgba(81, 70, 229, 0.16), transparent 34%),
                linear-gradient(305deg, rgba(240, 111, 82, 0.17), transparent 32%),
                linear-gradient(180deg, #edf2f8 0%, #f8fafc 52%, #eef8f4 100%);
            color: var(--profile-ink);
            isolation: isolate;
        }

        .profile-page::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(23, 32, 51, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(23, 32, 51, 0.035) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(to bottom, black, transparent 82%);
            pointer-events: none;
        }

        .profile-wrap {
            width: min(100% - 2rem, 1180px);
            margin-inline: auto;
            padding-block: 2rem 4rem;
        }

        .profile-glass {
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.82);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.58);
            -webkit-backdrop-filter: blur(26px) saturate(145%);
            backdrop-filter: blur(26px) saturate(145%);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.95),
                0 22px 60px -34px rgba(37, 44, 85, 0.55);
        }

        .profile-hero {
            position: relative;
            overflow: hidden;
            min-height: 280px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 8px;
            background:
                linear-gradient(112deg, rgba(22, 29, 67, 0.96), rgba(69, 56, 180, 0.86) 56%, rgba(23, 125, 105, 0.78)),
                rgba(23, 32, 51, 0.92);
            -webkit-backdrop-filter: blur(28px) saturate(155%);
            backdrop-filter: blur(28px) saturate(155%);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.25),
                0 30px 70px -34px rgba(39, 35, 116, 0.75);
        }

        .profile-hero::before {
            content: "";
            position: absolute;
            inset: -80% -30%;
            background: linear-gradient(105deg, transparent 42%, rgba(255, 255, 255, 0.18) 49%, transparent 56%);
            transform: translateX(-36%);
            transition: transform 900ms cubic-bezier(0.22, 1, 0.36, 1);
            pointer-events: none;
        }

        .profile-hero:hover::before {
            transform: translateX(36%);
        }

        .profile-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            min-height: 280px;
            grid-template-columns: minmax(0, 1fr) 320px;
        }

        .profile-identity {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 2.5rem;
        }

        .profile-avatar-wrap {
            position: relative;
            flex: 0 0 auto;
        }

        .profile-avatar {
            width: 104px;
            height: 104px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            object-fit: cover;
            box-shadow:
                0 0 0 7px rgba(255, 255, 255, 0.1),
                0 18px 36px rgba(11, 18, 48, 0.34);
        }

        .profile-online-dot {
            position: absolute;
            right: 2px;
            bottom: 7px;
            width: 20px;
            height: 20px;
            border: 4px solid #393aa0;
            border-radius: 50%;
            background: #4ade9a;
        }

        .profile-kicker,
        .profile-section-kicker {
            margin: 0;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .profile-kicker {
            color: #ffb49f;
        }

        .profile-title {
            max-width: 620px;
            margin: 0.45rem 0 0;
            color: white;
            font-family: 'Fraunces', serif;
            font-size: 4.6rem;
            line-height: 0.98;
            letter-spacing: 0;
            overflow-wrap: anywhere;
        }

        .profile-email {
            margin: 0.85rem 0 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            overflow-wrap: anywhere;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding: 0.45rem 0.7rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.82);
            font-size: 0.72rem;
            font-weight: 700;
            -webkit-backdrop-filter: blur(14px);
            backdrop-filter: blur(14px);
        }

        .profile-status span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade9a;
            box-shadow: 0 0 0 4px rgba(74, 222, 154, 0.13);
        }

        .profile-aside {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.4rem;
            margin: 1.25rem;
            padding: 1.75rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            -webkit-backdrop-filter: blur(20px) saturate(130%);
            backdrop-filter: blur(20px) saturate(130%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
        }

        .profile-aside-label {
            margin: 0;
            color: rgba(255, 255, 255, 0.58);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .profile-aside-value {
            margin: 0.35rem 0 0;
            color: white;
            font-size: 1.05rem;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-aside-link {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            width: fit-content;
            color: #ffd0c3;
            font-size: 0.82rem;
            font-weight: 800;
            text-decoration: none;
            transition: color 180ms ease, transform 180ms ease;
        }

        .profile-aside-link:hover {
            color: white;
            transform: translateX(3px);
        }

        .profile-alert {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
            padding: 0.9rem 1rem;
            border: 1px solid rgba(31, 157, 120, 0.25);
            border-radius: 8px;
            background: rgba(228, 255, 246, 0.76);
            color: #12684f;
            -webkit-backdrop-filter: blur(18px);
            backdrop-filter: blur(18px);
            box-shadow: 0 14px 34px -26px rgba(15, 111, 82, 0.6);
            font-size: 0.84rem;
            font-weight: 700;
        }

        .profile-alert svg {
            width: 20px;
            height: 20px;
            flex: 0 0 auto;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(320px, 0.85fr);
            gap: 1.25rem;
            margin-top: 1.25rem;
            align-items: start;
        }

        .profile-stack {
            display: grid;
            gap: 1.25rem;
        }

        .profile-card {
            overflow: hidden;
        }

        .profile-card::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), transparent 45%);
            pointer-events: none;
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 1.35rem;
            border-bottom: 1px solid rgba(95, 104, 128, 0.13);
            background: rgba(255, 255, 255, 0.3);
        }

        .profile-section-kicker {
            color: var(--profile-indigo);
        }

        .profile-card--security .profile-section-kicker {
            color: var(--profile-mint);
        }

        .profile-card--danger .profile-section-kicker {
            color: var(--profile-danger);
        }

        .profile-card-title {
            margin: 0.25rem 0 0;
            color: var(--profile-ink);
            font-size: 1.12rem;
            font-weight: 800;
            letter-spacing: 0;
        }

        .profile-card-description {
            margin: 0.25rem 0 0;
            color: var(--profile-muted);
            font-size: 0.78rem;
            line-height: 1.55;
        }

        .profile-card-icon {
            display: grid;
            width: 40px;
            height: 40px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(81, 70, 229, 0.15);
            border-radius: 8px;
            background: rgba(81, 70, 229, 0.08);
            color: var(--profile-indigo);
        }

        .profile-card--security .profile-card-icon {
            border-color: rgba(31, 157, 120, 0.16);
            background: rgba(31, 157, 120, 0.09);
            color: var(--profile-mint);
        }

        .profile-card--danger .profile-card-icon {
            border-color: rgba(217, 77, 92, 0.16);
            background: rgba(217, 77, 92, 0.08);
            color: var(--profile-danger);
        }

        .profile-card-icon svg {
            width: 19px;
            height: 19px;
        }

        .profile-card-body {
            padding: 1.35rem;
        }

        /* Flatten the visual wrappers supplied by the reusable form partials. */
        .profile-form-scope > section {
            overflow: visible !important;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        .profile-form-scope--info > section > div:first-child,
        .profile-form-scope > section > header {
            display: none !important;
        }

        .profile-form-scope--info > section > form,
        .profile-form-scope > section > form {
            margin-top: 0 !important;
            padding: 0 !important;
        }

        .profile-form-scope [class*="rounded-["],
        .profile-form-scope .rounded-3xl,
        .profile-form-scope .rounded-2xl,
        .profile-form-scope .rounded-xl {
            border-radius: 8px !important;
        }

        .profile-form-scope label,
        .profile-form-scope .block.font-medium {
            display: block;
            margin-bottom: 0.5rem !important;
            color: #374156 !important;
            font-size: 0.75rem !important;
            font-weight: 800 !important;
            letter-spacing: 0.03em;
        }

        .profile-form-scope input[type="text"],
        .profile-form-scope input[type="email"],
        .profile-form-scope input[type="password"],
        .profile-form-scope input[type="tel"],
        .profile-form-scope textarea,
        .profile-form-scope select {
            width: 100%;
            min-height: 48px;
            padding: 0.75rem 0.9rem !important;
            border: 1px solid rgba(100, 111, 136, 0.25) !important;
            border-radius: 8px !important;
            outline: none !important;
            background: rgba(255, 255, 255, 0.62) !important;
            color: var(--profile-ink) !important;
            font-size: 0.86rem !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
            transition: border-color 180ms ease, box-shadow 180ms ease, background 180ms ease !important;
        }

        .profile-form-scope input::placeholder,
        .profile-form-scope textarea::placeholder {
            color: #9aa3b2 !important;
        }

        .profile-form-scope input:focus,
        .profile-form-scope textarea:focus,
        .profile-form-scope select:focus {
            border-color: rgba(81, 70, 229, 0.7) !important;
            background: rgba(255, 255, 255, 0.88) !important;
            box-shadow: 0 0 0 4px rgba(81, 70, 229, 0.1) !important;
        }

        .profile-form-scope--security input:focus {
            border-color: rgba(31, 157, 120, 0.72) !important;
            box-shadow: 0 0 0 4px rgba(31, 157, 120, 0.11) !important;
        }

        .profile-form-scope input[type="file"] {
            width: 100%;
            padding: 0.6rem !important;
            border: 1px dashed rgba(81, 70, 229, 0.34) !important;
            border-radius: 8px !important;
            background: rgba(255, 255, 255, 0.5) !important;
            color: var(--profile-muted) !important;
            font-size: 0.75rem !important;
        }

        .profile-form-scope input[type="file"]::file-selector-button {
            margin-right: 0.65rem;
            padding: 0.55rem 0.75rem;
            border: 0;
            border-radius: 6px;
            background: var(--profile-indigo);
            color: white;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        .profile-form-scope--info form > .grid > div:first-child > div {
            border: 1px solid rgba(81, 70, 229, 0.14) !important;
            border-radius: 8px !important;
            background: rgba(239, 239, 255, 0.5) !important;
        }

        .profile-form-scope--info form > .grid > div:first-child img {
            border-radius: 8px !important;
        }

        .profile-form-scope p.text-sm {
            color: var(--profile-muted) !important;
            font-size: 0.78rem !important;
            line-height: 1.6 !important;
        }

        .profile-form-scope [class*="text-rose"],
        .profile-form-scope [class*="text-red"] {
            color: #c73f51 !important;
        }

        .profile-form-scope button[type="submit"],
        .profile-form-scope--danger > section > button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0.7rem 1rem !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            border-radius: 8px !important;
            background: linear-gradient(135deg, #5a4de8, #4338ca) !important;
            color: white !important;
            font-size: 0.78rem !important;
            font-weight: 800 !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 12px 24px -14px rgba(67, 56, 202, 0.85) !important;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease !important;
        }

        .profile-form-scope button[type="submit"]:hover,
        .profile-form-scope--danger > section > button:hover {
            transform: translateY(-2px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 16px 28px -14px rgba(67, 56, 202, 0.9) !important;
        }

        .profile-form-scope--security button[type="submit"] {
            background: linear-gradient(135deg, #27a681, #168463) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 12px 24px -14px rgba(22, 132, 99, 0.9) !important;
        }

        .profile-form-scope--danger > section > button,
        .profile-form-scope--danger button[type="submit"] {
            background: linear-gradient(135deg, #e25a68, #c83c4c) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 12px 24px -14px rgba(200, 60, 76, 0.85) !important;
        }

        .profile-form-scope--danger > section > button {
            margin-top: 0 !important;
        }

        .profile-form-scope form > div:last-child > p[x-data] {
            display: none !important;
        }

        .profile-form-scope--danger [x-cloak] > .relative > div {
            border-color: rgba(255, 255, 255, 0.7) !important;
            border-radius: 8px !important;
            background: rgba(255, 255, 255, 0.9) !important;
            -webkit-backdrop-filter: blur(28px) saturate(140%);
            backdrop-filter: blur(28px) saturate(140%);
        }

        .profile-form-scope--danger button[type="button"] {
            min-height: 44px;
            padding: 0.7rem 1rem !important;
            border: 1px solid #d7dce5 !important;
            border-radius: 8px !important;
            background: white !important;
            color: #4c566a !important;
            font-size: 0.78rem !important;
            font-weight: 800 !important;
        }

        @media (max-width: 960px) {
            .profile-hero-grid,
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-aside {
                display: grid;
                grid-template-columns: 1fr 1fr;
                margin-top: 0;
            }

            .profile-title {
                font-size: 3.4rem;
            }
        }

        @media (max-width: 640px) {
            .profile-wrap {
                width: min(100% - 1rem, 1180px);
                padding-block: 1rem 2.5rem;
            }

            .profile-identity {
                align-items: flex-start;
                padding: 1.35rem;
            }

            .profile-avatar {
                width: 72px;
                height: 72px;
            }

            .profile-online-dot {
                width: 16px;
                height: 16px;
                border-width: 3px;
            }

            .profile-title {
                font-size: 2.55rem;
            }

            .profile-email {
                font-size: 0.78rem;
            }

            .profile-aside {
                grid-template-columns: 1fr;
                margin: 0 0.75rem 0.75rem;
                padding: 1.1rem;
            }

            .profile-card-header,
            .profile-card-body {
                padding: 1rem;
            }

            .profile-form-scope--info form > .grid > div:first-child > div {
                align-items: flex-start !important;
            }
        }

        @media (max-width: 430px) {
            .profile-identity {
                flex-direction: column;
            }

            .profile-card-header {
                align-items: flex-start;
            }

            .profile-title {
                font-size: 2.2rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .profile-hero::before,
            .profile-aside-link,
            .profile-form-scope button {
                transition: none !important;
            }
        }
    </style>

    <div class="profile-page">
        <div class="profile-wrap">
            @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.opacity.duration.300ms
                    x-init="setTimeout(() => show = false, 4000)"
                    class="profile-alert"
                    role="status"
                >
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                    </svg>
                    <span>
                        {{ session('status') === 'profile-updated'
                            ? 'Perubahan profil berhasil disimpan.'
                            : 'Kata sandi berhasil diperbarui.' }}
                    </span>
                </div>
            @endif

            <section class="profile-hero" aria-labelledby="profile-page-title">
                <div class="profile-hero-grid">
                    <div class="profile-identity">
                        <div class="profile-avatar-wrap">
                            <img
                                src="{{ auth()->user()->profile_photo_url }}"
                                alt="Foto profil {{ auth()->user()->name }}"
                                class="profile-avatar"
                            >
                            <span class="profile-online-dot" aria-hidden="true"></span>
                        </div>

                        <div>
                            <p class="profile-kicker">Pengaturan akun</p>
                            <h1 id="profile-page-title" class="profile-title">{{ auth()->user()->name }}</h1>
                            <p class="profile-email">{{ auth()->user()->email }}</p>
                            <span class="profile-status"><span aria-hidden="true"></span>Akun aktif</span>
                        </div>
                    </div>

                    <aside class="profile-aside" aria-label="Ringkasan profil">
                        <div>
                            <p class="profile-aside-label">Kontak WhatsApp</p>
                            <p class="profile-aside-value">{{ auth()->user()->phone ?: 'Belum ditambahkan' }}</p>
                        </div>
                        <div>
                            <p class="profile-aside-label">Visibilitas</p>
                            <p class="profile-aside-value">Siap untuk ditemukan</p>
                        </div>
                        <a href="{{ route('matches.index') }}" class="profile-aside-link">
                            Lihat match terbaru
                            <svg aria-hidden="true" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </a>
                    </aside>
                </div>
            </section>

            <div class="profile-grid">
                <section class="profile-card profile-glass" aria-labelledby="profile-info-title">
                    <header class="profile-card-header">
                        <div>
                            <p class="profile-section-kicker">Identitas</p>
                            <h2 id="profile-info-title" class="profile-card-title">Informasi profil</h2>
                            <p class="profile-card-description">Perbarui foto dan detail yang dilihat pengguna lain.</p>
                        </div>
                        <span class="profile-card-icon" aria-hidden="true">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75a17.9 17.9 0 0 1-7.5-1.65Z" />
                            </svg>
                        </span>
                    </header>
                    <div class="profile-card-body profile-form-scope profile-form-scope--info">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                <div class="profile-stack">
                    <section class="profile-card profile-card--security profile-glass" aria-labelledby="profile-security-title">
                        <header class="profile-card-header">
                            <div>
                                <p class="profile-section-kicker">Keamanan</p>
                                <h2 id="profile-security-title" class="profile-card-title">Kata sandi</h2>
                                <p class="profile-card-description">Gunakan kombinasi yang unik untuk akun ini.</p>
                            </div>
                            <span class="profile-card-icon" aria-hidden="true">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                        </header>
                        <div class="profile-card-body profile-form-scope profile-form-scope--security">
                            @include('profile.partials.update-password-form')
                        </div>
                    </section>

                    <section class="profile-card profile-card--danger profile-glass" aria-labelledby="profile-danger-title">
                        <header class="profile-card-header">
                            <div>
                                <p class="profile-section-kicker">Zona sensitif</p>
                                <h2 id="profile-danger-title" class="profile-card-title">Hapus akun</h2>
                                <p class="profile-card-description">Semua data akan terhapus secara permanen.</p>
                            </div>
                            <span class="profile-card-icon" aria-hidden="true">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21c.35.05.7.1 1.04.16m-1.04-.16-.92 12a2.25 2.25 0 0 1-2.24 2.08H7.93a2.25 2.25 0 0 1-2.24-2.08l-.92-12m14.46 0a48.1 48.1 0 0 0-3.48-.4m-11 .56c.34-.06.69-.11 1.04-.16m0 0a48.1 48.1 0 0 1 3.48-.4m6.48 0v-.92c0-1.18-.91-2.17-2.09-2.2a52.6 52.6 0 0 0-3.32 0c-1.18.03-2.09 1.02-2.09 2.2v.92m7.5 0a48.7 48.7 0 0 0-7.5 0" />
                                </svg>
                            </span>
                        </header>
                        <div class="profile-card-body profile-form-scope profile-form-scope--danger">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

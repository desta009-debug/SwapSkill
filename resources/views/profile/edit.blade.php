<x-app-layout>
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

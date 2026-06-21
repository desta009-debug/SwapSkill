<x-app-layout>
    <style>
        :root {
            --chat-ink: #172033;
            --chat-muted: #687386;
            --chat-indigo: #5146e5;
            --chat-coral: #f06f52;
            --chat-mint: #1f9d78;
            --chat-line: rgba(99, 109, 133, 0.15);
        }

        .chat-page {
            position: relative;
            min-height: calc(100vh - 5rem);
            overflow: hidden;
            background:
                linear-gradient(125deg, rgba(81, 70, 229, 0.16), transparent 34%),
                linear-gradient(305deg, rgba(240, 111, 82, 0.16), transparent 32%),
                linear-gradient(180deg, #edf2f8 0%, #f8fafc 55%, #eef8f4 100%);
            color: var(--chat-ink);
            isolation: isolate;
        }

        .chat-page::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(23, 32, 51, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(23, 32, 51, 0.035) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(to bottom, black, transparent 88%);
            pointer-events: none;
        }

        .chat-shell {
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            width: min(100% - 2rem, 1400px);
            height: calc(100dvh - 7rem);
            min-height: 600px;
            margin-inline: auto;
            padding-block: 1rem;
        }

        .chat-glass {
            border: 1px solid rgba(255, 255, 255, 0.82);
            background: rgba(255, 255, 255, 0.58);
            -webkit-backdrop-filter: blur(26px) saturate(145%);
            backdrop-filter: blur(26px) saturate(145%);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.95),
                0 22px 60px -34px rgba(37, 44, 85, 0.55);
        }

        .chat-sidebar {
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border-radius: 8px 0 0 8px;
            border-right-color: var(--chat-line);
        }

        .chat-sidebar-header {
            flex: 0 0 auto;
            padding: 1.25rem;
            border-bottom: 1px solid var(--chat-line);
            background: rgba(255, 255, 255, 0.28);
        }

        .chat-kicker {
            margin: 0;
            color: var(--chat-indigo);
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .chat-sidebar-title {
            margin: 0.25rem 0 0;
            color: var(--chat-ink);
            font-family: 'Fraunces', serif;
            font-size: 1.7rem;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .chat-sidebar-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-top: 0.85rem;
            color: var(--chat-muted);
            font-size: 0.72rem;
            font-weight: 700;
        }

        .chat-count {
            display: inline-flex;
            min-width: 25px;
            height: 25px;
            align-items: center;
            justify-content: center;
            padding-inline: 0.45rem;
            border: 1px solid rgba(81, 70, 229, 0.15);
            border-radius: 999px;
            background: rgba(81, 70, 229, 0.08);
            color: var(--chat-indigo);
            font-size: 0.68rem;
        }

        .chat-list {
            min-height: 0;
            flex: 1;
            overflow-y: auto;
            scrollbar-color: rgba(81, 70, 229, 0.25) transparent;
            scrollbar-width: thin;
        }

        .chat-thread {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-height: 78px;
            padding: 0.9rem 1rem;
            border-bottom: 1px solid rgba(99, 109, 133, 0.09);
            color: inherit;
            text-decoration: none;
            transition: background 180ms ease;
        }

        .chat-thread:hover {
            background: rgba(255, 255, 255, 0.46);
        }

        .chat-thread--active {
            background: linear-gradient(90deg, rgba(81, 70, 229, 0.13), rgba(255, 255, 255, 0.34));
        }

        .chat-thread--active::before {
            content: "";
            position: absolute;
            inset: 10px auto 10px 0;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--chat-indigo);
        }

        .chat-thread-avatar,
        .chat-partner-avatar {
            flex: 0 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.86);
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 6px 18px -10px rgba(25, 32, 62, 0.65);
        }

        .chat-thread-avatar {
            width: 48px;
            height: 48px;
        }

        .chat-thread-body {
            min-width: 0;
            flex: 1;
        }

        .chat-thread-line {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 0.6rem;
        }

        .chat-thread-name {
            min-width: 0;
            overflow: hidden;
            color: var(--chat-ink);
            font-size: 0.82rem;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .chat-thread--active .chat-thread-name {
            color: var(--chat-indigo);
        }

        .chat-thread-time {
            flex: 0 0 auto;
            color: #929aaa;
            font-size: 0.62rem;
            font-weight: 700;
        }

        .chat-thread-preview {
            min-width: 0;
            flex: 1;
            overflow: hidden;
            color: var(--chat-muted);
            font-size: 0.72rem;
            line-height: 1.45;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .chat-thread-preview--unread {
            color: #394257;
            font-weight: 800;
        }

        .chat-unread {
            display: inline-flex;
            min-width: 20px;
            height: 20px;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            padding-inline: 0.35rem;
            border-radius: 999px;
            background: var(--chat-coral);
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            box-shadow: 0 7px 16px -9px rgba(240, 111, 82, 0.9);
        }

        .chat-panel {
            position: relative;
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border-radius: 0 8px 8px 0;
            border-left: 0;
        }

        .chat-header {
            position: relative;
            z-index: 2;
            display: flex;
            min-height: 78px;
            flex: 0 0 auto;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--chat-line);
            background: rgba(255, 255, 255, 0.44);
            -webkit-backdrop-filter: blur(22px) saturate(140%);
            backdrop-filter: blur(22px) saturate(140%);
        }

        .chat-partner {
            display: flex;
            min-width: 0;
            align-items: center;
            gap: 0.75rem;
        }

        .chat-partner-avatar-wrap {
            position: relative;
            flex: 0 0 auto;
        }

        .chat-partner-avatar {
            width: 44px;
            height: 44px;
        }

        .chat-online-dot {
            position: absolute;
            right: 0;
            bottom: 1px;
            width: 12px;
            height: 12px;
            border: 2px solid rgba(255, 255, 255, 0.92);
            border-radius: 50%;
            background: #39c995;
        }

        .chat-partner-copy {
            min-width: 0;
        }

        .chat-partner-name {
            overflow: hidden;
            margin: 0;
            color: var(--chat-ink);
            font-size: 0.9rem;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .chat-partner-status {
            margin: 0.15rem 0 0;
            color: var(--chat-mint);
            font-size: 0.68rem;
            font-weight: 700;
        }

        .chat-icon-button {
            display: none;
            width: 40px;
            height: 40px;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(81, 70, 229, 0.14);
            border-radius: 8px;
            background: rgba(81, 70, 229, 0.08);
            color: var(--chat-indigo);
        }

        .chat-complete-button {
            min-height: 40px;
            padding: 0.65rem 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 8px;
            background: linear-gradient(135deg, #27a681, #168463);
            color: white;
            font-size: 0.72rem;
            font-weight: 800;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 12px 24px -14px rgba(22, 132, 99, 0.9);
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .chat-complete-button:hover {
            transform: translateY(-2px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 16px 28px -14px rgba(22, 132, 99, 0.95);
        }

        .chat-messages {
            position: relative;
            min-height: 0;
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem;
            background:
                linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)),
                linear-gradient(rgba(81, 70, 229, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(81, 70, 229, 0.025) 1px, transparent 1px);
            background-size: auto, 32px 32px, 32px 32px;
            scrollbar-color: rgba(81, 70, 229, 0.24) transparent;
            scrollbar-width: thin;
        }

        .chat-notice {
            width: fit-content;
            max-width: 90%;
            margin: 0 auto 1.25rem;
            padding: 0.45rem 0.7rem;
            border: 1px solid rgba(81, 70, 229, 0.13);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.62);
            color: var(--chat-muted);
            font-size: 0.64rem;
            font-weight: 700;
            text-align: center;
            -webkit-backdrop-filter: blur(16px);
            backdrop-filter: blur(16px);
        }

        .chat-message-row {
            display: flex;
            margin-top: 0.7rem;
        }

        .chat-message-row--mine {
            justify-content: flex-end;
        }

        .chat-message-row--partner {
            justify-content: flex-start;
        }

        .chat-bubble {
            position: relative;
            max-width: min(72%, 680px);
            min-width: 90px;
            padding: 0.75rem 3rem 0.75rem 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 8px;
            color: var(--chat-ink);
            -webkit-backdrop-filter: blur(18px) saturate(135%);
            backdrop-filter: blur(18px) saturate(135%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 12px 30px -24px rgba(31, 38, 69, 0.72);
        }

        .chat-bubble--mine {
            border-color: rgba(81, 70, 229, 0.16);
            background: linear-gradient(135deg, rgba(225, 222, 255, 0.94), rgba(237, 235, 255, 0.82));
        }

        .chat-bubble--partner {
            background: rgba(255, 255, 255, 0.72);
        }

        .chat-bubble-text {
            margin: 0;
            font-size: 0.82rem;
            line-height: 1.6;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .chat-bubble-time {
            position: absolute;
            right: 0.65rem;
            bottom: 0.55rem;
            color: #858ea0;
            font-size: 0.58rem;
            font-weight: 700;
        }

        .chat-composer {
            flex: 0 0 auto;
            padding: 0.8rem 1rem;
            border-top: 1px solid var(--chat-line);
            background: rgba(255, 255, 255, 0.4);
            -webkit-backdrop-filter: blur(24px) saturate(140%);
            backdrop-filter: blur(24px) saturate(140%);
        }

        .chat-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 48px;
            gap: 0.6rem;
        }

        .chat-input {
            width: 100%;
            min-width: 0;
            min-height: 48px;
            padding: 0.75rem 1rem !important;
            border: 1px solid rgba(100, 111, 136, 0.24) !important;
            border-radius: 8px !important;
            outline: none !important;
            background: rgba(255, 255, 255, 0.68) !important;
            color: var(--chat-ink) !important;
            font-size: 0.82rem !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.92) !important;
            transition: border-color 180ms ease, box-shadow 180ms ease, background 180ms ease !important;
        }

        .chat-input::placeholder {
            color: #98a1b2;
        }

        .chat-input:focus {
            border-color: rgba(81, 70, 229, 0.68) !important;
            background: rgba(255, 255, 255, 0.9) !important;
            box-shadow: 0 0 0 4px rgba(81, 70, 229, 0.1) !important;
        }

        .chat-send-button {
            display: inline-flex;
            width: 48px;
            height: 48px;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            background: linear-gradient(135deg, #5a4de8, #4338ca);
            color: white;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 12px 24px -14px rgba(67, 56, 202, 0.88);
            cursor: pointer;
            transition: transform 180ms ease, opacity 180ms ease;
        }

        .chat-send-button:hover {
            transform: translateY(-2px);
        }

        .chat-send-button:disabled {
            cursor: wait;
            opacity: 0.55;
            transform: none;
        }

        .chat-empty {
            display: flex;
            min-height: 0;
            flex: 1;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }

        .chat-empty-content {
            max-width: 360px;
        }

        .chat-empty-logo {
            width: 82px;
            height: 82px;
            margin-inline: auto;
            border: 1px solid rgba(255, 255, 255, 0.86);
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 20px 42px -26px rgba(67, 56, 202, 0.78);
        }

        .chat-empty-title {
            margin: 1.2rem 0 0;
            font-family: 'Fraunces', serif;
            font-size: 2rem;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .chat-empty-copy {
            margin: 0.65rem 0 0;
            color: var(--chat-muted);
            font-size: 0.8rem;
            line-height: 1.7;
        }

        .chat-list-empty {
            display: grid;
            min-height: 240px;
            padding: 2rem;
            place-items: center;
            color: var(--chat-muted);
            text-align: center;
        }

        .chat-list-empty svg {
            width: 42px;
            height: 42px;
            margin-inline: auto;
            color: rgba(81, 70, 229, 0.45);
        }

        .chat-list-empty p {
            margin: 0.7rem 0 0;
            font-size: 0.76rem;
        }

        @media (max-width: 768px) {
            .chat-page {
                min-height: calc(100dvh - 5rem);
            }

            .chat-shell {
                display: block;
                width: min(100% - 1rem, 1400px);
                height: calc(100dvh - 6rem);
                min-height: 520px;
                padding-block: 0.5rem;
            }

            .chat-sidebar,
            .chat-panel {
                width: 100%;
                height: 100%;
                border: 1px solid rgba(255, 255, 255, 0.82);
                border-radius: 8px;
            }

            .chat-sidebar--mobile-hidden,
            .chat-panel--mobile-hidden {
                display: none;
            }

            .chat-icon-button {
                display: inline-flex;
            }

            .chat-bubble {
                max-width: 86%;
            }
        }

        @media (max-width: 480px) {
            .chat-complete-button {
                width: 40px;
                height: 40px;
                overflow: hidden;
                padding: 0;
                font-size: 0;
            }

            .chat-complete-button::before {
                content: "\2713";
                font-size: 1rem;
            }

            .chat-header,
            .chat-composer {
                padding-inline: 0.7rem;
            }

            .chat-messages {
                padding: 0.9rem 0.7rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .chat-thread,
            .chat-complete-button,
            .chat-send-button {
                transition: none !important;
            }
        }
    </style>

    <div class="chat-page">
        <div class="chat-shell">
            <aside class="chat-sidebar chat-glass {{ $skillSwap ? 'chat-sidebar--mobile-hidden' : '' }}" aria-label="Daftar percakapan">
                <header class="chat-sidebar-header">
                    <p class="chat-kicker">SwapSkill chat</p>
                    <h1 class="chat-sidebar-title">Pesan saya</h1>
                    <div class="chat-sidebar-summary">
                        <span>Percakapan aktif</span>
                        <span class="chat-count">{{ $activeSwaps->count() }}</span>
                    </div>
                </header>

                <div class="chat-list">
                    @forelse($activeSwaps as $swap)
                        @php
                            $swapPartner = auth()->id() === $swap->sender_id ? $swap->receiver : $swap->sender;
                            $lastMessage = $swap->messages->first();
                            $isActive = $skillSwap && $skillSwap->id === $swap->id;
                            $unreadCount = $swap->messages->where('sender_id', '!=', auth()->id())->where('is_read', false)->count();
                        @endphp

                        <a
                            href="{{ route('messages.show', $swap) }}"
                            class="chat-thread {{ $isActive ? 'chat-thread--active' : '' }}"
                            @if($isActive) aria-current="page" @endif
                        >
                            <img
                                src="{{ $swapPartner->profile_photo_url }}"
                                alt="Foto profil {{ $swapPartner->name }}"
                                class="chat-thread-avatar"
                            >
                            <div class="chat-thread-body">
                                <div class="chat-thread-line">
                                    <span class="chat-thread-name">{{ $swapPartner->name }}</span>
                                    @if($lastMessage)
                                        <time class="chat-thread-time" datetime="{{ $lastMessage->created_at->toIso8601String() }}">
                                            {{ $lastMessage->created_at->format('H:i') }}
                                        </time>
                                    @endif
                                </div>
                                <div class="chat-thread-line">
                                    <span class="chat-thread-preview {{ $unreadCount > 0 ? 'chat-thread-preview--unread' : '' }}">
                                        @if($lastMessage)
                                            {{ $lastMessage->sender_id === auth()->id() ? 'Anda: ' : '' }}{{ $lastMessage->message }}
                                        @else
                                            Belum ada obrolan
                                        @endif
                                    </span>
                                    @if($unreadCount > 0)
                                        <span class="chat-unread" aria-label="{{ $unreadCount }} pesan belum dibaca">{{ $unreadCount }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="chat-list-empty">
                            <div>
                                <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0 4.97 4.37 9 9.75 9a10.6 10.6 0 0 0 4.26-.88L21.75 21l-1.54-3.08A8.57 8.57 0 0 0 21.75 12c0-4.97-4.37-9-9.75-9s-9.75 4.03-9.75 9Z" />
                                </svg>
                                <p>Belum ada percakapan aktif.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </aside>

            <section class="chat-panel chat-glass {{ !$skillSwap ? 'chat-panel--mobile-hidden' : '' }}" aria-label="Ruang percakapan">
                @if($skillSwap)
                    <header class="chat-header">
                        <div class="chat-partner">
                            <button type="button" onclick="document.querySelector('.chat-sidebar').classList.remove('chat-sidebar--mobile-hidden'); document.querySelector('.chat-panel').classList.add('chat-panel--mobile-hidden');" class="chat-icon-button" aria-label="Kembali ke daftar pesan" title="Kembali">
                                <svg aria-hidden="true" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />
                                </svg>
                            </button>
                            <div class="chat-partner-avatar-wrap">
                                <img src="{{ $partner->profile_photo_url }}" alt="Foto profil {{ $partner->name }}" class="chat-partner-avatar">
                                <span class="chat-online-dot" aria-hidden="true"></span>
                            </div>
                            <div class="chat-partner-copy">
                                <h2 class="chat-partner-name">{{ $partner->name }}</h2>
                                <p class="chat-partner-status">Partner swap aktif</p>
                            </div>
                        </div>

                        <form action="{{ route('swaps.complete', $skillSwap) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="chat-complete-button"
                                title="Tandai swap selesai"
                                onclick="return confirm('Selesaikan skill swap ini?')"
                            >
                                Tandai selesai
                            </button>
                        </form>
                    </header>

                    <div
                        id="chat-messages"
                        class="chat-messages"
                        data-last-id="{{ $messages->last()?->id ?? 0 }}"
                        aria-live="polite"
                    >
                        <div class="chat-notice">Percakapan ini hanya terlihat oleh Anda dan partner swap.</div>

                        @foreach($messages as $message)
                            @php($isMine = $message->sender_id === auth()->id())
                            <div class="chat-message-row {{ $isMine ? 'chat-message-row--mine' : 'chat-message-row--partner' }}">
                                <div class="chat-bubble {{ $isMine ? 'chat-bubble--mine' : 'chat-bubble--partner' }}">
                                    <p class="chat-bubble-text">{{ $message->message }}</p>
                                    <time class="chat-bubble-time" datetime="{{ $message->created_at->toIso8601String() }}">
                                        {{ $message->created_at->format('H:i') }}
                                    </time>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="chat-composer">
                        <form id="chat-form" class="chat-form">
                            @csrf
                            <input
                                type="text"
                                id="message-input"
                                name="message"
                                class="chat-input"
                                placeholder="Tulis pesan..."
                                aria-label="Pesan"
                                required
                                autocomplete="off"
                            >
                            <button type="submit" id="send-btn" class="chat-send-button" aria-label="Kirim pesan" title="Kirim pesan">
                                <svg aria-hidden="true" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 12-3.27 9 18.54-9L2.73 3 6 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="chat-empty">
                        <div class="chat-empty-content">
                            <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill" class="chat-empty-logo">
                            <h2 class="chat-empty-title">Mulai percakapan</h2>
                            <p class="chat-empty-copy">Pilih partner dari daftar pesan untuk membahas jadwal, materi, dan progres skill swap.</p>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>

    @if($skillSwap)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const messagesContainer = document.getElementById('chat-messages');
                const chatForm = document.getElementById('chat-form');
                const messageInput = document.getElementById('message-input');
                const sendBtn = document.getElementById('send-btn');

                const currentUserId = {{ auth()->id() }};
                const skillSwapId = {{ $skillSwap->id }};

                function scrollToBottom() {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }

                function escapeHtml(unsafe) {
                    return unsafe
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#039;');
                }

                function appendMessage(message, isMine) {
                    const time = new Date(message.created_at).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const rowClass = isMine ? 'chat-message-row--mine' : 'chat-message-row--partner';
                    const bubbleClass = isMine ? 'chat-bubble--mine' : 'chat-bubble--partner';

                    messagesContainer.insertAdjacentHTML('beforeend', `
                        <div class="chat-message-row ${rowClass}">
                            <div class="chat-bubble ${bubbleClass}">
                                <p class="chat-bubble-text">${escapeHtml(message.message)}</p>
                                <time class="chat-bubble-time">${time}</time>
                            </div>
                        </div>
                    `);
                    scrollToBottom();
                }

                scrollToBottom();

                chatForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const message = messageInput.value.trim();

                    if (!message) {
                        return;
                    }

                    messageInput.disabled = true;
                    sendBtn.disabled = true;

                    fetch("{{ route('messages.store', $skillSwap) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': chatForm.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Pesan gagal dikirim.');
                            }

                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                messageInput.value = '';
                                appendMessage(data.message, true);
                                messagesContainer.dataset.lastId = data.message.id;
                            }
                        })
                        .catch(error => console.error('Send error:', error))
                        .finally(() => {
                            messageInput.disabled = false;
                            sendBtn.disabled = false;
                            messageInput.focus();
                        });
                });

                setInterval(() => {
                    const lastId = messagesContainer.dataset.lastId;

                    fetch(`/messages/${skillSwapId}/fetch?last_id=${lastId}`, {
                        headers: { 'Accept': 'application/json' }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Pesan baru gagal dimuat.');
                            }

                            return response.json();
                        })
                        .then(messages => {
                            messages.forEach(message => {
                                if (message.sender_id !== currentUserId) {
                                    appendMessage(message, false);
                                }

                                messagesContainer.dataset.lastId = message.id;
                            });
                        })
                        .catch(error => console.error('Polling error:', error));
                }, 3000);
            });
        </script>
    @endif
</x-app-layout>

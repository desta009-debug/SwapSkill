<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SwapSkill</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *,*::before,*::after{box-sizing:border-box;}

        :root{
            --navy:#0D1A63;
            --mid:#1A2CA3;
            --blue:#2845D6;
            --orange:#F68048;
        }

        body{
            font-family:'DM Sans',sans-serif;
            margin:0;
            background:#0D1A63;
            min-height:100vh;
        }

        /* ── LAYOUT ── */
        .l-root{
            min-height:100vh;
            display:grid;
            place-items:center;
            padding:32px 16px;
            background:
                radial-gradient(ellipse 70% 60% at 80% 20%, rgba(40,69,214,0.35) 0%, transparent 65%),
                radial-gradient(ellipse 50% 50% at 10% 80%, rgba(246,128,72,0.10) 0%, transparent 60%),
                #080F3A;
        }

        .l-card{
            width:100%;
            max-width:980px;
            display:grid;
            grid-template-columns:1fr 1fr;
            border-radius:28px;
            overflow:hidden;
            border:1px solid rgba(255,255,255,0.07);
            box-shadow:0 32px 96px rgba(8,15,58,0.55);
        }
        @media(max-width:768px){
            .l-card{grid-template-columns:1fr;}
            .l-left{display:none;}
        }

        /* ── LEFT PANEL ── */
        .l-left{
            background:var(--navy);
            padding:48px 44px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            position:relative;
            overflow:hidden;
        }
        .l-left-glow1{
            position:absolute;pointer-events:none;
            width:400px;height:400px;top:-120px;right:-120px;border-radius:50%;
            background:radial-gradient(circle,rgba(40,69,214,0.40) 0%,transparent 70%);
        }
        .l-left-glow2{
            position:absolute;pointer-events:none;
            width:260px;height:260px;bottom:-80px;left:-60px;border-radius:50%;
            background:radial-gradient(circle,rgba(246,128,72,0.12) 0%,transparent 70%);
        }
        .l-grid-bg{
            position:absolute;inset:0;pointer-events:none;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),
                linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);
            background-size:52px 52px;
        }

        .l-logo{
            position:relative;z-index:1;
            display:inline-flex;align-items:center;gap:12px;
            text-decoration:none;
        }
        .l-logo img{
            width:48px;height:48px;border-radius:14px;object-fit:cover;
            border:1.5px solid rgba(255,255,255,0.14);
        }
        .l-logo-name{
            font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:#fff;
        }
        .l-logo-sub{font-size:12px;color:rgba(255,255,255,0.45);margin-top:2px;}

        .l-left-body{position:relative;z-index:1;}

        .l-pill{
            display:inline-flex;align-items:center;gap:8px;
            background:rgba(246,128,72,0.12);border:1px solid rgba(246,128,72,0.25);
            color:#F68048;font-family:'Syne',sans-serif;font-size:10px;font-weight:700;
            letter-spacing:0.28em;text-transform:uppercase;border-radius:100px;padding:5px 14px;
            margin-bottom:20px;
        }
        .l-dot{width:6px;height:6px;border-radius:50%;background:#F68048;animation:lpulse 2s ease-in-out infinite;}
        @keyframes lpulse{0%,100%{opacity:1}50%{opacity:0.3}}

        .l-left-title{
            font-family:'Syne',sans-serif;font-size:clamp(1.8rem,2.8vw,2.6rem);
            font-weight:800;color:#fff;line-height:1.1;letter-spacing:-0.02em;margin:0 0 16px;
        }
        .l-left-title .acc{
            background:linear-gradient(135deg,#F68048,#FFB347);
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
        }
        .l-left-desc{font-size:13.5px;line-height:1.8;color:rgba(255,255,255,0.48);margin:0 0 28px;}

        .l-feature{
            background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);
            border-radius:16px;padding:18px 20px;
        }
        .l-feature-ey{font-family:'Syne',sans-serif;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.25em;color:rgba(255,255,255,0.35);}
        .l-feature-t{font-family:'Syne',sans-serif;font-size:15px;font-weight:800;color:#fff;margin:6px 0 6px;}
        .l-feature-d{font-size:12px;color:rgba(255,255,255,0.45);line-height:1.6;}

        .l-copy{position:relative;z-index:1;font-size:11px;color:rgba(255,255,255,0.25);}

        /* ── RIGHT PANEL ── */
        .l-right{
            background:#0B1230;
            padding:52px 48px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        @media(max-width:480px){.l-right{padding:36px 24px;}}

        .l-form-wrap{width:100%;max-width:360px;}

        /* mobile logo */
        .l-mob-logo{
            display:none;flex-direction:column;align-items:center;text-align:center;
            margin-bottom:32px;
        }
        @media(max-width:768px){.l-mob-logo{display:flex;}}
        .l-mob-logo img{width:56px;height:56px;border-radius:16px;object-fit:cover;border:1.5px solid rgba(255,255,255,0.12);}
        .l-mob-logo-name{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#fff;margin-top:10px;}
        .l-mob-logo-sub{font-size:12px;color:rgba(255,255,255,0.40);margin-top:3px;}

        .l-eyebrow{
            font-family:'Syne',sans-serif;font-size:10px;font-weight:700;
            text-transform:uppercase;letter-spacing:.3em;color:#F68048;
        }
        .l-title{
            font-family:'Syne',sans-serif;font-size:clamp(1.5rem,2.5vw,2rem);
            font-weight:800;color:#fff;letter-spacing:-0.01em;margin:10px 0 8px;line-height:1.15;
        }
        .l-subtitle{font-size:13px;color:rgba(255,255,255,0.42);line-height:1.7;margin:0 0 28px;}

        /* inputs */
        .l-field{margin-bottom:16px;}
        .l-label{
            display:block;font-family:'Syne',sans-serif;font-size:10px;font-weight:700;
            text-transform:uppercase;letter-spacing:.25em;color:rgba(255,255,255,0.40);margin-bottom:8px;
        }
        .l-input{
            width:100%;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);
            border-radius:14px;padding:13px 16px;font-size:14px;color:#fff;
            font-family:'DM Sans',sans-serif;outline:none;
            transition:border-color .18s,background .18s,box-shadow .18s;
        }
        .l-input::placeholder{color:rgba(255,255,255,0.20);}
        .l-input:focus{
            border-color:rgba(246,128,72,0.55);
            background:rgba(246,128,72,0.05);
            box-shadow:0 0 0 4px rgba(246,128,72,0.08);
        }
        .l-err{font-size:12px;color:#FF7A7A;margin-top:6px;}

        /* remember / forgot row */
        .l-row{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:20px;}
        .l-check-label{display:inline-flex;align-items:center;gap:8px;font-size:13px;color:rgba(255,255,255,0.50);cursor:pointer;}
        .l-check-label input[type=checkbox]{
            width:15px;height:15px;border-radius:5px;
            border:1.5px solid rgba(255,255,255,0.18);
            background:rgba(255,255,255,0.06);
            accent-color:#F68048;cursor:pointer;
        }
        .l-forgot{font-size:13px;font-weight:600;color:#F68048;text-decoration:none;transition:opacity .15s;}
        .l-forgot:hover{opacity:.75;}

        /* submit */
        .l-submit{
            display:block;width:100%;
            background:linear-gradient(135deg,#2845D6 0%,#F68048 100%);
            color:#fff;font-family:'Syne',sans-serif;font-weight:800;font-size:14px;
            border:none;border-radius:14px;padding:14px;cursor:pointer;
            box-shadow:0 12px 36px rgba(40,69,214,0.30);
            transition:transform .14s,opacity .14s;
            letter-spacing:.02em;
        }
        .l-submit:hover{transform:translateY(-2px);opacity:.93;}
        .l-submit:active{transform:scale(.99);}

        /* register link */
        .l-reg{text-align:center;margin-top:20px;font-size:13px;color:rgba(255,255,255,0.40);}
        .l-reg a{color:#F68048;font-weight:700;text-decoration:none;transition:opacity .15s;}
        .l-reg a:hover{opacity:.75;}

        .l-divider{height:1px;background:rgba(255,255,255,0.06);margin:20px 0;}

        .l-back{
            display:block;text-align:center;font-size:12.5px;font-weight:600;
            color:rgba(255,255,255,0.30);text-decoration:none;transition:color .15s;
        }
        .l-back:hover{color:rgba(255,255,255,0.60);}
    </style>
</head>
<body>
    <div class="l-root">
        <div class="l-card">

            {{-- ── LEFT PANEL ── --}}
            <div class="l-left">
                <div class="l-left-glow1"></div>
                <div class="l-left-glow2"></div>
                <div class="l-grid-bg"></div>

                <a href="{{ url('/') }}" class="l-logo">
                    <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo">
                    <div>
                        <p class="l-logo-name">SwapSkill</p>
                        <p class="l-logo-sub">Tukar skill. Naik level.</p>
                    </div>
                </a>

                <div class="l-left-body">
                    <span class="l-pill"><span class="l-dot"></span>Selamat datang kembali</span>
                    <h2 class="l-left-title">Masuk dan lanjutkan<br><span class="acc">perjalanan skill-mu.</span></h2>
                    <p class="l-left-desc">SwapSkill membantu kamu menemukan partner belajar yang tepat dan melanjutkan koneksi langsung lewat WhatsApp.</p>
                    <div class="l-feature">
                        <p class="l-feature-ey">Fitur utama</p>
                        <p class="l-feature-t">Smart Matching</p>
                        <p class="l-feature-d">Sistem mencocokkan skill dan level agar hasil match lebih relevan dan akurat.</p>
                    </div>
                </div>

                <p class="l-copy">© {{ date('Y') }} SwapSkill. Semua hak dilindungi.</p>
            </div>

            {{-- ── RIGHT PANEL ── --}}
            <div class="l-right">
                <div class="l-form-wrap">

                    {{-- Mobile logo --}}
                    <div class="l-mob-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}" alt="SwapSkill Logo">
                        </a>
                        <p class="l-mob-logo-name">SwapSkill</p>
                        <p class="l-mob-logo-sub">Tukar skill. Naik level.</p>
                    </div>

                    <p class="l-eyebrow">Login akun</p>
                    <h1 class="l-title">Masuk ke akun kamu</h1>
                    <p class="l-subtitle">Isi email dan password untuk lanjut ke dashboard SwapSkill.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="l-field">
                            <label for="email" class="l-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                required autofocus autocomplete="username"
                                placeholder="you@example.com" class="l-input">
                            @error('email')
                                <p class="l-err">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="l-field">
                            <label for="password" class="l-label">Password</label>
                            <input id="password" type="password" name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" class="l-input">
                            @error('password')
                                <p class="l-err">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="l-row">
                            <label class="l-check-label">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Ingat saya</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="l-forgot">Lupa password?</a>
                            @endif
                        </div>

                        <button type="submit" class="l-submit">Masuk Sekarang →</button>
                    </form>

                    @if (Route::has('register'))
                        <p class="l-reg">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                    @endif

                    <div class="l-divider"></div>

                    <a href="{{ url('/') }}" class="l-back">← Kembali ke landing page</a>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
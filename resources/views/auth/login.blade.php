<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk ke Akun — Smart Bin WIn Bandung</title>

    <!-- Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'win-green': '#287A4D',
                        'win-green-dark': '#1E5C3A',
                        'win-green-light': '#F0F7F3',
                        'win-dark': '#1C2822',
                        'win-slate': '#5C7065',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="max-w-4xl w-full bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[580px]">
        
        <!-- ============================================================== -->
        <!-- LEFT PANEL: Visual Brand & Value (Visible on Desktop) -->
        <!-- ============================================================== -->
        <div class="lg:col-span-5 bg-gradient-to-br from-[#1E5C3A] to-[#287A4D] p-8 sm:p-10 text-white flex flex-col justify-between relative overflow-hidden">
            
            <div class="space-y-6 relative z-10">
                <!-- Brand Header -->
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center font-bold text-white text-base">
                        SB
                    </div>
                    <div>
                        <div class="font-extrabold text-base tracking-tight leading-tight">SmartBin</div>
                        <div class="text-[10px] font-bold text-emerald-200 uppercase tracking-wider">WIn Bandung</div>
                    </div>
                </a>

                <!-- Message -->
                <div class="space-y-2 pt-4">
                    <h2 class="text-xl sm:text-2xl font-extrabold leading-snug">
                        Pilah Sampah, Kumpulkan Poin, Jaga Bandung.
                    </h2>
                    <p class="text-xs text-emerald-100/90 leading-relaxed">
                        Akses fitur personal Anda untuk setor sampah di stasiun Smart Bin dan dapatkan reward daur ulang.
                    </p>
                </div>

                <!-- 3 Key Features -->
                <div class="space-y-3 pt-2 text-xs">
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/10 backdrop-blur-sm">
                        <span class="text-sm">🪙</span>
                        <span>Akumulasi Poin Daur Ulang</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/10 backdrop-blur-sm">
                        <span class="text-sm">📱</span>
                        <span>Token QR Pribadi ke Mesin Fisik</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/10 backdrop-blur-sm">
                        <span class="text-sm">📷</span>
                        <span>Scan Sampah AI Kamera HP</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="pt-6 border-t border-white/15 text-[11px] text-emerald-200/80 relative z-10 flex items-center justify-between">
                <span>Pilot Project UIN SGD & DLH</span>
                <a href="{{ route('home') }}" class="text-white hover:underline">&larr; Beranda</a>
            </div>

            <!-- Ambient Glow -->
            <div class="absolute -right-16 -bottom-16 w-60 h-60 rounded-full bg-emerald-400/20 blur-2xl pointer-events-none"></div>
        </div>

        <!-- ============================================================== -->
        <!-- RIGHT PANEL: Clean & Seamless Login Form -->
        <!-- ============================================================== -->
        <div class="lg:col-span-7 p-8 sm:p-10 flex flex-col justify-center space-y-6">
            
            <div class="space-y-1">
                <h1 class="text-2xl font-extrabold text-win-dark">Masuk ke Akun</h1>
                <p class="text-xs text-slate-500">Gunakan akun Google Anda atau masuk dengan email terdaftar.</p>
            </div>

            <!-- Session Status / Alert -->
            @if (session('status'))
                <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <!-- 1. Google OAuth Button (Full Width, Crisp & Prominent) -->
            <div>
                <a href="{{ route('auth.google') }}" 
                   class="w-full flex items-center justify-center gap-3 bg-white border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 font-bold py-3 px-4 rounded-xl shadow-sm hover:shadow transition">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <span class="text-xs sm:text-sm">Masuk dengan Google (Cepat)</span>
                </a>

                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-[11px] uppercase">
                        <span class="bg-white px-3 text-slate-400 font-semibold">atau dengan email</span>
                    </div>
                </div>
            </div>

            <!-- 2. Credential Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div class="space-y-1">
                    <label for="email" class="block text-xs font-bold text-win-dark">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="nama@email.com"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-win-green focus:ring-2 focus:ring-win-green/20 outline-none text-xs sm:text-sm transition text-win-dark">
                    @if ($errors->has('email'))
                        <p class="text-xs text-rose-600 font-medium">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-win-dark">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] text-win-green hover:underline font-semibold">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-win-green focus:ring-2 focus:ring-win-green/20 outline-none text-xs sm:text-sm transition text-win-dark">
                    @if ($errors->has('password'))
                        <p class="text-xs text-rose-600 font-medium">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-win-green focus:ring-win-green">
                        <span class="text-xs text-slate-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Primary Submit Button -->
                <button type="submit" 
                        class="w-full py-3 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs sm:text-sm shadow-md shadow-win-green/20 hover:shadow-lg transition">
                    Masuk ke Akun
                </button>
            </form>

            <!-- Bottom Footer Link -->
            <div class="pt-2 text-center text-xs text-slate-500">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="font-bold text-win-green hover:underline ml-1">
                    Daftar Akun Baru
                </a>
            </div>

        </div>

    </div>

</body>
</html>

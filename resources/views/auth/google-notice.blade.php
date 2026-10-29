<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sign-In — SmartBin AI IoT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-800 border border-slate-700/80 rounded-2xl p-6 md:p-8 shadow-2xl shadow-cyan-950/40 text-center">
        <div class="w-16 h-16 bg-white/10 rounded-2xl border border-white/20 flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-9 h-9" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-white mb-2">Google Sign-In SmartBin</h1>
        <p class="text-sm text-slate-400 mb-6 leading-relaxed">
            Sistem autentikasi Google telah terintegrasi dengan arsitektur peran pengguna dan token QR personal.
        </p>

        <!-- Tombol Masuk Instan Demo -->
        <a href="{{ route('auth.google', ['demo' => 1]) }}" 
           class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-semibold py-3.5 px-5 rounded-xl shadow-lg shadow-emerald-950/30 transition transform hover:-translate-y-0.5 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Masuk dengan Akun Google (Mode Pengujian)
        </a>

        <!-- Petunjuk Kredensial Produksi -->
        <div class="bg-slate-900/80 border border-slate-700/60 rounded-xl p-4 text-left text-xs text-slate-300 space-y-2 mb-6">
            <div class="font-semibold text-cyan-400 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Konfigurasi Produksi (smartbin.myoin.id):
            </div>
            <p>Untuk mengaktifkan Google OAuth resmi dari Google Cloud Console, tambahkan ke file <code class="text-amber-300">.env</code>:</p>
            <pre class="bg-black/40 p-2.5 rounded text-[11px] font-mono text-emerald-400 overflow-x-auto">GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=https://smartbin.myoin.id/auth/google/callback</pre>
        </div>

        <a href="{{ route('login') }}" class="text-sm text-slate-400 hover:text-white transition">
            &larr; Kembali ke halaman Login Biasa
        </a>
    </div>
</body>
</html>

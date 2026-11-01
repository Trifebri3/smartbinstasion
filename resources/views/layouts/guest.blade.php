<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Bin — WIn Bandung') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN Fallback / Vite -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'win-green': '#287A4D',
                            'win-green-dark': '#1E5C3A',
                            'win-green-light': '#EBF4EF',
                            'win-neutral': '#E5EAE7',
                            'win-dark': '#26352D',
                            'win-slate': '#5A6E63',
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
    <body class="font-sans text-win-dark antialiased bg-slate-50 min-h-screen flex flex-col justify-center items-center p-4">
        
        <!-- Brand Header -->
        <div class="mb-6 text-center space-y-2">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-win-green flex items-center justify-center text-white shadow-md shadow-win-green/20 group-hover:scale-105 transition">
                    <span class="font-black text-xl">WIn</span>
                </div>
                <div class="text-left">
                    <div class="text-lg font-extrabold text-win-dark tracking-tight">SMART BIN</div>
                    <div class="text-[11px] font-bold text-win-green uppercase tracking-wider">WIn Bandung</div>
                </div>
            </a>
            <p class="text-xs text-win-slate">Masuk untuk mengakses poin, riwayat, dan scanner AI pribadi</p>
        </div>

        <!-- Form Card Container -->
        <div class="w-full sm:max-w-md bg-white border border-win-neutral shadow-sm rounded-3xl p-6 sm:p-8">
            {{ $slot }}
        </div>

        <!-- Back to Public Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-win-slate hover:text-win-green transition flex items-center justify-center gap-1.5">
                <span>&larr;</span>
                <span>Kembali ke Beranda Publik Smart Bin</span>
            </a>
        </div>

    </body>
</html>

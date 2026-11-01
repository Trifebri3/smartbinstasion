<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Bin — UIN Bandung') }}</title>

        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#287A4D">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="SmartBin UIN">
        <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/icons/icon-192.png">
        <link rel="manifest" href="/manifest.json">

        <!-- Fonts -->
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
                            'win-neutral': '#F1F4F2',
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
    <body class="font-sans text-win-dark antialiased bg-slate-50 min-h-screen flex flex-col justify-center items-center p-4">
        
        <!-- Brand Header -->
        <div class="mb-6 text-center space-y-2">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-win-green flex items-center justify-center text-white shadow-md shadow-win-green/20 group-hover:scale-105 transition">
                    <span class="font-black text-sm tracking-wider">UIN</span>
                </div>
                <div class="text-left">
                    <div class="text-lg font-extrabold text-win-dark tracking-tight">SMART BIN</div>
                    <div class="text-[11px] font-bold text-win-green uppercase tracking-wider">UIN Sunan Gunung Djati Bandung</div>
                </div>
            </a>
            <p class="text-xs text-win-slate">Akses fitur personal Smart Bin kampus UIN Bandung</p>
        </div>

        <!-- Form Card Container -->
        <div class="w-full sm:max-w-md bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
            {{ $slot }}
        </div>

        <!-- Back to Public Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-win-slate hover:text-win-green transition inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda Smart Bin</span>
            </a>
        </div>

    </body>
</html>

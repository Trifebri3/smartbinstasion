<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Smart Bin — WIn Bandung')</title>
    <meta name="description" content="Tempat sampah pintar IoT dan panduan pemilahan sampah kota Bandung.">

    <!-- PWA -->
    <meta name="theme-color" content="#287A4D">
    <link rel="manifest" href="/manifest.json">

    <!-- Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFFFF;
            color: #1C2822;
            -webkit-tap-highlight-color: transparent;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-win-dark antialiased">

    <!-- CLEAN & MINIMAL HEADER -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">

            <!-- LOGO: Minimal & Sleek -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 rounded-xl bg-win-green flex items-center justify-center text-white font-bold text-sm shadow-sm group-hover:scale-105 transition">
                    SB
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="font-extrabold text-base tracking-tight text-win-dark">SmartBin</span>
                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-win-green-light text-win-green">Bandung</span>
                </div>
            </a>

            <!-- DESKTOP NAV -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-xs font-semibold transition-colors {{ request()->routeIs('home') ? 'text-win-green font-bold' : 'text-win-slate hover:text-win-dark' }}">
                    Beranda
                </a>
                <a href="{{ route('public.locations') }}" class="text-xs font-semibold transition-colors flex items-center gap-1 {{ request()->routeIs('public.locations*') ? 'text-win-green font-bold' : 'text-win-slate hover:text-win-dark' }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-win-green"></span>
                    <span>Peta Lokasi</span>
                </a>
                <a href="{{ route('public.education') }}" class="text-xs font-semibold transition-colors {{ request()->routeIs('public.education*') ? 'text-win-green font-bold' : 'text-win-slate hover:text-win-dark' }}">
                    Cara Pemilahan
                </a>
            </nav>

            <!-- RIGHT ACTION -->
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('user.portal') }}" class="text-xs font-bold text-win-green bg-win-green-light hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition flex items-center gap-1.5">
                        <span>🪙 {{ number_format(Auth::user()->points) }}</span>
                        <span class="hidden sm:inline font-medium text-win-slate">• Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-win-slate hover:text-win-dark px-2.5 py-1.5 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-win-green hover:bg-win-green-dark text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-sm transition">
                        Daftar
                    </a>
                @endauth

                <!-- Mobile Toggle -->
                <button onclick="toggleNav()" class="md:hidden p-1.5 text-win-slate hover:text-win-dark">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>

        <!-- MOBILE MENU -->
        <div id="nav-mobile" class="hidden md:hidden border-t border-slate-100 bg-white px-4 py-3 space-y-2 text-xs font-semibold">
            <a href="{{ route('home') }}" class="block py-1.5 text-win-dark">Beranda</a>
            <a href="{{ route('public.locations') }}" class="block py-1.5 text-win-green font-bold">Peta Lokasi Smart Bin</a>
            <a href="{{ route('public.education') }}" class="block py-1.5 text-win-dark">Panduan Pemilahan</a>
            <a href="{{ route('public.monitor') }}" class="block py-1.5 text-slate-500">Live IoT Monitor</a>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- MINIMAL FOOTER -->
    <footer class="border-t border-slate-100 py-8 text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-win-green"></span>
                <span class="font-bold text-win-dark">SmartBin Bandung</span>
                <span>• Inovasi Pengelolaan Sampah Cerdas</span>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="{{ route('public.locations') }}" class="hover:text-win-green">Peta</a>
                <a href="{{ route('public.education') }}" class="hover:text-win-green">Edukasi</a>
                <a href="{{ route('public.monitor') }}" class="hover:text-win-green">IoT Monitor</a>
                <a href="{{ route('login') }}" class="hover:text-win-green">Admin</a>
            </div>
        </div>
    </footer>

    <script>
        function toggleNav() {
            const el = document.getElementById('nav-mobile');
            el.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>

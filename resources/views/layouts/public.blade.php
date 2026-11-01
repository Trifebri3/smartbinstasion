<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Smart Bin — WIn Bandung | Waste Management & Environmental Education')</title>
    <meta name="description" content="@yield('meta_description', 'Platform publik pemilahan sampah cerdas bertenaga AI, peta Smart Bin terdekat, dan edukasi lingkungan kota Bandung.')">

    <!-- PWA & Mobile Theme -->
    <meta name="theme-color" content="#287A4D">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts: Plus Jakarta Sans -->
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
                        'win-green-light': '#EBF4EF',
                        'win-neutral': '#E5EAE7',
                        'win-dark': '#26352D',
                        'win-slate': '#5A6E63',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS Base -->
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFFFF;
            color: #26352D;
            -webkit-tap-highlight-color: transparent;
        }
        .bg-win-gradient {
            background: linear-gradient(135deg, #F4F7F5 0%, #FFFFFF 100%);
        }
        .bg-win-hero {
            background: radial-gradient(circle at top right, rgba(40, 122, 77, 0.08) 0%, rgba(255, 255, 255, 0) 60%), #FFFFFF;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-win-dark antialiased">

    <!-- TOP ANNOUNCEMENT BAR (Identitas Kota Bandung) -->
    <div class="bg-win-green text-white text-[11px] sm:text-xs font-medium py-1.5 px-4 text-center tracking-wide flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
        <span>Platform Pengelolaan Sampah Cerdas & Edukasi Lingkungan — Kota Bandung</span>
        <span class="hidden md:inline">•</span>
        <span class="hidden md:inline opacity-90">Kolaborasi Inovasi Mahasiswa & DLH</span>
    </div>

    <!-- MAIN HEADER NAVIGATION -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-win-neutral transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- BRAND LOGO (WIn Bandung) -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group focus:outline-none">
                    <div class="w-12 h-12 rounded-2xl bg-win-green flex items-center justify-center text-white shadow-md shadow-win-green/20 group-hover:scale-105 transition-transform duration-200">
                        <!-- WIn Logo Icon (Leaf + Tech Waves) -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L15 8L21 9L17 14L18 20L12 17L6 20L7 14L3 9L9 8L12 2Z" fill="white" fill-opacity="0.2"/>
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z" />
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-xl font-extrabold tracking-tight text-win-dark">SMART BIN</span>
                            <span class="text-xs font-bold px-2 py-0.5 rounded-md bg-win-green text-white">WIn</span>
                        </div>
                        <p class="text-[11px] font-semibold tracking-wider text-win-green uppercase">Bandung Environmental Platform</p>
                    </div>
                </a>

                <!-- DESKTOP PUBLIC NAVIGATION -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'text-win-green border-b-2 border-win-green pb-1' : 'text-win-dark hover:text-win-green' }}">
                        Beranda
                    </a>
                    <a href="{{ route('public.locations') }}" class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ request()->routeIs('public.locations*') ? 'text-win-green border-b-2 border-win-green pb-1' : 'text-win-dark hover:text-win-green' }}">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Cari Smart Bin</span>
                    </a>
                    <a href="{{ route('public.education') }}" class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ request()->routeIs('public.education*') ? 'text-win-green border-b-2 border-win-green pb-1' : 'text-win-dark hover:text-win-green' }}">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Edukasi Lingkungan</span>
                    </a>
                    <a href="{{ route('public.monitor') }}" class="text-xs font-bold text-slate-500 hover:text-win-green border border-win-neutral hover:border-win-green px-2.5 py-1 rounded-lg transition-colors flex items-center gap-1" title="Lihat kamera & sensor stasiun langsung">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Live IoT Monitor</span>
                    </a>
                </nav>

                <!-- RIGHT ACTION: AUTH OR DASHBOARD -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <!-- Jika Sudah Login -->
                        <div class="flex items-center gap-2 bg-win-green-light border border-win-green/20 px-3.5 py-1.5 rounded-xl">
                            <span class="text-xs">🪙</span>
                            <span class="text-xs font-bold text-win-green">{{ number_format(Auth::user()->points) }}</span>
                            <span class="text-[11px] text-win-slate">Poin</span>
                        </div>
                        <a href="{{ route('user.portal') }}" class="bg-win-green hover:bg-win-green-dark text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Dashboard Saya</span>
                        </a>
                    @else
                        <!-- Jika Tamu / Belum Login -->
                        <a href="{{ route('login') }}" class="text-xs font-bold text-win-dark hover:text-win-green px-3.5 py-2 rounded-xl transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-win-green hover:bg-win-green-dark text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all flex items-center gap-1.5">
                            <span>Daftar Akun</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- MOBILE HAMBURGER TOGGLE -->
                <div class="flex md:hidden items-center gap-2">
                    @auth
                        <a href="{{ route('user.portal') }}" class="bg-win-green text-white text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1">
                            <span>🪙 {{ Auth::user()->points }}</span>
                        </a>
                    @endauth
                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="p-2 rounded-xl text-win-dark hover:bg-win-neutral focus:outline-none" aria-label="Menu">
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE MENU DRAWER -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-win-neutral bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'bg-win-green-light text-win-green font-bold' : 'text-win-dark' }}">
                🏠 Beranda
            </a>
            <a href="{{ route('public.locations') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('public.locations*') ? 'bg-win-green-light text-win-green font-bold' : 'text-win-dark' }}">
                📍 Cari Smart Bin Terdekat
            </a>
            <a href="{{ route('public.education') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('public.education*') ? 'bg-win-green-light text-win-green font-bold' : 'text-win-dark' }}">
                📖 Pusat Edukasi Lingkungan
            </a>
            <a href="{{ route('public.monitor') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-win-green">
                📡 Live IoT Monitor Stasiun
            </a>

            <div class="pt-3 border-t border-win-neutral space-y-2">
                @auth
                    <a href="{{ route('user.portal') }}" class="block w-full text-center bg-win-green text-white font-bold py-2.5 rounded-xl text-sm">
                        Buka Dashboard Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-center text-rose-600 text-xs font-semibold py-2">
                            Keluar Akun
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center border border-win-neutral text-win-dark font-bold py-2.5 rounded-xl text-sm">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-win-green text-white font-bold py-2.5 rounded-xl text-sm">
                        Daftar Akun Baru
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- CONTENT WRAPPER -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-win-dark text-white pt-14 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-win-green flex items-center justify-center text-white font-black text-lg">
                            WIn
                        </div>
                        <div>
                            <span class="text-lg font-bold text-white tracking-tight">SMART BIN</span>
                            <p class="text-xs text-emerald-400 font-semibold tracking-wider uppercase">Kota Bandung Platform</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-sm">
                        Inisiatif pengelolaan sampah modern berbasis Internet of Things (IoT) dan kecerdasan buatan (AI) untuk mewujudkan Bandung Bersih, Sirkular, dan Berkelanjutan.
                    </p>
                    <div class="flex items-center gap-3 pt-2 text-xs text-slate-400">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white/5 border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            Public-First Architecture
                        </span>
                        <span>•</span>
                        <span>PWA Ready</span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Publik -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold tracking-wider text-emerald-400 uppercase">Navigasi Publik</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Beranda Utama</a></li>
                        <li><a href="{{ route('public.locations') }}" class="hover:text-emerald-400 transition">Cari Smart Bin Terdekat</a></li>
                        <li><a href="{{ route('public.education') }}" class="hover:text-emerald-400 transition">Pusat Edukasi Pemilahan</a></li>
                        <li><a href="{{ route('public.monitor') }}" class="hover:text-emerald-400 transition">Live IoT Monitor Kamera</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kategori Sampah -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold tracking-wider text-emerald-400 uppercase">4 Fraksi Wadah</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Wadah Hijau: Organik</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-amber-400"></span> Wadah Kuning: Plastik</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Wadah Biru: Kertas</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Wadah Merah: Logam & Kaca</li>
                    </ul>
                </div>

                <!-- Col 4: Kolaborasi & Lokasi -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold tracking-wider text-emerald-400 uppercase">Mitra & Kampus</h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Pilot Project Kampus 1 UIN Sunan Gunung Djati Bandung & DLH Kota Bandung.
                    </p>
                    <div class="text-[11px] text-slate-400 font-mono">
                        Jl. A.H. Nasution No. 105, Cipadung, Cibiru, Kota Bandung, Jawa Barat 40614
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} SMART BIN — WIn Bandung. Dikembangkan untuk Inovasi Pengelolaan Sampah Berkelanjutan.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="hover:text-emerald-400 transition">Admin Portal</a>
                    <span>•</span>
                    <a href="#top" class="hover:text-emerald-400 transition">Kembali ke Atas &uarr;</a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                hamburger.classList.add('hidden');
                close.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                hamburger.classList.remove('hidden');
                close.classList.add('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>


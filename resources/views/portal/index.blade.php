<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SmartBin User Portal — UIN Bandung</title>

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
    
    <!-- Tailwind CSS -->
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

    <!-- QR Code Generator Lib -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .nav-btn.active { color: #287A4D; font-weight: 700; }
        .nav-btn.active svg { stroke: #287A4D; }
    </style>
</head>
<body class="bg-[#F8FAF9] text-win-dark min-h-screen pb-24 antialiased">

    <!-- Top App Bar (Clean Light Theme) -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 py-3">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="w-10 h-10 rounded-xl bg-win-green flex items-center justify-center font-black text-white text-xs tracking-wider shadow-sm hover:scale-105 transition">
                    UIN
                </a>
                <div>
                    <h1 class="text-sm font-bold text-win-dark tracking-tight">SmartBin UIN Bandung</h1>
                    <p class="text-[11px] text-win-green font-semibold">● Online • Portal Civitas</p>
                </div>
            </div>

            <!-- Profile & Points Pill -->
            <div class="flex items-center gap-2">
                <div class="bg-win-green-light border border-emerald-200 px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v10m-3-7h6"/>
                    </svg>
                    <span class="text-xs font-bold text-win-green" id="header-user-points">{{ number_format($user->points) }}</span>
                    <span class="text-[10px] text-win-slate font-medium">Poin</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" title="Keluar" class="p-2 text-slate-400 hover:text-rose-600 transition rounded-lg hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-2xl mx-auto p-4 space-y-4">

        <!-- PWA Install Banner (Interactive) -->
        <div id="pwa-install-banner" class="hidden bg-win-green-light border border-emerald-200 rounded-2xl p-3.5 shadow-sm flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-win-green text-white flex items-center justify-center font-bold text-xs shrink-0">
                    UIN
                </div>
                <div>
                    <h4 class="text-xs font-bold text-win-dark">Pasang Aplikasi SmartBin UIN</h4>
                    <p class="text-[11px] text-win-slate">Akses instan dari layar HP tanpa browser</p>
                </div>
            </div>
            <div class="flex items-center gap-1.5 shrink-0">
                <button onclick="installPWA()" class="px-3 py-1.5 bg-win-green hover:bg-win-green-dark text-white font-bold text-xs rounded-xl shadow-sm transition">
                    Pasang
                </button>
                <button onclick="dismissPWA()" class="p-1.5 text-slate-400 hover:text-slate-600 text-sm font-bold">
                    &times;
                </button>
            </div>
        </div>

        <!-- User Greeting Card (Clean Light Design) -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 sm:p-5 shadow-sm">
            <div class="flex items-center gap-3.5">
                <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=287A4D&color=fff' }}" 
                     alt="{{ $user->name }}" 
                     class="w-13 h-13 rounded-2xl border-2 border-emerald-500/20 object-cover shadow-sm">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm sm:text-base font-extrabold text-win-dark truncate">{{ $user->name }}</h2>
                        @if($user->isAdmin())
                            <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold px-2 py-0.5 rounded-full">Admin</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold px-2 py-0.5 rounded-full">Civitas UIN</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ $user->email }}</p>
                    <div class="mt-1.5 flex items-center gap-2 text-[11px]">
                        <span class="text-slate-500 font-medium">Token QR:</span>
                        <code class="bg-slate-100 text-win-green border border-slate-200 px-2 py-0.5 rounded font-mono text-[10px] font-bold">{{ $user->qr_code_token }}</code>
                    </div>
                </div>
            </div>

            @if($user->isAdmin())
                <div class="mt-3.5 pt-3 border-t border-slate-100 flex justify-end">
                    <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-win-green hover:underline flex items-center gap-1">
                        Buka Dashboard Admin (Full Control) &rarr;
                    </a>
                </div>
            @endif
        </div>

        <!-- ============================================================== -->
        <!-- TAB 1: TITIK SMARTBIN TERDEKAT -->
        <!-- ============================================================== -->
        <section id="tab-titik" class="tab-content active space-y-3.5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-win-dark flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Titik SmartBin Terdekat</span>
                    </h3>
                    <p class="text-xs text-slate-500">Kapasitas wadah stasiun kampus UIN SGD Bandung</p>
                </div>
                <button onclick="getUserLocation()" class="text-xs font-bold bg-win-green-light hover:bg-emerald-100 text-win-green border border-emerald-200 px-3 py-1.5 rounded-xl transition flex items-center gap-1.5 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Cari Lokasi Saya</span>
                </button>
            </div>

            <div id="nearby-bins-list" class="space-y-3">
                @foreach($stations as $st)
                <div class="bg-white border border-slate-200/80 hover:border-win-green rounded-2xl p-4 transition shadow-sm space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-win-dark text-sm">{{ $st->name }}</h4>
                                <span class="bg-emerald-50 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-200">
                                    {{ strtoupper($st->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $st->location_name }}</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-win-green bg-win-green-light px-2 py-0.5 rounded">
                            {{ $st->uuid ?? $st->station_code }}
                        </span>
                    </div>

                    <!-- 4 Kompartemen Kapasitas (Clean Light Track) -->
                    <div class="pt-2 border-t border-slate-100 grid grid-cols-4 gap-2 text-center text-[10px]">
                        <div>
                            <div class="text-emerald-800 font-semibold mb-1">Organik</div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-emerald-600 h-1.5 rounded-full" style="width: {{ $st->capacity_organik }}%"></div>
                            </div>
                            <span class="text-slate-600 font-bold mt-1 inline-block">{{ (int)$st->capacity_organik }}%</span>
                        </div>
                        <div>
                            <div class="text-amber-800 font-semibold mb-1">Plastik</div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ $st->capacity_plastik }}%"></div>
                            </div>
                            <span class="text-slate-600 font-bold mt-1 inline-block">{{ (int)$st->capacity_plastik }}%</span>
                        </div>
                        <div>
                            <div class="text-blue-800 font-semibold mb-1">Kertas</div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $st->capacity_kertas }}%"></div>
                            </div>
                            <span class="text-slate-600 font-bold mt-1 inline-block">{{ (int)$st->capacity_kertas }}%</span>
                        </div>
                        <div>
                            <div class="text-rose-800 font-semibold mb-1">Logam</div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-rose-500 h-1.5 rounded-full" style="width: {{ $st->capacity_logam }}%"></div>
                            </div>
                            <span class="text-slate-600 font-bold mt-1 inline-block">{{ (int)$st->capacity_logam }}%</span>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $st->latitude }},{{ $st->longitude }}" target="_blank" class="text-slate-500 hover:text-win-green inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <span>Rute Google Maps</span>
                        </a>
                        <a href="{{ route('public.bin-detail', $st->id) }}" class="font-bold text-win-green hover:underline">
                            Detail Wadah &rarr;
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 2: QR CODE SAYA (KUNCI DEPOSIT DI STASIUN) -->
        <!-- ============================================================== -->
        <section id="tab-qr" class="tab-content space-y-4">
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 text-center shadow-sm space-y-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-win-green bg-win-green-light px-2.5 py-1 rounded-full mb-2 inline-block">
                        Kunci Akses SmartBin Fisik
                    </span>
                    <h3 class="text-lg font-bold text-win-dark mb-1">Tunjukkan QR ke Kamera SmartBin</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto leading-relaxed">
                        Arahkan layar HP Anda dengan QR di bawah ini ke kamera stasiun. Mesin akan menyapa <strong class="text-win-green">"Halo, {{ $user->name }}!"</strong> dan mencatat poin Anda secara otomatis.
                    </p>
                </div>

                <!-- Container QR Canvas -->
                <div class="inline-block p-4 bg-white rounded-2xl shadow-md border-2 border-emerald-500/30">
                    <div id="user-qrcode" class="flex justify-center items-center"></div>
                </div>

                <div class="space-y-1">
                    <div class="font-mono text-sm font-extrabold text-win-dark tracking-wider bg-slate-50 border border-slate-200 py-1.5 px-3 rounded-xl inline-block">
                        {{ $user->qr_code_token }}
                    </div>
                    <div class="text-xs text-slate-500">
                        Total Poin Saat Ini: <strong class="text-win-green font-bold">{{ number_format($user->points) }} Poin</strong>
                    </div>
                </div>
            </div>

            <!-- Panduan Langkah Store Sampah -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 space-y-3 shadow-sm">
                <h4 class="text-xs font-bold uppercase tracking-wide text-win-green flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Langkah Setor Sampah & Dapatkan Poin:</span>
                </h4>
                <ol class="text-xs text-slate-600 space-y-2 list-decimal list-inside leading-relaxed">
                    <li><strong class="text-win-dark">Scan QR:</strong> Arahkan kode QR di atas ke kamera scanner stasiun SmartBin.</li>
                    <li><strong class="text-win-dark">Sapaan Pengguna:</strong> Layar SmartBin menampilkan sapaan nama Anda.</li>
                    <li><strong class="text-win-dark">Masukkan Sampah:</strong> Letakkan sampah di wadah yang sesuai (Organik/Plastik/Kertas/Logam).</li>
                    <li><strong class="text-win-dark">Verifikasi & Poin:</strong> Sensor memverifikasi setoran dan poin langsung ditambahkan ke akun Anda!</li>
                </ol>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 3: AI SCANNER VIA KAMERA HP -->
        <!-- ============================================================== -->
        <section id="tab-scan" class="tab-content space-y-4">
            <div>
                <h3 class="text-sm sm:text-base font-extrabold text-win-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Scan Sampah via Kamera HP</span>
                </h3>
                <p class="text-xs text-slate-500">Pindai jenis sampah untuk mengetahui wadah yang tepat dan perolehan poin</p>
            </div>

            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-3 shadow-sm overflow-hidden">
                <!-- Video Preview Camera -->
                <div class="relative bg-slate-900 rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-slate-200">
                    <video id="mobile-cam-video" autoplay playsinline class="w-full h-full object-cover hidden"></video>
                    <canvas id="mobile-cam-canvas" class="hidden"></canvas>
                    
                    <div id="cam-placeholder" class="text-center p-4">
                        <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-2 text-emerald-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-300 mb-3">Kamera belum diaktifkan</p>
                        <button onclick="startMobileCamera()" class="bg-win-green hover:bg-win-green-dark text-white font-bold text-xs px-4 py-2 rounded-xl transition shadow-sm">
                            Nyalakan Kamera
                        </button>
                    </div>

                    <!-- Target Reticle Overlay -->
                    <div id="cam-reticle" class="absolute inset-8 border-2 border-dashed border-emerald-400/80 rounded-xl pointer-events-none hidden flex items-center justify-center">
                        <span class="text-[10px] text-emerald-200 font-bold bg-black/60 px-2 py-0.5 rounded">Fokuskan Sampah Disini</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button id="btn-snap" onclick="captureAndScan()" disabled class="flex-1 bg-win-green hover:bg-win-green-dark disabled:opacity-40 text-white font-bold text-xs py-3 rounded-xl shadow transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Pindai Sampah Sekarang</span>
                    </button>
                    <button onclick="stopMobileCamera()" class="bg-slate-100 text-slate-600 text-xs px-4 py-3 rounded-xl hover:bg-slate-200 transition font-bold">
                        Tutup
                    </button>
                </div>

                <!-- Result Box (Clean Light) -->
                <div id="mobile-scan-result" class="hidden bg-win-green-light border border-emerald-200 rounded-xl p-4 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase text-win-green tracking-wider">Hasil Analisis AI</span>
                        <span id="scan-conf" class="text-xs font-mono font-bold text-emerald-800">96.5%</span>
                    </div>
                    <h4 id="scan-name" class="text-base font-bold text-win-dark">Sampah Plastik</h4>
                    <div class="flex items-center gap-2">
                        <span id="scan-bin" class="bg-white text-win-dark border border-slate-200 text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                            Wadah Biru (BIN 2)
                        </span>
                        <span id="scan-points" class="bg-win-green text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                            +50 Poin
                        </span>
                    </div>
                    <p id="scan-advice" class="text-xs text-slate-600 leading-relaxed pt-1">
                        Kosongkan sisa air/minuman, remas botol untuk menghemat ruang, lalu buang ke SmartBin Kuning.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 4: EDUKASI & EKOTEOLOGI ISLAM -->
        <!-- ============================================================== -->
        <section id="tab-edukasi" class="tab-content space-y-4">
            <div>
                <h3 class="text-sm sm:text-base font-extrabold text-win-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Edukasi Pemilahan & Ekoteologi Islam</span>
                </h3>
                <p class="text-xs text-slate-500">Panduan peduli lingkungan berlandaskan nilai-nilai keislaman</p>
            </div>

            <div class="space-y-3">
                @foreach($educations as $edu)
                <div class="bg-white border border-slate-200/80 rounded-2xl p-4 space-y-2.5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-sm text-win-dark flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-{{ $edu->color_badge }}-500"></span>
                            {{ $edu->title }}
                        </h4>
                        <span class="text-[10px] uppercase font-bold text-{{ $edu->color_badge }}-700 bg-{{ $edu->color_badge }}-50 border border-{{ $edu->color_badge }}-200 px-2 py-0.5 rounded-full">
                            {{ $edu->category }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $edu->summary }}</p>

                    <div class="bg-win-green-light rounded-xl p-3 border border-emerald-200/70 text-xs space-y-1">
                        <div class="text-win-green font-bold flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            <span>Dampak Daur Ulang:</span>
                        </div>
                        <p class="text-slate-600 text-[11px]">{{ $edu->recycling_impact }}</p>
                    </div>

                    <!-- Kutipan Ekoteologi -->
                    <div class="bg-amber-50/70 border-l-2 border-amber-500 rounded-r-xl p-3 text-xs space-y-1">
                        <p class="italic text-amber-950 text-[11px]">"{{ $edu->eco_theology_quote }}"</p>
                        <p class="text-[10px] text-amber-700 font-bold">— {{ $edu->eco_theology_ref }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 5: RIWAYAT SETORAN SAMPAH -->
        <!-- ============================================================== -->
        <section id="tab-riwayat" class="tab-content space-y-4">
            <div>
                <h3 class="text-sm sm:text-base font-extrabold text-win-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Riwayat Setoran & Poin</span>
                </h3>
                <p class="text-xs text-slate-500">Catatan transaksi setoran sampah Anda di SmartBin UIN</p>
            </div>

            <div class="space-y-2">
                @forelse($deposits as $dep)
                <div class="bg-white border border-slate-200/80 rounded-xl p-3.5 flex items-center justify-between shadow-sm">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-win-dark text-xs">{{ $dep->category_label }}</span>
                            <span class="text-[10px] text-slate-500 font-mono">{{ $dep->station_code }}</span>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-0.5">{{ $dep->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <span class="text-xs font-bold text-win-green bg-win-green-light border border-emerald-200 px-2.5 py-1 rounded-lg">
                        +{{ $dep->points_earned }} Poin
                    </span>
                </div>
                @empty
                <div class="bg-white border border-slate-200/80 rounded-2xl p-8 text-center text-slate-400 text-xs shadow-sm">
                    Belum ada riwayat setoran. Tunjukkan QR Code Anda ke kamera SmartBin untuk mulai mengumpulkan poin!
                </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- Bottom Navigation Bar (Clean Mobile Native Light Style) -->
    <nav class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-lg border-t border-slate-200/90 px-2 py-2 shadow-lg">
        <div class="max-w-2xl mx-auto grid grid-cols-5 text-center">
            <button onclick="switchTab('titik')" class="nav-btn active flex flex-col items-center gap-1 py-1 text-slate-400" id="btn-tab-titik">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-[10px]">Titik</span>
            </button>

            <button onclick="switchTab('qr')" class="nav-btn flex flex-col items-center gap-1 py-1 text-slate-400" id="btn-tab-qr">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
                <span class="text-[10px]">QR Saya</span>
            </button>

            <button onclick="switchTab('scan')" class="nav-btn flex flex-col items-center gap-1 py-1 text-slate-400" id="btn-tab-scan">
                <div class="-mt-4 w-11 h-11 bg-win-green rounded-full flex items-center justify-center text-white shadow-md shadow-win-green/40 hover:scale-105 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] text-win-green font-bold">Scan HP</span>
            </button>

            <button onclick="switchTab('edukasi')" class="nav-btn flex flex-col items-center gap-1 py-1 text-slate-400" id="btn-tab-edukasi">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-[10px]">Edukasi</span>
            </button>

            <button onclick="switchTab('riwayat')" class="nav-btn flex flex-col items-center gap-1 py-1 text-slate-400" id="btn-tab-riwayat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="text-[10px]">Riwayat</span>
            </button>
        </div>
    </nav>

    <!-- Client-side Scripts -->
    <script>
        // Inisialisasi QR Code Pengguna
        document.addEventListener('DOMContentLoaded', function () {
            const qrText = "{{ $user->qr_code_token }}";
            new QRCode(document.getElementById("user-qrcode"), {
                text: qrText,
                width: 180,
                height: 180,
                colorDark : "#1C2822",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        });

        // Tab Navigation Switcher
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.nav-btn').forEach(el => el.classList.remove('active'));

            const targetSection = document.getElementById('tab-' + tabId);
            const targetBtn = document.getElementById('btn-tab-' + tabId);

            if (targetSection) targetSection.classList.add('active');
            if (targetBtn) targetBtn.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Ambil Lokasi GPS Pengguna untuk Menghitung Titik Terdekat
        function getUserLocation() {
            if (!navigator.geolocation) {
                alert('Geolocation tidak didukung oleh browser Anda.');
                return;
            }
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                fetch(`/api/station/nearby?lat=${lat}&lng=${lng}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            renderNearbyList(data.stations);
                        }
                    });
            }, function (error) {
                alert('Tidak dapat mendeteksi lokasi GPS: ' + error.message);
            });
        }

        function renderNearbyList(stations) {
            const container = document.getElementById('nearby-bins-list');
            if (!container) return;
            container.innerHTML = '';
            stations.forEach(st => {
                container.innerHTML += `
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm space-y-3">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-win-dark text-sm">${st.name}</h4>
                                    <span class="bg-emerald-50 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-200">
                                        ${st.status.toUpperCase()}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">${st.location_name}</p>
                            </div>
                            <span class="text-xs font-bold text-win-green bg-win-green-light border border-emerald-200 px-2 py-1 rounded-lg">
                                ${st.distance_text}
                            </span>
                        </div>
                    </div>
                `;
            });
        }

        // Kamera HP AI Scanner
        let mobileStream = null;
        function startMobileCamera() {
            const video = document.getElementById('mobile-cam-video');
            const placeholder = document.getElementById('cam-placeholder');
            const reticle = document.getElementById('cam-reticle');
            const btnSnap = document.getElementById('btn-snap');

            navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: 'environment', width: { ideal: 640 }, height: { ideal: 480 } } 
            })
            .then(stream => {
                mobileStream = stream;
                video.srcObject = stream;
                video.classList.remove('hidden');
                placeholder.classList.add('hidden');
                reticle.classList.remove('hidden');
                btnSnap.disabled = false;
            })
            .catch(err => {
                alert('Gagal mengakses kamera HP: ' + err.message);
            });
        }

        function stopMobileCamera() {
            if (mobileStream) {
                mobileStream.getTracks().forEach(track => track.stop());
                mobileStream = null;
            }
            document.getElementById('mobile-cam-video').classList.add('hidden');
            document.getElementById('cam-placeholder').classList.remove('hidden');
            document.getElementById('cam-reticle').classList.add('hidden');
            document.getElementById('btn-snap').disabled = true;
        }

        function captureAndScan() {
            const video = document.getElementById('mobile-cam-video');
            const canvas = document.getElementById('mobile-cam-canvas');
            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            const b64 = canvas.toDataURL('image/jpeg', 0.8);
            const btnSnap = document.getElementById('btn-snap');
            btnSnap.disabled = true;
            btnSnap.innerHTML = `<span>Memindai AI...</span>`;

            fetch('{{ route("user.scan-mobile") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ image: b64 })
            })
            .then(res => res.json())
            .then(data => {
                btnSnap.disabled = false;
                btnSnap.innerHTML = `<span>Pindai Sampah Sekarang</span>`;
                if (data.status === 'ok') {
                    const r = data.result;
                    document.getElementById('mobile-scan-result').classList.remove('hidden');
                    document.getElementById('scan-name').textContent = r.name;
                    document.getElementById('scan-conf').textContent = r.confidence + '%';
                    document.getElementById('scan-bin').textContent = r.target_bin;
                    document.getElementById('scan-points').textContent = '+' + r.points + ' Poin';
                    document.getElementById('scan-advice').textContent = r.advice;
                }
            })
            .catch(err => {
                btnSnap.disabled = false;
                btnSnap.innerHTML = `<span>Pindai Sampah Sekarang</span>`;
                alert('Gagal memproses pemindaian: ' + err.message);
            });
        }

        // ==========================================
        // PWA SERVICE WORKER & INSTALL PROMPT
        // ==========================================
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('SW Registered:', reg.scope))
                    .catch(err => console.log('SW Failed:', err));
            });
        }

        let deferredPrompt = null;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const banner = document.getElementById('pwa-install-banner');
            if (banner && !sessionStorage.getItem('pwa_dismissed')) {
                banner.classList.remove('hidden');
            }
        });

        function installPWA() {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User installed the PWA');
                    }
                    deferredPrompt = null;
                    document.getElementById('pwa-install-banner').classList.add('hidden');
                });
            }
        }

        function dismissPWA() {
            sessionStorage.setItem('pwa_dismissed', '1');
            document.getElementById('pwa-install-banner').classList.add('hidden');
        }
    </script>
</body>
</html>

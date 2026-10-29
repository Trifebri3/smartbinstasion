<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SmartBin User Portal — Poin, Lokasi & Scan Sampah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- QR Code Generator Lib -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .nav-btn.active { color: #06b6d4; font-weight: 700; }
        .nav-btn.active svg { stroke: #06b6d4; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen pb-24">

    <!-- Top App Bar -->
    <header class="sticky top-0 z-40 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 px-4 py-3">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-emerald-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-cyan-950/40">
                    SB
                </div>
                <div>
                    <h1 class="text-sm font-bold text-white tracking-wide">SmartBin User Portal</h1>
                    <p class="text-[11px] text-emerald-400 font-medium">● Online • smartbin.myoin.id</p>
                </div>
            </div>

            <!-- Profile & Points Pill -->
            <div class="flex items-center gap-2">
                <div class="bg-gradient-to-r from-amber-500/20 to-emerald-500/20 border border-amber-500/40 px-3 py-1 rounded-full flex items-center gap-1.5 shadow-sm">
                    <span class="text-xs">🪙</span>
                    <span class="text-xs font-bold text-amber-300" id="header-user-points">{{ number_format($user->points) }}</span>
                    <span class="text-[10px] text-slate-400">Poin</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" title="Keluar" class="p-1.5 text-slate-400 hover:text-rose-400 transition">
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

        <!-- User Greeting Card -->
        <div class="bg-gradient-to-br from-slate-900 to-slate-800 border border-slate-700/80 rounded-2xl p-5 shadow-xl relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-cyan-500/10 rounded-full blur-2xl"></div>
            <div class="flex items-center gap-4 relative z-10">
                <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0284c7&color=fff' }}" 
                     alt="{{ $user->name }}" 
                     class="w-14 h-14 rounded-2xl border-2 border-cyan-400/60 object-cover shadow-md">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-white truncate">{{ $user->name }}</h2>
                        @if($user->isAdmin())
                            <span class="bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[10px] font-bold px-2 py-0.5 rounded-full">Admin</span>
                        @else
                            <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] font-bold px-2 py-0.5 rounded-full">Google User</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                    <div class="mt-2 flex items-center gap-2 text-[11px] text-cyan-400">
                        <span>Token QR:</span>
                        <code class="bg-black/40 px-2 py-0.5 rounded font-mono text-[10px] text-amber-300 font-bold">{{ $user->qr_code_token }}</code>
                    </div>
                </div>
            </div>

            @if($user->isAdmin())
                <div class="mt-4 pt-3 border-t border-slate-700/60 flex justify-end">
                    <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-rose-400 hover:text-rose-300 flex items-center gap-1">
                        Buka Dashboard Admin (Full Control) &rarr;
                    </a>
                </div>
            @endif
        </div>

        <!-- ============================================================== -->
        <!-- TAB 1: TITIK SMARTBIN TERDEKAT -->
        <!-- ============================================================== -->
        <section id="tab-titik" class="tab-content active space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <span>📍</span> Titik SmartBin Terdekat
                    </h3>
                    <p class="text-xs text-slate-400">Lokasi wadah sampah pintar & ketersediaan kapasitas</p>
                </div>
                <button onclick="getUserLocation()" class="text-xs font-semibold bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 border border-cyan-500/40 px-3 py-1.5 rounded-xl transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Cari Lokasi Saya</span>
                </button>
            </div>

            <div id="nearby-bins-list" class="space-y-3">
                @foreach($stations as $st)
                <div class="bg-slate-900 border border-slate-800 hover:border-slate-700 rounded-2xl p-4 transition shadow-md">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-white text-sm">{{ $st->name }}</h4>
                                <span class="bg-emerald-500/20 text-emerald-300 text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-500/30">
                                    {{ strtoupper($st->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $st->location_name }}</p>
                        </div>
                        <span class="text-xs font-mono font-bold text-cyan-400 bg-cyan-950/40 border border-cyan-800/40 px-2 py-1 rounded-lg">
                            {{ $st->uuid }}
                        </span>
                    </div>

                    <!-- 4 Kompartemen Kapasitas -->
                    <div class="mt-3 pt-3 border-t border-slate-800/80 grid grid-cols-4 gap-2 text-center text-[10px]">
                        <div>
                            <div class="text-emerald-400 font-semibold mb-1">Organik</div>
                            <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $st->capacity_organik }}%"></div>
                            </div>
                            <span class="text-slate-400 mt-1 inline-block">{{ (int)$st->capacity_organik }}%</span>
                        </div>
                        <div>
                            <div class="text-sky-400 font-semibold mb-1">Plastik</div>
                            <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-sky-500 h-1.5 rounded-full" style="width: {{ $st->capacity_plastik }}%"></div>
                            </div>
                            <span class="text-slate-400 mt-1 inline-block">{{ (int)$st->capacity_plastik }}%</span>
                        </div>
                        <div>
                            <div class="text-amber-400 font-semibold mb-1">Kertas</div>
                            <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ $st->capacity_kertas }}%"></div>
                            </div>
                            <span class="text-slate-400 mt-1 inline-block">{{ (int)$st->capacity_kertas }}%</span>
                        </div>
                        <div>
                            <div class="text-rose-400 font-semibold mb-1">Logam</div>
                            <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-rose-500 h-1.5 rounded-full" style="width: {{ $st->capacity_logam }}%"></div>
                            </div>
                            <span class="text-slate-400 mt-1 inline-block">{{ (int)$st->capacity_logam }}%</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 2: QR CODE SAYA (KUNCI DEPOSIT DI STASIUN) -->
        <!-- ============================================================== -->
        <section id="tab-qr" class="tab-content space-y-4">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 border border-slate-700/80 rounded-2xl p-6 text-center shadow-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-cyan-400 mb-2 inline-block">Kunci Akses SmartBin</span>
                <h3 class="text-lg font-bold text-white mb-1">Tunjukkan QR ke Kamera SmartBin</h3>
                <p class="text-xs text-slate-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Arahkan layar HP Anda dengan QR di bawah ini ke kamera stasiun. Stasiun akan menyapa <strong class="text-emerald-400">"Halo, {{ $user->name }}!"</strong> dan membuka sesi setoran berpoin.
                </p>

                <!-- Container QR Canvas -->
                <div class="inline-block p-4 bg-white rounded-2xl shadow-2xl shadow-black/60 mb-4 border-4 border-cyan-500/50">
                    <div id="user-qrcode" class="flex justify-center items-center"></div>
                </div>

                <div class="font-mono text-sm font-bold text-amber-300 tracking-wider">
                    {{ $user->qr_code_token }}
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    Total Akumulasi: <strong class="text-emerald-400 font-bold">{{ number_format($user->points) }} Poin</strong>
                </div>
            </div>

            <!-- Panduan Langkah Store Sampah -->
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wide text-cyan-400 flex items-center gap-1.5">
                    <span>💡</span> Cara Store Sampah & Dapatkan Poin:
                </h4>
                <ol class="text-xs text-slate-300 space-y-2 list-decimal list-inside leading-relaxed">
                    <li><strong class="text-white">Scan QR:</strong> Arahkan kode QR di atas ke kamera SmartBin.</li>
                    <li><strong class="text-white">Sambutan Pengguna:</strong> Layar SmartBin menampilkan sapaan nama Anda.</li>
                    <li><strong class="text-white">Arahkan Sampah:</strong> Letakkan sampah di kotak hijau stasiun.</li>
                    <li><strong class="text-white">Klasifikasi & Poin:</strong> AI mendeteksi kategori sampah, servo memasukkan ke tong yang tepat, dan poin langsung masuk ke akun Anda!</li>
                </ol>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 3: AI SCANNER VIA KAMERA HP -->
        <!-- ============================================================== -->
        <section id="tab-scan" class="tab-content space-y-4">
            <div>
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <span>📷</span> Scan Sampah via Kamera HP
                </h3>
                <p class="text-xs text-slate-400">Pindai sampah Anda untuk mengetahui jenis, wadah tujuan & poinnya</p>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 space-y-3 overflow-hidden">
                <!-- Video Preview Camera -->
                <div class="relative bg-black rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-slate-700">
                    <video id="mobile-cam-video" autoplay playsinline class="w-full h-full object-cover hidden"></video>
                    <canvas id="mobile-cam-canvas" class="hidden"></canvas>
                    
                    <div id="cam-placeholder" class="text-center p-4">
                        <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-2 text-cyan-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-400 mb-3">Kamera belum diaktifkan</p>
                        <button onclick="startMobileCamera()" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs px-4 py-2 rounded-xl transition">
                            Nyalakan Kamera
                        </button>
                    </div>

                    <!-- Target Reticle Overlay -->
                    <div id="cam-reticle" class="absolute inset-8 border-2 border-dashed border-cyan-400/60 rounded-xl pointer-events-none hidden flex items-center justify-center">
                        <span class="text-[10px] text-cyan-300/80 font-bold bg-black/60 px-2 py-0.5 rounded">Fokuskan Objek Disini</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button id="btn-snap" onclick="captureAndScan()" disabled class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-600 disabled:opacity-40 text-white font-bold text-xs py-3 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Pindai Sampah Sekarang</span>
                    </button>
                    <button onclick="stopMobileCamera()" class="bg-slate-800 text-slate-300 text-xs px-3 py-3 rounded-xl hover:bg-slate-700 transition">
                        Tutup
                    </button>
                </div>

                <!-- Result Box -->
                <div id="mobile-scan-result" class="hidden bg-slate-950 border border-cyan-500/40 rounded-xl p-4 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase text-cyan-400 tracking-wider">Hasil Analisis AI</span>
                        <span id="scan-conf" class="text-xs font-mono font-bold text-emerald-400">96.5%</span>
                    </div>
                    <h4 id="scan-name" class="text-base font-bold text-white">Sampah Plastik</h4>
                    <div class="flex items-center gap-2">
                        <span id="scan-bin" class="bg-sky-500/20 text-sky-300 border border-sky-500/30 text-xs font-bold px-2 py-0.5 rounded-full">
                            Wadah Biru (BIN 2)
                        </span>
                        <span id="scan-points" class="bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-bold px-2 py-0.5 rounded-full">
                            +50 Poin
                        </span>
                    </div>
                    <p id="scan-advice" class="text-xs text-slate-300 leading-relaxed pt-1">
                        Kosongkan sisa air/minuman, remas botol untuk menghemat ruang, lalu buang ke SmartBin Biru.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- TAB 4: EDUKASI & EKOTEOLOGI ISLAM -->
        <!-- ============================================================== -->
        <section id="tab-edukasi" class="tab-content space-y-4">
            <div>
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <span>📖</span> Edukasi Pemilahan & Ekoteologi Islam
                </h3>
                <p class="text-xs text-slate-400">Panduan peduli lingkungan berlandaskan nilai keislaman</p>
            </div>

            <div class="space-y-3">
                @foreach($educations as $edu)
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-sm text-white flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-{{ $edu->color_badge }}-500"></span>
                            {{ $edu->title }}
                        </h4>
                        <span class="text-[10px] uppercase font-bold text-{{ $edu->color_badge }}-400 bg-{{ $edu->color_badge }}-950/40 border border-{{ $edu->color_badge }}-800/40 px-2 py-0.5 rounded-full">
                            {{ $edu->category }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">{{ $edu->summary }}</p>

                    <div class="bg-slate-950/70 rounded-xl p-3 border border-slate-800/60 text-xs space-y-1.5">
                        <div class="text-emerald-400 font-semibold flex items-center gap-1.5">
                            <span>🌱</span> Dampak Daur Ulang:
                        </div>
                        <p class="text-slate-300 text-[11px]">{{ $edu->recycling_impact }}</p>
                    </div>

                    <!-- Kutipan Ekoteologi -->
                    <div class="bg-amber-950/20 border-l-2 border-amber-500 rounded-r-xl p-3 text-xs space-y-1">
                        <p class="italic text-amber-200/90 text-[11px]">"{{ $edu->eco_theology_quote }}"</p>
                        <p class="text-[10px] text-amber-400 font-bold">— {{ $edu->eco_theology_ref }}</p>
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
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <span>📜</span> Riwayat Setoran & Poin
                </h3>
                <p class="text-xs text-slate-400">Catatan transaksi setoran sampah Anda di SmartBin</p>
            </div>

            <div class="space-y-2">
                @forelse($deposits as $dep)
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-3 flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-white text-xs">{{ $dep->category_label }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">{{ $dep->station_code }}</span>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-0.5">{{ $dep->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <span class="text-xs font-bold text-emerald-400 bg-emerald-950/40 border border-emerald-800/40 px-2.5 py-1 rounded-lg">
                        +{{ $dep->points_earned }} Poin
                    </span>
                </div>
                @empty
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 text-center text-slate-400 text-xs">
                    Belum ada riwayat setoran. Tunjukkan QR Code Anda ke kamera SmartBin untuk mulai mengumpulkan poin!
                </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- Bottom Navigation Bar (Mobile Native Style) -->
    <nav class="fixed bottom-0 left-0 right-0 z-40 bg-slate-900/95 backdrop-blur-lg border-t border-slate-800 px-2 py-2">
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
                <div class="-mt-4 w-11 h-11 bg-gradient-to-tr from-cyan-500 to-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-cyan-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] text-cyan-400 font-bold">Scan HP</span>
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
                colorDark : "#0f172a",
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
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-md">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-white text-sm">${st.name}</h4>
                                    <span class="bg-emerald-500/20 text-emerald-300 text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-500/30">
                                        ${st.status.toUpperCase()}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-400 mt-0.5">${st.location_name}</p>
                            </div>
                            <span class="text-xs font-bold text-amber-300 bg-amber-950/40 border border-amber-800/40 px-2 py-1 rounded-lg">
                                📍 ${st.distance_text}
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
    </script>
</body>
</html>

@extends('layouts.public')

@section('title', 'Smart Bin — UIN Bandung | Platform Pengelolaan Sampah Cerdas')

@section('content')

<!-- ===================================================================== -->
<!-- 1. HERO: Minimalist, Airy & Direct -->
<!-- ===================================================================== -->
<section class="py-12 sm:py-16 border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            <!-- Kiri: Value & Actions -->
            <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-win-green-light text-win-green text-xs font-bold">
                    <img src="{{ asset('logo.png') }}" alt="Logo UIN" class="w-4 h-4 object-contain">
                    <span>Smart Waste Management • UIN Sunan Gunung Djati Bandung</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-win-dark tracking-tight leading-tight">
                    Pilah Sampah Cerdas, <br class="hidden sm:inline">
                    <span class="text-win-green">Kampus UIN Bandung</span> Lebih Bersih.
                </h1>

                <p class="text-sm sm:text-base text-win-slate max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Temukan lokasi Smart Bin terdekat, pantau kapasitas wadah secara real-time, dan setor sampah dengan verifikasi AI untuk mengumpulkan poin.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 pt-1">
                    <a href="{{ route('public.locations') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs sm:text-sm shadow-sm transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Cari Smart Bin Terdekat</span>
                    </a>

                    <a href="{{ route('public.education') }}" class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 text-win-dark hover:bg-slate-50 font-bold text-xs sm:text-sm transition text-center">
                        Panduan Pemilahan
                    </a>
                </div>

                <!-- Quick Stat Titik Stasiun -->
                <div class="flex items-center justify-center lg:justify-start pt-4 border-t border-slate-100 text-xs">
                    <div>
                        <div class="font-extrabold text-lg text-win-dark">{{ $totalBins }} Titik</div>
                        <div class="text-slate-400 text-[11px]">Stasiun Kampus UIN Sunan Gunung Djati</div>
                    </div>
                </div>

            </div>

            <!-- Kanan: Compact Live Station Card (Real-Time dari Database) -->
            <div class="lg:col-span-5">
                @php
                    $hOrg = (int)($heroStation->capacity_organik ?? $heroStation->capacity_organic ?? 25);
                    $hPla = (int)($heroStation->capacity_plastik ?? $heroStation->capacity_plastic ?? 45);
                    $hKer = (int)($heroStation->capacity_kertas ?? $heroStation->capacity_paper ?? 20);
                    $hLog = (int)($heroStation->capacity_logam ?? $heroStation->capacity_metal ?? 15);
                    $hCode = $heroStation->station_code ?? 'STATION-01';
                    $hName = $heroStation->name ?? 'SmartBin Rektorat Utama';
                    $hLoc  = $heroStation->location_name ?? 'Lobby Gedung Rektorat Kampus 1 UIN Bandung';
                    $hStatusLabel = $heroStatus['label'] ?? 'Siap Digunakan';
                    $hStatusBg    = $heroStatus['bg'] ?? 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                    $hStatusDot   = $heroStatus['dot'] ?? 'bg-emerald-500';
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4 relative overflow-hidden">
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('logo.png') }}" alt="Logo UIN" class="w-5 h-5 object-contain">
                            <span id="hero-station-code" class="text-[11px] font-mono font-bold text-win-green bg-win-green-light px-2 py-0.5 rounded">
                                {{ $hCode }} • UIN SGD
                            </span>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span id="hero-live-badge">Live DB</span>
                            </span>
                        </div>
                        <span id="hero-status-pill" class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $hStatusBg }} flex items-center gap-1.5">
                            <span id="hero-status-dot" class="w-1.5 h-1.5 rounded-full {{ $hStatusDot }}"></span>
                            <span id="hero-status-label">{{ $hStatusLabel }}</span>
                        </span>
                    </div>

                    <div>
                        <h3 id="hero-station-name" class="font-bold text-base text-win-dark">{{ $hName }}</h3>
                        <p id="hero-station-loc" class="text-xs text-slate-500 mt-0.5">{{ $hLoc }}</p>
                    </div>

                    <!-- 4 Live Bars Compact (Realtime dari Database) -->
                    <div class="space-y-2.5 pt-2 border-t border-slate-100 text-xs">
                        <div>
                            <div class="flex justify-between text-[11px] mb-1">
                                <span class="font-medium text-slate-700 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                                    <span>Organik (Sisa Makanan)</span>
                                </span>
                                <span id="hero-val-organik" class="font-bold text-emerald-700">{{ $hOrg }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div id="hero-bar-organik" class="bg-emerald-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $hOrg }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[11px] mb-1">
                                <span class="font-medium text-slate-700 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <span>Plastik (Botol / Gelas)</span>
                                </span>
                                <span id="hero-val-plastik" class="font-bold text-amber-600">{{ $hPla }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div id="hero-bar-plastik" class="bg-amber-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $hPla }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[11px] mb-1">
                                <span class="font-medium text-slate-700 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <span>Kertas & Karton</span>
                                </span>
                                <span id="hero-val-kertas" class="font-bold text-blue-600">{{ $hKer }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div id="hero-bar-kertas" class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $hKer }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[11px] mb-1">
                                <span class="font-medium text-slate-700 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    <span>Logam & Kaca</span>
                                </span>
                                <span id="hero-val-logam" class="font-bold text-rose-600">{{ $hLog }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div id="hero-bar-logam" class="bg-rose-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $hLog }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Link & Live Polling Info -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span id="hero-station-sync" class="text-slate-400 text-[11px]">Sync: Otomatis Database</span>
                        <a href="{{ route('public.locations') }}" class="font-bold text-win-green hover:underline">
                            Lihat di Peta &rarr;
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- ===================================================================== -->
<!-- 2. TITIK LOKASI SMART BIN TERDEKAT -->
<!-- ===================================================================== -->
<section class="py-12 bg-slate-50 border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-win-dark">Titik Smart Bin di Kampus UIN</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pantau keterisian stasiun secara transparan</p>
            </div>
            <a href="{{ route('public.locations') }}" class="text-xs font-bold text-win-green hover:underline flex items-center gap-1">
                <span>Peta Interaktif</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($featuredStations as $bin)
                @php
                    $status = $bin->getPublicStatus();
                    $avgCap = round(($bin->capacity_organik + $bin->capacity_plastik + $bin->capacity_kertas + $bin->capacity_logam) / 4);
                @endphp
                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm hover:border-win-green transition flex flex-col justify-between space-y-3">
                    
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-mono font-bold text-win-green bg-win-green-light px-1.5 py-0.5 rounded">
                                {{ $bin->station_code }}
                            </span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $status['bg'] }}">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-win-dark line-clamp-1">{{ $bin->name }}</h3>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $bin->location_name }}</p>
                        </div>

                        <!-- Capacity Bar -->
                        <div class="space-y-1 pt-1">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-slate-500">Rata-rata:</span>
                                <span class="font-bold text-win-dark">{{ $avgCap }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="h-1.5 rounded-full" style="width: {{ $avgCap }}%; background-color: {{ $status['color'] }}"></div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $bin->latitude }},{{ $bin->longitude }}" target="_blank" class="text-slate-500 hover:text-win-green font-medium inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span>Rute</span>
                        </a>
                        <a href="{{ route('public.bin-detail', $bin->id) }}" class="font-bold text-win-green hover:underline">
                            Detail &rarr;
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 3. PANDUAN RINGKAS 4 KATEGORI (ACTIONABLE) -->
<!-- ===================================================================== -->
<section class="py-12 bg-white border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-win-dark">Panduan 4 Kategori Wadah</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pilah sampah dengan benar sebelum memasukkan ke Smart Bin</p>
            </div>
            <a href="{{ route('public.education') }}" class="text-xs font-bold text-win-green hover:underline">
                Panduan Lengkap &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            
            <!-- Organik -->
            <div class="p-4 rounded-xl border border-emerald-100 bg-emerald-50/40 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <h3 class="text-xs font-bold text-emerald-950">Wadah Hijau</h3>
                </div>
                <div class="text-sm font-bold text-win-dark">Organik</div>
                <p class="text-[11px] text-slate-600 leading-relaxed">
                    Sisa makanan, nasi, sayur, daun gugur, kulit buah, ampas teh/kopi.
                </p>
            </div>

            <!-- Plastik -->
            <div class="p-4 rounded-xl border border-amber-100 bg-amber-50/40 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <h3 class="text-xs font-bold text-amber-950">Wadah Kuning</h3>
                </div>
                <div class="text-sm font-bold text-win-dark">Plastik</div>
                <p class="text-[11px] text-slate-600 leading-relaxed">
                    Botol air mineral (PET), gelas plastik, kresek bersih (kosongkan sisa air).
                </p>
            </div>

            <!-- Kertas -->
            <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/40 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                    <h3 class="text-xs font-bold text-blue-950">Wadah Biru</h3>
                </div>
                <div class="text-sm font-bold text-win-dark">Kertas</div>
                <p class="text-[11px] text-slate-600 leading-relaxed">
                    Kardus box, kertas HVS, koran, majalah, karton telur kering.
                </p>
            </div>

            <!-- Logam -->
            <div class="p-4 rounded-xl border border-rose-100 bg-rose-50/40 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <h3 class="text-xs font-bold text-rose-950">Wadah Merah</h3>
                </div>
                <div class="text-sm font-bold text-win-dark">Logam & Kaca</div>
                <p class="text-[11px] text-slate-600 leading-relaxed">
                    Kaleng minuman aluminium, kaleng susu, botol kaca sirup/selai.
                </p>
            </div>

        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 4. CLEAN CTA -->
<!-- ===================================================================== -->
<section class="py-12 bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold text-win-dark">Mulai Kumpulkan Poin Daur Ulang</h3>
                <p class="text-xs text-slate-500">Dapatkan token QR pribadi untuk setor sampah di mesin Smart Bin fisik.</p>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                @auth
                    <a href="{{ route('user.portal') }}" class="px-5 py-2.5 rounded-xl bg-win-green text-white font-bold text-xs hover:bg-win-green-dark transition">
                        Buka Dashboard Saya &rarr;
                    </a>
                @else
                    <a href="{{ route('auth.google') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-win-dark font-bold text-xs transition flex items-center gap-2">
                        <span>Masuk Google</span>
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2.5 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs transition">
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Script Real-Time Live Sync dari Database -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function pollRealtimeHeroStation() {
            const realtimeUrl = '{{ Route::has("api.stations.realtime") ? route("api.stations.realtime") : url("/api/stations/realtime") }}';
            fetch(realtimeUrl)
                .then(res => res.json())
                .then(res => {
                    if (res && res.status === 'success' && res.primary) {
                        const data = res.primary;
                        const org = parseInt(data.organik) || 0;
                        const pla = parseInt(data.plastik) || 0;
                        const ker = parseInt(data.kertas) || 0;
                        const log = parseInt(data.logam) || 0;

                        const valOrg = document.getElementById('hero-val-organik');
                        const barOrg = document.getElementById('hero-bar-organik');
                        if (valOrg) valOrg.textContent = org + '%';
                        if (barOrg) barOrg.style.width = org + '%';

                        const valPla = document.getElementById('hero-val-plastik');
                        const barPla = document.getElementById('hero-bar-plastik');
                        if (valPla) valPla.textContent = pla + '%';
                        if (barPla) barPla.style.width = pla + '%';

                        const valKer = document.getElementById('hero-val-kertas');
                        const barKer = document.getElementById('hero-bar-kertas');
                        if (valKer) valKer.textContent = ker + '%';
                        if (barKer) barKer.style.width = ker + '%';

                        const valLog = document.getElementById('hero-val-logam');
                        const barLog = document.getElementById('hero-bar-logam');
                        if (valLog) valLog.textContent = log + '%';
                        if (barLog) barLog.style.width = log + '%';

                        const nameEl = document.getElementById('hero-station-name');
                        if (nameEl && data.name) nameEl.textContent = data.name;

                        const locEl = document.getElementById('hero-station-loc');
                        if (locEl && data.location_name) locEl.textContent = data.location_name;

                        const statusLabel = document.getElementById('hero-status-label');
                        if (statusLabel && data.status_label) statusLabel.textContent = data.status_label;

                        const syncEl = document.getElementById('hero-station-sync');
                        if (syncEl && data.last_updated) {
                            syncEl.textContent = 'Sync DB: ' + data.last_updated;
                        }
                    }
                })
                .catch(err => {
                    // Fail silently for background poll
                });
        }

        // Jalankan polling setiap 3 detik
        setInterval(pollRealtimeHeroStation, 3000);
    });
</script>

@endsection

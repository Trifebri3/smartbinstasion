@extends('layouts.public')

@section('title', 'Smart Bin — WIn Bandung | Platform Pengelolaan Sampah Cerdas & Edukasi Lingkungan')

@section('content')

<!-- ===================================================================== -->
<!-- 1. HERO SECTION (WIn Bandung Identity) -->
<!-- ===================================================================== -->
<section class="relative overflow-hidden bg-win-hero pt-12 pb-20 border-b border-win-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <!-- Kiri: Value Proposition & CTA -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-win-green-light border border-win-green/20 text-win-green text-xs font-bold tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-win-green animate-ping"></span>
                    <span>SMART BIN — WIn Bandung</span>
                    <span class="text-win-slate">•</span>
                    <span class="text-win-dark font-medium">Public-First Experience</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-win-dark tracking-tight leading-tight">
                    Pilah Sampah Lebih Cerdas, <br class="hidden sm:inline">
                    <span class="text-win-green">Jaga Kelestarian</span> Kota Bandung.
                </h1>

                <p class="text-base sm:text-lg text-win-slate leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Temukan lokasi tempat sampah pintar bertenaga AI di sekitar Anda, pelajari cara memilah 4 kategori sampah secara benar, dan kumpulkan poin daur ulang untuk setiap aksi nyata Anda.
                </p>

                <!-- Tombol Aksi Utama -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                    <a href="{{ route('public.locations') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-sm shadow-lg shadow-win-green/20 hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Cari Smart Bin Terdekat</span>
                    </a>

                    <a href="{{ route('public.education') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white hover:bg-win-neutral text-win-dark border border-win-neutral font-bold text-sm transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Panduan Pemilahan Sampah</span>
                    </a>
                </div>

                <!-- Keunggulan Public-First -->
                <div class="grid grid-cols-3 gap-3 pt-4 border-t border-win-neutral/70 max-w-lg mx-auto lg:mx-0">
                    <div class="text-center lg:text-left">
                        <div class="text-xs font-bold text-win-green">Bebas Akses</div>
                        <div class="text-[11px] text-win-slate">Tanpa login awal</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-xs font-bold text-win-green">GPS Terintegrasi</div>
                        <div class="text-[11px] text-win-slate">Kalkulasi jarak instan</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-xs font-bold text-win-green">IoT & AI Real-time</div>
                        <div class="text-[11px] text-win-slate">Sensor kapasitas live</div>
                    </div>
                </div>

            </div>

            <!-- Kanan: Interactive Live Smart Bin Preview Card -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl border border-win-neutral shadow-xl p-6 relative">
                    
                    <!-- Decorative Badge -->
                    <div class="flex items-center justify-between pb-4 border-b border-win-neutral mb-5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></div>
                            <span class="text-xs font-bold text-win-dark">Live Smart Bin Preview</span>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                            🟢 Siap Digunakan
                        </span>
                    </div>

                    <!-- Station Info -->
                    <div class="space-y-1 mb-5">
                        <span class="text-[11px] font-mono text-win-green font-bold">STATION-01 • UIN SGD BANDUNG</span>
                        <h3 class="text-lg font-extrabold text-win-dark">SmartBin Rektorat Utama</h3>
                        <p class="text-xs text-win-slate flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-win-green shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span>Lobby Gedung Rektorat Kampus 1 UIN SGD Bandung</span>
                        </p>
                    </div>

                    <!-- 4 Chambers Capacity Progress -->
                    <div class="space-y-3.5 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                        <div class="text-xs font-bold text-win-dark flex justify-between items-center">
                            <span>Status Kapasitas 4 Wadah:</span>
                            <span class="text-[11px] text-win-slate">Real-time IoT</span>
                        </div>

                        <!-- 1. Organik -->
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-emerald-800 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> Organik (Sisa Makanan)
                                </span>
                                <span class="font-bold text-emerald-800">25%</span>
                            </div>
                            <div class="w-full bg-emerald-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-emerald-600 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                        </div>

                        <!-- 2. Plastik -->
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-amber-800 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Plastik (Botol / Gelas)
                                </span>
                                <span class="font-bold text-amber-800">45%</span>
                            </div>
                            <div class="w-full bg-amber-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>

                        <!-- 3. Kertas -->
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-blue-800 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span> Kertas (Kardus / HVS)
                                </span>
                                <span class="font-bold text-blue-800">20%</span>
                            </div>
                            <div class="w-full bg-blue-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 20%"></div>
                            </div>
                        </div>

                        <!-- 4. Logam -->
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-rose-800 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Logam & Kaca (Kaleng)
                                </span>
                                <span class="font-bold text-rose-800">15%</span>
                            </div>
                            <div class="w-full bg-rose-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-rose-500 h-2 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Quick Action -->
                    <div class="mt-5 pt-4 border-t border-win-neutral flex items-center justify-between">
                        <div class="text-[11px] text-win-slate">
                            <span>Jarak dari Anda: </span>
                            <span class="font-bold text-win-dark">~0.15 km</span>
                        </div>
                        <a href="{{ route('public.locations') }}" class="text-xs font-bold text-win-green hover:text-win-green-dark flex items-center gap-1">
                            <span>Buka di Peta</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- ===================================================================== -->
<!-- 2. STATISTIK DAMPAK KOTA BANDUNG -->
<!-- ===================================================================== -->
<section class="py-12 bg-win-gradient border-b border-win-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            
            <div class="bg-white p-5 rounded-2xl border border-win-neutral shadow-sm text-center">
                <div class="text-2xl sm:text-3xl font-extrabold text-win-green">{{ $totalBins }}</div>
                <div class="text-xs font-bold text-win-dark mt-1">Stasiun Smart Bin</div>
                <div class="text-[11px] text-win-slate mt-0.5">Tersebar di Kota Bandung</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-win-neutral shadow-sm text-center">
                <div class="text-2xl sm:text-3xl font-extrabold text-win-dark">{{ $totalWeightKg }} <span class="text-sm font-semibold">kg</span></div>
                <div class="text-xs font-bold text-win-dark mt-1">Sampah Terpilah</div>
                <div class="text-[11px] text-win-slate mt-0.5">Dari 4 kategori wadah</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-win-neutral shadow-sm text-center">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600">{{ $totalCo2Reduced }} <span class="text-sm font-semibold">kg</span></div>
                <div class="text-xs font-bold text-win-dark mt-1">Reduksi Emisi CO₂</div>
                <div class="text-[11px] text-win-slate mt-0.5">Dampak sirkular lingkungan</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-win-neutral shadow-sm text-center">
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-500">{{ number_format($totalPoints) }}</div>
                <div class="text-xs font-bold text-win-dark mt-1">Poin Diberikan</div>
                <div class="text-[11px] text-win-slate mt-0.5">Apresiasi partisipasi warga</div>
            </div>

        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 3. CARA KERJA (ALUR USER JOURNEY) -->
<!-- ===================================================================== -->
<section class="py-16 bg-white border-b border-win-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-extrabold tracking-wider text-win-green uppercase">Alur Pengguna</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-win-dark">Cara Mudah Menggunakan Smart Bin</h2>
            <p class="text-sm text-win-slate">
                Dari menemukan lokasi, memilah sampah, hingga memperoleh poin penghargaan untuk lingkungan kita.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            
            <!-- Step 1 -->
            <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl relative space-y-3">
                <div class="w-10 h-10 rounded-xl bg-win-green text-white font-extrabold text-sm flex items-center justify-center">
                    01
                </div>
                <h3 class="text-base font-bold text-win-dark">Temukan Lokasi</h3>
                <p class="text-xs text-win-slate leading-relaxed">
                    Buka halaman peta untuk melihat Smart Bin terdekat di Bandung beserta status kapasitasnya tanpa harus login.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl relative space-y-3">
                <div class="w-10 h-10 rounded-xl bg-win-green text-white font-extrabold text-sm flex items-center justify-center">
                    02
                </div>
                <h3 class="text-base font-bold text-win-dark">Pilah Sampah</h3>
                <p class="text-xs text-win-slate leading-relaxed">
                    Kenali jenis sampah Anda: Organik, Plastik, Kertas, atau Logam. Baca panduan pemilahan yang mudah dipahami.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl relative space-y-3">
                <div class="w-10 h-10 rounded-xl bg-win-green text-white font-extrabold text-sm flex items-center justify-center">
                    03
                </div>
                <h3 class="text-base font-bold text-win-dark">Scan & Masukkan</h3>
                <p class="text-xs text-win-slate leading-relaxed">
                    Tunjukkan QR Token dari HP Anda ke kamera Smart Bin. AI akan memverifikasi jenis sampah dan servo membuka wadah yang tepat.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl relative space-y-3">
                <div class="w-10 h-10 rounded-xl bg-win-green text-white font-extrabold text-sm flex items-center justify-center">
                    04
                </div>
                <h3 class="text-base font-bold text-win-dark">Dapatkan Poin</h3>
                <p class="text-xs text-win-slate leading-relaxed">
                    Poin bertambah secara otomatis di dashboard akun Anda. Naikkan level Eco-Warrior dan raih lencana keberlanjutan.
                </p>
            </div>

        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 4. PUSAT EDUKASI 4 FRAKSI WADAH -->
<!-- ===================================================================== -->
<section class="py-16 bg-slate-50 border-b border-win-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2">
                <span class="text-xs font-extrabold tracking-wider text-win-green uppercase">Edukasi Pengelolaan Sampah</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-win-dark">Mengenal 4 Kategori Wadah Smart Bin</h2>
                <p class="text-sm text-win-slate max-w-xl">
                    Pemilahan yang tepat di sumbernya adalah kunci keberhasilan ekonomi sirkular dan pengolahan limbah ramah lingkungan.
                </p>
            </div>
            <a href="{{ route('public.education') }}" class="text-xs font-bold text-win-green hover:text-win-green-dark flex items-center gap-1.5 self-start">
                <span>Pelajari Selengkapnya</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- 1. Organik -->
            <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-xl font-bold">
                    🍃
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700">Wadah Hijau</span>
                    <h3 class="text-lg font-bold text-win-dark mt-0.5">Sampah Organik</h3>
                </div>
                <p class="text-xs text-win-slate leading-relaxed">
                    Sisa makanan, sayuran, daun gugur, kulit buah, dan ampas kopi. Diolah menjadi pupuk kompos alami dan pakan maggot BSF.
                </p>
                <div class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 p-2.5 rounded-lg border border-emerald-100">
                    💡 <em>Cegah gas metana dan kembalikan nutrisi ke tanah.</em>
                </div>
            </div>

            <!-- 2. Plastik -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-700 text-xl font-bold">
                    🥤
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Wadah Kuning</span>
                    <h3 class="text-lg font-bold text-win-dark mt-0.5">Sampah Plastik</h3>
                </div>
                <p class="text-xs text-win-slate leading-relaxed">
                    Botol air mineral (PET), gelas plastik, tutup botol, dan kantong kresek bersih. Kosongkan sisa cairan sebelum dibuang.
                </p>
                <div class="text-[11px] font-semibold text-amber-800 bg-amber-50 p-2.5 rounded-lg border border-amber-100">
                    💡 <em>Didaur ulang menjadi biji plastik rPET dan serat tekstil.</em>
                </div>
            </div>

            <!-- 3. Kertas -->
            <div class="bg-white rounded-2xl p-6 border border-blue-200 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl font-bold">
                    📦
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700">Wadah Biru</span>
                    <h3 class="text-lg font-bold text-win-dark mt-0.5">Kertas & Karton</h3>
                </div>
                <p class="text-xs text-win-slate leading-relaxed">
                    Kardus box, kertas HVS sisa tugas/laporan, majalah, koran, dan karton telur. Pastikan kertas kering dan bebas minyak.
                </p>
                <div class="text-[11px] font-semibold text-blue-800 bg-blue-50 p-2.5 rounded-lg border border-blue-100">
                    💡 <em>Menyelamatkan 17 pohon untuk setiap 1 ton kertas daur ulang.</em>
                </div>
            </div>

            <!-- 4. Logam & Kaca -->
            <div class="bg-white rounded-2xl p-6 border border-rose-200 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center text-rose-700 text-xl font-bold">
                    🥫
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-rose-700">Wadah Merah / Abu</span>
                    <h3 class="text-lg font-bold text-win-dark mt-0.5">Logam & Kaca</h3>
                </div>
                <p class="text-xs text-win-slate leading-relaxed">
                    Kaleng minuman aluminium, kaleng kental manis, botol kaca sirup/selai, dan peralatan logam rusak tanpa baterai.
                </p>
                <div class="text-[11px] font-semibold text-rose-800 bg-rose-50 p-2.5 rounded-lg border border-rose-100">
                    💡 <em>Dapat dilebur berulang kali tanpa kehilangan kualitas material.</em>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 5. TITIK SMART BIN TERDEKAT (PREVIEW LOKASI BANDUNG) -->
<!-- ===================================================================== -->
<section class="py-16 bg-white border-b border-win-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2">
                <span class="text-xs font-extrabold tracking-wider text-win-green uppercase">Titik Lokasi Tersedia</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-win-dark">Smart Bin di Area Bandung</h2>
                <p class="text-sm text-win-slate">
                    Pantau kapasitas sensor secara transparan sebelum Anda datang ke lokasi stasiun.
                </p>
            </div>
            <a href="{{ route('public.locations') }}" class="px-4 py-2.5 rounded-xl bg-win-green text-white text-xs font-bold hover:bg-win-green-dark transition flex items-center gap-1.5 self-start">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <span>Buka Peta Interaktif Lengkap</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredStations as $bin)
                @php
                    $status = $bin->getPublicStatus();
                @endphp
                <div class="bg-white rounded-2xl border border-win-neutral p-5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-mono font-bold text-win-green px-2 py-0.5 rounded bg-win-green-light">
                                {{ $bin->station_code }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded-full {{ $status['bg'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $status['dot'] }}"></span>
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-win-dark line-clamp-1">{{ $bin->name }}</h3>
                            <p class="text-xs text-win-slate mt-1 line-clamp-2">{{ $bin->location_name }}</p>
                        </div>

                        <!-- Mini Kapasitas Bars -->
                        <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-slate-600">Rerata Kapasitas:</span>
                                <span class="font-bold text-win-dark">
                                    {{ round(($bin->capacity_organik + $bin->capacity_plastik + $bin->capacity_kertas + $bin->capacity_logam) / 4) }}%
                                </span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="h-1.5 rounded-full transition-all duration-500" 
                                     style="width: {{ round(($bin->capacity_organik + $bin->capacity_plastik + $bin->capacity_kertas + $bin->capacity_logam) / 4) }}%; background-color: {{ $status['color'] }}"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Link -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $bin->latitude }},{{ $bin->longitude }}" target="_blank" class="text-xs font-semibold text-win-slate hover:text-win-green flex items-center gap-1">
                            <span>🧭 Rute Maps</span>
                        </a>
                        <a href="{{ route('public.bin-detail', $bin->id) }}" class="text-xs font-bold text-win-green hover:underline">
                            Detail &rarr;
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ===================================================================== -->
<!-- 6. CALL TO ACTION BANNER (GABUNG & DAPATKAN POIN) -->
<!-- ===================================================================== -->
<section class="py-16 bg-win-hero">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gradient-to-r from-win-dark via-[#1E5C3A] to-win-green rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
            <div class="max-w-2xl space-y-5 relative z-10">
                <span class="inline-block text-xs font-extrabold uppercase tracking-wider text-emerald-300 bg-white/10 px-3 py-1 rounded-full">
                    Gamifikasi & Partisipasi Warga
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Setor Sampah, Dapatkan Poin, Jadilah Eco-Warrior Bandung!
                </h2>
                <p class="text-sm sm:text-base text-slate-200 leading-relaxed">
                    Masuk dengan akun Google Anda untuk mendapatkan <strong>Token QR Pribadi</strong>, fitur <strong>Scan Sampah Kamera HP</strong>, dan mulai menabung poin untuk setiap kilogram sampah terpilah.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                    @auth
                        <a href="{{ route('user.portal') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white text-win-dark font-extrabold text-sm hover:bg-slate-100 transition shadow-lg text-center">
                            Buka Dashboard Pengguna Saya &rarr;
                        </a>
                    @else
                        <a href="{{ route('auth.google') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white text-win-dark font-extrabold text-sm hover:bg-slate-100 transition shadow-lg flex items-center justify-center gap-2.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Masuk dengan Google (Cepat)</span>
                        </a>
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-white/40 text-white font-bold text-sm hover:bg-white/10 transition text-center">
                            Daftar Akun Baru
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Background Decorative Glow -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-emerald-400/20 blur-3xl pointer-events-none"></div>
        </div>

    </div>
</section>

@endsection

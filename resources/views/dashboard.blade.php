<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-win-dark leading-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-win-green"></span>
                    <span>Panel Kendali Utama SmartBin IoT</span>
                </h2>
                <p class="text-xs text-win-slate mt-0.5">Sistem Monitoring & Otomasi Pemilahan Sampah Kampus UIN Sunan Gunung Djati Bandung</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Aktif
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen bg-[#F8FAF9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- ============================================================== -->
            <!-- 1. KARTU IDENTITAS AKUN ADMINISTRATOR UIN -->
            <!-- ============================================================== -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-win-green flex items-center justify-center text-white font-black text-sm tracking-wider shadow-sm shrink-0">
                        UIN
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-extrabold text-win-dark">{{ Auth::user()?->name ?? 'Administrator UIN Bandung' }}</h3>
                            <span class="bg-win-green-light border border-emerald-200 text-win-green text-[10px] font-bold px-2 py-0.5 rounded-full">
                                Super Administrator
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">{{ Auth::user()?->email ?? 'admin@smartbin.myoin.id' }} • Akses Penuh Mesin & Telemetri</p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto pt-2 md:pt-0 border-t md:border-t-0 border-slate-100">
                    <div class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs flex items-center gap-2">
                        <span class="text-slate-500 font-medium text-[11px]">Token Master QR:</span>
                        <code class="font-mono font-bold text-win-green">{{ Auth::user()?->qr_code_token ?? 'SB-ADM-MASTER99' }}</code>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-sm">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Edit Profil</span>
                    </a>

                    <a href="{{ route('user.portal') }}" class="px-3.5 py-1.5 bg-win-green hover:bg-win-green-dark text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Tinjau Mode Pengguna</span>
                    </a>
                </div>
            </div>
            
            <!-- Camera Configuration -->
            <div class="border border-gray-100 rounded-2xl p-5 md:p-6 flex flex-col md:flex-row items-start md:items-center justify-between bg-white shadow-sm hover:shadow-md transition-shadow">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Live Camera Stream
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Kamera cerdas pendeteksi jenis sampah secara real-time.</p>
                </div>
                <div>
                    <span id="connection-status" class="inline-flex items-center rounded-full px-4 py-1.5 text-sm font-semibold bg-gray-100 text-gray-600 transition-colors">
                        Menghubungkan...
                    </span>
                </div>
            </div>

            <!-- Live Camera Feed -->
            <div class="border border-gray-100 rounded-3xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="p-1">
                    <div id="mixed-content-warning" class="m-4 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800" style="display: none;">
                        <p class="font-bold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Izin Keamanan Diperlukan
                        </p>
                        <p class="text-sm mt-2">
                            Mohon izinkan <strong>Insecure Content</strong> di pengaturan situs pada browser Anda untuk melihat *Live Stream*.
                        </p>
                    </div>

                    <div class="relative w-full bg-slate-50 flex items-center justify-center overflow-hidden rounded-2xl" style="min-height: 300px; md:min-height: 480px;">
                        <!-- Efek grid background saat loading -->
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNFMkU4RjAiLz48L3N2Zz4=')] opacity-50"></div>
                        
                        <!-- Menggunakan Canvas agar berperilaku persis seperti Video -->
                        <canvas id="camera-canvas" width="640" height="480" class="w-full h-full object-cover relative z-10" style="display: none;"></canvas>
                        
                        <div id="waiting-text" class="text-slate-400 font-medium relative z-10 flex flex-col items-center gap-3 animate-pulse">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Mencari Sinyal Kamera...
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sensor Data -->
            <div class="border border-gray-100 rounded-2xl p-5 md:p-6 bg-white shadow-sm hover:shadow-md transition-shadow">
                <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Status Tempat Sampah
                    </h3>
                    <span id="sensor-last-update" class="text-xs text-gray-400 font-medium bg-gray-50 px-2 py-1 rounded-md border border-gray-100">Loading...</span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Sensor 1 -->
                    <div class="relative overflow-hidden rounded-xl bg-slate-50 border border-slate-100 p-4 transition-all hover:bg-slate-100 group shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-semibold text-slate-600">Bin 1</span>
                            <span id="s1-status" class="flex h-2.5 w-2.5 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span id="s1-val" class="text-3xl font-bold text-slate-800 tracking-tight">--</span>
                                <span class="text-sm font-medium text-slate-500 ml-1">cm</span>
                            </div>
                            <div class="text-right">
                                <span id="s1-pct" class="text-sm font-bold text-blue-600">--%</span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 mt-3 overflow-hidden shadow-inner">
                            <div id="s1-bar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Sensor 2 -->
                    <div class="relative overflow-hidden rounded-xl bg-slate-50 border border-slate-100 p-4 transition-all hover:bg-slate-100 group shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-semibold text-slate-600">Bin 2</span>
                            <span id="s2-status" class="flex h-2.5 w-2.5 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span id="s2-val" class="text-3xl font-bold text-slate-800 tracking-tight">--</span>
                                <span class="text-sm font-medium text-slate-500 ml-1">cm</span>
                            </div>
                            <div class="text-right">
                                <span id="s2-pct" class="text-sm font-bold text-blue-600">--%</span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 mt-3 overflow-hidden shadow-inner">
                            <div id="s2-bar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Sensor 3 -->
                    <div class="relative overflow-hidden rounded-xl bg-slate-50 border border-slate-100 p-4 transition-all hover:bg-slate-100 group shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-semibold text-slate-600">Bin 3</span>
                            <span id="s3-status" class="flex h-2.5 w-2.5 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span id="s3-val" class="text-3xl font-bold text-slate-800 tracking-tight">--</span>
                                <span class="text-sm font-medium text-slate-500 ml-1">cm</span>
                            </div>
                            <div class="text-right">
                                <span id="s3-pct" class="text-sm font-bold text-blue-600">--%</span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 mt-3 overflow-hidden shadow-inner">
                            <div id="s3-bar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Sensor 4 -->
                    <div class="relative overflow-hidden rounded-xl bg-slate-50 border border-slate-100 p-4 transition-all hover:bg-slate-100 group shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-semibold text-slate-600">Bin 4</span>
                            <span id="s4-status" class="flex h-2.5 w-2.5 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="mt-4 flex items-end justify-between">
                            <div>
                                <span id="s4-val" class="text-3xl font-bold text-slate-800 tracking-tight">--</span>
                                <span class="text-sm font-medium text-slate-500 ml-1">cm</span>
                            </div>
                            <div class="text-right">
                                <span id="s4-pct" class="text-sm font-bold text-blue-600">--%</span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 mt-3 overflow-hidden shadow-inner">
                            <div id="s4-bar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- PUSAT NOTIFIKASI EMAIL SAMPAH PENUH (AUTO & MANUAL TRIGGER) -->
            <!-- ============================================================== -->
            <div class="border border-gray-100 rounded-2xl p-5 md:p-6 bg-white shadow-sm hover:shadow-md transition-shadow space-y-5">
                <div class="border-b border-gray-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Pusat Notifikasi Email Sampah Penuh
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Sistem otomatis mengirim email saat keterisian &ge; 85%. Anda juga dapat memicu (trigger) pengiriman email secara manual.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Auto-Alert: Aktif (&ge; 85%)
                        </span>
                    </div>
                </div>

                <!-- Feedback Banner -->
                <div id="email-alert-feedback" class="hidden p-4 rounded-xl text-xs sm:text-sm font-medium flex items-center justify-between">
                    <span id="email-alert-msg"></span>
                    <button onclick="document.getElementById('email-alert-feedback').classList.add('hidden')" class="font-bold ml-2 text-base">&times;</button>
                </div>

                <!-- Quick Manual Trigger for Live Sensors -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-slate-800">Trigger Email dari Sensor Live</h4>
                        <p class="text-xs text-slate-500">Kirim email peringatan instan dengan data sensor kamera & ultrasonik saat ini.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-2">
                        <input type="email" id="live-alert-email" placeholder="Email tujuan (opsional)" 
                               value="{{ Auth::user()->email ?? '' }}"
                               class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:border-emerald-600 outline-none w-full sm:w-60">
                        <button onclick="sendLiveAlertEmail()" id="btn-live-alert" class="w-full sm:w-auto px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-2 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <span id="btn-live-alert-text">Trigger Email Live</span>
                        </button>
                    </div>
                </div>

                <!-- Daftar Stasiun SmartBin Kampus UIN & Trigger per Stasiun -->
                <div class="space-y-3 pt-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">Stasiun SmartBin Terdaftar</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @if(isset($smartBins))
                            @forelse($smartBins as $bin)
                                @php
                                    $capOrg = (int)($bin->capacity_organik ?? $bin->capacity_organic ?? 0);
                                    $capPla = (int)($bin->capacity_plastik ?? $bin->capacity_plastic ?? 0);
                                    $capPap = (int)($bin->capacity_kertas ?? $bin->capacity_paper ?? 0);
                                    $capMet = (int)($bin->capacity_logam ?? $bin->capacity_metal ?? 0);
                                    $maxCap = max($capOrg, $capPla, $capPap, $capMet);
                                    $isFull = $maxCap >= 85;
                                @endphp
                                <div class="border border-slate-200 rounded-xl p-3.5 space-y-3 bg-white hover:border-slate-300 transition">
                                    <div class="flex items-start justify-between gap-2">
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-mono font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded">
                                                    {{ $bin->station_code }}
                                                </span>
                                                @if($isFull)
                                                    <span class="text-[10px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                                        KAPASITAS KRITIS
                                                    </span>
                                                @else
                                                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                                        NORMAL
                                                    </span>
                                                @endif
                                            </div>
                                            <h5 class="text-sm font-bold text-slate-800 mt-1">{{ $bin->name }}</h5>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">{{ $bin->location_name }}</p>
                                        </div>

                                        <button onclick="sendStationAlertEmail({{ $bin->id }}, '{{ $bin->name }}')" 
                                                id="btn-alert-{{ $bin->id }}"
                                                class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-rose-50 hover:text-rose-700 text-slate-700 text-xs font-bold transition flex items-center gap-1 shrink-0 border border-slate-200">
                                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            <span id="btn-alert-text-{{ $bin->id }}">Trigger Alert</span>
                                        </button>
                                    </div>

                                    <!-- Mini Bars -->
                                    <div class="grid grid-cols-4 gap-2 text-center text-[10px] pt-1 border-t border-slate-100">
                                        <div>
                                            <span class="text-slate-500">Org</span>
                                            <div class="w-full bg-slate-100 rounded-full h-1 mt-0.5 overflow-hidden">
                                                <div class="h-1 rounded-full {{ $capOrg >= 85 ? 'bg-rose-600' : 'bg-emerald-600' }}" style="width: {{ $capOrg }}%"></div>
                                            </div>
                                            <span class="font-bold text-slate-700">{{ $capOrg }}%</span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500">Pla</span>
                                            <div class="w-full bg-slate-100 rounded-full h-1 mt-0.5 overflow-hidden">
                                                <div class="h-1 rounded-full {{ $capPla >= 85 ? 'bg-rose-600' : 'bg-amber-500' }}" style="width: {{ $capPla }}%"></div>
                                            </div>
                                            <span class="font-bold text-slate-700">{{ $capPla }}%</span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500">Ker</span>
                                            <div class="w-full bg-slate-100 rounded-full h-1 mt-0.5 overflow-hidden">
                                                <div class="h-1 rounded-full {{ $capPap >= 85 ? 'bg-rose-600' : 'bg-blue-600' }}" style="width: {{ $capPap }}%"></div>
                                            </div>
                                            <span class="font-bold text-slate-700">{{ $capPap }}%</span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500">Log</span>
                                            <div class="w-full bg-slate-100 rounded-full h-1 mt-0.5 overflow-hidden">
                                                <div class="h-1 rounded-full {{ $capMet >= 85 ? 'bg-rose-600' : 'bg-purple-600' }}" style="width: {{ $capMet }}%"></div>
                                            </div>
                                            <span class="font-bold text-slate-700">{{ $capMet }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 p-4 text-center text-xs text-slate-400 bg-slate-50 rounded-xl">
                                    Belum ada data stasiun SmartBin.
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Canvas Rendering Component -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusBadge = document.getElementById('connection-status');
            const warningBox = document.getElementById('mixed-content-warning');
            const canvas = document.getElementById('camera-canvas');
            const ctx = canvas.getContext('2d');
            const waitingText = document.getElementById('waiting-text');
            
            // Set status jadi Connected 
            statusBadge.textContent = 'API Polling Active';
            statusBadge.className = 'inline-flex items-center rounded-full px-4 py-1.5 text-sm font-semibold bg-emerald-100 text-emerald-700 transition-colors';
            waitingText.style.display = 'none';
            warningBox.style.display = 'none';
            
            // Tampilkan Canvas
            canvas.style.display = 'block';

            // Fungsi rendering ke Canvas (Persis seperti Video Player)
            function fetchNextFrame() {
                const img = new Image();
                img.crossOrigin = "Anonymous"; // Hindari CORS issues di Canvas
                img.src = '/camera.jpg?time=' + new Date().getTime();
                
                img.onload = () => {
                    // Gambar sukses dimuat -> Lukis ke layar seketika! (0 kedip)
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    
                    // Segera tarik frame selanjutnya (10 FPS = 100ms)
                    setTimeout(fetchNextFrame, 100);
                };
                
                img.onerror = () => {
                    // Jika gambar gagal dimuat (misal file sedang ditimpa ESP32), abaikan dan coba lagi
                    setTimeout(fetchNextFrame, 100);
                };
            }

            // Nyalakan Mesin Video!
            fetchNextFrame();
        });
    </script>

    <!-- Sensor Polling Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const MAX_DISTANCE = 40; // cm (kosong)
            const MIN_DISTANCE = 5;  // cm (penuh)

            function updateSensorUI(id, distance) {
                const valEl = document.getElementById(`s${id}-val`);
                const pctEl = document.getElementById(`s${id}-pct`);
                const barEl = document.getElementById(`s${id}-bar`);
                const statusEl = document.getElementById(`s${id}-status`);

                if (distance === -1 || distance === null || distance === undefined) {
                    valEl.textContent = '--';
                    pctEl.textContent = 'Off';
                    barEl.style.width = '0%';
                    barEl.className = 'bg-slate-300 h-2.5 rounded-full transition-all duration-500';
                    statusEl.className = 'flex h-2.5 w-2.5 rounded-full bg-slate-300';
                    return;
                }

                // Format jarak
                valEl.textContent = parseFloat(distance).toFixed(1);

                // Hitung persentase kepenuhan (semakin dekat, semakin penuh)
                let pct = 0;
                if (distance <= MIN_DISTANCE) {
                    pct = 100;
                } else if (distance >= MAX_DISTANCE) {
                    pct = 0;
                } else {
                    pct = 100 - ((distance - MIN_DISTANCE) / (MAX_DISTANCE - MIN_DISTANCE) * 100);
                }
                
                pct = Math.round(pct);
                pctEl.textContent = `${pct}%`;
                barEl.style.width = `${pct}%`;

                // Tentukan warna berdasarkan persentase
                let colorClass = 'bg-blue-500';
                let dotClass = 'bg-blue-500';
                let textClass = 'text-blue-600';
                
                if (pct > 85) {
                    colorClass = 'bg-rose-500';
                    dotClass = 'bg-rose-500 animate-pulse';
                    textClass = 'text-rose-600';
                } else if (pct > 60) {
                    colorClass = 'bg-amber-500';
                    dotClass = 'bg-amber-500';
                    textClass = 'text-amber-600';
                } else {
                    colorClass = 'bg-emerald-500';
                    dotClass = 'bg-emerald-500';
                    textClass = 'text-emerald-600';
                }

                barEl.className = `${colorClass} h-2.5 rounded-full transition-all duration-500 shadow-sm`;
                statusEl.className = `flex h-2.5 w-2.5 rounded-full ${dotClass} shadow-sm`;
                pctEl.className = `text-sm font-bold ${textClass}`;
            }

            function fetchSensors() {
                fetch('/api/sensors/latest')
                    .then(response => response.json())
                    .then(data => {
                        updateSensorUI(1, data.sensor1);
                        updateSensorUI(2, data.sensor2);
                        updateSensorUI(3, data.sensor3);
                        updateSensorUI(4, data.sensor4);
                        
                        const now = new Date();
                        document.getElementById('sensor-last-update').textContent = 
                            `Diperbarui: ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}`;
                    })
                    .catch(error => {
                        console.error('Error fetching sensor data:', error);
                        document.getElementById('sensor-last-update').textContent = 'Koneksi Terputus';
                        document.getElementById('sensor-last-update').classList.add('text-rose-500', 'bg-rose-50');
                    });
            }

            // Polling setiap 2 detik
            setInterval(fetchSensors, 2000);
            fetchSensors(); // Fetch pertama kali
        });
    </script>

    <!-- Email Alert Trigger Script -->
    <script>
        function showEmailFeedback(isSuccess, message) {
            const box = document.getElementById('email-alert-feedback');
            const msg = document.getElementById('email-alert-msg');
            box.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-800', 'border-emerald-200', 'bg-rose-50', 'text-rose-800', 'border-rose-200');
            
            if (isSuccess) {
                box.classList.add('bg-emerald-50', 'text-emerald-800', 'border', 'border-emerald-200');
            } else {
                box.classList.add('bg-rose-50', 'text-rose-800', 'border', 'border-rose-200');
            }
            msg.textContent = message;
            box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function sendLiveAlertEmail() {
            const btn = document.getElementById('btn-live-alert');
            const btnText = document.getElementById('btn-live-alert-text');
            const emailInput = document.getElementById('live-alert-email');
            
            btn.disabled = true;
            btnText.textContent = 'Mengirim...';

            fetch('{{ route("admin.sensors.alert-live") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    target_email: emailInput.value
                })
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btnText.textContent = 'Trigger Email Live';
                showEmailFeedback(data.status === 'success', data.message);
            })
            .catch(err => {
                btn.disabled = false;
                btnText.textContent = 'Trigger Email Live';
                showEmailFeedback(false, 'Gagal memicu email: ' + err.message);
            });
        }

        function sendStationAlertEmail(stationId, stationName) {
            const btnText = document.getElementById(`btn-alert-text-${stationId}`);
            const btn = document.getElementById(`btn-alert-${stationId}`);
            const emailInput = document.getElementById('live-alert-email');

            if (btn) btn.disabled = true;
            if (btnText) btnText.textContent = 'Mengirim...';

            fetch(`/admin/stations/${stationId}/alert-email`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    target_email: emailInput ? emailInput.value : ''
                })
            })
            .then(res => res.json())
            .then(data => {
                if (btn) btn.disabled = false;
                if (btnText) btnText.textContent = 'Trigger Alert';
                showEmailFeedback(data.status === 'success', `[${stationName}] ` + data.message);
            })
            .catch(err => {
                if (btn) btn.disabled = false;
                if (btnText) btnText.textContent = 'Trigger Alert';
                showEmailFeedback(false, `[${stationName}] Gagal: ` + err.message);
            });
        }
    </script>
</x-app-layout>

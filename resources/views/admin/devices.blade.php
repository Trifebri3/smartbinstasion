<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-extrabold text-xl text-win-dark leading-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-win-green"></span>
                    <span>Kondisi & Kesehatan Perangkat IoT</span>
                </h2>
                <p class="text-xs text-win-slate mt-0.5">Telemetri hardware ESP32, motor servo, modul kamera AI, dan sensor ultrasonik SmartBin Kampus UIN Bandung</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Semua Perangkat Online
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen bg-[#F8FAF9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 1. HARDWARE SYSTEM STATUS (ESP32 & NETWORK) -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-win-dark">{{ $hardwareState['controller'] }}</h3>
                            <p class="text-xs text-slate-500">Firmware: <span class="font-mono font-bold text-win-green">{{ $hardwareState['firmware_version'] }}</span></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-mono text-xs font-bold">
                            Ping: {{ $hardwareState['latency_ms'] }} ms
                        </span>
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                            Online
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                    <!-- WiFi SSID & Signal -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1">
                        <div class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Koneksi Jaringan</div>
                        <div class="font-bold text-win-dark flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                            <span>{{ $hardwareState['wifi_ssid'] }}</span>
                        </div>
                        <div class="text-[11px] text-slate-500 font-medium">Sinyal: {{ $hardwareState['wifi_quality'] }} ({{ $hardwareState['wifi_signal_dbm'] }} dBm)</div>
                    </div>

                    <!-- IP Address -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1">
                        <div class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Alamat IP Lokal</div>
                        <div class="font-mono font-bold text-win-dark">{{ $hardwareState['ip_address'] }}</div>
                        <div class="text-[11px] text-slate-500 font-medium">Port WebSocket: 81 / HTTP: 80</div>
                    </div>

                    <!-- Uptime -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1">
                        <div class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Masa Aktif (Uptime)</div>
                        <div class="font-bold text-win-dark">{{ $hardwareState['uptime'] }}</div>
                        <div class="text-[11px] text-emerald-700 font-medium">Stabilitas: 99.98%</div>
                    </div>

                    <!-- Power Source -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 space-y-1">
                        <div class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Sumber Daya</div>
                        <div class="font-bold text-win-dark flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>AC 220V + UPS</span>
                        </div>
                        <div class="text-[11px] text-slate-500 font-medium">{{ $hardwareState['power_source'] }}</div>
                    </div>
                </div>
            </div>

            <!-- 2. STATUS SERVO MOTOR PEMILAH & KALIBRASI -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-win-dark">Status 4 Motor Servo Pemilah (MG996R)</h3>
                        <p class="text-xs text-slate-500">Kondisi aktuator mekanik pengarah wadah sampah</p>
                    </div>
                    <a href="{{ route('servos.index') }}" class="text-xs font-bold text-win-green hover:underline flex items-center gap-1">
                        <span>Buka Kontrol Servo Detail</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($servos as $sv)
                        <div class="border border-slate-200 rounded-xl p-4 bg-white space-y-3 shadow-sm hover:border-win-green transition">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-win-dark">{{ $sv->name }}</span>
                                <span class="text-[10px] font-mono font-bold px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-800">
                                    Pin {{ $sv->pin }}
                                </span>
                            </div>

                            <div class="flex items-end justify-between">
                                <div>
                                    <div class="text-2xl font-black text-win-green">{{ $sv->current_angle }}&deg;</div>
                                    <div class="text-[10px] text-slate-400">Posisi Sudut Saat Ini</div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                    Siap / Siaga
                                </span>
                            </div>

                            <!-- Bar Visual Sudut 0 - 180 Derajat -->
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-win-green h-1.5 rounded-full transition-all duration-300" style="width: {{ min(100, max(5, ($sv->current_angle / 180) * 100)) }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 3. MODUL KAMERA AI & SENSOR ULTRASONIK -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- Kamera AI -->
                <div class="lg:col-span-6 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <h3 class="text-base font-extrabold text-win-dark">Modul Kamera AI (OV2640)</h3>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                            Feed Aktif
                        </span>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-900 text-white space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Status Sensor Kamera:</span>
                            <span class="font-bold text-emerald-400">{{ $hardwareState['camera_status'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Kecepatan Frame:</span>
                            <span class="font-mono text-white">{{ $hardwareState['camera_fps'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Resolusi Input:</span>
                            <span class="font-mono text-white">640 &times; 480 (VGA RGB)</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Model Pengenal:</span>
                            <span class="text-emerald-300 font-bold">UIN SGD AI Waste Classifier</span>
                        </div>
                    </div>

                    <div class="pt-1">
                        <a href="{{ route('auto.sort') }}" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-win-dark text-xs font-bold transition flex items-center justify-center gap-2">
                            <span>Uji Auto-Sort AI Kamera</span>
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 4 Channel Sensor Ultrasonik HC-SR04 -->
                <div class="lg:col-span-6 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <h3 class="text-base font-extrabold text-win-dark">Sensor Ultrasonik 4 Kompartemen</h3>
                        </div>
                        <span class="text-[10px] text-slate-400 font-mono">HC-SR04 40kHz</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="text-[10px] font-bold text-slate-500">Sensor 1 (Organik)</div>
                            <div class="text-lg font-black text-win-dark mt-1">22.4 cm</div>
                            <div class="text-[10px] text-emerald-700">Respons: Normal (12ms)</div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="text-[10px] font-bold text-slate-500">Sensor 2 (Plastik)</div>
                            <div class="text-lg font-black text-win-dark mt-1">11.8 cm</div>
                            <div class="text-[10px] text-amber-700">Respons: Cepat (8ms)</div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="text-[10px] font-bold text-slate-500">Sensor 3 (Kertas)</div>
                            <div class="text-lg font-black text-win-dark mt-1">28.5 cm</div>
                            <div class="text-[10px] text-emerald-700">Respons: Normal (14ms)</div>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="text-[10px] font-bold text-slate-500">Sensor 4 (Logam & Kaca)</div>
                            <div class="text-lg font-black text-win-dark mt-1">34.2 cm</div>
                            <div class="text-[10px] text-emerald-700">Respons: Normal (15ms)</div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Seluruh transduser ultrasonik terkalibrasi presisi pada tinggi tabung 45 cm.</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

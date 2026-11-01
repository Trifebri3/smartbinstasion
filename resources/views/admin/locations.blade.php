<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-extrabold text-xl text-win-dark leading-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-win-green"></span>
                    <span>Peta & Lokasi Stasiun SmartBin</span>
                </h2>
                <p class="text-xs text-win-slate mt-0.5">Sebaran titik stasiun tempat sampah pintar di lingkungan Kampus 1 UIN Sunan Gunung Djati Bandung</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.capacity') }}" class="px-3 py-1.5 bg-win-green hover:bg-win-green-dark text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Monitoring Kapasitas</span>
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="py-6 min-h-screen bg-[#F8FAF9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- 1. PETA INTERAKTIF SEBARAN KAMPUS 1 UIN BANDUNG -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <h3 class="text-base font-extrabold text-win-dark">Peta Titik Kampus 1 UIN Sunan Gunung Djati Bandung</h3>
                    </div>
                    <span class="text-xs text-slate-500 font-medium">Jl. A.H. Nasution No. 105, Cipadung, Bandung</span>
                </div>

                <div id="admin-map" class="w-full h-80 sm:h-96 rounded-xl border border-slate-200 z-10"></div>
            </div>

            <!-- 2. DAFTAR KARTU STASIUN & MANAJEMEN LOKASI -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-win-dark">Daftar Titik Stasiun SmartBin Terdaftar</h3>
                        <p class="text-xs text-slate-500">Koordinat GPS, status operasional, dan pengelolaan stasiun fisik</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg bg-win-green-light text-win-green font-bold text-xs font-mono">
                        {{ count($stations) }} Stasiun
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($stations as $st)
                        @php
                            $avgCap = round(((float)($st->capacity_organik ?? $st->capacity_organic ?? 0) +
                                            (float)($st->capacity_plastik ?? $st->capacity_plastic ?? 0) +
                                            (float)($st->capacity_kertas  ?? $st->capacity_paper ?? 0) +
                                            (float)($st->capacity_logam   ?? $st->capacity_metal ?? 0)) / 4);
                            $isCritical = $avgCap >= 85;
                        @endphp
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:border-win-green transition space-y-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-xs font-bold text-win-green bg-win-green-light px-2 py-0.5 rounded">
                                            {{ $st->station_code ?? 'STATION' }}
                                        </span>
                                        @if($st->status === 'active')
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                                Aktif / Siaga
                                            </span>
                                        @elseif($st->status === 'maintenance')
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">
                                                Pemeliharaan
                                            </span>
                                        @else
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-100 text-rose-800">
                                                Penuh
                                            </span>
                                        @endif
                                    </div>
                                    <h4 class="text-base font-bold text-win-dark mt-1">{{ $st->name }}</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $st->location_name }}</p>
                                </div>

                                <div class="text-right shrink-0">
                                    <div class="text-lg font-extrabold {{ $isCritical ? 'text-rose-600' : 'text-win-dark' }}">{{ $avgCap }}%</div>
                                    <div class="text-[10px] text-slate-400">Rata-rata Kapasitas</div>
                                </div>
                            </div>

                            <!-- Koordinat GPS & Info Gedung -->
                            <div class="p-3 bg-slate-50 rounded-xl text-xs space-y-1.5 font-mono">
                                <div class="flex items-center justify-between text-slate-600">
                                    <span>Latitude:</span>
                                    <span class="font-bold text-win-dark">{{ $st->latitude }}</span>
                                </div>
                                <div class="flex items-center justify-between text-slate-600">
                                    <span>Longitude:</span>
                                    <span class="font-bold text-win-dark">{{ $st->longitude }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="pt-2 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $st->latitude }},{{ $st->longitude }}" 
                                   target="_blank"
                                   class="text-xs font-bold text-slate-700 hover:text-win-green flex items-center gap-1 transition">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    <span>Buka di Google Maps</span>
                                </a>

                                <!-- Update Status Form -->
                                <form action="{{ route('admin.stations.update-status', $st->id ?? 1) }}" method="POST" class="inline-flex items-center gap-1.5">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="text-xs px-2.5 py-1 rounded-lg border border-slate-200 bg-white text-slate-700 font-medium focus:border-win-green outline-none">
                                        <option value="active" {{ $st->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="maintenance" {{ $st->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Script Inisialisasi Peta Leaflet -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Koordinat Kampus 1 UIN SGD Bandung
            const map = L.map('admin-map').setView([-6.929824, 107.718162], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors • SmartBin UIN SGD Bandung',
                maxZoom: 19
            }).addTo(map);

            const stations = @json($stations);

            stations.forEach(function (bin) {
                const marker = L.marker([bin.latitude, bin.longitude]).addTo(map);
                marker.bindPopup(`
                    <div style="font-family: inherit; font-size: 12px; line-height: 1.4; padding: 2px;">
                        <span style="background: #287A4D; color: #fff; font-size: 9px; padding: 2px 5px; border-radius: 4px; font-weight: bold;">${bin.station_code || 'STATION'}</span>
                        <h4 style="font-size: 13px; font-weight: bold; margin: 5px 0 2px 0; color: #1C2822;">${bin.name}</h4>
                        <p style="margin: 0 0 6px 0; color: #64748b; font-size: 11px;">${bin.location_name}</p>
                        <a href="https://www.google.com/maps/search/?api=1&query=${bin.latitude},${bin.longitude}" target="_blank" style="color: #287A4D; font-weight: bold; text-decoration: underline; font-size: 11px;">Rute Google Maps &rarr;</a>
                    </div>
                `);
            });
        });
    </script>
</x-app-layout>

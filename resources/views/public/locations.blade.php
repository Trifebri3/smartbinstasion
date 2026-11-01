@extends('layouts.public')

@section('title', 'Peta Lokasi Smart Bin — WIn Bandung')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map {
        height: 580px;
        z-index: 10;
        border-radius: 1.25rem;
    }
    @media (max-width: 768px) {
        #map {
            height: 380px;
        }
    }
    .custom-bin-marker {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        border: 2px solid white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        color: white;
        font-weight: bold;
        font-size: 11px;
    }
</style>
@endpush

@section('content')
<div class="bg-slate-50 py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Header & GPS Trigger -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-win-neutral shadow-sm">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-win-green mb-1">
                    <span class="w-2 h-2 rounded-full bg-win-green"></span>
                    <span>LOCATION DISCOVERY</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-win-dark">Peta Lokasi Smart Bin se-Bandung</h1>
                <p class="text-xs sm:text-sm text-win-slate mt-0.5">
                    Temukan wadah sampah pintar terdekat dan periksa ketersediaan kapasitas secara real-time.
                </p>
            </div>

            <!-- Tombol GPS Geolocation -->
            <button onclick="detectUserLocation()" id="btn-gps" class="px-5 py-3 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs shadow-md transition-all flex items-center justify-center gap-2 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                <span id="btn-gps-text">Pindai Lokasi Terdekat Saya</span>
            </button>
        </div>

        <!-- Notification GPS Info -->
        <div id="gps-status-box" class="hidden p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center justify-between">
            <span id="gps-status-text">Mendeteksi koordinat GPS Anda...</span>
            <button onclick="document.getElementById('gps-status-box').classList.add('hidden')" class="font-bold text-emerald-900">&times;</button>
        </div>

        <!-- Grid Layout: Peta (Kiri/Utama) & Daftar List (Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Map Container (8 Cols on desktop) -->
            <div class="lg:col-span-8 bg-white p-3 rounded-3xl border border-win-neutral shadow-sm">
                
                <!-- Map Legend Bar -->
                <div class="flex items-center justify-between px-3 py-2 text-[11px] text-win-slate border-b border-slate-100 mb-2">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> Tersedia</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Hampir Penuh</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Penuh</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> Offline</span>
                    </div>
                    <span class="hidden sm:inline font-mono text-[10px]">OpenStreetMap • Leaflet</span>
                </div>

                <div id="map"></div>
            </div>

            <!-- List of Smart Bins with Filter (4 Cols) -->
            <div class="lg:col-span-4 space-y-4">
                
                <!-- Search & Filter Card -->
                <div class="bg-white p-4 rounded-2xl border border-win-neutral shadow-sm space-y-3">
                    <div class="relative">
                        <input type="text" id="input-search" oninput="filterStations()" placeholder="Cari nama atau gedung..." 
                               class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-win-neutral focus:border-win-green focus:ring-1 focus:ring-win-green outline-none">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Filter Status Buttons -->
                    <div class="flex flex-wrap gap-1.5 text-[11px] font-bold">
                        <button onclick="setFilterStatus('all')" id="flt-all" class="px-2.5 py-1 rounded-lg bg-win-green text-white filter-btn transition">Semua</button>
                        <button onclick="setFilterStatus('tersedia')" id="flt-tersedia" class="px-2.5 py-1 rounded-lg bg-slate-100 text-win-slate hover:bg-slate-200 filter-btn transition">Tersedia</button>
                        <button onclick="setFilterStatus('hampir_penuh')" id="flt-hampir" class="px-2.5 py-1 rounded-lg bg-slate-100 text-win-slate hover:bg-slate-200 filter-btn transition">Hampir Penuh</button>
                        <button onclick="setFilterStatus('penuh')" id="flt-penuh" class="px-2.5 py-1 rounded-lg bg-slate-100 text-win-slate hover:bg-slate-200 filter-btn transition">Penuh</button>
                    </div>
                </div>

                <!-- Station Cards List -->
                <div id="station-list-container" class="space-y-3 max-h-[480px] overflow-y-auto pr-1">
                    @foreach($smartBins as $bin)
                        @php
                            $status = $bin->getPublicStatus();
                        @endphp
                        <div class="station-card bg-white p-4 rounded-2xl border border-win-neutral hover:border-win-green transition-all shadow-sm cursor-pointer"
                             data-id="{{ $bin->id }}"
                             data-name="{{ strtolower($bin->name) }}"
                             data-loc="{{ strtolower($bin->location_name) }}"
                             data-status="{{ $status['status'] }}"
                             onclick="focusMarker({{ $bin->id }}, {{ $bin->latitude }}, {{ $bin->longitude }})">
                            
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-mono font-bold text-win-green bg-win-green-light px-2 py-0.5 rounded">
                                    {{ $bin->station_code }}
                                </span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $status['bg'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </div>

                            <h3 class="text-sm font-bold text-win-dark">{{ $bin->name }}</h3>
                            <p class="text-xs text-win-slate mt-0.5 line-clamp-1">{{ $bin->location_name }}</p>

                            <!-- Distance Badge -->
                            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                <span class="text-slate-500 distance-text" id="distance-{{ $bin->id }}">
                                    @if(isset($bin->distance_km))
                                        📍 {{ $bin->distance_km }} km dari Anda
                                    @else
                                        📍 Klik GPS untuk jarak
                                    @endif
                                </span>
                                <a href="{{ route('public.bin-detail', $bin->id) }}" class="font-bold text-win-green hover:underline">
                                    Detail &rarr;
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // Data Stasiun dari Backend Laravel
    const stations = @json($smartBins);
    let map;
    let markers = {};
    let userMarker = null;
    let activeFilter = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });

    function initMap() {
        // Pusat peta awal: Area Kampus UIN SGD Cibiru Bandung
        const defaultLat = -6.929824;
        const defaultLng = 107.718162;

        map = L.map('map').setView([defaultLat, defaultLng], 16);

        // Tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors • SMART BIN WIn Bandung'
        }).addTo(map);

        // Pasang Pin untuk Setiap Stasiun
        stations.forEach(bin => {
            const capOrg = Number(bin.capacity_organic ?? bin.capacity_organik ?? 0);
            const capPla = Number(bin.capacity_plastic ?? bin.capacity_plastik ?? 0);
            const capPap = Number(bin.capacity_paper ?? bin.capacity_kertas ?? 0);
            const capMet = Number(bin.capacity_metal ?? bin.capacity_logam ?? 0);
            const avgCap = Math.round((capOrg + capPla + capPap + capMet) / 4);
            const statusColor = getStatusColor(bin, capOrg, capPla, capPap, capMet);
            
            // Custom Marker Icon dengan CSS
            const customIcon = L.divIcon({
                className: 'custom-bin-marker-wrapper',
                html: `<div class="custom-bin-marker" style="background-color: ${statusColor}; width: 34px; height: 34px;">
                        <span>🗑️</span>
                       </div>`,
                iconSize: [34, 34],
                iconAnchor: [17, 17],
                popupAnchor: [0, -18]
            });

            const marker = L.marker([bin.latitude, bin.longitude], { icon: customIcon }).addTo(map);

            const popupHtml = `
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 220px; padding: 4px;">
                    <div style="font-size: 10px; font-weight: bold; color: #287A4D; margin-bottom: 2px;">${bin.station_code || 'STATION'}</div>
                    <div style="font-size: 13px; font-weight: bold; color: #26352D; margin-bottom: 4px;">${bin.name}</div>
                    <div style="font-size: 11px; color: #5A6E63; margin-bottom: 8px;">${bin.location_name}</div>
                    
                    <div style="font-size: 11px; margin-bottom: 8px; border-top: 1px solid #E5EAE7; padding-top: 6px;">
                        <div>Kapasitas Rata-rata: <strong>${avgCap}%</strong></div>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <a href="https://www.google.com/maps/search/?api=1&query=${bin.latitude},${bin.longitude}" target="_blank" 
                           style="background: #287A4D; color: white; padding: 5px 10px; border-radius: 8px; text-decoration: none; font-size: 11px; font-weight: bold;">
                           🧭 Arahkan Rute
                        </a>
                        <a href="/bins/${bin.id}" style="color: #287A4D; font-size: 11px; font-weight: bold; padding: 5px 0;">
                           Detail &rarr;
                        </a>
                    </div>
                </div>
            `;

            marker.bindPopup(popupHtml);
            markers[bin.id] = marker;
        });
    }

    function getStatusColor(bin, capOrg, capPla, capPap, capMet) {
        if (!bin.is_online || bin.status === 'maintenance') return '#64748b';
        const maxCap = Math.max(capOrg || 0, capPla || 0, capPap || 0, capMet || 0);
        if (bin.status === 'full' || maxCap >= 90) return '#EF4444';
        if (maxCap >= 75) return '#F59E0B';
        return '#287A4D';
    }

    function focusMarker(id, lat, lng) {
        map.setView([lat, lng], 18, { animate: true });
        if (markers[id]) {
            markers[id].openPopup();
        }
    }

    // Geolocation Haversine Distance
    function detectUserLocation() {
        const btnText = document.getElementById('btn-gps-text');
        const box = document.getElementById('gps-status-box');
        const statusText = document.getElementById('gps-status-text');

        if (!navigator.geolocation) {
            alert('Perangkat Anda tidak mendukung geolokasi GPS.');
            return;
        }

        btnText.innerText = 'Mencari Koordinat...';
        box.classList.remove('hidden');
        statusText.innerText = 'Mengakses sensor GPS smartphone/laptop Anda...';

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                btnText.innerText = 'Lokasi Terdeteksi ✓';
                statusText.innerText = `Posisi Anda terdeteksi: ${userLat.toFixed(5)}, ${userLng.toFixed(5)}. Menghitung jarak ke Smart Bin terdekat...`;

                // Pasang marker posisi user di peta
                if (userMarker) {
                    map.removeLayer(userMarker);
                }

                const userIcon = L.divIcon({
                    className: 'user-marker',
                    html: `<div style="background-color: #0284c7; width: 20px; height: 20px; border-radius: 9999px; border: 3px solid white; box-shadow: 0 0 12px #0284c7;"></div>`,
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map);
                userMarker.bindPopup('<strong>📍 Posisi Anda Saat Ini</strong>').openPopup();

                // Hitung Haversine untuk tiap stasiun
                stations.forEach(bin => {
                    const distKm = calculateHaversine(userLat, userLng, bin.latitude, bin.longitude);
                    const el = document.getElementById(`distance-${bin.id}`);
                    if (el) {
                        el.innerHTML = `📍 <strong>${distKm.toFixed(2)} km</strong> dari Anda`;
                    }
                });

                map.setView([userLat, userLng], 16);
            },
            function(error) {
                btnText.innerText = 'Pindai Lokasi Terdekat Saya';
                statusText.innerText = 'Gagal mengakses GPS: ' + error.message;
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }

    function calculateHaversine(lat1, lon1, lat2, lon2) {
        const R = 6371; // km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    function filterStations() {
        const query = document.getElementById('input-search').value.toLowerCase();
        const cards = document.querySelectorAll('.station-card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const loc = card.getAttribute('data-loc');
            const status = card.getAttribute('data-status');

            const matchQuery = name.includes(query) || loc.includes(query);
            const matchStatus = (activeFilter === 'all') || (status === activeFilter);

            if (matchQuery && matchStatus) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function setFilterStatus(status) {
        activeFilter = status;

        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-win-green', 'text-white');
            btn.classList.add('bg-slate-100', 'text-win-slate');
        });

        const activeBtn = document.getElementById(
            status === 'all' ? 'flt-all' :
            status === 'tersedia' ? 'flt-tersedia' :
            status === 'hampir_penuh' ? 'flt-hampir' : 'flt-penuh'
        );

        if (activeBtn) {
            activeBtn.classList.remove('bg-slate-100', 'text-win-slate');
            activeBtn.classList.add('bg-win-green', 'text-white');
        }

        filterStations();
    }
</script>
@endpush


@extends('layouts.public')

@section('title', 'Peta Lokasi Smart Bin — WIn Bandung')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<style>
    #map {
        height: 600px;
        width: 100%;
        border-radius: 1rem;
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
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        color: white;
        font-weight: bold;
        font-size: 13px;
    }
</style>
@endpush

@section('content')
<div class="bg-slate-50 py-6 min-h-[calc(100vh-8rem)]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-4">

        <!-- COMPACT CONTROL BAR -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">
            <div>
                <h1 class="text-base sm:text-lg font-extrabold text-win-dark">Peta Titik Smart Bin</h1>
                <p class="text-xs text-slate-500">Cek keterisian wadah dan temukan yang terdekat</p>
            </div>

            <div class="flex items-center gap-2">
                <button onclick="detectUserLocation()" id="btn-gps" class="px-3.5 py-2 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs shadow-sm transition flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span id="btn-gps-text">Lokasi Saya</span>
                </button>
            </div>
        </div>

        <!-- Notification GPS -->
        <div id="gps-status-box" class="hidden p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center justify-between">
            <span id="gps-status-text">Mendeteksi koordinat GPS...</span>
            <button onclick="document.getElementById('gps-status-box').classList.add('hidden')" class="font-bold">&times;</button>
        </div>

        <!-- MAIN SPLIT: MAP (Left) & CARDS (Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-start">
            
            <!-- Map Container (7 cols) -->
            <div class="lg:col-span-7 bg-white p-2 rounded-2xl border border-slate-200 shadow-sm relative">
                <div id="map"></div>
            </div>

            <!-- List of Bins (5 cols) -->
            <div class="lg:col-span-5 space-y-3">
                
                <!-- Quick Filter & Search -->
                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm space-y-2">
                    <input type="text" id="input-search" oninput="filterStations()" placeholder="Cari nama lokasi..." 
                           class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-200 focus:border-win-green outline-none">
                    
                    <div class="flex gap-1.5 text-[11px] font-bold">
                        <button onclick="setFilterStatus('all')" id="flt-all" class="px-2.5 py-1 rounded bg-win-green text-white filter-btn transition">Semua</button>
                        <button onclick="setFilterStatus('tersedia')" id="flt-tersedia" class="px-2.5 py-1 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 filter-btn transition">Tersedia</button>
                        <button onclick="setFilterStatus('hampir_penuh')" id="flt-hampir" class="px-2.5 py-1 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 filter-btn transition">Hampir Penuh</button>
                        <button onclick="setFilterStatus('penuh')" id="flt-penuh" class="px-2.5 py-1 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 filter-btn transition">Penuh</button>
                    </div>
                </div>

                <!-- Cards Scroll Container -->
                <div id="station-list-container" class="space-y-2.5 max-h-[500px] overflow-y-auto pr-1">
                    @foreach($smartBins as $bin)
                        @php
                            $status = $bin->getPublicStatus();
                            $avgCap = round(($bin->capacity_organik + $bin->capacity_plastik + $bin->capacity_kertas + $bin->capacity_logam) / 4);
                        @endphp
                        <div class="station-card bg-white p-3.5 rounded-xl border border-slate-200 hover:border-win-green transition shadow-sm cursor-pointer space-y-2"
                             data-id="{{ $bin->id }}"
                             data-name="{{ strtolower($bin->name) }}"
                             data-loc="{{ strtolower($bin->location_name) }}"
                             data-status="{{ $status['status'] }}"
                             onclick="focusMarker({{ $bin->id }}, {{ $bin->latitude }}, {{ $bin->longitude }})">
                            
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-mono font-bold text-win-green bg-win-green-light px-1.5 py-0.5 rounded">
                                    {{ $bin->station_code }}
                                </span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $status['bg'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </div>

                            <div>
                                <h3 class="text-xs font-bold text-win-dark">{{ $bin->name }}</h3>
                                <p class="text-[11px] text-slate-500 line-clamp-1">{{ $bin->location_name }}</p>
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between text-[10px] text-slate-500">
                                    <span>Kapasitas:</span>
                                    <span class="font-bold text-win-dark">{{ $avgCap }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1 overflow-hidden">
                                    <div class="h-1 rounded-full" style="width: {{ $avgCap }}%; background-color: {{ $status['color'] }}"></div>
                                </div>
                            </div>

                            <div class="pt-1.5 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                <span class="text-slate-400" id="distance-{{ $bin->id }}">
                                    @if(isset($bin->distance_km))
                                        📍 {{ $bin->distance_km }} km
                                    @else
                                        📍 Klik GPS
                                    @endif
                                </span>
                                <div class="flex items-center gap-2">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $bin->latitude }},{{ $bin->longitude }}" target="_blank" onclick="event.stopPropagation()" class="text-slate-500 hover:text-win-green">
                                        Rute Maps
                                    </a>
                                    <span>•</span>
                                    <a href="{{ route('public.bin-detail', $bin->id) }}" onclick="event.stopPropagation()" class="font-bold text-win-green hover:underline">
                                        Detail &rarr;
                                    </a>
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    const stations = @json($smartBins);
    let map;
    let markers = {};
    let userMarker = null;
    let activeFilter = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });

    function initMap() {
        if (typeof L === 'undefined') return;

        const defaultLat = -6.929824;
        const defaultLng = 107.718162;

        map = L.map('map', {
            center: [defaultLat, defaultLng],
            zoom: 16,
            zoomControl: true
        });

        // Google Maps Layer (Ultra Cepat & Bebas Blokir)
        L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            attribution: '&copy; Google Maps'
        }).addTo(map);

        setTimeout(() => { if (map) map.invalidateSize(); }, 300);
        window.addEventListener('resize', () => { if (map) map.invalidateSize(); });

        stations.forEach(bin => {
            const capOrg = Number(bin.capacity_organic ?? bin.capacity_organik ?? 0);
            const capPla = Number(bin.capacity_plastic ?? bin.capacity_plastik ?? 0);
            const capPap = Number(bin.capacity_paper ?? bin.capacity_kertas ?? 0);
            const capMet = Number(bin.capacity_metal ?? bin.capacity_logam ?? 0);
            const avgCap = Math.round((capOrg + capPla + capPap + capMet) / 4);
            const statusColor = getStatusColor(bin, capOrg, capPla, capPap, capMet);
            
            const customIcon = L.divIcon({
                className: 'custom-bin-marker-wrapper',
                html: `<div class="custom-bin-marker" style="background-color: ${statusColor}; width: 32px; height: 32px;">
                        <span>🗑️</span>
                       </div>`,
                iconSize: [32, 32],
                iconAnchor: [16, 16],
                popupAnchor: [0, -16]
            });

            const marker = L.marker([bin.latitude, bin.longitude], { icon: customIcon }).addTo(map);

            const popupHtml = `
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 200px; padding: 2px;">
                    <div style="font-size: 10px; font-weight: bold; color: #287A4D;">${bin.station_code || 'STATION'}</div>
                    <div style="font-size: 13px; font-weight: bold; color: #1C2822; margin-bottom: 2px;">${bin.name}</div>
                    <div style="font-size: 11px; color: #5C7065; margin-bottom: 6px;">${bin.location_name}</div>
                    <div style="font-size: 11px; margin-bottom: 6px;">Kapasitas: <strong>${avgCap}%</strong></div>
                    <div style="display: flex; gap: 8px;">
                        <a href="https://www.google.com/maps/search/?api=1&query=${bin.latitude},${bin.longitude}" target="_blank" 
                           style="background: #287A4D; color: white; padding: 4px 8px; border-radius: 6px; text-decoration: none; font-size: 11px; font-weight: bold;">
                           🧭 Buka Rute
                        </a>
                        <a href="/bins/${bin.id}" style="color: #287A4D; font-size: 11px; font-weight: bold; padding: 4px 0;">
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

    function detectUserLocation() {
        const btnText = document.getElementById('btn-gps-text');
        const box = document.getElementById('gps-status-box');
        const statusText = document.getElementById('gps-status-text');

        if (!navigator.geolocation) {
            alert('Perangkat Anda tidak mendukung GPS.');
            return;
        }

        btnText.innerText = 'Mencari...';
        box.classList.remove('hidden');
        statusText.innerText = 'Mengakses lokasi GPS...';

        navigator.geolocation.getCurrentPosition(
            function(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;

                btnText.innerText = 'Lokasi Terdeteksi ✓';
                statusText.innerText = `Lokasi Anda: ${lat.toFixed(5)}, ${lng.toFixed(5)}. Jarak stasiun diperbarui.`;

                if (userMarker) map.removeLayer(userMarker);
                const userIcon = L.divIcon({
                    className: 'user-marker',
                    html: `<div style="background-color: #0284c7; width: 18px; height: 18px; border-radius: 9999px; border: 3px solid white; box-shadow: 0 0 10px #0284c7;"></div>`,
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });

                userMarker = L.marker([lat, lng], { icon: userIcon }).addTo(map);
                userMarker.bindPopup('<strong>📍 Posisi Anda</strong>').openPopup();

                stations.forEach(bin => {
                    const distKm = calculateHaversine(lat, lng, bin.latitude, bin.longitude);
                    const el = document.getElementById(`distance-${bin.id}`);
                    if (el) el.innerHTML = `📍 <strong>${distKm.toFixed(2)} km</strong>`;
                });

                map.setView([lat, lng], 16);
            },
            function(err) {
                btnText.innerText = 'Lokasi Saya';
                statusText.innerText = 'Gagal mengakses GPS: ' + err.message;
            },
            { enableHighAccuracy: true, timeout: 8000 }
        );
    }

    function calculateHaversine(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)));
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

            card.style.display = (matchQuery && matchStatus) ? 'block' : 'none';
        });
    }

    function setFilterStatus(status) {
        activeFilter = status;
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-win-green', 'text-white');
            btn.classList.add('bg-slate-100', 'text-slate-600');
        });

        const activeBtn = document.getElementById(
            status === 'all' ? 'flt-all' :
            status === 'tersedia' ? 'flt-tersedia' :
            status === 'hampir_penuh' ? 'flt-hampir' : 'flt-penuh'
        );

        if (activeBtn) {
            activeBtn.classList.remove('bg-slate-100', 'text-slate-600');
            activeBtn.classList.add('bg-win-green', 'text-white');
        }

        filterStations();
    }
</script>
@endpush

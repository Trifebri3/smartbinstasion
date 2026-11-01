@extends('layouts.public')

@section('title', $bin->name . ' — Detail Smart Bin UIN Bandung')

@section('content')
<div class="bg-slate-50 py-10 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-win-slate">
            <a href="{{ route('home') }}" class="hover:text-win-green">Beranda</a>
            <span>/</span>
            <a href="{{ route('public.locations') }}" class="hover:text-win-green">Peta Lokasi</a>
            <span>/</span>
            <span class="text-win-dark font-bold">{{ $bin->station_code }}</span>
        </nav>

        <!-- Main Detail Card -->
        <div class="bg-white rounded-3xl border border-win-neutral p-6 sm:p-8 shadow-sm space-y-8">
            
            <!-- Top Header & Status -->
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-win-neutral">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono font-bold text-win-green bg-win-green-light px-2.5 py-0.5 rounded-md">
                            {{ $bin->station_code }}
                        </span>
                        <span class="text-xs text-win-slate">● Stasiun Aktif Kampus UIN Bandung</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-win-dark">{{ $bin->name }}</h1>
                    <p class="text-sm text-win-slate flex items-center gap-1.5 pt-1">
                        <svg class="w-4 h-4 text-win-green shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $bin->location_name }}</span>
                    </p>
                </div>

                <div class="flex flex-col items-start sm:items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $statusInfo['bg'] }}">
                        <span class="w-2 h-2 rounded-full {{ $statusInfo['dot'] }}"></span>
                        {{ $statusInfo['label'] }}
                    </span>
                    <span class="text-[11px] text-win-slate">{{ $statusInfo['desc'] }}</span>
                </div>
            </div>

            <!-- 4 Chambers Live Capacity Visual -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-win-dark">Kapasitas Sensor Ultrasonik Real-Time</h2>
                        <p class="text-xs text-win-slate">Status keterisian masing-masing kompartemen wadah</p>
                    </div>
                    <span class="text-xs font-mono text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>ESP32 Synced</span>
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- 1. Organik -->
                    <div class="p-4 rounded-2xl border border-emerald-200 bg-emerald-50/50 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-emerald-900 flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                                Wadah 1: ORGANIK
                            </span>
                            <span class="font-mono font-bold text-emerald-800 text-sm">{{ $bin->capacity_organik }}%</span>
                        </div>
                        <div class="w-full bg-emerald-200/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-emerald-600 h-2.5 rounded-full transition-all duration-700" style="width: {{ $bin->capacity_organik }}%"></div>
                        </div>
                        <p class="text-[11px] text-emerald-800 pt-1">Sisa sayur, nasi, buah, daun gugur</p>
                    </div>

                    <!-- 2. Plastik -->
                    <div class="p-4 rounded-2xl border border-amber-200 bg-amber-50/50 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-amber-900 flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                Wadah 2: PLASTIK
                            </span>
                            <span class="font-mono font-bold text-amber-800 text-sm">{{ $bin->capacity_plastik }}%</span>
                        </div>
                        <div class="w-full bg-amber-200/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-amber-500 h-2.5 rounded-full transition-all duration-700" style="width: {{ $bin->capacity_plastik }}%"></div>
                        </div>
                        <p class="text-[11px] text-amber-800 pt-1">Botol PET, gelas plastik, kresek kering</p>
                    </div>

                    <!-- 3. Kertas -->
                    <div class="p-4 rounded-2xl border border-blue-200 bg-blue-50/50 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-blue-900 flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                                Wadah 3: KERTAS
                            </span>
                            <span class="font-mono font-bold text-blue-800 text-sm">{{ $bin->capacity_kertas }}%</span>
                        </div>
                        <div class="w-full bg-blue-200/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-700" style="width: {{ $bin->capacity_kertas }}%"></div>
                        </div>
                        <p class="text-[11px] text-blue-800 pt-1">Kardus, kertas HVS, koran, karton bersih</p>
                    </div>

                    <!-- 4. Logam -->
                    <div class="p-4 rounded-2xl border border-rose-200 bg-rose-50/50 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-bold text-rose-900 flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                                Wadah 4: LOGAM & KACA
                            </span>
                            <span class="font-mono font-bold text-rose-800 text-sm">{{ $bin->capacity_logam }}%</span>
                        </div>
                        <div class="w-full bg-rose-200/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-rose-500 h-2.5 rounded-full transition-all duration-700" style="width: {{ $bin->capacity_logam }}%"></div>
                        </div>
                        <p class="text-[11px] text-rose-800 pt-1">Kaleng minuman aluminium, botol kaca</p>
                    </div>

                </div>
            </div>

            <!-- Koordinat & Panduan Menuju Lokasi -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-3">
                <h3 class="text-xs font-bold text-win-dark uppercase tracking-wider">Informasi Teknis Titik Lokasi</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-win-slate font-mono">
                    <div>
                        <span class="text-slate-400 block text-[10px]">KOORDINAT LATITUDE</span>
                        <span class="text-win-dark font-bold">{{ $bin->latitude }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">KOORDINAT LONGITUDE</span>
                        <span class="text-win-dark font-bold">{{ $bin->longitude }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-3 pt-4 border-t border-win-neutral">
                <a href="https://www.google.com/maps/search/?api=1&query={{ $bin->latitude }},{{ $bin->longitude }}" target="_blank" 
                   class="w-full sm:w-auto px-6 py-3 rounded-xl bg-win-green hover:bg-win-green-dark text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span>Buka Rute di Google Maps</span>
                </a>

                <a href="{{ route('public.locations') }}" class="w-full sm:w-auto px-5 py-3 rounded-xl border border-win-neutral text-win-dark font-bold text-xs hover:bg-slate-100 transition text-center">
                    &larr; Kembali ke Peta
                </a>

                @auth
                    <a href="{{ route('user.portal') }}" class="w-full sm:w-auto ml-auto px-5 py-3 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition text-center">
                        Tampilkan QR Token Saya &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto sm:ml-auto px-5 py-3 rounded-xl bg-win-green-light text-win-green font-bold text-xs hover:bg-emerald-100 transition text-center">
                        Login untuk Kumpulkan Poin di Sini
                    </a>
                @endauth
            </div>

        </div>

    </div>
</div>
@endsection


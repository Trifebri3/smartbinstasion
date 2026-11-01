<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-extrabold text-xl text-win-dark leading-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-win-green"></span>
                    <span>Monitoring Kapasitas Wadah SmartBin</span>
                </h2>
                <p class="text-xs text-win-slate mt-0.5">Pemantauan real-time keterisian 4 kompartemen di seluruh stasiun Kampus UIN Sunan Gunung Djati Bandung</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-800 border border-rose-200">
                    <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
                    Batas Kritis: &ge; 85%
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen bg-[#F8FAF9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-800 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- 1. PANDUAN INDIKATOR STATUS KAPASITAS -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-win-dark">Indikator Keterisian:</span>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-slate-600 font-medium">Normal (&lt; 70%)</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                        <span class="text-slate-600 font-medium">Hampir Penuh (70% - 84%)</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-600"></span>
                        <span class="text-rose-700 font-bold">Kritis Penuh (&ge; 85%)</span>
                    </div>
                </div>
            </div>

            <!-- 2. GRID KARTU KAPASITAS SEMUA STASIUN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($stations as $st)
                    @php
                        $capOrg = (int)($st->capacity_organik ?? $st->capacity_organic ?? 0);
                        $capPla = (int)($st->capacity_plastik ?? $st->capacity_plastic ?? 0);
                        $capPap = (int)($st->capacity_kertas  ?? $st->capacity_paper ?? 0);
                        $capMet = (int)($st->capacity_logam   ?? $st->capacity_metal ?? 0);
                        $maxCap = max($capOrg, $capPla, $capPap, $capMet);
                        $isFull = $maxCap >= 85;
                    @endphp
                    <div class="bg-white border {{ $isFull ? 'border-rose-300 ring-2 ring-rose-100' : 'border-slate-200/80' }} rounded-2xl p-6 shadow-sm space-y-5">
                        
                        <!-- Header Stasiun -->
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-win-green bg-win-green-light px-2 py-0.5 rounded">
                                        {{ $st->station_code ?? 'STATION' }}
                                    </span>
                                    @if($isFull)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200 animate-pulse">
                                            KAPASITAS KRITIS (&ge; 85%)
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            NORMAL
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-base font-extrabold text-win-dark mt-1">{{ $st->name }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $st->location_name }}</p>
                            </div>

                            <div class="text-right shrink-0">
                                <div class="text-2xl font-black {{ $isFull ? 'text-rose-600' : 'text-win-dark' }}">{{ $maxCap }}%</div>
                                <div class="text-[10px] text-slate-400">Puncak Keterisian</div>
                            </div>
                        </div>

                        <!-- 4 Kompartemen Bars -->
                        <div class="space-y-3.5 pt-1">
                            <!-- 1. Organik -->
                            <div class="space-y-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                        <span>Wadah Hijau: Organik (Sisa Makanan)</span>
                                    </span>
                                    <span class="font-bold {{ $capOrg >= 85 ? 'text-rose-600' : 'text-slate-800' }}">{{ $capOrg }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden shadow-inner">
                                    <div class="{{ $capOrg >= 85 ? 'bg-rose-600' : 'bg-emerald-500' }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $capOrg }}%"></div>
                                </div>
                            </div>

                            <!-- 2. Plastik -->
                            <div class="space-y-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                        <span>Wadah Kuning: Plastik & Kemasan</span>
                                    </span>
                                    <span class="font-bold {{ $capPla >= 85 ? 'text-rose-600' : 'text-slate-800' }}">{{ $capPla }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden shadow-inner">
                                    <div class="{{ $capPla >= 85 ? 'bg-rose-600' : 'bg-amber-400' }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $capPla }}%"></div>
                                </div>
                            </div>

                            <!-- 3. Kertas -->
                            <div class="space-y-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                        <span>Wadah Biru: Kertas & Karton</span>
                                    </span>
                                    <span class="font-bold {{ $capPap >= 85 ? 'text-rose-600' : 'text-slate-800' }}">{{ $capPap }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden shadow-inner">
                                    <div class="{{ $capPap >= 85 ? 'bg-rose-600' : 'bg-blue-500' }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $capPap }}%"></div>
                                </div>
                            </div>

                            <!-- 4. Logam & Kaca -->
                            <div class="space-y-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                                        <span>Wadah Abu/Merah: Logam & Kaca</span>
                                    </span>
                                    <span class="font-bold {{ $capMet >= 85 ? 'text-rose-600' : 'text-slate-800' }}">{{ $capMet }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden shadow-inner">
                                    <div class="{{ $capMet >= 85 ? 'bg-rose-600' : 'bg-purple-500' }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $capMet }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Aksi Petugas / Admin: Kosongkan Wadah & Trigger Email -->
                        <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs">
                            <!-- Reset / Kosongkan Wadah -->
                            <form action="{{ route('admin.stations.empty', $st->id ?? 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin sampah pada stasiun {{ $st->name }} sudah diangkut dan wadah dikosongkan?')">
                                @csrf
                                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>Kosongkan Wadah (Reset 0%)</span>
                                </button>
                            </form>

                            <!-- Trigger Email Alert Langsung -->
                            <form action="{{ route('admin.stations.alert', $st->id ?? 1) }}" method="POST">
                                @csrf
                                <input type="hidden" name="target_email" value="trifebriansah321@gmail.com">
                                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold transition flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span>Trigger Email Peringatan</span>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>

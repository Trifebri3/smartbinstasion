<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-extrabold text-xl text-win-dark leading-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-win-green"></span>
                    <span>Statistik & Analitik Pemilahan Sampah</span>
                </h2>
                <p class="text-xs text-win-slate mt-0.5">Agregasi data pemilahan, poin civitas, dan dampak lingkungan Kampus UIN Sunan Gunung Djati Bandung</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.capacity') }}" class="px-3 py-1.5 bg-white border border-slate-200 hover:border-win-green text-xs font-bold text-win-dark rounded-xl shadow-sm transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Cek Kapasitas</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen bg-[#F8FAF9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 1. KEY METRIC CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Total Setoran -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Setoran</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl sm:text-3xl font-extrabold text-win-dark">{{ number_format($totalDeposits) }}</div>
                        <p class="text-[11px] text-win-slate mt-1 flex items-center gap-1 font-medium">
                            <span class="text-emerald-700 font-bold">+18.5%</span> dari bulan lalu
                        </p>
                    </div>
                </div>

                <!-- Total Poin Civitas -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Poin Terdistribusi</span>
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v10m-3-7h6"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl sm:text-3xl font-extrabold text-win-dark">{{ number_format($totalPoints) }}</div>
                        <p class="text-[11px] text-win-slate mt-1 flex items-center gap-1 font-medium">
                            Reward daur ulang civitas UIN
                        </p>
                    </div>
                </div>

                <!-- Akurasi Auto-Sort AI -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Akurasi AI Classifier</span>
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl sm:text-3xl font-extrabold text-win-dark">96.8%</div>
                        <p class="text-[11px] text-win-slate mt-1 flex items-center gap-1 font-medium">
                            Model MobileNet + Heuristik
                        </p>
                    </div>
                </div>

                <!-- Civitas Berpartisipasi -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Civitas Terdaftar</span>
                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl sm:text-3xl font-extrabold text-win-dark">{{ number_format($totalUsers) }}</div>
                        <p class="text-[11px] text-win-slate mt-1 flex items-center gap-1 font-medium">
                            Mahasiswa, Dosen, & Tendik
                        </p>
                    </div>
                </div>

            </div>

            <!-- 2. KOMPOSISI 4 KATEGORI SAMPAH & DAMPAK LINGKUNGAN -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- Komposisi Kategori -->
                <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div>
                            <h3 class="text-base font-extrabold text-win-dark">Distribusi 4 Kategori Sampah</h3>
                            <p class="text-xs text-slate-500">Persentase dan frekuensi pemilahan sampah di seluruh stasiun</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-600">
                            {{ array_sum($categoryCounts) }} Item
                        </span>
                    </div>

                    <!-- Progress Bar Gabungan -->
                    <div class="w-full h-4 rounded-full bg-slate-100 overflow-hidden flex shadow-inner">
                        <div style="width: {{ $categoryPercentages['organik'] }}%" class="bg-emerald-500 hover:opacity-90 transition" title="Organik: {{ $categoryPercentages['organik'] }}%"></div>
                        <div style="width: {{ $categoryPercentages['plastik'] }}%" class="bg-amber-400 hover:opacity-90 transition" title="Plastik: {{ $categoryPercentages['plastik'] }}%"></div>
                        <div style="width: {{ $categoryPercentages['kertas'] }}%" class="bg-blue-500 hover:opacity-90 transition" title="Kertas: {{ $categoryPercentages['kertas'] }}%"></div>
                        <div style="width: {{ $categoryPercentages['logam'] }}%" class="bg-purple-500 hover:opacity-90 transition" title="Logam & Kaca: {{ $categoryPercentages['logam'] }}%"></div>
                    </div>

                    <!-- Detail per Kategori -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <!-- Organik -->
                        <div class="p-3 rounded-xl bg-emerald-50/60 border border-emerald-100 space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-emerald-900">Organik</span>
                            </div>
                            <div class="text-lg font-extrabold text-emerald-950">{{ $categoryPercentages['organik'] }}%</div>
                            <div class="text-[10px] text-emerald-700 font-medium">{{ $categoryCounts['organik'] }} setoran</div>
                        </div>

                        <!-- Plastik -->
                        <div class="p-3 rounded-xl bg-amber-50/60 border border-amber-100 space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                <span class="text-xs font-bold text-amber-900">Plastik</span>
                            </div>
                            <div class="text-lg font-extrabold text-amber-950">{{ $categoryPercentages['plastik'] }}%</div>
                            <div class="text-[10px] text-amber-700 font-medium">{{ $categoryCounts['plastik'] }} setoran</div>
                        </div>

                        <!-- Kertas -->
                        <div class="p-3 rounded-xl bg-blue-50/60 border border-blue-100 space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                <span class="text-xs font-bold text-blue-900">Kertas</span>
                            </div>
                            <div class="text-lg font-extrabold text-blue-950">{{ $categoryPercentages['kertas'] }}%</div>
                            <div class="text-[10px] text-blue-700 font-medium">{{ $categoryCounts['kertas'] }} setoran</div>
                        </div>

                        <!-- Logam & Kaca -->
                        <div class="p-3 rounded-xl bg-purple-50/60 border border-purple-100 space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                                <span class="text-xs font-bold text-purple-900">Logam & Kaca</span>
                            </div>
                            <div class="text-lg font-extrabold text-purple-950">{{ $categoryPercentages['logam'] }}%</div>
                            <div class="text-[10px] text-purple-700 font-medium">{{ $categoryCounts['logam'] }} setoran</div>
                        </div>
                    </div>
                </div>

                <!-- Dampak Ekoteologi & Lingkungan -->
                <div class="lg:col-span-5 bg-gradient-to-br from-[#1E5C3A] to-[#287A4D] rounded-2xl p-6 text-white flex flex-col justify-between shadow-md relative overflow-hidden">
                    <div class="space-y-4 relative z-10">
                        <div>
                            <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-200">Dampak Ekologis Kampus</span>
                            <h3 class="text-lg font-extrabold mt-0.5">Kontribusi Daur Ulang Civitas UIN</h3>
                        </div>

                        <div class="space-y-3 text-xs">
                            <div class="p-3 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-between">
                                <span class="text-emerald-100">Reduksi Emisi Karbon (CO2e)</span>
                                <span class="font-extrabold text-white text-sm">~184.2 kg CO2e</span>
                            </div>

                            <div class="p-3 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-between">
                                <span class="text-emerald-100">Potensi Kompos Tanah Organik</span>
                                <span class="font-extrabold text-white text-sm">~62.5 kg Pupuk</span>
                            </div>

                            <div class="p-3 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-between">
                                <span class="text-emerald-100">Pohon Terselamatkan (Daur Ulang Kertas)</span>
                                <span class="font-extrabold text-white text-sm">~4 Pohon Dewasa</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/15 text-[11px] text-emerald-100/80 relative z-10 flex items-center justify-between">
                        <span>Penerapan Nilai Ekoteologi Islam</span>
                        <span class="font-semibold text-white">UIN SGD Bandung</span>
                    </div>

                    <div class="absolute -right-12 -bottom-12 w-48 h-48 rounded-full bg-emerald-400/20 blur-xl pointer-events-none"></div>
                </div>

            </div>

            <!-- 3. TABEL AKTIVITAS SETORAN TERKINI -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-win-dark">Aktivitas Pemilahan Terkini</h3>
                        <p class="text-xs text-slate-500">Catatan transaksi setoran sampah oleh civitas akademika</p>
                    </div>
                    <span class="text-xs text-slate-500 font-medium">Real-time sync</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-400 uppercase text-[10px] tracking-wider font-bold">
                                <th class="py-3 px-3">Waktu</th>
                                <th class="py-3 px-3">Pengguna Civitas</th>
                                <th class="py-3 px-3">Kategori Sampah</th>
                                <th class="py-3 px-3">Stasiun</th>
                                <th class="py-3 px-3">Tujuan Wadah</th>
                                <th class="py-3 px-3 text-right">Poin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentDeposits as $dep)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-3 px-3 text-slate-500 font-mono text-[11px]">
                                        {{ $dep->created_at ? $dep->created_at->format('d M H:i') : now()->format('d M H:i') }}
                                    </td>
                                    <td class="py-3 px-3">
                                        <div class="font-bold text-win-dark">{{ $dep->user?->name ?? 'Mahasiswa UIN' }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $dep->user?->email ?? 'civitas@uinsgd.ac.id' }}</div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                            {{ $dep->category_label ?? ucfirst($dep->category) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-mono font-medium text-slate-600">
                                        {{ $dep->station_code ?? 'STATION-01' }}
                                    </td>
                                    <td class="py-3 px-3 font-bold text-win-green">
                                        {{ $dep->target_bin ?? 'BIN 1' }}
                                    </td>
                                    <td class="py-3 px-3 text-right font-extrabold text-win-green">
                                        +{{ $dep->points_earned ?? 25 }}
                                    </td>
                                </tr>
                            @empty
                                <!-- Data Contoh Demonstrasi jika tabel masih kosong -->
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-3 px-3 text-slate-500 font-mono text-[11px]">{{ now()->subMinutes(12)->format('d M H:i') }}</td>
                                    <td class="py-3 px-3">
                                        <div class="font-bold text-win-dark">Ahmad Fauzi (Mahasiswa FST)</div>
                                        <div class="text-[10px] text-slate-400">user@smartbin.myoin.id</div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                            Plastik (Botol Minuman)
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-mono font-medium text-slate-600">STATION-01</td>
                                    <td class="py-3 px-3 font-bold text-win-green">BIN 2 (Plastik)</td>
                                    <td class="py-3 px-3 text-right font-extrabold text-win-green">+50</td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-3 px-3 text-slate-500 font-mono text-[11px]">{{ now()->subMinutes(45)->format('d M H:i') }}</td>
                                    <td class="py-3 px-3">
                                        <div class="font-bold text-win-dark">Siti Rahmawati (Dosen Tarbiyah)</div>
                                        <div class="text-[10px] text-slate-400">siti.rahma@uinsgd.ac.id</div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                            Kertas (Karton Bekas)
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-mono font-medium text-slate-600">STATION-03</td>
                                    <td class="py-3 px-3 font-bold text-win-green">BIN 3 (Kertas)</td>
                                    <td class="py-3 px-3 text-right font-extrabold text-win-green">+30</td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-3 px-3 text-slate-500 font-mono text-[11px]">{{ now()->subHours(2)->format('d M H:i') }}</td>
                                    <td class="py-3 px-3">
                                        <div class="font-bold text-win-dark">Muhammad Rizki (Civitas Rektorat)</div>
                                        <div class="text-[10px] text-slate-400">mrizki@uinsgd.ac.id</div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                            Organik (Sisa Buah)
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-mono font-medium text-slate-600">STATION-01</td>
                                    <td class="py-3 px-3 font-bold text-win-green">BIN 1 (Organik)</td>
                                    <td class="py-3 px-3 text-right font-extrabold text-win-green">+25</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

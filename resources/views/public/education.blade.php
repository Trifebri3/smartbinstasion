@extends('layouts.public')

@section('title', 'Panduan Pemilahan Sampah — Smart Bin UIN Bandung')

@section('content')
<div class="bg-slate-50 py-10 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 space-y-8">

        <!-- Minimal Header -->
        <div class="text-center max-w-xl mx-auto space-y-2">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-win-dark">Panduan 4 Kategori Pemilahan</h1>
            <p class="text-xs sm:text-sm text-win-slate">
                Pilah sampah sesuai wadah sebelum memasukkan ke Smart Bin untuk menjaga kelestarian kampus UIN Sunan Gunung Djati Bandung.
            </p>
        </div>

        <!-- 4 Actionable Cards (Clean Do's & Don'ts) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            
            <!-- 1. Organik -->
            <div class="bg-white rounded-2xl border border-emerald-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                        <h2 class="text-base font-bold text-win-dark">Wadah Hijau: ORGANIK</h2>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-800">Kompos & Pakan</span>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-800 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Yang Boleh Dibuang:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Sisa makanan, nasi, sayuran, daun gugur, kulit buah, ampas teh dan kopi.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <span class="font-bold text-rose-700 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Jangan Masukkan:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Plastik kemasan makanan, styrofoam, tusuk sate, atau puntung rokok.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. Plastik -->
            <div class="bg-white rounded-2xl border border-amber-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <h2 class="text-base font-bold text-win-dark">Wadah Kuning: PLASTIK</h2>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800">Daur Ulang Tinggi</span>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-800 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Yang Boleh Dibuang:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Botol air mineral (PET), gelas plastik bersih, tutup botol, kantong kresek kering.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <span class="font-bold text-rose-700 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Jangan Masukkan:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Botol yang masih terisi cairan, sachet kopi/snack berlaminasi aluminium foil tebal.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Kertas -->
            <div class="bg-white rounded-2xl border border-blue-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                        <h2 class="text-base font-bold text-win-dark">Wadah Biru: KERTAS</h2>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-800">Penyelamat Pohon</span>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-800 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Yang Boleh Dibuang:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Kardus box, kertas HVS dokumen, buku tulis bekas, koran, majalah, karton telur.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <span class="font-bold text-rose-700 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Jangan Masukkan:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Kertas basah atau berminyak (kertas pembungkus nasi berminyak), tisu kotor.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 4. Logam -->
            <div class="bg-white rounded-2xl border border-rose-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <h2 class="text-base font-bold text-win-dark">Wadah Merah: LOGAM & KACA</h2>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-rose-50 text-rose-800">Daur Ulang Tanpa Batas</span>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-800 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Yang Boleh Dibuang:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Kaleng soda/minuman aluminium, kaleng biskuit/susu, botol kaca sirup dan selai.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <span class="font-bold text-rose-700 flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Jangan Masukkan:</span>
                        </span>
                        <p class="text-slate-600 pl-5 leading-relaxed">
                            Baterai bekas, lampu neon pecah, kaleng aerosol bertekanan, atau paku tajam.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Clean Action -->
        <div class="text-center pt-2">
            <a href="{{ route('public.locations') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-win-green text-white font-bold text-xs hover:bg-win-green-dark transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Cari Smart Bin Terdekat</span>
                <span>&rarr;</span>
            </a>
        </div>

    </div>
</div>
@endsection

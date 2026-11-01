@extends('layouts.public')

@section('title', 'Pusat Edukasi Pemilahan Sampah & Lingkungan — WIn Bandung')

@section('content')
<div class="bg-slate-50 py-12 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-win-green-light border border-win-green/20 text-win-green text-xs font-bold tracking-wide">
                <span>🌱 EDUCATION CENTER</span>
                <span>•</span>
                <span>WIn Bandung</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-win-dark">Pusat Edukasi Pemilahan Sampah & Ekoteologi</h1>
            <p class="text-sm sm:text-base text-win-slate leading-relaxed">
                Pelajari panduan memilah 4 kategori sampah, prinsip keberlanjutan sirkular, dan nilai-nilai etika menjaga kelestarian bumi untuk generasi masa depan.
            </p>
        </div>

        <!-- 4 Kategori Pemilahan Detail Cards -->
        <div class="space-y-6">
            @foreach($materials as $mat)
                @php
                    $theme = match($mat->category) {
                        'organik' => ['border' => 'border-emerald-300', 'bg' => 'bg-emerald-50/70', 'badge' => 'bg-emerald-600', 'text' => 'text-emerald-900', 'subtext' => 'text-emerald-800', 'badge_text' => 'Wadah Hijau'],
                        'plastik' => ['border' => 'border-amber-300', 'bg' => 'bg-amber-50/70', 'badge' => 'bg-amber-500', 'text' => 'text-amber-900', 'subtext' => 'text-amber-800', 'badge_text' => 'Wadah Kuning'],
                        'kertas' => ['border' => 'border-blue-300', 'bg' => 'bg-blue-50/70', 'badge' => 'bg-blue-600', 'text' => 'text-blue-900', 'subtext' => 'text-blue-800', 'badge_text' => 'Wadah Biru'],
                        default => ['border' => 'border-rose-300', 'bg' => 'bg-rose-50/70', 'badge' => 'bg-rose-600', 'text' => 'text-rose-900', 'subtext' => 'text-rose-800', 'badge_text' => 'Wadah Merah / Abu'],
                    };
                @endphp

                <div class="bg-white rounded-3xl border {{ $theme['border'] }} p-6 sm:p-8 shadow-sm space-y-6">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-2xl {{ $theme['badge'] }} text-white flex items-center justify-center font-bold text-lg shadow-sm">
                                @if($mat->category === 'organik') 🍃
                                @elseif($mat->category === 'plastik') 🥤
                                @elseif($mat->category === 'kertas') 📦
                                @else 🥫
                                @endif
                            </span>
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">{{ $theme['badge_text'] }} • KATEGORI {{ strtoupper($mat->category) }}</span>
                                <h2 class="text-xl sm:text-2xl font-bold text-win-dark">{{ $mat->title }}</h2>
                            </div>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-bold text-white {{ $theme['badge'] }} self-start sm:self-auto">
                            Daur Ulang Tinggi
                        </span>
                    </div>

                    <p class="text-sm text-win-slate leading-relaxed">
                        {{ $mat->summary }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                        <!-- Panduan Pilah -->
                        <div class="{{ $theme['bg'] }} p-4 rounded-2xl border border-white space-y-2">
                            <h3 class="font-bold {{ $theme['text'] }} flex items-center gap-1.5">
                                <span>📋</span> Panduan Pemilahan yang Benar
                            </h3>
                            <p class="{{ $theme['subtext'] }} leading-relaxed">
                                {{ $mat->sorting_guide }}
                            </p>
                        </div>

                        <!-- Dampak Daur Ulang -->
                        <div class="{{ $theme['bg'] }} p-4 rounded-2xl border border-white space-y-2">
                            <h3 class="font-bold {{ $theme['text'] }} flex items-center gap-1.5">
                                <span>🔄</span> Manfaat & Dampak Daur Ulang
                            </h3>
                            <p class="{{ $theme['subtext'] }} leading-relaxed">
                                {{ $mat->recycling_impact }}
                            </p>
                        </div>
                    </div>

                    @if($mat->eco_theology_quote)
                        <!-- Pesan Ekoteologi & Etika Lingkungan -->
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 space-y-1 text-xs">
                            <div class="text-[11px] font-bold text-win-green uppercase tracking-wide">
                                🌿 Nilai Ekoteologi & Kelestarian Bumi ({{ $mat->eco_theology_ref }})
                            </div>
                            <blockquote class="italic text-win-dark font-medium">
                                "{{ $mat->eco_theology_quote }}"
                            </blockquote>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        <!-- 3R Tips Box -->
        <div class="bg-white rounded-3xl border border-win-neutral p-8 shadow-sm space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-win-dark">Prinsip 3R Sehari-Hari untuk Warga Bandung</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs text-win-slate leading-relaxed">
                <div class="space-y-2 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold flex items-center justify-center text-sm">1</div>
                    <h3 class="font-bold text-sm text-win-dark">Reduce (Kurangi)</h3>
                    <p>Bawa tumbler dan tas belanja kain sendiri. Batasi pemakaian wadah sekali pakai saat berbelanja di pasar maupun supermarket Bandung.</p>
                </div>

                <div class="space-y-2 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 font-extrabold flex items-center justify-center text-sm">2</div>
                    <h3 class="font-bold text-sm text-win-dark">Reuse (Gunakan Kembali)</h3>
                    <p>Manfaatkan kardus dan botol kaca bekas untuk penyimpanan barang, pot tanaman hias, atau wadah serbaguna sebelum dibuang.</p>
                </div>

                <div class="space-y-2 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-800 font-extrabold flex items-center justify-center text-sm">3</div>
                    <h3 class="font-bold text-sm text-win-dark">Recycle (Daur Ulang)</h3>
                    <p>Setorkan sampah terpilah Anda ke stasiun Smart Bin terdekat agar diproses kembali menjadi bahan baku bernilai ekonomis tinggi.</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center pt-4">
            <a href="{{ route('public.locations') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-win-green text-white font-bold text-sm hover:bg-win-green-dark shadow-md transition">
                <span>📍 Temukan Smart Bin Terdekat Sekarang</span>
                <span>&rarr;</span>
            </a>
        </div>

    </div>
</div>
@endsection


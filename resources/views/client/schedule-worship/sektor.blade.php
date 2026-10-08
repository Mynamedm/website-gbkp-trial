@extends('layouts.client.app')

@section('content')

    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="flex items-center gap-2 text-slate-300 text-[13px] mb-4">
                <a href="{{ route('client.schedule-worship.umum') }}" class="hover:text-white transition-colors">Jadwal Ibadah</a>
                <span>&#9654;</span>
                <a href="{{ route('client.schedule-worship.detail', $kategoriId) }}" class="hover:text-white transition-colors">{{ $kategori['breadcrumb'] }}</a>
                <span>&#9654;</span>
                <span class="text-white">{{ $sektorItem['nama'] }}</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                {{ $sektorItem['nama'] }}
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                {{ $kategori['deskripsi'] }}
            </p>
        </div>
    </section>

    {{-- DETAIL SEKTOR --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

            <div class="grid lg:grid-cols-3 gap-8">
                {{-- Kegiatan Minggu Ini --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-100">
                            <h3 class="text-slate-400 text-[12px] font-bold uppercase tracking-wider mb-2">Kegiatan Minggu Ini</h3>
                            <h2 class="font-display text-blue-700 text-xl sm:text-2xl font-extrabold">{{ $sektorEvent['judul'] }}</h2>
                            <div class="flex flex-wrap items-center gap-4 mt-3 text-[13px] text-slate-600">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                    {{ $sektorEvent['tanggal'] }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $sektorEvent['waktu'] }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                    {{ $sektorEvent['lokasi'] }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @if(!empty($sektorEvent['host']) && $sektorEvent['host'] !== '-')
                                <div class="flex items-center gap-4">
                                    <span class="text-slate-500 text-[13px] shrink-0 min-w-[110px] font-medium">{{ $sektorEvent['host_label'] }}</span>
                                    <span class="text-slate-800 text-[13px] font-semibold">: {{ $sektorEvent['host'] }}</span>
                                </div>
                                @endif
                                <div class="flex items-center gap-4">
                                    <span class="text-slate-500 text-[13px] shrink-0 min-w-[110px] font-medium">Tema</span>
                                    <span class="text-slate-800 text-[13px] font-semibold">: {{ $sektorEvent['tema'] }}</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-slate-500 text-[13px] shrink-0 min-w-[110px] font-medium">Ayat Tema</span>
                                    <span class="text-slate-800 text-[13px] font-semibold">: {{ $sektorEvent['ayat_tema'] }}</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-slate-500 text-[13px] shrink-0 min-w-[110px] font-medium">Pembicara</span>
                                    <span class="text-slate-800 text-[13px] font-semibold">: {{ $sektorEvent['pembicara'] }}</span>
                                </div>
                                @if(!empty($sektorEvent['worship_leader']) && $sektorEvent['worship_leader'] !== '-')
                                <div class="flex items-center gap-4">
                                    <span class="text-slate-500 text-[13px] shrink-0 min-w-[110px] font-medium">Worship Leader</span>
                                    <span class="text-slate-800 text-[13px] font-semibold">: {{ $sektorEvent['worship_leader'] }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dokumentasi --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <h3 class="text-slate-800 text-[14px] font-bold mb-4">Dokumentasi</h3>
                        <div class="space-y-4">
                            @foreach($sektorEvent['dokumentasi'] as $img)
                                <div class="w-full h-40 bg-slate-200 rounded-xl overflow-hidden">
                                    <img src="{{ $img }}" alt="Dokumentasi {{ $sektorItem['nama'] }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Ibadah untuk Moria --}}
            @if($sektorEvent['is_moria'])
                <div class="mt-8">
                    <a href="{{ route('client.schedule-worship.riwayat', [$kategoriId, $sektorIndex]) }}" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                        <div class="flex items-center gap-0 min-w-0">
                            <div class="shrink-0 min-w-[160px] sm:min-w-[180px]">
                                <h3 class="text-white font-bold text-[18px] sm:text-[20px] uppercase tracking-wide leading-tight">Riwayat Ibadah</h3>
                                <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-1">Lihat ibadah minggu kemarin</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center shrink-0 ml-4 group-hover:bg-yellow-400 transition-colors">
                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </div>
                    </a>
                </div>
            @else
                {{-- Kegiatan Lainnya untuk selain Moria --}}
                <div class="mt-8 space-y-4">
                    @foreach($sektorEvent['kegiatan'] as $kg)
                        <a href="{{ $kg['route'] }}" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                            <div class="flex items-center gap-0 min-w-0">
                                <div class="shrink-0 min-w-[160px] sm:min-w-[180px]">
                                    <h3 class="text-white font-bold text-[18px] sm:text-[20px] uppercase tracking-wide leading-tight">{{ $kg['kode'] }}</h3>
                                    <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-1">{{ $kg['nama'] }}</p>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center shrink-0 ml-4 group-hover:bg-yellow-400 transition-colors">
                                <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 bg-white rounded-2xl border border-slate-200 p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 text-[14.5px] mb-1">Perubahan Jadwal</h4>
                    <p class="text-slate-500 text-[13px] leading-relaxed">Jadwal dapat berubah sewaktu-waktu. Pastikan untuk selalu memeriksa informasi terbaru</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@extends('layouts.client.app')

@section('content')

    {{-- Breadcrumb --}}
    <section class="bg-gradient-to-r from-slate-800 to-slate-700 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-[13px] text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.about-church') }}" class="hover:text-white transition-colors">Tentang</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.about-kategorial') }}" class="hover:text-white transition-colors">Kategorial</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium">{{ $kategorial['name'] }}</span>
            </div>
        </div>
    </section>

    {{-- Hero --}}
    <section class="relative bg-gradient-to-br from-{{ $kategorial['color'] }}-600 via-{{ $kategorial['color'] }}-700 to-{{ $kategorial['color'] }}-800 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="{{ $kategorial['name'] }}" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        {!! $kategorial['icon'] !!}
                    </svg>
                </div>
                <div>
                    <span class="inline-block text-white/70 text-[11px] font-semibold uppercase tracking-[0.18em]">Kategorial</span>
                    <h1 class="font-display text-white text-3xl sm:text-4xl font-extrabold">{{ $kategorial['name'] }}</h1>
                </div>
            </div>
            <p class="text-white/80 text-[15px] leading-relaxed max-w-xl">{{ $kategorial['deskripsi'] }}</p>
            <div class="mt-6 flex items-center gap-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 border border-white/20">
                    <p class="text-white/60 text-[11px] uppercase tracking-wider font-semibold">Total Anggota</p>
                    <p class="text-white text-2xl font-extrabold">{{ $kategorial['total_anggota'] }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Pengurus --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-{{ $kategorial['color'] }}-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Struktur Organisasi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Pengurus {{ $kategorial['name'] }}</h2>
            </div>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="bg-{{ $kategorial['color'] }}-50 px-6 py-4 border-b border-{{ $kategorial['color'] }}-100">
                        <h3 class="font-display text-slate-800 font-bold text-[15px]">{{ $kategorial['name'] }} Periode 2024-2027</h3>
                    </div>
                    <div class="px-6 py-4">
                        @foreach($kategorial['pengurus'] as $person)
                            <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                                <span class="text-slate-500 text-[13px]">{{ $person['jabatan'] }}</span>
                                <span class="text-slate-800 text-[14px] font-medium">{{ $person['nama'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Data Jemaat --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-{{ $kategorial['color'] }}-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Data Jemaat</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">
                    @if($kategorial['sektor'])
                        Data Sektor {{ $kategorial['name'] }}
                    @else
                        Data Anggota {{ $kategorial['name'] }}
                    @endif
                </h2>
            </div>

            @if($kategorial['sektor'])
                {{-- Tampilan Sektor (Moria, Mamre, PJJ) --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($kategorial['sektor'] as $sektor)
                        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-11 h-11 rounded-xl bg-{{ $kategorial['color'] }}-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-{{ $kategorial['color'] }}-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016A3.001 3.001 0 0021 9.349m-18 0V6a3 3 0 013-3h12a3 3 0 013 3v.002"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-display text-slate-800 font-bold text-[14px]">{{ $sektor['nama'] }}</h3>
                                    <p class="text-slate-500 text-[12px]">{{ $sektor['lokasi'] }}</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 text-[12.5px]">Penanggung Jawab</span>
                                    <span class="text-slate-800 text-[13px] font-medium">{{ $sektor['host'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 text-[12.5px]">Jumlah Anggota</span>
                                    <span class="text-{{ $kategorial['color'] }}-600 text-[14px] font-bold">{{ $sektor['jumlah'] }} orang</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Tampilan Anggota (Permata, KAKR, Saitun, Naomi) --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="bg-{{ $kategorial['color'] }}-50 px-6 py-4 border-b border-{{ $kategorial['color'] }}-100">
                        <h3 class="font-display text-slate-800 font-bold text-[15px]">Daftar Anggota {{ $kategorial['name'] }}</h3>
                    </div>
                    <div class="px-6 py-4">
                        @foreach($kategorial['anggota'] as $anggota)
                            <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                                <div>
                                    <span class="text-slate-800 text-[14px] font-medium">{{ $anggota['nama'] }}</span>
                                    @if(isset($anggota['lokasi']))
                                        <p class="text-slate-400 text-[12px] mt-0.5">{{ $anggota['lokasi'] }} - {{ $anggota['waktu'] ?? '' }}</p>
                                    @endif
                                </div>
                                <span class="text-{{ $kategorial['color'] }}-600 text-[12.5px] font-medium bg-{{ $kategorial['color'] }}-50 px-3 py-1 rounded-full">{{ $anggota['peran'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Dokumentasi --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-{{ $kategorial['color'] }}-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Galeri</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Dokumentasi Kegiatan</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($kategorial['dokumentasi'] as $item)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 hover:shadow-md transition-all group cursor-pointer">
                        <div class="bg-gradient-to-br {{ $item['warna'] }} h-44 flex items-center justify-center relative">
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Kegiatan</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 text-[14.5px] mb-1">{{ $item['judul'] }}</h3>
                            <p class="text-slate-500 text-[12.5px]">{{ $item['tanggal'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Kembali --}}
    <section class="pb-14 sm:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="{{ route('client.about-kategorial') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 text-white text-[13.5px] font-semibold rounded-lg hover:bg-slate-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Kembali ke Kategorial
            </a>
        </div>
    </section>

@endsection

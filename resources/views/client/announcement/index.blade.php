@extends('layouts.client.app')

@section('content')

    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                WARTA <span class="text-blue-400">JEMAAT</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Informasi dan pengumuman resmi GBKP Bandar Lampung untuk seluruh jemaat
            </p>
        </div>
    </section>

    {{-- ARSIP WARTA JEMAAT --}}
    <section class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h2 class="font-display text-slate-800 text-lg font-bold mb-5 uppercase tracking-wide">Arsip Warta Jemaat</h2>
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div class="flex-1 w-full">
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Pilih Tahun</label>
                        <div class="relative">
                            <select class="w-full appearance-none bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="2026" selected>2026</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Pilih Bulan</label>
                        <div class="relative">
                            <select class="w-full appearance-none bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8" selected>Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-700 text-white text-[13.5px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                        Tampilkan
                    </button>
                </div>
                <p class="text-slate-400 text-[12px] mt-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    Pilih tahun dan bulan untuk melihat warta jemaat.
                </p>
            </div>
        </div>
    </section>

    {{-- CARA MEMBACA --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-slate-800 text-base font-bold">Cara Membaca Warta Jemaat</h3>
                </div>
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-full bg-blue-700 text-white flex items-center justify-center shrink-0 text-[12px] font-bold">1</div>
                        <p class="text-slate-600 text-[13.5px] leading-relaxed">Klik "Baca Warta" pada warta yang dipilih</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-full bg-blue-700 text-white flex items-center justify-center shrink-0 text-[12px] font-bold">2</div>
                        <p class="text-slate-600 text-[13.5px] leading-relaxed">Warta akan terbuka di tab baru menggunakan PDF viewer browser</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-full bg-blue-700 text-white flex items-center justify-center shrink-0 text-[12px] font-bold">3</div>
                        <p class="text-slate-600 text-[13.5px] leading-relaxed">Anda dapat membaca langsung dan mengunduh jika diperlukan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR WARTA JEMAAT --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-extrabold text-center mb-10 uppercase tracking-wide">
                Warta <span class="text-blue-600">Jemaat</span>
            </h2>

            @php
                $wartaList = [
                    [
                        'judul' => 'Warta Jemaat',
                        'tanggal' => '02',
                        'bulan' => 'Agustus',
                        'tahun' => '2026',
                        'hari_gereja' => 'Minggu Advent II',
                        'tema' => 'Tuhan Gembalaku',
                        'ayat' => 'Mazmur 23 : 1 - 3',
                        'warna' => 'from-sky-900 to-sky-800',
                    ],
                    [
                        'judul' => 'Warta Jemaat',
                        'tanggal' => '09',
                        'bulan' => 'Agustus',
                        'tahun' => '2026',
                        'hari_gereja' => 'Minggu Advent II',
                        'tema' => 'Tuhan Gembalaku',
                        'ayat' => 'Mazmur 23 : 1 - 3',
                        'warna' => 'from-sky-900 to-sky-800',
                    ],
                    [
                        'judul' => 'Warta Jemaat',
                        'tanggal' => '16',
                        'bulan' => 'Agustus',
                        'tahun' => '2026',
                        'hari_gereja' => 'Minggu Advent II',
                        'tema' => 'Tuhan Gembalaku',
                        'ayat' => 'Mazmur 23 : 1 - 3',
                        'warna' => 'from-sky-900 to-sky-800',
                    ],
                    [
                        'judul' => 'Warta Jemaat',
                        'tanggal' => '23',
                        'bulan' => 'Agustus',
                        'tahun' => '2026',
                        'hari_gereja' => 'Minggu Advent II',
                        'tema' => 'Tuhan Gembalaku',
                        'ayat' => 'Mazmur 23 : 1 - 3',
                        'warna' => 'from-sky-900 to-sky-800',
                    ],
                    [
                        'judul' => 'Warta Jemaat',
                        'tanggal' => '30',
                        'bulan' => 'Agustus',
                        'tahun' => '2026',
                        'hari_gereja' => 'Minggu Advent II',
                        'tema' => 'Tuhan Gembalaku',
                        'ayat' => 'Mazmur 23 : 1 - 3',
                        'warna' => 'from-sky-900 to-sky-800',
                    ],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach($wartaList as $index => $warta)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex flex-col sm:flex-row">
                            {{-- Thumbnail --}}
                            <div class="sm:w-48 h-48 sm:h-auto bg-gradient-to-br {{ $warta['warna'] }} flex items-center justify-center relative shrink-0">
                                <div class="text-center px-4">
                                    <p class="text-white/60 text-[10px] uppercase tracking-wider mb-1">Warta</p>
                                    <p class="text-white font-bold text-lg leading-tight">Jemaat</p>
                                    <p class="text-white/40 text-[9px] uppercase tracking-wider mt-1">GBKP Bandar Lampung</p>
                                    <svg class="w-10 h-10 text-white/20 mx-auto mt-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 p-5">
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <div>
                                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-800 leading-none">{{ $warta['tanggal'] }}</span>
                                        <div class="mt-1">
                                            <span class="text-slate-600 text-[13px] font-semibold">{{ $warta['bulan'] }}</span>
                                            <span class="text-slate-400 text-[12px] ml-1">{{ $warta['tahun'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <span class="inline-block bg-blue-50 text-blue-700 text-[11px] font-semibold px-2.5 py-1 rounded-md mb-3">
                                    {{ $warta['hari_gereja'] }}
                                </span>

                                <div class="space-y-2 mb-4">
                                    <div>
                                        <p class="text-blue-600 text-[11px] font-semibold uppercase tracking-wide">Tema</p>
                                        <p class="text-slate-700 text-[13.5px] font-medium">{{ $warta['tema'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-blue-600 text-[11px] font-semibold uppercase tracking-wide">Ayat</p>
                                        <p class="text-slate-700 text-[13.5px] font-medium">{{ $warta['ayat'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 pt-3 border-t border-slate-100">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-[12.5px] font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Baca Warta
                                    </a>
                                    <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-700 text-white text-[12.5px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                        </svg>
                                        Unduh PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

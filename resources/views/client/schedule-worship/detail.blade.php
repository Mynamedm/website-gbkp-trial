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
                <a href="{{ route('client.schedule-worship') }}" class="hover:text-white transition-colors">Jadwal Ibadah</a>
                <span>&#9654;</span>
                <span class="text-white">{{ $kategori['breadcrumb'] }}</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                IBADAH <span class="text-yellow-500">{{ $kategori['judul'] }}</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                {{ $kategori['deskripsi'] }}
            </p>
        </div>
    </section>

    @if($kategori['type'] === 'umum')
        {{-- LAYOUT UMUM --}}
        <section class="bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

                {{-- Filter --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-10">
                    <div class="flex items-center gap-2 mb-5">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                        <h2 class="font-display text-slate-800 text-base font-bold uppercase tracking-wide">{{ $kategori['section_title'] }}</h2>
                    </div>
                    <div class="flex flex-col sm:flex-row items-end gap-4">
                        <div class="flex-1 w-full">
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Pilih Tahun</label>
                            <div class="relative">
                                <select class="w-full appearance-none bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="2026" selected>2026</option>
                                    <option value="2025">2025</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Pilih Nama Minggu</label>
                            <div class="relative">
                                <select class="w-full appearance-none bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option>Minggu Advent II</option>
                                    <option>Minggu Advent III</option>
                                    <option>Minggu Advent IV</option>
                                    <option>Minggu Natal</option>
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
                        Pilih tahun dan nama minggu untuk melihat jadwal dan petugas pelayanan.
                    </p>
                </div>

                {{-- Petugas --}}
                @if($petugas)
                    <div class="text-center mb-8">
                        <h3 class="text-blue-700 text-[13px] font-bold uppercase tracking-wider mb-1">Petugas Kebaktian Minggu</h3>
                        <p class="font-display text-slate-800 text-2xl sm:text-3xl font-extrabold">{{ $petugas['tanggal'] }}</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Pagi --}}
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                            <div class="p-5 border-b border-slate-100">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-blue-700 font-bold text-base">IBADAH UMUM PAGI</h4>
                                        <p class="text-slate-800 font-bold text-sm">{{ $petugas['pagi']['jam'] }}</p>
                                    </div>
                                </div>
                                <p class="text-slate-500 text-[12.5px] flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                    {{ $petugas['pagi']['lokasi'] }}
                                </p>
                            </div>
                            <div class="divide-y divide-slate-100">
                                @foreach($petugas['pagi']['petugas'] as $p)
                                    <div class="flex items-center px-5 py-2.5">
                                        <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">{{ $p['jabatan'] }}</span>
                                        <span class="text-slate-800 text-[13px] font-medium">{{ $p['nama'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Sore --}}
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                            <div class="p-5 border-b border-slate-100">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-yellow-600 font-bold text-base">IBADAH UMUM SORE</h4>
                                        <p class="text-slate-800 font-bold text-sm">{{ $petugas['sore']['jam'] }}</p>
                                    </div>
                                </div>
                                <p class="text-slate-500 text-[12.5px] flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                    {{ $petugas['sore']['lokasi'] }}
                                </p>
                            </div>
                            <div class="divide-y divide-slate-100">
                                @foreach($petugas['sore']['petugas'] as $p)
                                    <div class="flex items-center px-5 py-2.5">
                                        <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">{{ $p['jabatan'] }}</span>
                                        <span class="text-slate-800 text-[13px] font-medium">{{ $p['nama'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="mt-8 bg-blue-50 rounded-2xl border border-blue-100 p-5 flex items-start gap-4 max-w-xl mx-auto">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                            </svg>
                        </div>
                        <div class="text-center flex-1">
                            <h4 class="font-bold text-slate-800 text-[14.5px] mb-1">{{ $petugas['info']['judul'] }}</h4>
                            <p class="text-slate-600 text-[13px]">{{ $petugas['info']['deskripsi'] }}</p>
                            <p class="text-slate-500 text-[12px] mt-1 italic">{{ $petugas['info']['ayat'] }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </section>

    @elseif($kategori['type'] === 'kelas')
        {{-- LAYOUT KA-KR --}}
        <section class="bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-extrabold uppercase tracking-wide mb-2">{{ $kategori['section_title'] }}</h2>
                <p class="text-slate-500 text-[14px] mb-8">{{ $kategori['section_subtitle'] }}</p>

                <div class="space-y-4">
                    @foreach($sektor as $item)
                        <a href="#" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                            <div class="flex items-center gap-0 min-w-0">
                                <div class="shrink-0 w-[200px] sm:w-[220px]">
                                    <h3 class="text-white font-bold text-[14px] sm:text-[15px] uppercase tracking-wide leading-tight">{{ $item['nama'] }}</h3>
                                    <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-1">Waktu Ibadah : {{ $item['waktu'] }}</p>
                                </div>
                                <div class="w-px h-12 bg-slate-500 mx-4 sm:mx-6 shrink-0"></div>
                                <div class="min-w-0">
                                    <p class="text-slate-300 text-[12px] sm:text-[12.5px]">Lokasi :</p>
                                    <p class="text-white font-bold text-[13px] sm:text-[14px] mt-0.5">{{ $item['lokasi'] }}</p>
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

    @elseif($kategori['type'] === 'permata')
        {{-- LAYOUT PERMATA --}}
        <section class="bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

                <div class="grid lg:grid-cols-3 gap-8">
                    {{-- Kegiatan Minggu Ini --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                            <div class="p-6 border-b border-slate-100">
                                <h3 class="text-slate-400 text-[12px] font-bold uppercase tracking-wider mb-2">Kegiatan Minggu Ini</h3>
                                <h2 class="font-display text-blue-700 text-xl sm:text-2xl font-extrabold">{{ $permataEvent['judul'] }}</h2>
                                <div class="flex flex-wrap items-center gap-4 mt-3 text-[13px] text-slate-600">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                        </svg>
                                        {{ $permataEvent['tanggal'] }}
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $permataEvent['waktu'] }}
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                        </svg>
                                        {{ $permataEvent['lokasi'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Tema</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['tema'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Ayat Tema</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['ayat_tema'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Pembicara</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['pembicara'] }}</span>
                                    </div>
                                    @if(!empty($permataEvent['worship_leader']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Worship Leader</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['worship_leader'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['gitaris']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Gitaris</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['gitaris'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['cajonist']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Cajonist</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['cajonist'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['basist']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Basist</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['basist'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['singer_1']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Singer 1</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['singer_1'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['singer_2']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Singer 2</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['singer_2'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($permataEvent['multimedia']))
                                    <div class="flex items-center gap-4">
                                        <span class="text-slate-500 text-[13px] w-[130px] shrink-0 font-medium">Multimedia</span>
                                        <span class="text-slate-800 text-[13px] font-semibold">: {{ $permataEvent['multimedia'] }}</span>
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
                                @foreach($permataEvent['dokumentasi'] as $img)
                                    <div class="w-full h-40 bg-slate-200 rounded-xl overflow-hidden">
                                        <img src="{{ $img }}" alt="Dokumentasi {{ $kategori['judul'] }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kegiatan Lainnya --}}
                <div class="mt-8 space-y-4">
                    @foreach($permataEvent['kegiatan'] as $kg)
                        <a href="{{ $kg['route'] }}" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                            <div class="flex items-center gap-0 min-w-0">
                                <div class="shrink-0 w-[200px] sm:w-[220px]">
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

    @else
        {{-- LAYOUT SEKTOR --}}
        <section class="bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-extrabold uppercase tracking-wide mb-2">{{ $kategori['section_title'] }}</h2>
                <p class="text-slate-500 text-[14px] mb-8">{{ $kategori['section_subtitle'] }}</p>

                <div class="space-y-4">
                    @foreach($sektor as $item)
                        <a href="#" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                            <div class="flex items-center gap-0 min-w-0">
                                <div class="shrink-0 w-[200px] sm:w-[220px]">
                                    <h3 class="text-white font-bold text-[14px] sm:text-[15px] uppercase tracking-wide leading-tight">{{ $item['nama'] }}</h3>
                                    @if($hostLabel && $item['host'])
                                        <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-1">{{ $hostLabel }} : {{ $item['host'] }}</p>
                                    @endif
                                    <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-0.5">Lokasi : {{ $item['lokasi'] }}</p>
                                </div>
                                <div class="w-px h-12 bg-slate-500 mx-4 sm:mx-6 shrink-0"></div>
                                <div class="min-w-0">
                                    <p class="text-slate-300 text-[12px] sm:text-[12.5px]">Jadwal Ibadah</p>
                                    <p class="text-white font-bold text-[13px] sm:text-[14px] mt-0.5">{{ $item['tanggal'] }}</p>
                                    <p class="text-slate-300 text-[12px] sm:text-[12.5px] mt-2">Waktu Ibadah</p>
                                    <p class="text-white font-bold text-[13px] sm:text-[14px] font-mono mt-0.5">{{ $item['waktu'] }}</p>
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
    @endif

@endsection
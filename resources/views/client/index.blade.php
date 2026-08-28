@extends('layouts.client.app')

@section('content')

    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
            <div class="max-w-xl">
                <span class="inline-block text-teal-300 text-[11px] font-semibold uppercase tracking-[0.18em] mb-4">Selamat Datang Di</span>
                <h1 class="font-display text-white text-[2.5rem] sm:text-[3.2rem] lg:text-[3.6rem] font-extrabold leading-[1.08] mb-5">
                    GBKP<br>Bandar Lampung
                </h1>
                <p class="text-slate-300 text-[15px] leading-relaxed mb-8 max-w-md">
                    Tempat bertumbuh dalam iman, pelayanan, dan persekutuan bersama Tuhan.
                </p>
                <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-slate-800 text-[13.5px] font-semibold rounded-lg hover:bg-slate-50 transition-colors shadow-lg shadow-black/10">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- RENUNGAN HARI INI --}}
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="grid lg:grid-cols-[280px_1fr] gap-6">

                {{-- Kiri: Info --}}
                <div class="bg-white/[0.08] backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <span class="text-blue-200 text-[11.5px] font-semibold uppercase tracking-wider">Renungan Hari Ini</span>
                    </div>
                    <p class="text-white/60 text-[11.5px] uppercase tracking-wide font-medium">Minggu</p>
                    <p class="text-white text-xl font-bold mt-1">9 Agustus 2026</p>
                    <div class="mt-5 pt-5 border-t border-white/10">
                        <p class="text-white/50 text-[11px] uppercase tracking-wide font-medium mb-1">Hari Gereja</p>
                        <p class="text-white text-sm font-semibold">Minggu Advent</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-white/50 text-[11px] uppercase tracking-wide font-medium mb-1">Bacaan</p>
                        <p class="text-white text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-yellow-400 shrink-0"></span>
                            Matius 14 : 22 - 33
                        </p>
                    </div>
                </div>

                {{-- Kanan: Isi Renungan --}}
                <div class="bg-white/[0.06] backdrop-blur-sm rounded-2xl p-6 sm:p-8 border border-white/10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                            </svg>
                            <span class="text-white font-bold text-sm uppercase tracking-wide">Tenanglah, Jangan Takut</span>
                        </div>
                        <blockquote class="text-white/80 text-[14.5px] leading-[1.75] italic space-y-3">
                            <p>Sesudah itu Yesus segera memerintahkan murid-murid-Nya naik ke perahu dan mendahului-Nya ke seberang...</p>
                            <p class="text-white/50">Dan setelah orang banyak itu dihuus ribuah tingai kaplingdinga, Yesus naik ke atas bukit untuk berdoa seorang diri. Ketika hari sudah malam, Ia sendirian di situ.</p>
                            <p>Perahu murid-murid-Nya sudah beberapa mil jauhnya dari pantai dan diombang-ambingkan gelombang, karena angin sakal. ...</p>
                        </blockquote>
                        <div class="mt-6 flex items-center gap-3">
                            <span class="text-blue-300 text-[12.5px] font-bold uppercase tracking-wide">Matius 14 : 22 - 33</span>
                            <span class="text-white/30 text-[12px]">Terjemahan Baru</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-5 border-t border-white/10 flex items-center justify-between">
                        <p class="text-white/30 text-[12px] italic">Renungan Harian GBKP BANDAR LAMPUNG</p>
                        <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-blue-700 text-[12.5px] font-semibold rounded-lg hover:bg-blue-50 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- JADWAL IBADAH TERDEKAT --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Jadwal Ibadah Terdekat</h2>
                <a href="{{ route('client.schedule-worship') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Jadwal
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($schedules as $item)
                    <a href="{{ route('client.schedule-worship') }}" class="group bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 flex items-start gap-4 hover:from-slate-600 hover:to-slate-700 transition-all">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-[15px] mb-1">{{ $item->title }}</h3>
                            <p class="text-white/50 text-[12.5px]">{{ $item->date->locale('id')->translatedFormat('j F Y') }}</p>
                            <p class="text-white/70 text-[12.5px] mt-0.5">{{ $item->category ?? 'Ibadah' }}</p>
                            <p class="text-white/40 text-[12px] mt-1">{{ $item->time ?? '-' }}</p>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-slate-400 text-sm">Belum ada jadwal ibadah.</p>
                @endforelse
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="{{ route('client.schedule-worship') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Jadwal &rarr;</a>
            </div>
        </div>
    </section>

    {{-- WARTA JEMAAT --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Warta Jemaat</h2>
                <a href="{{ route('client.announcements') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Warta
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($announcements as $item)
                    <a href="{{ route('client.announcements') }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <div class="bg-gradient-to-br from-sky-100 to-sky-50 h-36 flex items-center justify-center relative overflow-hidden">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Warta</span>
                            @endif
                            <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                {{ $item->date->locale('id')->translatedFormat('j F Y') }}
                            </span>
                        </div>
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-slate-800 text-[14.5px]">{{ $item->title }}</h3>
                                <p class="text-slate-500 text-[12.5px] mt-0.5">{{ $item->theme }}</p>
                            </div>
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-slate-400 text-sm">Belum ada warta jemaat.</p>
                @endforelse
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="{{ route('client.announcements') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Warta &rarr;</a>
            </div>
        </div>
    </section>

    {{-- KEGIATAN GEREJA --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Kegiatan Gereja</h2>
                <a href="{{ route('client.events') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Kegiatan
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($events as $item)
                    <a href="{{ route('client.events') }}" class="bg-white rounded-2xl overflow-hidden border border-slate-100 hover:border-slate-200 hover:shadow-md transition-all group">
                        <div class="bg-gradient-to-br from-slate-100 to-slate-50 h-36 flex items-center justify-center relative overflow-hidden">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Kegiatan</span>
                            @endif
                            <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                {{ $item->date->locale('id')->translatedFormat('j F Y') }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 text-[14.5px]">{{ $item->title }}</h3>
                            <p class="text-slate-500 text-[12.5px] mt-1 leading-relaxed line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 80) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-slate-400 text-sm">Belum ada kegiatan gereja.</p>
                @endforelse
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="{{ route('client.events') }}" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Kegiatan &rarr;</a>
            </div>
        </div>
    </section>

    {{-- LOKASI GEREJA --}}
    <section class="py-14 sm:py-20 bg-gradient-to-br from-slate-100 to-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold mb-8">Lokasi Gereja</h2>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                <div class="grid md:grid-cols-[1fr_380px]">
                    <div class="h-64 md:h-auto bg-slate-200 relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3!2d105.2!3d-5.4!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMjQnMDAuMCJTIDEwNcKwMTInMDAuMCJF!5e0!3m2!1sid!2sid!4v1"
                            width="100%" height="100%" style="border:0; min-height: 280px;" allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                    <div class="p-7 sm:p-8 flex flex-col justify-center">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">GBKP Bandar Lampung</h3>
                                <p class="text-slate-500 text-[14px] mt-1.5 leading-relaxed">
                                    Jalan Turi Raya (By Pass KP) No.36,<br>
                                    Tanjung Senang,<br>
                                    Bandar Lampung, Lampung 35141
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

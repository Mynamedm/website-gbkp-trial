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
                KEGIATAN <span class="text-blue-400">GEREJA</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Informasi dan pengumuman resmi untuk seluruh jemaat GBKP Bandar Lampung
            </p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <section class="bg-gradient-to-r from-slate-800 to-slate-700 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-[13px]">
                <a href="{{ route('client.home') }}" class="text-slate-300 hover:text-white transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.events') }}" class="text-slate-300 hover:text-white transition-colors">Kegiatan Gereja</a>
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium">Tahun {{ $year }}</span>
            </nav>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid lg:grid-cols-3 gap-8">
                {{-- Main --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-extrabold uppercase tracking-wide">
                            Kegiatan <span class="text-blue-600">{{ $year }}</span>
                        </h2>
                        <a href="{{ route('client.events') }}" class="inline-flex items-center gap-1.5 text-blue-700 text-[13px] font-semibold hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                            </svg>
                            Semua Kegiatan
                        </a>
                    </div>

                    @php
                        $defaultColor = 'bg-slate-100 text-slate-700';
                    @endphp

                    @if($events->isEmpty())
                        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200">
                            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            <p class="text-slate-500 text-[15px]">Belum ada kegiatan untuk tahun {{ $year }}.</p>
                        </div>
                    @else
                        <div class="grid sm:grid-cols-2 gap-6">
                            @foreach($events as $event)
                                @php
                                    $date = $event->date;
                                    $day = $date->format('d');
                                    $month = strtoupper($date->format('M'));
                                    $yr = $date->format('Y');
                                    $catColor = $categoryColors[$event->category] ?? $defaultColor;
                                @endphp
                                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
                                    <div class="bg-gradient-to-br from-slate-100 to-slate-50 px-5 pt-5 pb-4">
                                        <div class="w-14 h-14 rounded-xl bg-blue-700 flex flex-col items-center justify-center text-white shrink-0">
                                            <span class="text-lg font-extrabold leading-none">{{ $day }}</span>
                                            <span class="text-[9px] uppercase tracking-wider font-semibold leading-none mt-0.5">{{ $month }}</span>
                                            <span class="text-[8px] uppercase tracking-wider font-medium leading-none mt-0.5">{{ $yr }}</span>
                                        </div>
                                    </div>
                                    <div class="p-5 flex flex-col flex-1">
                                        <span class="inline-block {{ $catColor }} text-[11px] font-semibold px-2.5 py-1 rounded-md mb-3 self-start uppercase tracking-wide">
                                            {{ $event->category }}
                                        </span>
                                        <h3 class="font-display text-slate-800 text-[15px] font-bold leading-snug mb-2">{{ $event->title }}</h3>
                                        <p class="text-slate-500 text-[13px] leading-relaxed mb-4 line-clamp-2">{{ $event->description }}</p>
                                        <div class="mt-auto">
                                            <div class="flex items-center gap-1.5 text-slate-400 text-[12px] mb-4">
                                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                                </svg>
                                                {{ $event->location }}
                                            </div>
                                            <a href="{{ route('client.events.detail', $event->slug) }}" class="block w-full text-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 text-[13px] font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                                                Lihat Detail &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-10 flex justify-center">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <h3 class="font-display text-slate-800 text-base font-bold mb-4">Arsip per Tahun</h3>
                        <div class="space-y-3">
                            @foreach($archiveYears as $archive)
                                <a href="{{ route('client.events.archive', $archive->year) }}"
                                   class="flex items-center justify-between {{ $archive->year == $year ? 'bg-blue-700 text-white' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }} rounded-xl px-4 py-3 transition-colors group">
                                    <div>
                                        <p class="text-[14px] font-semibold">Tahun {{ $archive->year }}</p>
                                        <p class="{{ $archive->year == $year ? 'text-blue-200' : 'text-slate-400' }} text-[12px]">{{ $archive->count }} Kegiatan</p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full {{ $archive->year == $year ? 'bg-white/15' : 'bg-slate-200 group-hover:bg-slate-300' }} flex items-center justify-center transition-colors shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

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

    {{-- FILTER SECTION --}}
    <section class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form action="{{ route('client.events') }}" method="GET">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-end gap-4">
                        <div class="flex-1 w-full">
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Tahun</label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <select name="year" class="w-full appearance-none bg-white border border-slate-300 rounded-lg pl-10 pr-10 py-2.5 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Kategori</label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                    </svg>
                                </div>
                                <select name="category" onchange="this.closest('form').submit()" class="w-full appearance-none bg-white border border-slate-300 rounded-lg pl-10 pr-10 py-2.5 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-[1.5] w-full">
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Cari Kegiatan</label>
                            <div class="relative" x-data="eventSearch()">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan...."
                                       class="w-full border border-slate-300 rounded-lg pl-10 pr-4 py-2.5 text-[14px] text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       x-model="query"
                                       @input="onInput()"
                                       @focus="onInput()"
                                       @keydown.escape="close()"
                                       autocomplete="off">

                                {{-- Suggestions Dropdown --}}
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 transform -translate-y-1"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-1"
                                     class="absolute z-50 w-full mt-1 bg-white border border-slate-200 rounded-lg shadow-lg overflow-hidden"
                                     @click.outside="close()">
                                    <template x-for="result in results" :key="result.id">
                                        <a :href="result.url" 
                                           class="block px-4 py-3 hover:bg-slate-50 border-b last:border-0 border-slate-100">
                                            <p class="text-slate-800 text-[13.5px] font-medium" x-text="result.title"></p>
                                            <div class="flex flex-wrap items-center gap-3 mt-1.5 text-[11px] text-slate-500">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                                    </svg>
                                                    <span x-text="result.date"></span>
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                                    </svg>
                                                    <span x-text="result.location"></span>
                                                </span>
                                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded" x-text="result.category"></span>
                                            </div>
                                        </a>
                                    </template>
                                    <div x-show="loading" class="px-4 py-3 text-center text-slate-500 text-[13px]">
                                        <svg class="animate-spin w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-8-6 8-6z"/>
                                        </svg>
                                        Mencari...
                                    </div>
                                    <div x-show="!loading && results.length === 0 && query.length >= 2" class="px-4 py-3 text-center text-slate-500 text-[13px]">
                                        Tidak ditemukan kegiatan dengan "<span x-text="query"></span>"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- DAFTAR KEGIATAN (hasil filter) --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-extrabold mb-10 uppercase tracking-wide">
                @if(request('year') || request('category') || request('search'))
                    Hasil <span class="text-blue-600">Pencarian</span>
                @else
                    Kegiatan <span class="text-blue-600">Terbaru</span>
                @endif
            </h2>

            @php
                $defaultColor = 'bg-slate-100 text-slate-700';
            @endphp

            @if($events->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    <p class="text-slate-500 text-[15px]">Tidak ada kegiatan yang sesuai dengan filter.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        @php
                            $date = $event->date;
                            $day = $date->format('d');
                            $month = strtoupper($date->format('M'));
                            $year = $date->format('Y');
                            $catColor = $categoryColors[$event->category] ?? $defaultColor;
                        @endphp
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
                            <div class="bg-gradient-to-br from-slate-100 to-slate-50 px-5 pt-5 pb-4">
                                <div class="w-14 h-14 rounded-xl bg-blue-700 flex flex-col items-center justify-center text-white shrink-0">
                                    <span class="text-lg font-extrabold leading-none">{{ $day }}</span>
                                    <span class="text-[9px] uppercase tracking-wider font-semibold leading-none mt-0.5">{{ $month }}</span>
                                    <span class="text-[8px] uppercase tracking-wider font-medium leading-none mt-0.5">{{ $year }}</span>
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
            @endif
        </div>
    </section>

    {{-- PAGINATION --}}
    @if($events->hasPages())
    <section class="bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-center">
                {{ $events->links() }}
            </div>
        </div>
    </section>
    @endif

@endsection

{{-- Alpine.js Search Component --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventSearch', () => ({
            query: '',
            results: [],
            open: false,
            loading: false,
            debounceTimer: null,

            onInput() {
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => this.search(), 300);
            },

            async search() {
                if (this.query.length < 2) {
                    this.results = [];
                    this.open = false;
                    this.loading = false;
                    return;
                }

                this.loading = true;
                this.open = true;

                try {
                    const response = await fetch(`{{ route('client.events.search') }}?q=${encodeURIComponent(this.query)}`);
                    this.results = await response.json();
                } catch (error) {
                    this.results = [];
                } finally {
                    this.loading = false;
                }
            },

            close() {
                clearTimeout(this.debounceTimer);
                this.open = false;
                this.results = [];
            }
        }));
    });
</script>

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
                JADWAL <span class="text-blue-400">IBADAH</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Temukan jadwal ibadah sesuai kategori pelayanan di GBKP Bandar Lampung
            </p>
        </div>
    </section>

    @php
        $kategorial = [
            ['id' => 2, 'nama' => 'MORIA', 'subtitle' => 'Ibadah Kaum Ibu'],
            ['id' => 3, 'nama' => 'MAMRE', 'subtitle' => 'Ibadah Kaum Ayah'],
            ['id' => 4, 'nama' => 'PERPULUNGEN JABU-JABU', 'subtitle' => 'Ibadah Keluarga (PJJ)'],
            ['id' => 5, 'nama' => 'PERMATA', 'subtitle' => 'Ibadah Pemuda - Pemudi'],
            ['id' => 6, 'nama' => 'KA-KR', 'subtitle' => 'Ibadah Anak - Anak'],
            ['id' => 7, 'nama' => 'SAITUN', 'subtitle' => 'Ibadah Lansia'],
            ['id' => 8, 'nama' => 'NAOMI', 'subtitle' => 'Ibadah Kaum Janda'],
        ];
    @endphp

    {{-- KATEGORI IBADAH --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="space-y-12">

                {{-- IBADAH KATEGORIAL --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-blue-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-extrabold uppercase tracking-wide leading-none">Ibadah Kategorial</h2>
                            <p class="text-slate-500 text-[13px] mt-1.5">Pilih kategorial untuk melihat sektor & jadwal ibadah</p>
                        </div>
                    </div>

                    {{-- CAROUSEL KATEGORIAL --}}
                    <div x-data="kategorialCarousel({ total: {{ count($kategorial) }} })"
                        class="relative">
                        {{-- Arrows --}}
                        <button @click="prevPage()" :disabled="currentPage === 0"
                                class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-100 transition-colors disabled:opacity-40 disabled:cursor-not-allowed hidden sm:flex"
                                aria-label="Sebelumnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                        </button>
                        <button @click="nextPage()" :disabled="currentPage >= pages - 1"
                                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-100 transition-colors disabled:opacity-40 disabled:cursor-not-allowed hidden sm:flex"
                                aria-label="Selanjutnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </button>

                        {{-- Track --}}
                        <div class="overflow-hidden touch-pan-y" style="touch-action: pan-y;" @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)">
                            <div class="flex transition-transform duration-500 ease-out cursor-grab active:cursor-grabbing" :style="track()">
                                @foreach($kategorial as $item)
                                    <div class="shrink-0 basis-1/2 sm:basis-1/3 lg:basis-1/4 px-1.5 sm:px-2">
                                        <a href="{{ route('client.schedule-worship.detail', $item['id']) }}"
                                           class="group flex flex-col items-center justify-center text-center h-full min-h-[150px] sm:min-h-[170px] bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl p-4 sm:p-5 transition-all duration-300 hover:from-slate-700 hover:to-slate-600 hover:shadow-lg">
                                            <div class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center mb-3 group-hover:bg-yellow-500 transition-colors shrink-0">
                                                <svg class="w-5 h-5 text-white group-hover:text-slate-900 transition-colors" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-white font-bold text-[13px] sm:text-[14px] uppercase tracking-wide leading-tight">{{ $item['nama'] }}</h3>
                                            <p class="text-yellow-300 text-[11px] sm:text-[11.5px] font-medium mt-1.5">{{ $item['subtitle'] }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Dots --}}
                        <div class="flex items-center justify-center flex-wrap gap-2 mt-6">
                            <template x-for="page in pages" :key="page">
                                <button @click="goToPage(page - 1)"
                                        :class="currentPage === (page - 1) ? 'bg-blue-600 w-8' : 'bg-slate-300 hover:bg-slate-400 w-2.5'"
                                        class="h-2.5 rounded-full transition-all duration-300"
                                        :aria-label="'Halaman ' + page"></button>
                            </template>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Info Perubahan Jadwal --}}
            <div class="mt-10 bg-white rounded-2xl border border-slate-200 p-5 flex items-start gap-4">
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

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('kategorialCarousel', (props) => ({
                currentPage: 0,
                perView: 2,
                total: props.total,
                pages: 1,
                touchStartX: 0,
                touchEndX: 0,
                init() {
                    this.updateLayout();
                    window.addEventListener('resize', () => this.updateLayout());
                },
                updateLayout() {
                    this.perView = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 640 ? 3 : 2);
                    this.pages = Math.max(1, this.total - this.perView + 1);
                    if (this.currentPage > this.pages - 1) this.currentPage = this.pages - 1;
                },
                nextPage() { if (this.currentPage < this.pages - 1) this.currentPage++; },
                prevPage() { if (this.currentPage > 0) this.currentPage--; },
                goToPage(page) { this.currentPage = page; },
                track() { return 'transform: translateX(-' + (this.currentPage * (100 / this.perView)) + '%);'; },
                handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
                handleTouchEnd(e) { this.touchEndX = e.changedTouches[0].screenX; this.handleSwipe(); },
                handleSwipe() {
                    const diff = this.touchStartX - this.touchEndX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) this.nextPage();
                        else this.prevPage();
                    }
                }
            }));
        });
    </script>
    @endpush

@endsection
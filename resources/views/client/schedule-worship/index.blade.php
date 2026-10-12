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

    {{-- DAFTAR KATEGORI IBADAH --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            @php
                $kategori = [
                    [
                        'id' => 1,
                        'nama' => 'IBADAH UMUM',
                        'subtitle' => 'Pagi & Sore',
                        'deskripsi' => 'Jadwal ibadah umum pagi dan sore.',
                    ],
                    [
                        'id' => 2,
                        'nama' => 'MORIA',
                        'subtitle' => 'Ibadah Kaum Ibu',
                        'deskripsi' => 'Jadwal ibadah khusus kaum ibu.',
                    ],
                    [
                        'id' => 3,
                        'nama' => 'MAMRE',
                        'subtitle' => 'Ibadah Kaum Ayah',
                        'deskripsi' => 'Jadwal ibadah khusus kaum ayah.',
                    ],
                    [
                        'id' => 4,
                        'nama' => 'PERPULUNGEN JABU-JABU',
                        'subtitle' => 'Ibadah keluarga',
                        'deskripsi' => 'Jadwal ibadah keluarga',
                    ],
                    [
                        'id' => 5,
                        'nama' => 'PERMATA',
                        'subtitle' => 'Ibadah Pemuda - Pemudi',
                        'deskripsi' => 'Jadwal ibadah Pemuda - Pemudi',
                    ],
                    [
                        'id' => 6,
                        'nama' => 'KA-KR',
                        'subtitle' => 'Ibadah Anak - Anak',
                        'deskripsi' => 'Jadwal ibadah untuk kelas batita - remaja',
                    ],
                    [
                        'id' => 7,
                        'nama' => 'SAITUN',
                        'subtitle' => 'Ibadah lansia',
                        'deskripsi' => 'Jadwal ibadah khusus kaum lansia.',
                    ],
                    [
                        'id' => 8,
                        'nama' => 'NAOMI',
                        'subtitle' => 'Ibadah janda',
                        'deskripsi' => 'Jadwal ibadah khusus kaum janda.',
                    ],
                ];
            @endphp

            {{-- CAROUSEL KATEGORI IBADAH --}}
            <div x-data="{
                currentIndex: 0,
                kategoriData: @json($kategori),
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.kategoriData.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.kategoriData.length) % this.kategoriData.length;
                },
                goTo(index) {
                    this.currentIndex = index;
                }
            }" class="mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-extrabold uppercase tracking-wide mb-6">Kategori Pelayanan</h2>
                
                {{-- Carousel Container --}}
                <div class="relative">
                    {{-- Navigation Arrows --}}
                    <button @click="prev()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 sm:-translate-x-8 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-100 transition-colors hidden sm:block" aria-label="Sebelumnya">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                        </svg>
                    </button>
                    <button @click="next()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 sm:translate-x-8 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-100 transition-colors hidden sm:block" aria-label="Selanjutnya">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>

                    {{-- Carousel Track --}}
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-out" :style="'transform: translateX(' + (-currentIndex * 100) + '%)'">
                            <template x-for="(item, index) in kategoriData" :key="index">
                                <div class="w-full shrink-0 px-2 sm:px-3">
                                    <a :href="'/jadwal-ibadah/' + item.id" class="w-full aspect-[4/3] rounded-2xl bg-gradient-to-br from-slate-800 to-slate-700 flex flex-col items-center justify-center p-5 sm:p-6 text-center transition-all duration-300 hover:from-slate-700 hover:to-slate-600 group">
                                        <h3 class="text-white font-bold text-[14px] sm:text-[16px] lg:text-[18px] uppercase tracking-wide leading-tight mb-1" x-text="item.nama"></h3>
                                        <p class="text-yellow-300 text-[11px] sm:text-[12px] font-medium mb-2" x-text="item.subtitle"></p>
                                        <p class="text-slate-300 text-[12px] sm:text-[13px] line-clamp-2" x-text="item.deskripsi"></p>
                                        <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center mt-4 group-hover:bg-yellow-400 transition-colors">
                                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Dots Indicator --}}
                    <div class="flex items-center justify-center gap-2 mt-6">
                        <template x-for="(item, index) in kategoriData" :key="index">
                            <button @click="goTo(index)" :class="['w-2.5 h-2.5 rounded-full transition-all duration-300', currentIndex === index ? 'bg-blue-600 w-8' : 'bg-slate-300 hover:bg-slate-400']" :aria-label="'Go to category ' + (index + 1)"></button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Info Perubahan Jadwal --}}
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
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

            <div class="space-y-4">
                @foreach($kategori as $item)
                    <a href="{{ route('client.schedule-worship.detail', $item['id']) }}" class="flex items-center justify-between bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl p-5 sm:p-6 hover:from-slate-700 hover:to-slate-600 transition-all group">
                        <div class="flex items-center gap-0 min-w-0">
                            <div class="shrink-0 w-[180px] sm:w-[200px]">
                                <h3 class="text-white font-bold text-[14px] sm:text-[15px] uppercase tracking-wide leading-tight">{{ $item['nama'] }}</h3>
                                <p class="text-slate-400 text-[12px] sm:text-[12.5px] mt-0.5">{{ $item['subtitle'] }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-500 mx-4 sm:mx-5 shrink-0"></div>
                            <p class="text-slate-300 text-[13px] sm:text-[13.5px] min-w-0">{{ $item['deskripsi'] }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center shrink-0 ml-4 group-hover:bg-yellow-400 transition-colors">
                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
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
@extends('layouts.client.app')

@section('content')

    {{-- Breadcrumb --}}
    <section class="bg-gradient-to-r from-slate-800 to-slate-700 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-[13px] text-slate-400">
                <a href="{{ route('client.home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.about-church') }}" class="hover:text-white transition-colors">Tentang</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium">Tentang Kategorial</span>
            </div>
        </div>
    </section>

    {{-- Hero --}}
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Kategorial GBKP" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="max-w-2xl">
                <span class="inline-block text-blue-200 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Pelayanan Kategorial</span>
                <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5">
                    Tentang Kategorial
                </h1>
                <p class="text-blue-100/80 text-[15px] leading-relaxed max-w-xl">
                    Mengenal lebih dekat pelayanan kategorial di GBKP Bandar Lampung yang melayani setiap kelompok usia dan kebutuhan jemaat.
                </p>
            </div>
        </div>
    </section>

    {{-- Pengantar --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Pengantar</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold mb-5">Pelayanan Berdasarkan Kelompok Usia</h2>
                <p class="text-slate-600 text-[15px] leading-relaxed">
                    GBKP Bandar Lampung memiliki pelayanan kategorial yang terdiri dari berbagai kelompok pelayanan berdasarkan usia dan kebutuhan. Setiap kategorial memiliki peran penting dalam membina iman dan membangun persekutuan jemaat.
                </p>
            </div>
        </div>
    </section>

    @php
        $kategorials = [
            [
                'name' => 'MORIA',
                'slug' => 'moria',
                'color' => 'pink',
                'desc_1' => 'Moria adalah persekutuan kaum ibu di GBKP Bandar Lampung. Kategorial ini melayani dan membina para ibu dalam kehidupan beriman, berkeluarga, dan bermasyarakat.',
                'desc_2' => 'Kegiatan Moria meliputi persekutuan doa, ibadah rutin, bakti sosial, serta berbagai kegiatan pelayanan yang berfokus pada penguatan peran ibu dalam keluarga dan jemaat.',
                'schedule_id' => 2,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                'anggota' => 'Kaum Ibu',
                'tagline' => 'Persekutuan Kaum Ibu',
                'jumlah' => '186',
            ],
            [
                'name' => 'MAMRE',
                'slug' => 'mamre',
                'color' => 'blue',
                'desc_1' => 'Mamre adalah persekutuan kaum ayah di GBKP Bandar Lampung. Kategorial ini menjadi wadah bagi para pria untuk bertumbuh dalam iman dan memperkuat peran sebagai pemimpin keluarga.',
                'desc_2' => 'Kegiatan Mamre meliputi persekutuan doa, diskusi keimanan, pelayanan sosial, serta berbagai kegiatan yang mendukung pelayanan kaum ayah di tengah keluarga dan jemaat.',
                'schedule_id' => 3,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                'anggota' => 'Kaum Ayah',
                'tagline' => 'Persekutuan Kaum Ayah',
                'jumlah' => '142',
            ],
            [
                'name' => 'PJJ',
                'slug' => 'pjj',
                'color' => 'teal',
                'desc_1' => 'PJJ (Perpulungen Jabu-Jabu) adalah persekutuan keluarga di GBKP Bandar Lampung. Kategorial ini membina kehidupan keluarga Kristen dalam berbagai aspek.',
                'desc_2' => 'Kegiatan PJJ meliputi persekutuan keluarga, diskusi kehidupan berkeluarga, bakti sosial, serta kegiatan yang memperkuat hubungan suami istri dan pendidikan anak.',
                'schedule_id' => 4,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>',
                'anggota' => 'Keluarga',
                'tagline' => 'Perpulungen Jabu-Jabu',
                'jumlah' => '164',
            ],
            [
                'name' => 'KA-KR',
                'slug' => 'ka-kr',
                'color' => 'green',
                'desc_1' => 'KA-KR (Kelas Anak - Kelas Remaja) adalah pelayanan untuk anak-anak dan remaja di GBKP Bandar Lampung. Kategorial ini membina generasi muda sejak usia dini hingga remaja.',
                'desc_2' => 'Kegiatan KA-KR meliputi sekolah minggu, katekisasi, persekutuan remaja, dan berbagai kegiatan edukatif yang membentuk karakter iman generasi muda sejak dini.',
                'schedule_id' => 6,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>',
                'anggota' => 'Anak & Remaja',
                'tagline' => 'Sekolah Minggu & Remaja',
                'jumlah' => '95',
            ],
            [
                'name' => 'PERMATA',
                'slug' => 'permata',
                'color' => 'violet',
                'desc_1' => 'PERMATA adalah persekutuan pemuda-pemudi di GBKP Bandar Lampung. Kategorial ini menjadi wadah bagi generasi muda untuk bertumbuh dalam iman, berkarya, dan melayani.',
                'desc_2' => 'Kegiatan PERMATA meliputi ibadah pemuda, kajian Alkitab, kegiatan sosial, worship night, serta berbagai kegiatan kreatif yang mengembangkan potensi generasi muda.',
                'schedule_id' => 5,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>',
                'anggota' => 'Pemuda & Pemudi',
                'tagline' => 'Persekutuan Pemuda',
                'jumlah' => '128',
            ],
            [
                'name' => 'SAITUN',
                'slug' => 'saitun',
                'color' => 'amber',
                'desc_1' => 'SAITUN adalah persekutuan kaum lansia di GBKP Bandar Lampung. Kategorial ini melayani dan membina para lansia dengan penuh kasih dan perhatian.',
                'desc_2' => 'Kegiatan SAITUN meliputi ibadah lansia, kunjungan kasih, persekutuan doa, serta kegiatan yang memperhatikan kebutuhan rohani dan jasmani para lansia.',
                'schedule_id' => 7,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                'anggota' => 'Lansia',
                'tagline' => 'Persekutuan Lansia',
                'jumlah' => '67',
            ],
            [
                'name' => 'NAOMI',
                'slug' => 'naomi',
                'color' => 'rose',
                'desc_1' => 'NAOMI adalah persekutuan kaum janda di GBKP Bandar Lampung. Kategorial ini menjadi tempat perlindungan dan penguatan bagi kaum janda dalam menjalani kehidupan.',
                'desc_2' => 'Kegiatan NAOMI meliputi ibadah rutin, persekutuan doa, bakti sosial, serta kegiatan yang memberikan dukungan rohani dan emosional bagi kaum janda.',
                'schedule_id' => 8,
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
                'anggota' => 'Kaum Janda',
                'tagline' => 'Persekutuan Kaum Janda',
                'jumlah' => '43',
            ],
        ];
    @endphp

    {{-- List Kategorial --}}
    <section class="pb-14 sm:pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach($kategorials as $index => $item)
                @php
                    $isEven = $index % 2 === 0;
                @endphp
                <div class="grid lg:grid-cols-2 gap-12 items-center mb-16 last:mb-0">
                    @if(!$isEven)
                        <div class="order-2 lg:order-1">
                            <div class="bg-gradient-to-br from-{{ $item['color'] }}-100 to-{{ $item['color'] }}-50 rounded-2xl h-64 sm:h-72 flex items-center justify-center">
                                <span class="text-{{ $item['color'] }}-300 text-[13px] font-medium">Foto {{ $item['name'] }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="{{ $isEven ? '' : 'order-1 lg:order-2' }}">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-{{ $item['color'] }}-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-{{ $item['color'] }}-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                            </div>
                            <div>
                                <span class="inline-block text-{{ $item['color'] }}-600 text-[11px] font-semibold uppercase tracking-[0.18em]">Kategorial</span>
                                <h3 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">{{ $item['name'] }}</h3>
                            </div>
                        </div>
                        <p class="text-slate-500 text-[13px] uppercase tracking-wide font-medium mb-2">{{ $item['tagline'] }}</p>
                        <p class="text-slate-600 text-[15px] leading-relaxed mb-4">{{ $item['desc_1'] }}</p>
                        <p class="text-slate-600 text-[15px] leading-relaxed mb-4">{{ $item['desc_2'] }}</p>
                        <div class="flex items-center gap-3 mt-5">
                            <a href="{{ route('client.about-kategorial.detail', $item['slug']) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-700 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                                Lihat Selengkapnya
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if($isEven)
                        <div class="bg-gradient-to-br from-{{ $item['color'] }}-100 to-{{ $item['color'] }}-50 rounded-2xl h-64 sm:h-72 flex items-center justify-center">
                            <span class="text-{{ $item['color'] }}-300 text-[13px] font-medium">Foto {{ $item['name'] }}</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pengurus Kategorial --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Struktur Organisasi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Pengurus Kategorial</h2>
            </div>

            @php
                $pengurus = [
                    [
                        'name' => 'MORIA',
                        'color' => 'pink',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Ny. Ratna Ginting'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Ny. Sri Hartati'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Ny. Rina br. Sitepu'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Ny. Dewi br. Karo'],
                        ],
                    ],
                    [
                        'name' => 'MAMRE',
                        'color' => 'blue',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Pt. Andreas Ginting'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Pt. Budi Surbakti'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Pt. Rudi Sinulingga'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Pt. Hiskia Barus'],
                        ],
                    ],
                    [
                        'name' => 'KA-KR',
                        'color' => 'green',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Dk. Martha br. Ketaren'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Dk. Ester br. Sembiring'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Dk. Ruth br. Ginting'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Dk. Sarah br. Perangin-angin'],
                        ],
                    ],
                    [
                        'name' => 'PERMATA',
                        'color' => 'violet',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Angelica br. Surbakti'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Viko A. Sebayang'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Claresta br. Ginting'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Daniel Siahaan'],
                        ],
                    ],
                    [
                        'name' => 'SAITUN',
                        'color' => 'amber',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Pt. Tulus Ginting'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Pt. Ngading Surbakti'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Nd. Riama br. Karo'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Nd. Tumini br. Sitepu'],
                        ],
                    ],
                    [
                        'name' => 'NAOMI',
                        'color' => 'rose',
                        'items' => [
                            ['jabatan' => 'Ketua', 'nama' => 'Nd. Naomi br. Ginting'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Nd. Herawati br. Sinulingga'],
                            ['jabatan' => 'Sekretaris', 'nama' => 'Nd. Ratna br. Surbakti'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Nd. Siti br. Perangin-angin'],
                        ],
                    ],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($pengurus as $item)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="bg-{{ $item['color'] }}-50 px-6 py-4 border-b border-{{ $item['color'] }}-100">
                            <h3 class="font-display text-slate-800 font-bold text-[15px]">{{ $item['name'] }}</h3>
                        </div>
                        <div class="px-6 py-4">
                            @foreach($item['items'] as $person)
                                <div class="flex items-center justify-between py-2.5 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                                    <span class="text-slate-500 text-[12.5px]">{{ $person['jabatan'] }}</span>
                                    <span class="text-slate-800 text-[13px] font-medium">{{ $person['nama'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Jumlah Anggota --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Statistik</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Jumlah Anggota</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($kategorials as $item)
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-{{ $item['color'] }}-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-{{ $item['color'] }}-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-display text-slate-800 font-bold text-[15px]">{{ $item['name'] }}</h3>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="text-3xl font-extrabold text-slate-800 leading-none">{{ $item['jumlah'] }}</span>
                            <span class="text-slate-500 text-[13px] mb-0.5">anggota</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-center">
                <p class="text-blue-200 text-[13px] uppercase tracking-wider font-semibold mb-2">Total Seluruh Anggota Kategorial</p>
                <p class="text-white text-4xl sm:text-5xl font-extrabold">661</p>
                <p class="text-blue-200/70 text-[13px] mt-2">Jemaat GBKP Bandar Lampung</p>
            </div>
        </div>
    </section>

    {{-- Dokumentasi Kegiatan --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Galeri</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Dokumentasi Kegiatan</h2>
            </div>

            @php
                $dokumentasi = [
                    ['judul' => 'Ibadah Minggu Advent', 'tanggal' => '27 Agustus 2026', 'kategori' => 'Ibadah', 'warna' => 'from-sky-100 to-sky-50'],
                    ['judul' => 'Persekutuan Moria', 'tanggal' => '20 Agustus 2026', 'kategori' => 'Kategorial', 'warna' => 'from-pink-100 to-pink-50'],
                    ['judul' => 'Sekolah Minggu', 'tanggal' => '17 Agustus 2026', 'kategori' => 'KA-KR', 'warna' => 'from-green-100 to-green-50'],
                    ['judul' => 'Kebaktian Malam PERMATA', 'tanggal' => '14 Agustus 2026', 'kategori' => 'Pemuda', 'warna' => 'from-violet-100 to-violet-50'],
                    ['judul' => 'Ibadah Lansia SAITUN', 'tanggal' => '10 Agustus 2026', 'kategori' => 'Lansia', 'warna' => 'from-amber-100 to-amber-50'],
                    ['judul' => 'Bakti Sosial Jemaat', 'tanggal' => '06 Agustus 2026', 'kategori' => 'Sosial', 'warna' => 'from-rose-100 to-rose-50'],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($dokumentasi as $item)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 hover:shadow-md transition-all group cursor-pointer">
                        <div class="bg-gradient-to-br {{ $item['warna'] }} h-44 flex items-center justify-center relative">
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Kegiatan</span>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                {{ $item['kategori'] }}
                            </span>
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

@endsection

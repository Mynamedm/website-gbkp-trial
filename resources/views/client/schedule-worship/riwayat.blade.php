@extends('layouts.client.app')

@section('content')

    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=1600&q=80"
                 alt="Alkitab GBKP" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="flex items-center gap-2 text-blue-200 text-[13px] mb-4">
                <a href="{{ route('client.schedule-worship.umum') }}" class="hover:text-white transition-colors">Jadwal Ibadah</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.schedule-worship.detail', $kategoriId) }}" class="hover:text-white transition-colors">{{ $kategori['breadcrumb'] }}</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="{{ route('client.schedule-worship.sektor', [$kategoriId, $sektorIndex]) }}" class="hover:text-white transition-colors">{{ $sektorItem['nama'] }}</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium">Riwayat Ibadah</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                Riwayat <span class="text-yellow-400">Ibadah</span>
            </h1>
            <div class="w-16 h-1 bg-yellow-400 rounded-full mb-4"></div>
            <p class="text-blue-100/80 text-[15px] leading-relaxed max-w-xl">
                Lihat kembali informasi ibadah mingguan {{ $sektorItem['nama'] }} selama 1 tahun terakhir
            </p>
        </div>
    </section>

    {{-- STATISTIK RINGKASAN --}}
    <section class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 rounded-xl p-4 text-center">
                    <p class="text-blue-600 text-2xl sm:text-3xl font-extrabold" id="totalIbadah">{{ count($riwayatIbadah) }}</p>
                    <p class="text-slate-500 text-[12px] font-medium mt-1">Total Ibadah</p>
                </div>
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-green-600 text-2xl sm:text-3xl font-extrabold" id="totalBulan">12</p>
                    <p class="text-slate-500 text-[12px] font-medium mt-1">Bulan Tercatat</p>
                </div>
                <div class="bg-yellow-50 rounded-xl p-4 text-center">
                    <p class="text-yellow-600 text-2xl sm:text-3xl font-extrabold">{{ $sektorItem['nama'] }}</p>
                    <p class="text-slate-500 text-[12px] font-medium mt-1">Sektor</p>
                </div>
                <div class="bg-purple-50 rounded-xl p-4 text-center">
                    <p class="text-purple-600 text-2xl sm:text-3xl font-extrabold">1 Tahun</p>
                    <p class="text-slate-500 text-[12px] font-medium mt-1">Jangka Waktu</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FILTER & DAFTAR RIWAYAT --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

            {{-- Filter --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-display text-slate-800 text-base font-bold">Filter Pencarian</h2>
                        <p class="text-slate-400 text-[12px]">Temukan ibadah berdasarkan periode waktu</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-end gap-4">
                    <div class="flex-1 w-full">
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Bulan</label>
                        <div class="relative">
                            <select id="filterBulan" onchange="filterRiwayat()" class="w-full appearance-none bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="all">Semua Bulan</option>
                                <option value="0">Januari</option>
                                <option value="1">Februari</option>
                                <option value="2">Maret</option>
                                <option value="3">April</option>
                                <option value="4">Mei</option>
                                <option value="5">Juni</option>
                                <option value="6">Juli</option>
                                <option value="7">Agustus</option>
                                <option value="8">September</option>
                                <option value="9">Oktober</option>
                                <option value="10">November</option>
                                <option value="11">Desember</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1.5">Cari</label>
                        <div class="relative">
                            <input type="text" id="searchInput" onkeyup="filterRiwayat()" placeholder="Ketik nama tema atau pembicara..." class="w-full bg-white border border-slate-300 rounded-lg px-4 py-2.5 pr-10 text-[14px] text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hasil Pencarian --}}
            <div id="hasilInfo" class="mb-4 text-[13px] text-slate-500 font-medium" style="display: none;">
                Menampilkan <span id="jumlahHasil" class="text-slate-800 font-bold">0</span> riwayat ibadah
            </div>

            {{-- Daftar Riwayat --}}
            <div id="riwayatList" class="space-y-3">
                @php
                    $bulanNames = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    $hariNames = [
                        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
                    ];
                    $currentMonth = null;
                @endphp

                @foreach($riwayatIbadah as $index => $riwayat)
                    @php
                        $tanggalObj = \Carbon\Carbon::parse($riwayat['tanggal']);
                        $bulan = $tanggalObj->month - 1;
                        $namaBulan = $bulanNames[$bulan];
                        $tahun = $tanggalObj->year;
                        $namaHari = $hariNames[$tanggalObj->dayOfWeek];
                        $bulanKey = $namaBulan . ' ' . $tahun;
                        $isNewMonth = ($bulanKey !== $currentMonth);
                        $currentMonth = $bulanKey;
                    @endphp

                    @if($isNewMonth)
                        {{-- Header Bulan --}}
                        <div class="riwayat-bulan" data-bulan="{{ $bulan }}">
                            <div class="flex items-center gap-3 py-3 mt-2">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-display text-slate-800 text-lg font-bold">{{ $namaBulan }} {{ $tahun }}</h3>
                                    <p class="text-slate-400 text-[12px]">{{ $sektorItem['nama'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Kartu Riwayat --}}
                    <div class="riwayat-item" data-bulan="{{ $bulan }}" data-tema="{{ strtolower($riwayat['tema']) }}" data-pembicara="{{ strtolower($riwayat['pembicara']) }}">
                        <div x-data="{ open: false }" class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:border-blue-200 hover:shadow-md transition-all duration-200">
                            <button @click="open = !open" class="w-full flex items-center gap-4 p-4 sm:p-5 text-left group">
                                {{-- Tanggal --}}
                                <div class="shrink-0 w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex flex-col items-center justify-center text-white">
                                    <span class="text-[10px] font-bold uppercase tracking-wider opacity-80">{{ $namaHari }}</span>
                                    <span class="text-xl font-extrabold leading-none">{{ $tanggalObj->format('d') }}</span>
                                    <span class="text-[10px] font-medium opacity-80">{{ $namaBulan }}</span>
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-slate-800 font-bold text-[14px] sm:text-[15px] leading-tight truncate">{{ $riwayat['tema'] }}</h4>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1.5">
                                        <span class="flex items-center gap-1 text-slate-500 text-[12px]">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                            {{ $riwayat['ayat_tema'] }}
                                        </span>
                                        <span class="flex items-center gap-1 text-slate-500 text-[12px]">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                            </svg>
                                            {{ $riwayat['pembicara'] }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Chevron --}}
                                <div class="shrink-0 w-8 h-8 rounded-full bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </div>
                            </button>

                            {{-- Detail --}}
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-1"
                                 class="border-t border-slate-100 bg-slate-50">
                                <div class="p-5 sm:p-6">
                                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Tema</p>
                                                <p class="text-slate-800 text-[13px] font-semibold mt-0.5">{{ $riwayat['tema'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Ayat Tema</p>
                                                <p class="text-slate-800 text-[13px] font-semibold mt-0.5">{{ $riwayat['ayat_tema'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-purple-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Pembicara</p>
                                                <p class="text-slate-800 text-[13px] font-semibold mt-0.5">{{ $riwayat['pembicara'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-yellow-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Lokasi</p>
                                                <p class="text-slate-800 text-[13px] font-semibold mt-0.5">{{ $riwayat['lokasi'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-orange-100 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Waktu</p>
                                                <p class="text-slate-800 text-[13px] font-semibold mt-0.5">{{ $sektorItem['waktu'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pesan Kosong --}}
            <div id="pesanKosong" class="hidden text-center py-16">
                <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                </div>
                <h3 class="text-slate-800 text-lg font-bold mb-1">Tidak Ada Data</h3>
                <p class="text-slate-500 text-[14px]">Tidak ditemukan riwayat ibadah yang sesuai dengan pencarian Anda.</p>
            </div>

            {{-- Info --}}
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100/50 rounded-2xl border border-blue-200 p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 text-[14.5px] mb-1">Tentang Riwayat Ibadah</h4>
                    <p class="text-blue-700/80 text-[13px] leading-relaxed">Halaman ini menampilkan riwayat ibadah {{ $sektorItem['nama'] }} selama 1 tahun terakhir. Gunakan filter bulan atau kolom pencarian untuk menemukan ibadah tertentu. Klik kartu untuk melihat informasi lengkap.</p>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function filterRiwayat() {
            const bulan = document.getElementById('filterBulan').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.riwayat-item');
            const bulanHeaders = document.querySelectorAll('.riwayat-bulan');
            let visibleCount = 0;

            items.forEach(item => {
                const itemBulan = item.getAttribute('data-bulan');
                const tema = item.getAttribute('data-tema');
                const pembicara = item.getAttribute('data-pembicara');

                const matchBulan = bulan === 'all' || itemBulan === bulan;
                const matchSearch = !search || tema.includes(search) || pembicara.includes(search);

                if (matchBulan && matchSearch) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            bulanHeaders.forEach(header => {
                const headerBulan = header.getAttribute('data-bulan');
                if (bulan === 'all') {
                    header.style.display = 'block';
                } else {
                    header.style.display = headerBulan === bulan ? 'block' : 'none';
                }
            });

            const hasilInfo = document.getElementById('hasilInfo');
            const pesanKosong = document.getElementById('pesanKosong');
            const jumlahHasil = document.getElementById('jumlahHasil');

            if (search || bulan !== 'all') {
                hasilInfo.style.display = 'block';
                jumlahHasil.textContent = visibleCount;
                pesanKosong.classList.toggle('hidden', visibleCount > 0);
                document.getElementById('riwayatList').style.display = visibleCount > 0 ? 'block' : 'none';
            } else {
                hasilInfo.style.display = 'none';
                pesanKosong.classList.add('hidden');
                document.getElementById('riwayatList').style.display = 'block';
            }
        }
    </script>
    @endpush

@endsection

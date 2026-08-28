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
                <span class="text-white">Jadwal Ibadah Umum</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                IBADAH <span class="text-yellow-500">UMUM</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Temukan jadwal ibadah sesuai kategori pelayanan di GBKP Bandar Lampung
            </p>
        </div>
    </section>

    {{-- FILTER & PETUGAS --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

            {{-- Filter --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-10">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                    <h2 class="font-display text-slate-800 text-base font-bold uppercase tracking-wide">CARI JADWAL IBADAH UMUM</h2>
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

            {{-- Petugas Kebaktian Minggu --}}
            <div class="text-center mb-8">
                <h3 class="text-blue-700 text-[13px] font-bold uppercase tracking-wider mb-1">Petugas Kebaktian Minggu</h3>
                <p class="font-display text-slate-800 text-2xl sm:text-3xl font-extrabold">Minggu, 13 Desember 2026</p>
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
                                <p class="text-slate-800 font-bold text-sm">08.00 WIB</p>
                            </div>
                        </div>
                        <p class="text-slate-500 text-[12.5px] flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                            Gedung Gereja GBKP Bandar Lampung
                        </p>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Pengkhotbah</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pdt. Andreas Pranata Meliala, M.Th</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Liturgis</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Dedy K. Sinulingga</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Koordinator</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Diana Nona Br. Sembiring</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Pengantar Doa</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Gunawan Barus</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kata Pengantar / Warta Jemaat</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Mariatim Br. Kaban</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Persembahan</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Gelora Sinuhaji</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kolektan / Counter 1</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Hiskia Juana Ginting</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kolektan / Counter 2</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Misnawati Br. Sebayang</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Penerima Jemaat 1</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Patuan Situmorang</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Penerima Jemaat 2</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Dwija Ginting</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Organis</span>
                            <span class="text-slate-800 text-[13px] font-medium">Anselmus Libreynra Sinulingga</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0"></span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Margaretba Sagala</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Song Leader</span>
                            <span class="text-slate-800 text-[13px] font-medium">Liwarni Simamora</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0"></span>
                            <span class="text-slate-800 text-[13px] font-medium">Mispia Br. Surbakti</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Worship Leader</span>
                            <span class="text-slate-800 text-[13px] font-medium">-</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Multimedia</span>
                            <span class="text-slate-800 text-[13px] font-medium">Claresta Br. Ginting</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Persembahan Pujian</span>
                            <span class="text-slate-800 text-[13px] font-medium">Getsemani</span>
                        </div>
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
                                <p class="text-slate-800 font-bold text-sm">17.00 WIB</p>
                            </div>
                        </div>
                        <p class="text-slate-500 text-[12.5px] flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                            Gedung Gereja GBKP Bandar Lampung
                        </p>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Pengkhotbah</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pdt. Edy Surbakti, S.Th</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Liturgis</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Normal Ginting</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Koordinator</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Fransta Kacaribu</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Pengantar Doa</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Riza Surbakti</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kata Pengantar / Warta Jemaat</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Herlan Tarigan</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Persembahan</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Antony Tarigan</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kolektan / Counter 1</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Riston Surbakti</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Kolektan / Counter 2</span>
                            <span class="text-slate-800 text-[13px] font-medium">Dk. Andelta Sinuraya</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Penerima Jemaat 1</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Masdi Sitepu</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Penerima Jemaat 2</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Em. Gideon Perangin-angin</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Organis</span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Bartolomeus Sinuhaji</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0"></span>
                            <span class="text-slate-800 text-[13px] font-medium">Pt. Yetty Br. Tobing</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Song Leader</span>
                            <span class="text-slate-800 text-[13px] font-medium">Angelica Br. Surbakti</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0"></span>
                            <span class="text-slate-800 text-[13px] font-medium">Viko Alexandro Sebayang</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Worship Leader</span>
                            <span class="text-slate-800 text-[13px] font-medium">Nora Nd. Bara Sembiring</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Multimedia</span>
                            <span class="text-slate-800 text-[13px] font-medium">Vina Br. Perangin-angin</span>
                        </div>
                        <div class="flex items-center px-5 py-2.5">
                            <span class="text-slate-600 text-[12.5px] w-[180px] shrink-0">Persembahan Pujian</span>
                            <span class="text-slate-800 text-[13px] font-medium">-</span>
                        </div>
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
                    <h4 class="font-bold text-slate-800 text-[14.5px] mb-1">Minggu Advent III</h4>
                    <p class="text-slate-600 text-[13px]">Merupakan minggu natal........</p>
                    <p class="text-slate-500 text-[12px] mt-1 italic">( 2 Timotius 2 : 1 )</p>
                </div>
            </div>

        </div>
    </section>

@endsection

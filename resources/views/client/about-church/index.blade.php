@extends('layouts.client.app')

@section('content')

    {{-- Breadcrumb --}}
    <section class="bg-gradient-to-r from-slate-800 to-slate-700 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-[13px] text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium">Tentang Gereja</span>
            </div>
        </div>
    </section>

    {{-- Hero --}}
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="max-w-2xl">
                <span class="inline-block text-blue-200 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Tentang Kami</span>
                <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5">
                    Gereja Batak Karo Protestan<br>Bandar Lampung
                </h1>
                <p class="text-blue-100/80 text-[15px] leading-relaxed max-w-xl">
                    Mengenal lebih dekat sejarah, visi, misi, dan pelayanan GBKP Bandar Lampung dalam melayani jemaat dan masyarakat.
                </p>
            </div>
        </div>
    </section>

    {{-- Sejarah --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Sejarah</span>
                    <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold mb-5">Awal Mula Berdirinya GBKP Bandar Lampung</h2>
                    <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                        Gereja Batak Karo Protestan (GBKP) Bandar Lampung merupakan salah satu jemaat di bawah naungan Resort GBKP Bandar Lampung. Gereja ini berdiri untuk melayani komunitas Batak Karo yang tinggal di wilayah Bandar Lampung dan sekitarnya.
                    </p>
                    <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                        Seiring dengan pertumbuhan jemaat, GBKP Bandar Lampung terus berkomitmen untuk menjadi berkat bagi seluruh anggota jemaat dan masyarakat sekitar melalui pelayanan firman Tuhan, persekutuan, dan pelayanan kasih.
                    </p>
                    <p class="text-slate-600 text-[15px] leading-relaxed">
                        Dengan dipimpin oleh para gembala yang setia, jemaat GBKP Bandar Lampung terus bertumbuh dalam iman dan menjadi terang di kota Bandar Lampung.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl h-72 sm:h-80 flex items-center justify-center">
                    <span class="text-slate-400 text-[13px] font-medium">Foto Gereja</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Visi & Misi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Panduan Hidup Jemaat</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-slate-800 text-lg font-bold mb-3">Visi</h3>
                    <p class="text-slate-600 text-[14.5px] leading-relaxed">
                        Menjadi jemaat yang bertumbuh dalam iman, mengasihi Allah dan sesama, serta menjadi terang Kristus di tengah masyarakat Bandar Lampung.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-slate-800 text-lg font-bold mb-3">Misi</h3>
                    <ul class="space-y-2.5">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-2 shrink-0"></span>
                            <span class="text-slate-600 text-[14.5px] leading-relaxed">Menyampaikan firman Tuhan dengan setia kepada seluruh jemaat.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-2 shrink-0"></span>
                            <span class="text-slate-600 text-[14.5px] leading-relaxed">Membina persekutuan yang erat antar anggota jemaat.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-2 shrink-0"></span>
                            <span class="text-slate-600 text-[14.5px] leading-relaxed">Melayani masyarakat melalui kegiatan sosial dan kemanusiaan.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-2 shrink-0"></span>
                            <span class="text-slate-600 text-[14.5px] leading-relaxed">Mengembangkan pelayanan kategorial untuk setiap kelompok usia.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Pelayanan --}}
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Pelayanan</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Kategori Pelayanan di GBKP</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Ibadah Minggu</h3>
                    <p class="text-white/50 text-[13px] leading-relaxed">Ibadah utama jemaat setiap minggu pagi dan sore.</p>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Persekutuan</h3>
                    <p class="text-white/50 text-[13px] leading-relaxed">Persekutuan antar jemaat dalam berbagai kegiatan.</p>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Pelayanan Kasih</h3>
                    <p class="text-white/50 text-[13px] leading-relaxed">Kegiatan sosial dan kemanusiaan untuk masyarakat.</p>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Pendidikan</h3>
                    <p class="text-slate-400 text-[13px] leading-relaxed">Sekolah minggu dan pembinaan iman generasi muda.</p>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Doa & Pujian</h3>
                    <p class="text-white/50 text-[13px] leading-relaxed">Persekutuan doa dan pujian bersama jemaat.</p>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 hover:from-slate-600 hover:to-slate-700 transition-all">
                    <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-bold text-[15px] mb-1.5">Misi & Evangelisasi</h3>
                    <p class="text-white/50 text-[13px] leading-relaxed">Pewartakan injil dan penginjilan di berbagai daerah.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi --}}
    <section class="py-14 sm:py-20 bg-gradient-to-br from-slate-100 to-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Lokasi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Kantor & Gedung Gereja</h2>
            </div>
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

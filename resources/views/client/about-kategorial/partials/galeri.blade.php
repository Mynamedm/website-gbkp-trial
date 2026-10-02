{{-- Galeri --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Galeri</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Dokumentasi Kegiatan</h2>
            </div>

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

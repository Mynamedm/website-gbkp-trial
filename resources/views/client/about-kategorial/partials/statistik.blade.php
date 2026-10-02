{{-- Statistik --}}
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
                            <span class="text-slate-500 text-[13px] mb-0.5">{{ $item['satuan'] ?? 'anggota' }}</span>
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

{{-- Pengurus --}}
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Struktur Organisasi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Pengurus Kategorial</h2>
            </div>

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

@extends('layouts.client.app')

@section('content')

    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-blue-900 overflow-hidden">
        @if($reflection->image_url)
            <div class="absolute inset-0">
                <img src="{{ $reflection->image_url }}" alt="" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
            </div>
        @endif
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 text-center">
            <span class="inline-block bg-white/10 text-blue-100 text-[11.5px] font-semibold uppercase tracking-[0.18em] px-3 py-1.5 rounded-full mb-5">
                Renungan Harian
            </span>
            <h1 class="font-display text-white text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight mb-4">
                {{ $reflection->title }}
            </h1>
            <div class="w-16 h-1 bg-blue-400 rounded-full mx-auto mb-4"></div>
            <p class="text-blue-100/80 text-[14px] font-medium">
                {{ $reflection->date->translatedFormat('l, d F Y') }}
            </p>
            @if(filled($reflection->church_day))
                <p class="text-blue-200/70 text-[12.5px] mt-1">{{ $reflection->church_day }}</p>
            @endif
        </div>
    </section>

    {{-- ISI RENUNGAN --}}
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-9">
                @if(filled($reflection->theme) || filled($reflection->bible_verse))
                    <div class="grid sm:grid-cols-2 gap-4 pb-6 mb-6 border-b border-slate-100">
                        @if(filled($reflection->theme))
                            <div>
                                <p class="text-blue-600 text-[11px] font-semibold uppercase tracking-wide mb-1">Tema</p>
                                <p class="text-slate-700 text-[14px] font-medium">{{ $reflection->theme }}</p>
                            </div>
                        @endif
                        @if(filled($reflection->bible_verse))
                            <div>
                                <p class="text-blue-600 text-[11px] font-semibold uppercase tracking-wide mb-1">Bacaan</p>
                                <p class="text-slate-700 text-[14px] font-semibold flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-yellow-400 shrink-0"></span>
                                    {{ $reflection->bible_verse }}
                                    @if(filled($reflection->bible_translation))
                                        <span class="text-slate-400 text-[12px] font-normal">{{ $reflection->bible_translation }}</span>
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                @if(filled($reflection->body))
                    <div class="space-y-5 text-slate-700 text-[15px] leading-[1.8]">
                        {!! nl2br(e($reflection->body)) !!}
                    </div>
                @else
                    <p class="text-slate-400 text-sm">Isi renungan belum tersedia.</p>
                @endif

                <div class="mt-8 pt-5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-slate-400 text-[12.5px] italic">Renungan Harian GBKP Bandar Lampung</p>
                    <a href="{{ route('client.reflections') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-700 text-white text-[12.5px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                        </svg>
                        Semua Renungan
                    </a>
                </div>
            </article>
        </div>
    </section>

    @if($otherReflections->isNotEmpty())
        {{-- RENUNGAN LAINNYA --}}
        <section class="pb-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-slate-800 text-lg font-bold mb-6 uppercase tracking-wide">Renungan Lainnya</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($otherReflections as $item)
                        <a href="{{ route('client.reflections.detail', $item) }}"
                           class="group flex flex-col bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md hover:border-blue-200 transition-all">
                            <span class="text-blue-600 text-[11.5px] font-semibold uppercase tracking-wide mb-2">
                                {{ $item->date->format('d M Y') }}
                            </span>
                            <h3 class="text-slate-800 text-[14px] font-bold leading-snug mb-1.5 group-hover:text-blue-700 transition-colors">
                                {{ $item->title }}
                            </h3>
                            @if(filled($item->bible_verse))
                                <p class="text-slate-500 text-[12.5px] mt-auto">{{ $item->bible_verse }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
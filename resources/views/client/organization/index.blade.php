@extends('layouts.client.app')

@section('content')

    @push('styles')
        <style>
            .org-tree {
                --node-w: min(280px, 90vw);
                --org-gap: 1rem;
                --org-level-gap: 2rem;
            }
            .org-tree ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                justify-content: safe center;
                gap: var(--org-gap);
                max-width: calc(6 * var(--node-w) + 5 * var(--org-gap));
                margin-left: auto;
                margin-right: auto;
            }
            .org-tree li {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .org-tree li > ul { margin-top: var(--org-level-gap); }
            .org-tree .org-card {
                width: var(--node-w);
                flex-shrink: 0;
            }
            .org-tree .org-card img,
            .org-tree .org-photo {
                width: 64px;
                height: 64px;
            }
            @media (max-width: 640px) {
                .org-tree { --node-w: 92vw; --org-gap: .75rem; --org-level-gap: 1.5rem; }
                .org-tree .org-card { padding: 1rem; }
                .org-tree .org-card img,
                .org-tree .org-photo { width: 56px; height: 56px; }
            }
        </style>
    @endpush

    {{-- Hero --}}
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        @if($settings->hero_image_url)
            <div class="absolute inset-0">
                <img src="{{ $settings->hero_image_url }}" alt="" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            </div>
        @endif
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3 uppercase">
                {{ $settings->title }}
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            @if(filled($settings->description))
                <p class="text-slate-300 text-base leading-relaxed max-w-xl">{{ $settings->description }}</p>
            @endif
            @if(filled($settings->periode))
                <p class="text-slate-400 text-sm mt-3">
                    Periode {{ $settings->periode }}
                </p>
            @endif
        </div>
    </section>

    {{-- Bagan --}}
    <section class="py-10 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(filled($settings->subtitle) || $roots->isNotEmpty())
                <div class="text-center mb-10">
                    <span class="inline-block text-blue-600 text-xs font-semibold uppercase tracking-[0.18em] mb-2">Bagan</span>
                    <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">
                        {{ filled($settings->subtitle) ? $settings->subtitle : 'Susunan Organisasi' }}
                    </h2>
                </div>
            @endif

            @if($roots->isEmpty())
                <div class="py-16 text-center">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    <h3 class="font-display text-slate-700 text-lg font-bold">Data struktur organisasi belum tersedia</h3>
                    <p class="text-slate-400 text-sm mt-2 max-w-md mx-auto">
                        Admin belum menambahkan susunan pengurus. Silakan kembali lagi nanti.
                    </p>
                </div>
            @else
                <div class="org-tree overflow-x-auto pb-2">
                    @php
                        $pohon = function ($nodes, int $depth = 0) use (&$pohon) {
                            $html = '<ul>';

                            foreach ($nodes as $item) {
                                $kelas = $depth === 0 ? 'border-blue-200 bg-blue-50' : 'border-slate-200 bg-white';

                                $html .= '<li>';
                                $html .= '<div class="org-card block rounded-2xl border ' . $kelas . ' shadow-sm p-5 text-center">';

                                if ($item->photo_url) {
                                    $html .= '<img src="' . e($item->photo_url) . '" alt="' . e($item->position) . '" loading="lazy"'
                                        . ' class="rounded-full object-cover mx-auto mb-3 border-2 border-white shadow">';
                                } else {
                                    $html .= '<div class="org-photo rounded-full mx-auto mb-3 border-2 border-dashed border-slate-300 bg-slate-100 flex items-center justify-center">'
                                        . '<svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">'
                                        . '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>'
                                        . '</div>';
                                }

                                $html .= '<p class="font-display text-slate-800 text-base font-bold leading-snug">' . e($item->position) . '</p>';

                                if (filled($item->name)) {
                                    $html .= '<p class="text-slate-500 text-sm mt-1">' . e($item->name) . '</p>';
                                }

                                $html .= '</div>';

                                if ($item->children->isNotEmpty()) {
                                    $html .= $pohon($item->children, $depth + 1);
                                }

                                $html .= '</li>';
                            }

                            return $html . '</ul>';
                        };
                    @endphp

                    {!! $pohon($roots) !!}
                </div>
            @endif
        </div>
    </section>

@endsection

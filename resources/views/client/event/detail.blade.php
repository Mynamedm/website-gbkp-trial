@extends('layouts.client.app')

@section('content')

    {{-- HERO with BREADCRUMB --}}
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-[13px] mb-6">
                <a href="{{ route('client.events') }}" class="text-slate-300 hover:text-white transition-colors">Kegiatan Gereja</a>
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium truncate max-w-full sm:max-w-[300px]">{{ $event->title }}</span>
            </nav>

            {{-- Title --}}
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5 italic">
                {{ $event->title }}
            </h1>

            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-5 text-slate-300 text-[14px]">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    {{ $event->date->translatedFormat('d F Y') }}
                </div>
                @if($event->location)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                    </svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- DETAIL CONTENT --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @php
                $defaultColor = 'bg-slate-100 text-slate-700';
                $catColor = $categoryColors[$event->category] ?? $defaultColor;
                $catParts = explode(' ', $catColor);
                $catBg = $catParts[0] ?? 'bg-slate-100';
                $catText = $catParts[1] ?? 'text-slate-700';
            @endphp

            @if(session('keuangan_unlocked_message'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-[13.5px] font-medium">{{ session('keuangan_unlocked_message') }}</p>
                </div>
            @endif

            @if($locked)
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm">
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </div>
                            <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-extrabold">Berita Terkunci</h2>
                            <p class="text-slate-500 text-[14px] leading-relaxed mt-2 max-w-md mx-auto">
                                Berita kategori keuangan hanya dapat dibaca setelah memasukkan PIN.
                                Masukkan PIN yang telah dibagikan oleh admin gereja.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('client.events.unlock', $event->slug) }}" class="mt-7 max-w-sm mx-auto text-left">
                            @csrf
                            <label for="pin" class="block text-slate-700 text-[13px] font-semibold mb-1.5">PIN Berita</label>
                            <input
                                id="pin"
                                name="pin"
                                type="password"
                                inputmode="numeric"
                                autocomplete="off"
                                required
                                maxlength="32"
                                placeholder="Masukkan PIN"
                                aria-describedby="pin-help"
                                @error('pin') aria-invalid="true" @enderror
                                class="w-full rounded-xl border bg-white px-4 py-3 text-slate-800 text-[14px] tracking-[0.2em] placeholder:tracking-normal placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 @error('pin') border-red-400 @else border-slate-300 @enderror">
                            @error('pin')
                                <p class="mt-2 flex items-center gap-1.5 text-red-600 text-[12.5px] font-medium" role="alert">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @else
                                <p id="pin-help" class="mt-2 text-slate-400 text-[12px]">PIN terdiri dari angka dan bersifat rahasia.</p>
                            @enderror
                            <button type="submit"
                                    class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-3 text-white text-[14px] font-semibold hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                                Buka Berita
                            </button>
                        </form>

                        <div class="mt-7 pt-5 border-t border-slate-100 text-center">
                            <p class="text-slate-500 text-[12.5px]">Tidak tahu atau lupa PIN?</p>
                            @if($whatsappUrl)
                                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                                   class="mt-2 inline-flex items-center justify-center gap-2 text-emerald-700 text-[13px] font-semibold hover:underline">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    Lupa PIN? Hubungi Admin via WhatsApp
                                </a>
                            @else
                                <p class="mt-2 text-slate-400 text-[12.5px]">Hubungi admin gereja untuk meminta PIN.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    @if($hasPdf)
                        <div class="bg-gradient-to-br from-blue-700 via-blue-800 to-slate-900 rounded-2xl p-6 sm:p-8 shadow-sm text-white">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-blue-200 text-[11.5px] uppercase tracking-wider font-semibold">Laporan Keuangan</p>
                                    <h2 class="font-display text-white text-xl sm:text-2xl font-extrabold mt-1">Laporan Lengkap (PDF)</h2>
                                    <p class="text-blue-100 text-[13.5px] leading-relaxed mt-2 max-w-lg">
                                        Laporan keuangan lengkap tersedia dalam format PDF. Anda dapat membukanya di tab baru atau mengunduhnya untuk disimpan.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('client.events.pdf', $event->slug) }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-blue-800 text-[13.5px] font-semibold hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white/70 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                    </svg>
                                    Buka PDF
                                </a>
                                <a href="{{ route('client.events.pdf.download', $event->slug) }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/40 px-4 py-2.5 text-white text-[13.5px] font-semibold hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/70 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                    </svg>
                                    Unduh PDF
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Tentang Kegiatan --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <h2 class="font-display text-slate-800 text-xl font-extrabold mb-4">Tentang Kegiatan</h2>
                        <p class="text-slate-600 text-[14px] leading-relaxed mb-6">
                            {{ $event->description }}
                        </p>

                        {{-- Quote --}}
                        @if($event->quote)
                        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6 text-blue-300 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                <div>
                                    <p class="text-slate-700 text-[14px] leading-relaxed italic">{{ $event->quote }}</p>
                                    @if($event->quote_source)
                                    <p class="text-blue-700 text-[13px] font-bold mt-3">{{ $event->quote_source }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(! $hasPdf)
                    {{-- Detail Kegiatan --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <h2 class="font-display text-slate-800 text-xl font-extrabold mb-5">Detail Kegiatan</h2>
                        <div class="divide-y divide-slate-100">
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Jenis Kegiatan</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{{ ucfirst($event->category) }}</span>
                            </div>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Tanggal</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{{ $event->date->translatedFormat('d F Y') }}</span>
                            </div>
                            @if($event->time_start)
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Waktu</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{{ $event->time_start }}{{ $event->time_end ? ' - ' . $event->time_end : '' }}</span>
                            </div>
                            @endif
                            @if($event->location)
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Tempat</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{{ $event->location }}</span>
                            </div>
                            @endif
                            @if($event->organizedBy)
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Dilayani Oleh</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{{ $event->organizedBy }}</span>
                            </div>
                            @endif
                            @if($event->content)
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Keterangan</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium">{!! strip_tags($event->content) !!}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- Informasi Singkat --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="font-display text-slate-800 text-lg font-extrabold mb-5">Informasi Singkat</h3>
                        <div class="space-y-4">
                            {{-- Date --}}
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold">{{ $event->date->translatedFormat('d F Y') }}</p>
                                    <p class="text-slate-400 text-[12px]">{{ $event->date->translatedFormat('l') }}</p>
                                </div>
                            </div>

                            {{-- Time --}}
                            @if($event->time_start)
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold">{{ $event->time_start }}{{ $event->time_end ? ' - ' . $event->time_end : '' }}</p>
                                    <p class="text-slate-400 text-[12px]">Waktu</p>
                                </div>
                            </div>
                            @endif

                            {{-- Location --}}
                            @if($event->location)
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold">{{ $event->location }}</p>
                                    <p class="text-slate-400 text-[12px]">Lokasi</p>
                                </div>
                            </div>
                            @endif

                            {{-- Organizer --}}
                            @if($event->organizedBy)
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold">{{ $event->organizedBy }}</p>
                                    <p class="text-slate-400 text-[12px]">Pelayan Firman</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Kategori Kegiatan --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="font-display text-slate-800 text-lg font-extrabold mb-4">Kategori Kegiatan</h3>
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl {{ $catBg }} flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 {{ $catText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold">{{ ucfirst($event->category) }}</p>
                                    <p class="text-slate-400 text-[12px]">Kategori {{ ucfirst($event->category) }}</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Dokumentasi --}}
            <div class="mt-10 bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <h2 class="font-display text-slate-800 text-2xl font-extrabold text-center mb-8">Dokumentasi</h2>
                <div class="text-center py-10">
                    <svg class="w-16 h-16 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/>
                    </svg>
                    <p class="text-slate-400 text-[14px]">Belum ada dokumentasi untuk kegiatan ini.</p>
                </div>
            </div>
        </div>
    </section>

@endsection

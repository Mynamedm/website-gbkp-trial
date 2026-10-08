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
                <a href="{{ route('client.home') }}" class="hover:text-white transition-colors">Beranda</a>
                <span>&#9654;</span>
                <span class="text-white">Persembahan</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                PERSEMBAHAN <span class="text-yellow-500">ONLINE</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Pilih kategori persembahan dan scan barcode untuk melakukan transaksi. Terima kasih atas kemurahan hati Anda.
            </p>
        </div>
    </section>

    {{-- DAFTAR KATEGORI PERSEMBAHAN --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

            {{-- Info Cara Berpersembahan --}}
            <div class="mb-10 bg-blue-50 rounded-2xl border border-blue-100 p-6 max-w-2xl mx-auto">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-[14.5px] mb-1">Cara Berpersembahan</h4>
                        <ol class="text-slate-600 text-[13px] space-y-1 list-decimal list-inside">
                            <li>Pilih kategori persembahan yang diinginkan</li>
                            <li>Klik tombol "Tampilkan QR Code"</li>
                            <li>Scan barcode menggunakan aplikasi mobile banking Anda</li>
                            <li>Masukkan jumlah nominal persembahan</li>
                            <li>Konfirmasi transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if($categories->isEmpty())
                <div class="text-center py-16">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-600 font-semibold text-lg mb-1">Belum Ada Kategori Persembahan</h3>
                    <p class="text-slate-400 text-[13px]">Kategori persembahan akan ditampilkan setelah ditambahkan oleh admin.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categories as $category)
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow"
                             x-data="{ showQR: false }">
                            {{-- Header --}}
                            <div class="p-5 border-b border-slate-100">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-display text-slate-800 text-lg font-bold">{{ $category->name }}</h3>
                                        @if($category->description)
                                            <p class="text-slate-500 text-[12.5px] mt-0.5">{{ $category->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Info Rekening --}}
                            <div class="px-5 py-4 bg-slate-50 border-b border-slate-100">
                                @if($category->bank_name)
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                                        </svg>
                                        <span class="text-slate-600 text-[13px] font-medium">{{ $category->bank_name }}</span>
                                    </div>
                                @endif
                                @if($category->bank_account_number)
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                                        </svg>
                                        <span class="text-slate-800 text-[14px] font-bold font-mono tracking-wide">{{ $category->bank_account_number }}</span>
                                    </div>
                                @endif
                                @if($category->bank_account_name)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                        </svg>
                                        <span class="text-slate-600 text-[13px]">{{ $category->bank_account_name }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- QR Code Section --}}
                            <div class="p-5">
                                <div x-show="!showQR" class="text-center">
                                    <button @click="showQR = true"
                                            class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white text-[13.5px] font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.008v.008H6.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM18 15.75h.008v.008H18V15.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM9.375 18h.008v.008H9.375V18zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                        </svg>
                                        Tampilkan QR Code
                                    </button>
                                </div>

                                <div x-show="showQR" x-cloak class="text-center"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100">
                                    {{-- QR Code Image --}}
                                    <div class="inline-block p-3 bg-white rounded-2xl border-2 border-slate-100 shadow-sm mb-3">
                                        @if($category->qris_image)
                                            <img src="{{ $category->qris_image }}" alt="QRIS {{ $category->name }}" class="w-full max-w-[192px] h-auto object-contain">
                                        @else
                                            <img src="{{ $category->qr_code_url }}" alt="QR Code {{ $category->name }}" class="w-full max-w-[192px] h-auto">
                                        @endif
                                    </div>
                                    <p class="text-slate-500 text-[12px] mb-3">Scan barcode di atas untuk melakukan persembahan</p>
                                    <button @click="showQR = false"
                                            class="text-[12px] text-slate-400 hover:text-slate-600 transition-colors">
                                        Sembunyikan QR Code
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection

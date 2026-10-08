<header x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
            $currentUrl = request()->url();
            $navItems = [
                ['label' => 'Beranda', 'route' => route('client.home')],
                ['label' => 'Warta Jemaat', 'route' => route('client.announcements')],
                ['label' => 'Renungan', 'route' => route('client.reflections'), 'pattern' => 'renungan*'],
                ['label' => 'Jadwal Ibadah', 'route' => 'schedule-dropdown'],
                ['label' => 'Tentang', 'route' => 'about-dropdown'],
                ['label' => 'Kegiatan Gereja', 'route' => route('client.events')],
                ['label' => 'Persembahan', 'route' => route('client.persembahan')],
                ['label' => 'Struktur Organisasi', 'route' => route('client.organization'), 'pattern' => 'struktur-organisasi*'],
            ];
            $scheduleCategories = [
                ['label' => 'Ibadah Umum', 'route' => route('client.schedule-worship.umum'), 'pattern' => 'jadwal-ibadah/umum'],
                ['label' => 'Moria', 'route' => route('client.schedule-worship.detail', 2), 'pattern' => 'jadwal-ibadah/2'],
                ['label' => 'Mamre', 'route' => route('client.schedule-worship.detail', 3), 'pattern' => 'jadwal-ibadah/3'],
                ['label' => 'Perpulungen Jabu-Jabu', 'route' => route('client.schedule-worship.detail', 4), 'pattern' => 'jadwal-ibadah/4'],
                ['label' => 'Permata', 'route' => route('client.schedule-worship.detail', 5), 'pattern' => 'jadwal-ibadah/5'],
                ['label' => 'KA-KR', 'route' => route('client.schedule-worship.detail', 6), 'pattern' => 'jadwal-ibadah/6'],
                ['label' => 'Saitun', 'route' => route('client.schedule-worship.detail', 7), 'pattern' => 'jadwal-ibadah/7'],
                ['label' => 'Naomi', 'route' => route('client.schedule-worship.detail', 8), 'pattern' => 'jadwal-ibadah/8'],
            ];
            $aboutCategories = [
                ['label' => 'Tentang Gereja', 'route' => route('client.about-church'), 'pattern' => 'tentang-gereja'],
                ['label' => 'Tentang Kategorial', 'route' => route('client.about-kategorial'), 'pattern' => 'tentang-kategorial'],
            ];
            $isScheduleActive = request()->is('jadwal-ibadah*');
            $isAboutActive = request()->is('tentang-gereja*') || request()->is('tentang-kategorial*');
        @endphp
{{-- MOBILE TOP BAR (lg:hidden) --}}
        <div class="lg:hidden flex items-center justify-between h-14 relative px-2">

            {{-- Hamburger (Left) --}}
            <button @click="open = !open"
                    class="flex items-center justify-center w-10 h-10 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors"
                    aria-label="Buka menu" aria-expanded="false" :aria-expanded="open.toString()">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Logo Centered (Mobile) --}}
            <a href="{{ route('client.home') }}" class="absolute left-1/2 -translate-x-1/2 flex items-center gap-2 shrink-0" aria-label="GBKP Bandar Lampung - Beranda">
                <div class="w-8 h-8 rounded-full bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>
                <span class="text-[14px] font-bold text-slate-800 tracking-tight">GBKP</span>
            </a>

            {{-- Login Button (Right) --}}
            <a href="{{ route('login') }}"
               class="flex items-center px-3 py-1.5 bg-blue-700 text-white text-[12px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm"
               aria-label="Login">
                Login
            </a>
        </div>

        {{-- DESKTOP ROW --}}
        <div class="hidden lg:flex items-center justify-between h-[68px]">

            {{-- Logo --}}
            <a href="{{ route('client.home') }}" class="flex items-center gap-3 shrink-0">
                <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <span class="text-[15px] font-bold text-slate-800 tracking-tight">GBKP</span>
                    <span class="block text-[11px] text-slate-500 -mt-0.5">Bandar Lampung</span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-1">

                @foreach($navItems as $item)
                    @if($item['route'] === 'about-dropdown')
                        {{-- Tentang Dropdown --}}
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('client.about-church') }}"
                               class="px-3 py-2 text-[13.5px] font-medium rounded-md transition-colors inline-flex items-center gap-1
                                     {{ $isAboutActive ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                Tentang
                                <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </a>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-1"
                                 class="absolute left-0 top-full pt-1 z-50">
                                <div class="bg-white rounded-xl shadow-lg border border-slate-100 py-2 w-56">
                                    @foreach($aboutCategories as $cat)
                                        <a href="{{ $cat['route'] }}"
                                           class="block px-4 py-2 text-[13px] font-medium transition-colors
                                                 {{ request()->is($cat['pattern']) ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                            {{ $cat['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @elseif($item['route'] === 'schedule-dropdown')
                        {{-- Jadwal Ibadah Dropdown --}}
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('client.schedule-worship.umum') }}"
                               class="px-3 py-2 text-[13.5px] font-medium rounded-md transition-colors inline-flex items-center gap-1
                                     {{ $isScheduleActive ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                Jadwal Ibadah
                                <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </a>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-1"
                                 class="absolute left-0 top-full pt-1 z-50">
                                <div class="bg-white rounded-xl shadow-lg border border-slate-100 py-2 w-56">
                                    @foreach($scheduleCategories as $cat)
                                        <a href="{{ $cat['route'] }}"
                                           class="block px-4 py-2 text-[13px] font-medium transition-colors
                                                 {{ request()->is($cat['pattern']) ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                            {{ $cat['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        @php $isActive = $item['route'] !== '#' && ($currentUrl === $item['route'] || (isset($item['pattern']) && request()->is($item['pattern']))); @endphp
                        <a href="{{ $item['route'] }}"
                           class="px-3 py-2 text-[13.5px] font-medium rounded-md transition-colors
                                 {{ $isActive ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">
                {{-- User Icon --}}
                <a href="{{ route('login') }}" class="hidden sm:flex items-center justify-center w-9 h-9 rounded-full text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </a>

                {{-- Login Button --}}
                <a href="{{ route('login') }}"
                   class="inline-flex items-center px-5 py-2 bg-blue-700 text-white text-[13.5px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                    Login
                </a>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU: Full Screen Overlay --}}
    <div x-show="open" x-cloak
         @keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="lg:hidden fixed inset-0 z-50 bg-white" role="dialog" aria-modal="true" aria-label="Navigasi mobile">

        {{-- Close Button (Top Right) --}}
        <button @click="open = false"
                class="absolute top-4 right-4 z-50 w-10 h-10 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors flex items-center justify-center"
                aria-label="Tutup menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Menu Content - Full Screen Left Aligned --}}
        <div class="h-full flex flex-col justify-start px-6 py-10 space-y-6 overflow-hidden">
            {{-- Main Nav Items --}}
            <nav class="flex flex-col space-y-2 w-full">
                @foreach($navItems as $item)
                    @if($item['route'] !== 'schedule-dropdown' && $item['route'] !== 'about-dropdown')
                        @php $isActive = $item['route'] !== '#' && ($currentUrl === $item['route'] || (isset($item['pattern']) && request()->is($item['pattern']))); @endphp
                        <a href="{{ $item['route'] }}" @click="open = false"
                           class="w-full text-left px-4 py-4 text-[18px] font-medium rounded-lg transition-colors
                                 {{ $isActive ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50' }}">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach

                {{-- Jadwal Ibadah Accordion --}}
                <div x-data="{ open: false }" class="w-full">
                    <button @click="open = !open" type="button"
                            class="w-full text-left px-4 py-4 text-[18px] font-medium rounded-lg transition-colors
                                  {{ $isScheduleActive ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50' }}"
                            aria-expanded="false" :aria-expanded="open.toString()">
                        <span class="flex items-center justify-between">
                            Jadwal Ibadah
                            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-slate-500 transition-transform duration-200 shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                         class="mt-2 space-y-1 pl-4 border-l-2 border-slate-200">
                        @foreach($scheduleCategories as $cat)
                            <a href="{{ $cat['route'] }}" @click="open = false"
                               class="block px-4 py-3 text-[16px] font-medium rounded-lg transition-colors
                                     {{ request()->is($cat['pattern']) ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $cat['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Tentang Accordion --}}
                <div x-data="{ open: false }" class="w-full">
                    <button @click="open = !open" type="button"
                            class="w-full text-left px-4 py-4 text-[18px] font-medium rounded-lg transition-colors
                                  {{ $isAboutActive ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50' }}"
                            aria-expanded="false" :aria-expanded="open.toString()">
                        <span class="flex items-center justify-between">
                            Tentang
                            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-slate-500 transition-transform duration-200 shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                         class="mt-2 space-y-1 pl-4 border-l-2 border-slate-200">
                        @foreach($aboutCategories as $cat)
                            <a href="{{ $cat['route'] }}" @click="open = false"
                               class="block px-4 py-3 text-[16px] font-medium rounded-lg transition-colors
                                     {{ request()->is($cat['pattern']) ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $cat['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Copyright --}}
                <div class="mt-8 pt-6 border-t border-slate-200 w-full text-center">
                    <p class="text-[13px] text-slate-500">
                        &copy; {{ date('Y') }} GBKP Bandar Lampung
                    </p>
                </div>
            </nav>
        </div>
    </div>
</header>
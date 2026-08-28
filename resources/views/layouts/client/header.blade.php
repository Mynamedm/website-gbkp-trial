<header x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[68px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
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
                @php
                    $currentUrl = request()->url();
                    $navItems = [
                        ['label' => 'Beranda', 'route' => route('home')],
                        ['label' => 'Warta Jemaat', 'route' => route('client.announcements')],
                        ['label' => 'Jadwal Ibadah', 'route' => 'schedule-dropdown'],
                        ['label' => 'Tentang Gereja', 'route' => '#'],
                        ['label' => 'Kegiatan Gereja', 'route' => '#'],
                        ['label' => 'Struktur Organisasi', 'route' => '#'],
                    ];
                    $scheduleCategories = [
                        ['label' => 'Ibadah Umum', 'route' => route('client.schedule-worship.detail', 1), 'pattern' => 'jadwal-ibadah/1'],
                        ['label' => 'Moria', 'route' => route('client.schedule-worship.detail', 2), 'pattern' => 'jadwal-ibadah/2'],
                        ['label' => 'Mamre', 'route' => route('client.schedule-worship.detail', 3), 'pattern' => 'jadwal-ibadah/3'],
                        ['label' => 'Perpulungen Jabu-Jabu', 'route' => route('client.schedule-worship.detail', 4), 'pattern' => 'jadwal-ibadah/4'],
                        ['label' => 'Permata', 'route' => route('client.schedule-worship.detail', 5), 'pattern' => 'jadwal-ibadah/5'],
                        ['label' => 'KA-KR', 'route' => route('client.schedule-worship.detail', 6), 'pattern' => 'jadwal-ibadah/6'],
                        ['label' => 'Saitun', 'route' => route('client.schedule-worship.detail', 7), 'pattern' => 'jadwal-ibadah/7'],
                        ['label' => 'Naomi', 'route' => route('client.schedule-worship.detail', 8), 'pattern' => 'jadwal-ibadah/8'],
                    ];
                    $isScheduleActive = request()->is('jadwal-ibadah*');
                @endphp

                @foreach($navItems as $item)
                    @if($item['route'] === 'schedule-dropdown')
                        {{-- Jadwal Ibadah Dropdown --}}
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('client.schedule-worship') }}"
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
                        <a href="{{ $item['route'] }}"
                           class="px-3 py-2 text-[13.5px] font-medium rounded-md transition-colors
                                  {{ $item['route'] !== '#' && $currentUrl === $item['route'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
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

                {{-- Mobile Menu Toggle --}}
                <button @click="open = !open" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-md text-slate-500 hover:bg-slate-100">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden border-t border-slate-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            @foreach($navItems as $item)
                @if($item['route'] !== 'schedule-dropdown')
                    <a href="{{ $item['route'] }}"
                       class="block px-3 py-2.5 text-[14px] font-medium rounded-lg
                              {{ $item['route'] !== '#' && $currentUrl === $item['route'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:bg-slate-50' }}">
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach

            {{-- Jadwal Ibadah --}}
            <a href="{{ route('client.schedule-worship') }}"
               class="block px-3 py-2.5 text-[14px] font-medium rounded-lg
                      {{ $isScheduleActive ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:bg-slate-50' }}">
                Jadwal Ibadah
            </a>
            <div class="pl-4 space-y-0.5">
                @foreach($scheduleCategories as $cat)
                    <a href="{{ $cat['route'] }}"
                       class="block px-3 py-2 text-[13px] font-medium rounded-lg
                              {{ request()->is($cat['pattern']) ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:bg-slate-50' }}">
                        {{ $cat['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>

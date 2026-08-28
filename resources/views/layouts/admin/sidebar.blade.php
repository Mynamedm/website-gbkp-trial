<aside x-data="{ open: false }" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-slate-800 text-slate-300 flex flex-col transform transition-transform duration-200 lg:translate-x-0"
       :class="open ? 'translate-x-0' : '-translate-x-full'">

    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-5 border-b border-slate-700/50 shrink-0">
        <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
            </svg>
        </div>
        <div>
            <span class="text-white text-sm font-bold">GBKP</span>
            <span class="block text-[10px] text-slate-400 -mt-0.5">
                @if(auth()->user()->hasRole('super_admin'))
                    Super Admin Panel
                @else
                    Admin Panel
                @endif
            </span>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        @php
            $current = request()->route()?->getName();

            $navItems = [
                ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>'],
                ['label' => 'Events', 'route' => 'admin.events.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>'],
                ['label' => 'Warta Jemaat', 'route' => 'admin.announcements.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>'],
                ['label' => 'Kategori', 'route' => 'admin.categories.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>'],
            ];

            $jadwalActive = in_array($current, ['admin.schedules.index', 'admin.schedules.umum', 'admin.schedules.kategorial']);

            if(auth()->user()->hasRole('super_admin')) {
                $navItems[] = ['label' => 'Users', 'route' => 'admin.users.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'];
            }

            $navItems[] = ['label' => 'Kembali ke Site', 'route' => 'home', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>'];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px] font-medium transition-colors
                      {{ $current === $item['route'] ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                {{ $item['label'] }}
            </a>

            @if($item['route'] === 'admin.events.index')
                {{-- Jadwal Ibadah with submenu --}}
                <div x-data="{ open: {{ $jadwalActive ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-[13.5px] font-medium transition-colors
                                   {{ $jadwalActive ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Jadwal Ibadah
                        </span>
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1">
                        <div class="ml-5 pl-4 border-l border-slate-600 space-y-0.5 mt-0.5 mb-1">
                            <a href="{{ route('admin.schedules.umum') }}"
                               class="flex items-center gap-3 px-3 py-2 rounded-lg text-[13px] font-medium transition-colors
                                      {{ $current === 'admin.schedules.umum' ? 'bg-blue-600/20 text-blue-400' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $current === 'admin.schedules.umum' ? 'bg-blue-400' : 'bg-slate-500' }}"></span>
                                Ibadah Umum
                            </a>
                            <a href="{{ route('admin.schedules.kategorial') }}"
                               class="flex items-center gap-3 px-3 py-2 rounded-lg text-[13px] font-medium transition-colors
                                      {{ $current === 'admin.schedules.kategorial' ? 'bg-blue-600/20 text-blue-400' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $current === 'admin.schedules.kategorial' ? 'bg-blue-400' : 'bg-slate-500' }}"></span>
                                Ibadah Kategorial
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </nav>
</aside>

{{-- Mobile overlay --}}
<div x-data="{ open: false }" x-show="open" x-cloak @sidebar-toggle.window="open = $event.detail" class="fixed inset-0 z-40 bg-black/50 lg:hidden" @click="open = false; $dispatch('sidebar-close')"></div>

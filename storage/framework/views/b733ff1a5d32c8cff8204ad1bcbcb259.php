<header x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php
            $currentUrl = request()->url();

            $dropdownMenus = [
                'about-dropdown' => [
                    'label' => 'Tentang',
                    'route' => route('client.about-church'),
                    'active' => request()->is('tentang-gereja*') || request()->is('tentang-kategorial*') || request()->is('struktur-organisasi*'),
                    'items' => [
                        ['label' => 'Tentang Gereja', 'route' => route('client.about-church'), 'active' => request()->is('tentang-gereja*')],
                        ['label' => 'Tentang Kategorial', 'route' => route('client.about-kategorial'), 'active' => request()->is('tentang-kategorial*')],
                        ['label' => 'Struktur Organisasi', 'route' => route('client.organization'), 'active' => request()->is('struktur-organisasi*')],
                    ],
                ],
                'schedule-dropdown' => [
                    'label' => 'Jadwal Ibadah',
                    'route' => route('client.schedule-worship.umum'),
                    'active' => request()->is('jadwal-ibadah*'),
                    'items' => [
                        ['label' => 'Ibadah Umum', 'route' => route('client.schedule-worship.umum'), 'active' => request()->is('jadwal-ibadah/umum*')],
                        ['label' => 'Ibadah Kategorial', 'route' => route('client.schedule-worship'), 'active' => request()->is('jadwal-ibadah*') && ! request()->is('jadwal-ibadah/umum*')],
                    ],
                ],
                'bahan-rohani-dropdown' => [
                    'label' => 'Bahan Rohani',
                    'route' => route('client.reflections'),
                    'active' => request()->is('renungan*') || request()->is('bahan-ibadah*'),
                    'items' => [
                        ['label' => 'Renungan Harian', 'route' => route('client.reflections'), 'active' => request()->is('renungan*')],
                        ['label' => 'Bahan Ibadah', 'route' => route('client.bahan-ibadah'), 'active' => request()->is('bahan-ibadah*')],
                    ],
                ],
                'informasi-dropdown' => [
                    'label' => 'Informasi',
                    'route' => route('client.announcements'),
                    'active' => request()->is('warta-jemaat*') || request()->is('kegiatan-gereja*') || request()->is('persembahan*'),
                    'items' => [
                        ['label' => 'Warta Jemaat', 'route' => route('client.announcements'), 'active' => request()->is('warta-jemaat*')],
                        ['label' => 'Kegiatan Gereja', 'route' => route('client.events'), 'active' => request()->is('kegiatan-gereja*')],
                        ['label' => 'Persembahan', 'route' => route('client.persembahan'), 'active' => request()->is('persembahan*')],
                    ],
                ],
            ];

            $navItems = [
                ['label' => 'Beranda', 'route' => route('client.home'), 'active' => $currentUrl === route('client.home')],
                ['label' => 'Tentang', 'route' => 'about-dropdown'],
                ['label' => 'Jadwal Ibadah', 'route' => 'schedule-dropdown'],
                ['label' => 'Bahan Rohani', 'route' => 'bahan-rohani-dropdown'],
                ['label' => 'Informasi', 'route' => 'informasi-dropdown'],
            ];
        ?>

        
        <div class="lg:hidden flex items-center justify-between h-14 relative px-2">

            
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

            
            <a href="<?php echo e(route('client.home')); ?>" class="absolute left-1/2 -translate-x-1/2 flex items-center gap-2 shrink-0" aria-label="GBKP Bandar Lampung - Beranda">
                <div class="w-8 h-8 rounded-full bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>
                <span class="text-[14px] font-bold text-slate-800 tracking-tight">GBKP</span>
            </a>

            
            <a href="<?php echo e(route('login')); ?>"
               class="flex items-center px-3 py-1.5 bg-blue-700 text-white text-[12px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm"
               aria-label="Login">
                Login
            </a>
        </div>

        
        <div class="hidden lg:flex items-center justify-between h-[68px] gap-4">

            
            <a href="<?php echo e(route('client.home')); ?>" class="flex items-center gap-3 shrink-0">
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

            
            <nav class="hidden lg:flex items-center gap-0.5" aria-label="Navigasi utama">

                <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($dropdownMenus[$item['route']])): ?>
                        <?php $menu = $dropdownMenus[$item['route']]; ?>
                        <div x-data="{ open: false }"
                             @mouseenter="open = true"
                             @mouseleave="open = false"
                             @focusin="open = true"
                             @focusout="if (! $el.contains($event.relatedTarget)) open = false"
                             @keydown.escape.window="open = false"
                             class="relative shrink-0">
                            <a href="<?php echo e($menu['route']); ?>"
                               aria-haspopup="true" :aria-expanded="open.toString()"
                               class="flex items-center gap-1 whitespace-nowrap rounded-md px-3 py-2 text-[13.5px] font-medium transition-colors
                                     <?php echo e($menu['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'); ?>">
                                <?php echo e($menu['label']); ?>

                                <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
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
                                 class="absolute left-0 top-full pt-2 z-50">
                                <div class="w-56 overflow-hidden rounded-xl border border-slate-100 bg-white py-1.5 shadow-lg">
                                    <?php $__currentLoopData = $menu['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e($cat['route']); ?>"
                                           class="block whitespace-nowrap px-4 py-2 text-[13px] font-medium transition-colors
                                                 <?php echo e($cat['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'); ?>">
                                            <?php echo e($cat['label']); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e($item['route']); ?>"
                           class="shrink-0 whitespace-nowrap rounded-md px-3 py-2 text-[13.5px] font-medium transition-colors
                                 <?php echo e($item['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'); ?>">
                            <?php echo e($item['label']); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>

            
            <div class="flex items-center gap-2 shrink-0">
                
                <a href="<?php echo e(route('login')); ?>" class="hidden sm:flex items-center justify-center w-9 h-9 rounded-full text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors" aria-label="Login">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </a>

                
                <a href="<?php echo e(route('login')); ?>"
                   class="inline-flex items-center px-5 py-2 bg-blue-700 text-white text-[13.5px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                    Login
                </a>
            </div>
        </div>
    </div>

    
    <div x-show="open" x-cloak
         @keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="lg:hidden fixed inset-0 z-50 bg-white" role="dialog" aria-modal="true" aria-label="Navigasi mobile">

        
        <button @click="open = false"
                class="absolute top-4 right-4 z-50 w-10 h-10 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors flex items-center justify-center"
                aria-label="Tutup menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        
        <div class="h-full overflow-y-auto px-6 py-10">
            <nav class="flex w-full flex-col space-y-1.5 pb-10" aria-label="Navigasi mobile">
                <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($dropdownMenus[$item['route']])): ?>
                        <?php $menu = $dropdownMenus[$item['route']]; ?>
                        <div x-data="{ open: false }" class="w-full">
                            <button @click="open = !open" type="button"
                                    class="flex w-full items-center justify-between rounded-lg px-4 py-3.5 text-left text-[18px] font-medium transition-colors
                                          <?php echo e($menu['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50'); ?>"
                                    aria-expanded="false" :aria-expanded="open.toString()">
                                <?php echo e($menu['label']); ?>

                                <svg :class="open ? 'rotate-180' : ''" class="ml-2 h-5 w-5 shrink-0 text-slate-500 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                                 class="mt-1 space-y-1 border-l-2 border-slate-200 pl-4">
                                <?php $__currentLoopData = $menu['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($cat['route']); ?>" @click="open = false"
                                       class="block rounded-lg px-4 py-3 text-[16px] font-medium transition-colors
                                             <?php echo e($cat['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:bg-slate-50'); ?>">
                                        <?php echo e($cat['label']); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e($item['route']); ?>" @click="open = false"
                           class="block w-full rounded-lg px-4 py-3.5 text-left text-[18px] font-medium transition-colors
                                 <?php echo e($item['active'] ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50'); ?>">
                            <?php echo e($item['label']); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <div class="mt-8 w-full border-t border-slate-200 pt-6 text-center">
                    <p class="text-[13px] text-slate-500">
                        &copy; <?php echo e(date('Y')); ?> GBKP Bandar Lampung
                    </p>
                </div>
            </nav>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views/layouts/client/header.blade.php ENDPATH**/ ?>
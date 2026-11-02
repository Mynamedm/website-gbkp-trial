

<?php $__env->startSection('content'); ?>

    
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
            <div class="max-w-xl">
                <span class="inline-block text-teal-300 text-[11px] font-semibold uppercase tracking-[0.18em] mb-4">Selamat Datang Di</span>
                <h1 class="font-display text-white text-[2.5rem] sm:text-[3.2rem] lg:text-[3.6rem] font-extrabold leading-[1.08] mb-5">
                    GBKP<br>Bandar Lampung
                </h1>
                <p class="text-slate-300 text-[15px] leading-relaxed mb-8 max-w-md">
                    Tempat bertumbuh dalam iman, pelayanan, dan persekutuan bersama Tuhan.
                </p>
                <a href="<?php echo e(route('client.about-church')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-slate-800 text-[13.5px] font-semibold rounded-lg hover:bg-slate-50 transition-colors shadow-lg shadow-black/10">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    
    <?php if(count($bahanRohaniSlides) > 0): ?>
    <?php
        $lightIndex = collect($bahanRohaniSlides)->search(fn ($slide) => ! empty($slide['light']));
    ?>
    <section class="bahan-rohani"
             x-data="{
                 slide: 0,
                 total: <?php echo e(count($bahanRohaniSlides)); ?>,
                 lightIndex: <?php echo e($lightIndex === false ? -1 : $lightIndex); ?>,
                 next() { this.slide = (this.slide + 1) % this.total },
                 prev() { this.slide = (this.slide - 1 + this.total) % this.total }
             }"
             :class="slide === lightIndex ? 'is-light' : ''">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

            <div class="flex items-center justify-between gap-4 mb-5">
                <h2 class="br-title text-lg sm:text-xl font-display font-bold">
                    <?php $__currentLoopData = $bahanRohaniSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span x-show="slide === <?php echo e($index); ?>" <?php if($index > 0): ?> x-cloak <?php endif; ?>><?php echo e($slide['label']); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </h2>

                <div class="flex items-center gap-2">
                    <button type="button" @click="prev()" aria-label="Slide sebelumnya"
                            class="w-9 h-9 flex items-center justify-center rounded-full border br-divider br-title br-soft-hover transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                        </svg>
                    </button>
                    <button type="button" @click="next()" aria-label="Slide berikutnya"
                            class="w-9 h-9 flex items-center justify-center rounded-full border br-divider br-title br-soft-hover transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid">
                <?php $__currentLoopData = $bahanRohaniSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $item = $slide['reflection']; ?>
                    <div x-show="slide === <?php echo e($index); ?>" <?php if($index > 0): ?> x-cloak <?php endif; ?>
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-3"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-3"
                         class="col-start-1 row-start-1 grid lg:grid-cols-[280px_1fr] gap-6">

                        
                        <div class="br-panel backdrop-blur-sm rounded-2xl p-6 border flex flex-col">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 br-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.966 8.966 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                            </div>
                            <p class="br-label text-[11.5px] uppercase tracking-wide font-medium"><?php echo e($item->date->locale('id')->translatedFormat('l')); ?></p>
                            <p class="br-title text-xl font-bold mt-1"><?php echo e($item->date->format('d F Y')); ?></p>
                            <?php if(filled($item->church_day)): ?>
                                <div class="mt-5 pt-5 border-t br-divider">
                                    <p class="br-label text-[11px] uppercase tracking-wide font-medium mb-1">Hari Gereja</p>
                                    <p class="br-title text-sm font-semibold"><?php echo e($item->church_day); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if(filled($item->theme)): ?>
                                <div class="mt-4">
                                    <p class="br-label text-[11px] uppercase tracking-wide font-medium mb-1">Tema</p>
                                    <p class="br-title text-sm font-semibold"><?php echo e($item->theme); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if(filled($item->bible_verse)): ?>
                                <div class="mt-4">
                                    <p class="br-label text-[11px] uppercase tracking-wide font-medium mb-1">Bacaan</p>
                                    <p class="br-title text-sm font-semibold flex items-center gap-2">
                                        <span class="br-dot w-2 h-2 rounded-full shrink-0"></span>
                                        <?php echo e($item->bible_verse); ?>

                                    </p>
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo e($slide['listUrl']); ?>" class="mt-auto pt-5 inline-flex items-center gap-1.5 br-accent text-[12px] font-semibold hover:opacity-80 transition-opacity">
                                <?php echo e($slide['listLabel']); ?>

                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        </div>

                        
                        <div class="br-panel-2 backdrop-blur-sm rounded-2xl p-6 sm:p-8 border flex flex-col justify-between">
                            <div>
                                <h3 class="br-title font-bold text-base sm:text-lg leading-snug mb-4"><?php echo e($item->title); ?></h3>
                                <?php if(filled($item->summary)): ?>
                                    <p class="br-body text-[14.5px] leading-[1.75] line-clamp-4"><?php echo e($item->summary); ?></p>
                                <?php endif; ?>
                                <?php if(filled($item->bible_translation)): ?>
                                    <p class="br-footer text-[12px] mt-3"><?php echo e($item->bible_translation); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mt-6 pt-5 border-t br-divider flex items-center justify-between gap-4">
                                <p class="br-footer text-[12px] italic"><?php echo e($slide['footer']); ?></p>
                                <a href="<?php echo e($slide['url']); ?>" class="br-cta inline-flex items-center gap-1.5 px-4 py-2 text-[12.5px] font-semibold rounded-lg transition-opacity shrink-0">
                                    Baca Selengkapnya
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-6 flex items-center justify-center gap-3">
                <?php $__currentLoopData = $bahanRohaniSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" @click="slide = <?php echo e($index); ?>"
                            aria-label="Tampilkan <?php echo e($slide['label']); ?>"
                            :aria-current="slide === <?php echo e($index); ?>"
                            class="br-tab group flex items-center gap-2 rounded-full px-3 py-1.5 border transition-all duration-300"
                            :class="slide === <?php echo e($index); ?> ? 'br-tab-active' : ''">
                        <span class="br-dot h-1.5 rounded-full transition-all duration-300"
                              :class="slide === <?php echo e($index); ?> ? 'w-5' : 'w-1.5 opacity-40 group-hover:opacity-70'"></span>
                        <span class="text-[11.5px] font-semibold"><?php echo e($slide['label']); ?></span>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Jadwal Ibadah Terdekat</h2>
                <a href="<?php echo e(route('client.schedule-worship')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Jadwal
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('client.schedule-worship')); ?>" class="group bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl p-6 flex items-start gap-4 hover:from-slate-600 hover:to-slate-700 transition-all">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-[15px] mb-1"><?php echo e($item->title); ?></h3>
                            <p class="text-white/50 text-[12.5px]"><?php echo e($item->date->locale('id')->translatedFormat('j F Y')); ?></p>
                            <p class="text-white/70 text-[12.5px] mt-0.5"><?php echo e($item->category ?? 'Ibadah'); ?></p>
                            <p class="text-white/40 text-[12px] mt-1"><?php echo e($item->time ?? '-'); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-slate-400 text-sm">Belum ada jadwal ibadah.</p>
                <?php endif; ?>
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="<?php echo e(route('client.schedule-worship')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Jadwal &rarr;</a>
            </div>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Warta Jemaat</h2>
                <a href="<?php echo e(route('client.announcements')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Warta
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('client.announcements')); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <div class="bg-gradient-to-br from-sky-100 to-sky-50 h-36 flex items-center justify-center relative overflow-hidden">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/'.$item->image)); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Warta</span>
                            <?php endif; ?>
                            <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                <?php echo e($item->date->locale('id')->translatedFormat('j F Y')); ?>

                            </span>
                        </div>
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-slate-800 text-[14.5px]"><?php echo e($item->title); ?></h3>
                                <p class="text-slate-500 text-[12.5px] mt-0.5"><?php echo e($item->theme); ?></p>
                            </div>
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-slate-400 text-sm">Belum ada warta jemaat.</p>
                <?php endif; ?>
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="<?php echo e(route('client.announcements')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Warta &rarr;</a>
            </div>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold">Kegiatan Gereja</h2>
                <a href="<?php echo e(route('client.events')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    Lihat Semua Kegiatan
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('client.events')); ?>" class="bg-white rounded-2xl overflow-hidden border border-slate-100 hover:border-slate-200 hover:shadow-md transition-all group">
                        <div class="bg-gradient-to-br from-slate-100 to-slate-50 h-36 flex items-center justify-center relative overflow-hidden">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/'.$item->image)); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Kegiatan</span>
                            <?php endif; ?>
                            <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                <?php echo e($item->date->locale('id')->translatedFormat('j F Y')); ?>

                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 text-[14.5px]"><?php echo e($item->title); ?></h3>
                            <?php if($item->isKeuangan() && ! session('keuangan_unlocked', false)): ?>
                                <p class="mt-1 inline-flex items-center gap-1.5 text-amber-700 text-[12.5px] font-medium">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                    </svg>
                                    Berita terkunci. Masukkan PIN untuk membaca.
                                </p>
                            <?php else: ?>
                                <p class="text-slate-500 text-[12.5px] mt-1 leading-relaxed line-clamp-2"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->description), 80)); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-slate-400 text-sm">Belum ada kegiatan gereja.</p>
                <?php endif; ?>
            </div>

            <div class="mt-5 text-center sm:hidden">
                <a href="<?php echo e(route('client.events')); ?>" class="text-blue-600 text-[12.5px] font-semibold hover:underline">Lihat Semua Kegiatan &rarr;</a>
            </div>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-gradient-to-br from-slate-100 to-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold mb-8">Lokasi Gereja</h2>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-[1fr_380px]">
                    <div class="h-64 md:h-auto bg-slate-200 relative">
                        <iframe
                            src="<?php echo e($mapEmbedUrl); ?>"
                            title="Lokasi GBKP Bandar Lampung di Google Maps"
                            width="100%" height="100%" style="border:0; min-height: 280px; aspect-ratio: 16/9;"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="p-7 sm:p-8 flex flex-col justify-center">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">GBKP Bandar Lampung</h3>
                                <p class="text-slate-500 text-[14px] mt-1.5 leading-relaxed">
                                    Jalan Turi Raya (By Pass KP) No.36,<br>
                                    Tanjung Senang,<br>
                                    Bandar Lampung, Lampung 35141
                                </p>
                                <a href="<?php echo e($mapDirectionsUrl); ?>" target="_blank" rel="noopener noreferrer"
                                   class="mt-3 inline-flex items-center gap-1.5 text-blue-700 text-[12.5px] font-semibold hover:underline">
                                    Buka di Google Maps
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

    
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            
            <nav class="flex items-center gap-2 text-[13px] mb-6">
                <a href="<?php echo e(route('client.events')); ?>" class="text-slate-300 hover:text-white transition-colors">Kegiatan Gereja</a>
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-white font-medium truncate max-w-full sm:max-w-[300px]"><?php echo e($event->title); ?></span>
            </nav>

            
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5 italic">
                <?php echo e($event->title); ?>

            </h1>

            
            <div class="flex flex-wrap items-center gap-5 text-slate-300 text-[14px]">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    <?php echo e($event->date->translatedFormat('d F Y')); ?>

                </div>
                <?php if($event->location): ?>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                    </svg>
                    <?php echo e($event->location); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <?php
                $defaultColor = 'bg-slate-100 text-slate-700';
                $catColor = $categoryColors[$event->category] ?? $defaultColor;
                $catParts = explode(' ', $catColor);
                $catBg = $catParts[0] ?? 'bg-slate-100';
                $catText = $catParts[1] ?? 'text-slate-700';
            ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <h2 class="font-display text-slate-800 text-xl font-extrabold mb-4">Tentang Kegiatan</h2>
                        <p class="text-slate-600 text-[14px] leading-relaxed mb-6">
                            <?php echo e($event->description); ?>

                        </p>

                        
                        <?php if($event->quote): ?>
                        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6 text-blue-300 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                <div>
                                    <p class="text-slate-700 text-[14px] leading-relaxed italic"><?php echo e($event->quote); ?></p>
                                    <?php if($event->quote_source): ?>
                                    <p class="text-blue-700 text-[13px] font-bold mt-3"><?php echo e($event->quote_source); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <h2 class="font-display text-slate-800 text-xl font-extrabold mb-5">Detail Kegiatan</h2>
                        <div class="divide-y divide-slate-100">
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Jenis Kegiatan</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo e(ucfirst($event->category)); ?></span>
                            </div>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Tanggal</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo e($event->date->translatedFormat('d F Y')); ?></span>
                            </div>
                            <?php if($event->time_start): ?>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Waktu</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo e($event->time_start); ?><?php echo e($event->time_end ? ' - ' . $event->time_end : ''); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($event->location): ?>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Tempat</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo e($event->location); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($event->organizedBy): ?>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Dilayani Oleh</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo e($event->organizedBy); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($event->content): ?>
                            <div class="flex items-start gap-4 py-3">
                                <span class="text-slate-500 text-[13.5px] shrink-0 min-w-[100px]">Keterangan</span>
                                <span class="text-slate-500 text-[13.5px]">:</span>
                                <span class="text-slate-700 text-[13.5px] font-medium"><?php echo strip_tags($event->content); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="font-display text-slate-800 text-lg font-extrabold mb-5">Informasi Singkat</h3>
                        <div class="space-y-4">
                            
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold"><?php echo e($event->date->translatedFormat('d F Y')); ?></p>
                                    <p class="text-slate-400 text-[12px]"><?php echo e($event->date->translatedFormat('l')); ?></p>
                                </div>
                            </div>

                            
                            <?php if($event->time_start): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold"><?php echo e($event->time_start); ?><?php echo e($event->time_end ? ' - ' . $event->time_end : ''); ?></p>
                                    <p class="text-slate-400 text-[12px]">Waktu</p>
                                </div>
                            </div>
                            <?php endif; ?>

                            
                            <?php if($event->location): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold"><?php echo e($event->location); ?></p>
                                    <p class="text-slate-400 text-[12px]">Lokasi</p>
                                </div>
                            </div>
                            <?php endif; ?>

                            
                            <?php if($event->organizedBy): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold"><?php echo e($event->organizedBy); ?></p>
                                    <p class="text-slate-400 text-[12px]">Pelayan Firman</p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="font-display text-slate-800 text-lg font-extrabold mb-4">Kategori Kegiatan</h3>
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl <?php echo e($catBg); ?> flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 <?php echo e($catText); ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-700 text-[14px] font-bold"><?php echo e(ucfirst($event->category)); ?></p>
                                    <p class="text-slate-400 text-[12px]">Kategori <?php echo e(ucfirst($event->category)); ?></p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\event\detail.blade.php ENDPATH**/ ?>
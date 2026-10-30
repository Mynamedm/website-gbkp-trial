
    <section class="pb-14 sm:pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="kategorialCarousel" class="relative group">
                <div class="overflow-hidden rounded-3xl">
                    <div id="kategorialTrack" class="flex transition-transform duration-500 ease-in-out">
                        <?php $__currentLoopData = $kategorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="kategorial-slide min-w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-2 bg-white border border-slate-100 shadow-sm rounded-3xl overflow-hidden">
                                    <div class="bg-gradient-to-br from-<?php echo e($item['color']); ?>-100 to-<?php echo e($item['color']); ?>-50 min-h-[220px] lg:min-h-[380px] flex items-center justify-center">
                                        <span class="text-<?php echo e($item['color']); ?>-300 text-[13px] font-medium">Foto <?php echo e($item['name']); ?></span>
                                    </div>
                                    <div class="p-7 sm:p-10 flex flex-col justify-center">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-11 h-11 rounded-xl bg-<?php echo e($item['color']); ?>-50 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5 text-<?php echo e($item['color']); ?>-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <?php echo $item['icon']; ?>

                                                </svg>
                                            </div>
                                            <div>
                                                <span class="inline-block text-<?php echo e($item['color']); ?>-600 text-[11px] font-semibold uppercase tracking-[0.18em]">Kategorial</span>
                                                <h3 class="font-display text-slate-800 text-xl sm:text-2xl font-bold"><?php echo e($item['name']); ?></h3>
                                            </div>
                                        </div>
                                        <p class="text-slate-500 text-[13px] uppercase tracking-wide font-medium mb-3"><?php echo e($item['tagline']); ?></p>
                                        <p class="text-slate-600 text-[15px] leading-relaxed mb-3"><?php echo e($item['desc_1']); ?></p>
                                        <p class="text-slate-600 text-[15px] leading-relaxed mb-5"><?php echo e($item['desc_2']); ?></p>
                                        <div class="flex flex-wrap items-center gap-3">
                                            <a href="<?php echo e(route('client.about-kategorial.detail', $item['slug'])); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-700 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-800 transition-colors shadow-sm">
                                                Lihat Selengkapnya
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                                </svg>
                                            </a>
                                            <span class="inline-flex items-center gap-1.5 text-slate-500 text-[13px]">
                                                <span class="text-slate-800 font-bold text-[15px]"><?php echo e($item['jumlah']); ?></span> <?php echo e($item['satuan'] ?? 'anggota'); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <button id="kategorialPrev" onclick="kategorialPrev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-white shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-60 hover:!opacity-100 hidden sm:flex">
                    <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                </button>
                <button id="kategorialNext" onclick="kategorialNext()" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-white shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-60 hover:!opacity-100 hidden sm:flex">
                    <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>

                
                <div class="mt-6 flex items-center justify-center gap-2">
                    <?php $__currentLoopData = $kategorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button onclick="kategorialGoTo(<?php echo e($index); ?>)"
                                class="kategorial-dot w-2.5 h-2.5 rounded-full transition-all <?php echo e($index === 0 ? 'bg-blue-600' : 'bg-slate-300 hover:bg-slate-400'); ?>"></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\about-kategorial\partials\carousel.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

    
    <section class="relative bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=1600&q=80"
                 alt="" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3 uppercase">
                Bahan <span class="text-emerald-200">Ibadah</span>
            </h1>
            <div class="w-16 h-1 bg-emerald-400 rounded-full mb-4"></div>
            <p class="text-emerald-100/80 text-[15px] leading-relaxed max-w-xl">
                Bahan ibadah GBKP Bandar Lampung untuk menuntun jemaat dalam persiapan dan pelaksanaan ibadah.
            </p>
        </div>
    </section>

    
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-slate-800 text-xl sm:text-2xl font-bold text-center mb-10 uppercase tracking-wide">
                Daftar <span class="text-emerald-600">Bahan Ibadah</span>
            </h2>

            <?php if($reflections->isEmpty()): ?>
                <div class="bg-white rounded-2xl border border-slate-200 px-6 py-14 text-center">
                    <p class="text-slate-400 text-sm">Belum ada bahan ibadah yang dipublikasikan.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $reflections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reflection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('client.bahan-ibadah.detail', $reflection)); ?>"
                           class="group flex flex-col bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg hover:border-emerald-200 transition-all">
                            <?php if($reflection->image_url): ?>
                                <div class="h-40 bg-slate-100 overflow-hidden">
                                    <img src="<?php echo e($reflection->image_url); ?>" alt=""
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php else: ?>
                                <div class="h-40 bg-gradient-to-br from-emerald-800 to-emerald-950 flex items-center justify-center">
                                    <div class="text-center px-6">
                                        <p class="text-emerald-200/60 text-[10px] uppercase tracking-[0.2em] mb-1">Bahan Ibadah</p>
                                        <p class="text-white font-bold text-lg leading-tight">GBKP Bandar Lampung</p>
                                        <svg class="w-9 h-9 text-white/25 mx-auto mt-3" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.966 8.966 0 00-6 2.292m0-14.25v14.25"/>
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="flex-1 flex flex-col p-5">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <span class="text-emerald-600 text-[11.5px] font-semibold uppercase tracking-wide">
                                        <?php echo e($reflection->date->format('d M Y')); ?>

                                    </span>
                                    <?php if(filled($reflection->church_day)): ?>
                                        <span class="inline-block bg-emerald-50 text-emerald-700 text-[11px] font-semibold px-2.5 py-1 rounded-md">
                                            <?php echo e($reflection->church_day); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="font-display text-slate-800 text-base font-bold leading-snug mb-2 group-hover:text-emerald-700 transition-colors">
                                    <?php echo e($reflection->title); ?>

                                </h3>

                                <?php if(filled($reflection->summary)): ?>
                                    <p class="text-slate-500 text-[13px] leading-relaxed mb-4 line-clamp-3"><?php echo e($reflection->summary); ?></p>
                                <?php endif; ?>

                                <div class="mt-auto space-y-1.5">
                                    <?php if(filled($reflection->theme)): ?>
                                        <p class="text-slate-600 text-[12.5px]">
                                            <span class="text-slate-400">Tema: </span><?php echo e($reflection->theme); ?>

                                        </p>
                                    <?php endif; ?>
                                    <?php if(filled($reflection->bible_verse)): ?>
                                        <p class="text-slate-600 text-[12.5px] flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 shrink-0"></span>
                                            <?php echo e($reflection->bible_verse); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-[12px] italic text-slate-400">Bahan Ibadah</span>
                                    <span class="inline-flex items-center gap-1.5 text-emerald-700 text-[12.5px] font-semibold group-hover:gap-2.5 transition-all">
                                        Baca Selengkapnya
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($reflections->hasPages()): ?>
                    <div class="mt-10">
                        <?php echo e($reflections->links()); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views/client/reflection/bahan-ibadah.blade.php ENDPATH**/ ?>
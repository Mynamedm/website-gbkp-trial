<?php $__env->startSection('content'); ?>

    
    <section class="relative bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 overflow-hidden">
        <?php if($reflection->image_url): ?>
            <div class="absolute inset-0">
                <img src="<?php echo e($reflection->image_url); ?>" alt="" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
            </div>
        <?php endif; ?>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 text-center">
            <span class="inline-block bg-white/10 text-emerald-100 text-[11.5px] font-semibold uppercase tracking-[0.18em] px-3 py-1.5 rounded-full mb-5">
                Bahan Ibadah
            </span>
            <h1 class="font-display text-white text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight mb-4">
                <?php echo e($reflection->title); ?>

            </h1>
            <div class="w-16 h-1 bg-emerald-400 rounded-full mx-auto mb-4"></div>
            <p class="text-emerald-100/80 text-[14px] font-medium">
                <?php echo e($reflection->date->translatedFormat('l, d F Y')); ?>

            </p>
            <?php if(filled($reflection->church_day)): ?>
                <p class="text-emerald-200/70 text-[12.5px] mt-1"><?php echo e($reflection->church_day); ?></p>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-9">
                <?php if(filled($reflection->theme) || filled($reflection->bible_verse)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-6 mb-6 border-b border-slate-100">
                        <?php if(filled($reflection->theme)): ?>
                            <div>
                                <p class="text-emerald-600 text-[11px] font-semibold uppercase tracking-wide mb-1">Tema</p>
                                <p class="text-slate-700 text-[14px] font-medium"><?php echo e($reflection->theme); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if(filled($reflection->bible_verse)): ?>
                            <div>
                                <p class="text-emerald-600 text-[11px] font-semibold uppercase tracking-wide mb-1">Bacaan</p>
                                <p class="text-slate-700 text-[14px] font-semibold flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-yellow-400 shrink-0"></span>
                                    <?php echo e($reflection->bible_verse); ?>

                                    <?php if(filled($reflection->bible_translation)): ?>
                                        <span class="text-slate-400 text-[12px] font-normal"><?php echo e($reflection->bible_translation); ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if(filled($reflection->body)): ?>
                    <div class="space-y-5 text-slate-700 text-[15px] leading-[1.8]">
                        <?php echo nl2br(e($reflection->body)); ?>

                    </div>
                <?php else: ?>
                    <p class="text-slate-400 text-sm">Isi bahan ibadah belum tersedia.</p>
                <?php endif; ?>

                <div class="mt-8 pt-5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-slate-400 text-[12.5px] italic">Bahan Ibadah GBKP Bandar Lampung</p>
                    <a href="<?php echo e(route('client.bahan-ibadah')); ?>"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-700 text-white text-[12.5px] font-semibold rounded-lg hover:bg-emerald-800 transition-colors shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                        </svg>
                        Semua Bahan Ibadah
                    </a>
                </div>
            </article>
        </div>
    </section>

    <?php if($otherReflections->isNotEmpty()): ?>
        
        <section class="pb-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-slate-800 text-lg font-bold mb-6 uppercase tracking-wide">Bahan Ibadah Lainnya</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <?php $__currentLoopData = $otherReflections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('client.bahan-ibadah.detail', $item)); ?>"
                           class="group flex flex-col bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md hover:border-emerald-200 transition-all">
                            <span class="text-emerald-600 text-[11.5px] font-semibold uppercase tracking-wide mb-2">
                                <?php echo e($item->date->format('d M Y')); ?>

                            </span>
                            <h3 class="text-slate-800 text-[14px] font-bold leading-snug mb-1.5 group-hover:text-emerald-700 transition-colors">
                                <?php echo e($item->title); ?>

                            </h3>
                            <?php if(filled($item->bible_verse)): ?>
                                <p class="text-slate-500 text-[12.5px] mt-auto"><?php echo e($item->bible_verse); ?></p>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\reflection\bahan-ibadah-detail.blade.php ENDPATH**/ ?>

<?php $__env->startSection('content'); ?>

    
    <div class="bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-[13px] text-slate-400">
                <a href="<?php echo e(route('client.home')); ?>" class="hover:text-blue-600 transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <a href="<?php echo e(route('client.organization')); ?>" class="hover:text-blue-600 transition-colors"><?php echo e($settings->title); ?></a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-slate-800 font-medium"><?php echo e($member->position); ?></span>
            </div>
        </div>
    </div>

    
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <?php if($settings->hero_image_url): ?>
            <div class="absolute inset-0">
                <img src="<?php echo e($settings->hero_image_url); ?>" alt="" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
            </div>
        <?php endif; ?>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                <?php if($member->photo_url): ?>
                    <img src="<?php echo e($member->photo_url); ?>" alt="<?php echo e($member->position); ?>"
                         class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-white/20 shadow-lg shrink-0">
                <?php else: ?>
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-white/10 border-2 border-dashed border-white/30 flex items-center justify-center shrink-0">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white/40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                <?php endif; ?>
                <div>
                    <span class="inline-block text-white/70 text-[11px] font-semibold uppercase tracking-[0.18em]"><?php echo e($settings->title); ?></span>
                    <h1 class="font-display text-white text-3xl sm:text-4xl font-extrabold leading-tight mt-1"><?php echo e($member->position); ?></h1>
                    <?php if(filled($member->name)): ?>
                        <p class="text-yellow-500 text-base sm:text-lg font-semibold mt-2"><?php echo e($member->name); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Profil</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold"><?php echo e($member->position); ?></h2>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                    <h3 class="font-display text-slate-800 font-bold text-[15px]">Rincian Jabatan</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between py-3 border-b border-slate-50">
                        <span class="text-slate-500 text-[13px]">Jabatan</span>
                        <span class="text-slate-800 text-[14px] font-medium"><?php echo e($member->position); ?></span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-slate-50">
                        <span class="text-slate-500 text-[13px]">Nama</span>
                        <span class="text-slate-800 text-[14px] font-medium"><?php echo e($member->name ?: '-'); ?></span>
                    </div>
                    <?php if(filled($settings->periode)): ?>
                        <div class="flex items-center justify-between py-3 border-b border-slate-50">
                            <span class="text-slate-500 text-[13px]">Periode</span>
                            <span class="text-slate-800 text-[14px] font-medium"><?php echo e($settings->periode); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($parent): ?>
                        <div class="flex items-center justify-between py-3 border-b border-slate-50">
                            <span class="text-slate-500 text-[13px]">Atasan</span>
                            <a href="<?php echo e(route('client.organization.detail', $parent->slug)); ?>" class="text-blue-600 text-[14px] font-medium hover:underline"><?php echo e($parent->position); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if(filled($member->description)): ?>
                        <div class="flex items-start justify-between gap-6 py-3">
                            <span class="text-slate-500 text-[13px] shrink-0">Tugas</span>
                            <span class="text-slate-800 text-[14px] text-right leading-relaxed"><?php echo e($member->description); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    
    <?php if($children->isNotEmpty()): ?>
        <section class="py-14 sm:py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Struktur</span>
                    <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Bawahan <?php echo e($member->position); ?></h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                            <div class="flex items-center gap-4">
                                <?php if($child->photo_url): ?>
                                    <img src="<?php echo e($child->photo_url); ?>" alt="<?php echo e($child->position); ?>" loading="lazy"
                                         class="w-14 h-14 rounded-full object-cover border-2 border-white shadow shrink-0">
                                <?php else: ?>
                                    <div class="w-14 h-14 rounded-full bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="min-w-0">
                                    <h3 class="font-display text-slate-800 font-bold text-[14.5px]"><?php echo e($child->position); ?></h3>
                                    <?php if(filled($child->name)): ?>
                                        <p class="text-slate-500 text-[12.5px] mt-0.5"><?php echo e($child->name); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <section class="pb-14 sm:pb-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="<?php echo e(route('client.organization')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 text-white text-[13.5px] font-semibold rounded-lg hover:bg-slate-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Kembali ke <?php echo e($settings->title); ?>

            </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\organization\detail.blade.php ENDPATH**/ ?>
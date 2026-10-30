
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Struktur Organisasi</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Pengurus Kategorial</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="bg-<?php echo e($item['color']); ?>-50 px-6 py-4 border-b border-<?php echo e($item['color']); ?>-100">
                            <h3 class="font-display text-slate-800 font-bold text-[15px]"><?php echo e($item['name']); ?></h3>
                        </div>
                        <div class="px-6 py-4">
                            <?php $__currentLoopData = $item['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between py-2.5 <?php echo e(!$loop->last ? 'border-b border-slate-50' : ''); ?>">
                                    <span class="text-slate-500 text-[12.5px]"><?php echo e($person['jabatan']); ?></span>
                                    <span class="text-slate-800 text-[13px] font-medium"><?php echo e($person['nama']); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\about-kategorial\partials\pengurus.blade.php ENDPATH**/ ?>
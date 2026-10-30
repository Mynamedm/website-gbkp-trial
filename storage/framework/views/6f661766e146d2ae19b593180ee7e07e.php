
    <section class="py-14 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Galeri</span>
                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold">Dokumentasi Kegiatan</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__currentLoopData = $dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 hover:shadow-md transition-all group cursor-pointer">
                        <div class="bg-gradient-to-br <?php echo e($item['warna']); ?> h-44 flex items-center justify-center relative">
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Foto Kegiatan</span>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[11px] font-medium text-slate-600 px-2.5 py-1 rounded-md">
                                <?php echo e($item['kategori']); ?>

                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 text-[14.5px] mb-1"><?php echo e($item['judul']); ?></h3>
                            <p class="text-slate-500 text-[12.5px]"><?php echo e($item['tanggal']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\about-kategorial\partials\galeri.blade.php ENDPATH**/ ?>
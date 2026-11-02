<?php $__env->startSection('content'); ?>

    
    <section class="relative bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80"
                 alt="Gereja GBKP" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="flex items-center gap-2 text-slate-300 text-[13px] mb-4">
                <a href="<?php echo e(route('client.home')); ?>" class="hover:text-white transition-colors">Beranda</a>
                <span>&#9654;</span>
                <span class="text-white">Persembahan</span>
            </div>
            <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-3">
                PERSEMBAHAN <span class="text-yellow-500">ONLINE</span>
            </h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full mb-4"></div>
            <p class="text-slate-300 text-[15px] leading-relaxed max-w-xl">
                Satu QR Code untuk persembahan umum. Scan barcode di bawah untuk melakukan transaksi. Terima kasih atas kemurahan hati Anda.
            </p>
        </div>
    </section>

    
    <section class="bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">

            <?php if(! $category): ?>
                <div class="text-center py-16">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-600 font-semibold text-lg mb-1">Informasi Persembahan Belum Tersedia</h3>
                    <p class="text-slate-400 text-[13px]">QR Code persembahan akan ditampilkan setelah ditambahkan oleh admin.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-start">

                    
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden lg:sticky lg:top-24">
                        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.008v.008H6.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM18 15.75h.008v.008H18V15.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM9.375 18h.008v.008H9.375V18zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-blue-600">QRIS</p>
                                <h2 class="font-display text-slate-800 text-lg font-bold leading-tight truncate"><?php echo e($category->name); ?></h2>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8">
                            <div class="mx-auto w-full max-w-[320px] sm:max-w-[380px]">
                                <div class="rounded-2xl border-2 border-slate-100 bg-white p-3 sm:p-4 shadow-sm">
                                    <div class="aspect-square w-full overflow-hidden rounded-xl bg-white">
                                        <?php if($category->qris_image): ?>
                                            <img src="<?php echo e($category->qris_image); ?>" alt="QRIS <?php echo e($category->name); ?>" class="w-full h-full object-contain">
                                        <?php else: ?>
                                            <img src="<?php echo e($category->qr_code_url); ?>" alt="QR Code <?php echo e($category->name); ?>" class="w-full h-full object-contain">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-4 text-center text-slate-500 text-[13px] leading-relaxed">
                                Scan QR Code ini dengan aplikasi mobile banking atau e-wallet yang mendukung QRIS.
                            </p>

                            <?php if (! ($category->qris_image)): ?>
                                <?php if($category->bank_name || $category->bank_account_number): ?>
                                    <div class="mt-6 rounded-xl bg-slate-50 border border-slate-100 px-4 py-3.5">
                                        <p class="text-[10.5px] font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Atau transfer ke rekening</p>
                                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                            <?php if($category->bank_name): ?>
                                                <span class="text-slate-600 text-[13px] font-medium"><?php echo e($category->bank_name); ?></span>
                                            <?php endif; ?>
                                            <?php if($category->bank_account_number): ?>
                                                <span class="text-slate-800 text-[14px] font-bold font-mono tracking-wide"><?php echo e($category->bank_account_number); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($category->bank_account_name): ?>
                                            <p class="text-slate-500 text-[12.5px] mt-0.5">a.n. <?php echo e($category->bank_account_name); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="space-y-5">
                        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                            <h2 class="font-display text-slate-800 text-xl font-extrabold">Cara Berpersembahan</h2>
                            <p class="text-slate-500 text-[13.5px] leading-relaxed mt-1.5">
                                Ikuti langkah berikut untuk memberi persembahan melalui QR Code.
                            </p>

                            <ol class="mt-7 space-y-6">
                                <?php $__currentLoopData = [
                                    ['Buka aplikasi pembayaran', 'Buka aplikasi mobile banking atau e-wallet yang mendukung QRIS.'],
                                    ['Pilih menu Scan QRIS', 'Cari dan pilih menu scan QR atau bayar dengan QRIS.'],
                                    ['Scan QR Code', 'Arahkan kamera ke QR Code persembahan umum di samping.'],
                                    ['Masukkan nominal', 'Isi jumlah persembahan, lalu periksa nama penerima yang muncul.'],
                                    ['Konfirmasi & simpan bukti', 'Selesaikan transaksi dan simpan bukti pembayaran sebagai tanda persembahan Anda.'],
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex gap-4">
                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-700 text-[13.5px] font-bold ring-1 ring-blue-100">
                                            <?php echo e($index + 1); ?>

                                        </span>
                                        <div class="pt-1">
                                            <p class="font-semibold text-slate-800 text-[14px]"><?php echo e($step[0]); ?></p>
                                            <p class="text-slate-500 text-[13px] leading-relaxed mt-0.5"><?php echo e($step[1]); ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </div>

                        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-5 sm:p-6 flex items-start gap-4">
                            <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-[14px] mb-1">Periksa Sebelum Konfirmasi</h3>
                                <p class="text-slate-600 text-[13px] leading-relaxed">
                                    Pastikan nama penerima yang tertera adalah <span class="font-semibold text-slate-800">GBKP Bandar Lampung</span> sebelum menekan tombol konfirmasi.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\client\persembahan\index.blade.php ENDPATH**/ ?>
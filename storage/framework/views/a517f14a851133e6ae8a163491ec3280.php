<ul>
    <?php $__currentLoopData = $roots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <div class="org-card">
                <div class="flex flex-col items-center text-center gap-2 px-3 py-3.5">
                    <?php if($member->photo_url): ?>
                        <img src="<?php echo e($member->photo_url); ?>" alt="<?php echo e($member->position); ?>"
                             class="w-12 h-12 rounded-full object-cover border border-slate-200">
                    <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-slate-50 border border-dashed border-slate-300 flex items-center justify-center" title="Belum ada foto">
                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <div class="min-w-0">
                        <p class="text-[13px] font-semibold text-slate-800 leading-snug break-words"><?php echo e($member->position); ?></p>
                        <?php if(filled($member->name)): ?>
                            <p class="text-[12px] text-slate-500 mt-0.5 break-words"><?php echo e($member->name); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if (! ($member->is_active)): ?>
                        <span class="text-[9px] font-semibold uppercase tracking-wide text-amber-600 bg-amber-50 border border-amber-200 rounded px-1.5 py-0.5">Nonaktif</span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($member->children->isNotEmpty()): ?>
                <?php echo $__env->make('admin.organization.partials.tree', ['roots' => $member->children], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\admin\organization\partials\tree.blade.php ENDPATH**/ ?>
<div class="overflow-x-auto">
    <table class="w-full text-left min-w-[600px]">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="sticky left-0 z-20 bg-white py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider border-r border-slate-100/60">No</th>
                <th class="py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                <th class="py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider">Bank</th>
                <th class="py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider">Rekening</th>
                <th class="py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="sticky right-0 z-20 bg-white py-3 px-4 text-[12px] font-semibold text-slate-500 uppercase tracking-wider text-right border-l border-slate-100/60">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 border-r border-slate-100/60 py-3 px-4 text-[13px] text-slate-500"><?php echo e($loop->iteration); ?></td>
                    <td class="py-3 px-4">
                        <div class="text-[13px] font-medium text-slate-700"><?php echo e($category->name); ?></div>
                        <?php if($category->description): ?>
                            <div class="text-[11px] text-slate-400 mt-0.5"><?php echo e(\Illuminate\Support\Str::limit($category->description, 50)); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 px-4 text-[13px] text-slate-600"><?php echo e($category->bank_name ?? '-'); ?></td>
                    <td class="py-3 px-4 text-[13px] text-slate-600 font-mono"><?php echo e($category->bank_account_number ?? '-'); ?></td>
                    <td class="py-3 px-4">
                        <?php if($category->is_active): ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-600">Aktif</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-500">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="sticky right-0 z-10 bg-white group-hover:bg-slate-50 border-l border-slate-100/60 py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="document.getElementById('edit-<?php echo e($category->id); ?>').showModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </button>
                            <button type="button" onclick="deleteOffering(<?php echo e($category->id); ?>)" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="py-12 text-center text-sm text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                            <span>Belum ada data kategori persembahan</span>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <form id="delete-offering-<?php echo e($category->id); ?>" method="POST" action="<?php echo e(route('admin.offering-categories.destroy', $category->id)); ?>" class="hidden">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

    <dialog id="edit-<?php echo e($category->id); ?>" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Edit Kategori Persembahan</h3>
                <button type="button" onclick="document.getElementById('edit-<?php echo e($category->id); ?>').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="<?php echo e(route('admin.offering-categories.update', $category->id)); ?>" class="p-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="<?php echo e($category->name); ?>" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Deskripsi</label>
                        <textarea name="description" rows="2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"><?php echo e($category->description); ?></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama Bank</label>
                            <input type="text" name="bank_name" value="<?php echo e($category->bank_name); ?>" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nomor Rekening</label>
                            <input type="text" name="bank_account_number" value="<?php echo e($category->bank_account_number); ?>" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Atas Nama Rekening</label>
                        <input type="text" name="bank_account_name" value="<?php echo e($category->bank_account_name); ?>" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">URL QRIS (opsional)</label>
                        <input type="text" name="qris_image" value="<?php echo e($category->qris_image); ?>" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Urutan</label>
                            <input type="number" name="sort_order" value="<?php echo e($category->sort_order); ?>" min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" <?php echo e($category->is_active ? 'checked' : ''); ?> class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-[13px] text-slate-600">Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('edit-<?php echo e($category->id); ?>').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Update</button>
                </div>
            </form>
        </div>
    </dialog>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\admin\offering\partials\table.blade.php ENDPATH**/ ?>
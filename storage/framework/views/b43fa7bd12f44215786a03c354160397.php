<div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[740px]">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="sticky left-0 z-20 bg-white text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-r border-slate-100/60">User</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Bergabung</th>
                <th class="sticky right-0 z-20 bg-white text-right px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-l border-slate-100/60">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50/50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 border-r border-slate-100/60 px-6 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-xs font-bold shrink-0">
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            </div>
                            <span class="font-medium text-slate-700 text-[13.5px]"><?php echo e($user->name); ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-slate-500 text-[13px]"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-3.5">
                        <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($role->name === 'super_admin'): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-purple-50 text-purple-600">Super Admin</span>
                            <?php elseif($role->name === 'admin'): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-blue-50 text-blue-600">Admin</span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-slate-100 text-slate-600">User</span>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td class="px-6 py-3.5 text-slate-500 text-[13px]"><?php echo e($user->created_at->format('d M Y')); ?></td>
                    <td class="sticky right-0 z-10 bg-white group-hover:bg-slate-50 border-l border-slate-100/60 px-6 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="document.getElementById('edit-<?php echo e($user->id); ?>').showModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                            </button>
                            <?php if($user->id !== auth()->id()): ?>
                                <button type="button" onclick="deleteUser(<?php echo e($user->id); ?>)" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data user.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($user->id !== auth()->id()): ?>
        <form id="delete-user-<?php echo e($user->id); ?>" method="POST" action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" class="hidden">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
    <?php endif; ?>

    <dialog id="edit-<?php echo e($user->id); ?>" class="modal sm">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Edit User</h3>
                <button type="button" onclick="document.getElementById('edit-<?php echo e($user->id); ?>').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="<?php echo e(route('admin.users.update', $user->id)); ?>" class="p-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="<?php echo e($user->name); ?>" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="<?php echo e($user->email); ?>" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Password <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" autocomplete="new-password" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Role <span class="text-red-500">*</span></label>
                        <select name="role" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="user" <?php if($user->roles->first()?->name === 'user'): echo 'selected'; endif; ?>>User</option>
                            <option value="admin" <?php if($user->roles->first()?->name === 'admin'): echo 'selected'; endif; ?>>Admin</option>
                            <option value="super_admin" <?php if($user->roles->first()?->name === 'super_admin'): echo 'selected'; endif; ?>>Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('edit-<?php echo e($user->id); ?>').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Update</button>
                </div>
            </form>
        </div>
    </dialog>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<?php endif; ?>

<?php if($users->hasPages()): ?>
    <div class="px-6 py-3 border-t border-slate-100">
        <?php echo e($users->links()); ?>

    </div>
<?php endif; ?><?php /**PATH C:\Users\User\Documents\GitHub\website-gbkp-trial\resources\views\admin\user\partials\table.blade.php ENDPATH**/ ?>
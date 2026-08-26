@extends('layouts.admin.app', ['title' => 'Users'])

@section('content')
<div x-data="{ modal: null, editingId: null, search: '{{ request('search') }}', perPage: '{{ request('per_page', 10) }}', debounceTimer: null }"
     @edit-user.window="editingId = $event.detail; modal = 'edit'"
     @delete-user.window="
         Swal.fire({
             title: 'Yakin hapus?',
             text: 'User yang dihapus tidak bisa dikembalikan',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#dc2626',
             cancelButtonColor: '#64748b',
             confirmButtonText: 'Ya, hapus!',
             cancelButtonText: 'Batal',
             customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg', cancelButton: 'rounded-lg' }
         }).then((result) => {
             if (result.isConfirmed) {
                 fetch(`/admin/users/${$event.detail}`, {
                     method: 'DELETE',
                     headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() }
                 })
                 .then(r => r.json().then(d => ({ ok: r.ok, d })))
                 .then(({ ok, d }) => {
                     if (!ok) { Swal.fire({ icon: 'error', title: 'Gagal', text: d.message || 'Terjadi kesalahan', customClass: { popup: 'rounded-2xl' } }); return; }
                     Swal.fire({ icon: 'success', title: 'Terhapus', text: 'User berhasil dihapus', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
                     loadUserTable();
                 });
             }
         })
     "
>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Daftar User</h2>
            <button @click="modal = 'create'" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah User
            </button>
        </div>

        {{-- Toolbar: Search + Per Page --}}
        <div class="px-6 py-3 border-b border-slate-100 flex items-center gap-3">
            <div class="relative flex-1 max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
                <input x-model="search" x-on:input="clearTimeout(debounceTimer); debounceTimer = setTimeout(() => loadUserTable(), 300)" type="text" placeholder="Cari user..."
                       class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-[13px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
            <select x-model="perPage" x-on:change="loadUserTable()"
                    class="border border-slate-200 rounded-lg px-3 py-2 text-[13px] text-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div id="user-table-container">
            @include('admin.user.partials.table')
        </div>
    </div>

    {{-- Create Modal --}}
    <div x-show="modal === 'create'" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="modal === 'create'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="modal = null"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
            <div x-show="modal === 'create'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-800">Tambah User</h3>
                        <button @click="modal = null" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form id="create-user-form" onsubmit="submitUserForm(event, this)">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password_confirmation" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Role <span class="text-red-500">*</span></label>
                                <select name="role" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                            <button type="button" @click="modal = null" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div x-show="modal === 'edit'" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="modal === 'edit'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="modal = null"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
            <div x-show="modal === 'edit'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-800">Edit User</h3>
                        <button @click="modal = null" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form id="edit-user-form" onsubmit="submitEditUserForm(event, this)">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Password <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                                <input type="password" name="password" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Role <span class="text-red-500">*</span></label>
                                <select name="role" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                            <button type="button" @click="modal = null" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function csrf() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

function close() {
    Alpine.$data(document.querySelector('[x-data]')).modal = null;
}

function getUserParams() {
    const el = document.querySelector('[x-data]');
    const data = Alpine.$data(el);
    return `search=${encodeURIComponent(data.search)}&per_page=${data.perPage}`;
}

function submitUserForm(e, form) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch('/admin/users', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() }
    })
    .then(r => {
        if (r.status === 422) return r.json().then(err => { throw err; });
        return r.json();
    })
    .then(() => {
        Swal.fire({ icon: 'success', title: 'Berhasil', text: 'User berhasil ditambahkan', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
        form.reset();
        close();
        loadUserTable();
    })
    .catch(err => {
        if (err.errors) {
            const msgs = Object.values(err.errors).flat().join('<br>');
            Swal.fire({ icon: 'error', title: 'Validasi Gagal', html: msgs, customClass: { popup: 'rounded-2xl' } });
        }
    });
}

function submitEditUserForm(e, form) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() }
    })
    .then(r => {
        if (r.status === 422) return r.json().then(err => { throw err; });
        return r.json();
    })
    .then(() => {
        Swal.fire({ icon: 'success', title: 'Berhasil', text: 'User berhasil diupdate', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
        close();
        loadUserTable();
    })
    .catch(err => {
        if (err.errors) {
            const msgs = Object.values(err.errors).flat().join('<br>');
            Swal.fire({ icon: 'error', title: 'Validasi Gagal', html: msgs, customClass: { popup: 'rounded-2xl' } });
        }
    });
}

function loadUserTable(page = 1) {
    fetch(`/admin/users?page=${page}&${getUserParams()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.text())
    .then(html => { document.getElementById('user-table-container').innerHTML = html; });
}
</script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        const data = Alpine.$data(document.querySelector('[x-data]'));
        if (data.editingId && data.modal === 'edit') {
            openEditUser(data.editingId);
            data.editingId = null;
        }
    });
});

function openEditUser(id) {
    fetch(`/admin/users/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
        const form = document.getElementById('edit-user-form');
        form.action = `/admin/users/${id}`;
        form.querySelector('[name="name"]').value = data.name;
        form.querySelector('[name="email"]').value = data.email;
        form.querySelector('[name="role"]').value = data.roles[0]?.name || 'user';
    });
}
</script>
@endpush
@endsection

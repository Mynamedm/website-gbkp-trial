@extends('layouts.admin.app', ['title' => 'Ibadah Umum'])

@section('content')
<div id="page-data" x-data="{ modal: null, editingId: null, detailId: null, search: '{{ request('search') }}', perPage: '{{ request('per_page', 10) }}', debounceTimer: null }"
     @edit-worship.window="editingId = $event.detail; modal = 'edit'"
     @view-worship.window="detailId = $event.detail; modal = 'view'"
     @delete-worship.window="
         Swal.fire({
             title: 'Yakin hapus?',
             text: 'Data yang dihapus tidak bisa dikembalikan',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#dc2626',
             cancelButtonColor: '#64748b',
             confirmButtonText: 'Ya, hapus!',
             cancelButtonText: 'Batal',
             customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg', cancelButton: 'rounded-lg' }
         }).then((result) => {
             if (result.isConfirmed) {
                 fetch(`/admin/jadwal-ibadah/umum/${$event.detail}`, {
                     method: 'DELETE',
                     headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() }
                 })
                 .then(r => r.json().then(d => ({ ok: r.ok, d })))
                 .then(({ ok, d }) => {
                     if (!ok) { Swal.fire({ icon: 'error', title: 'Gagal', text: d.message || 'Terjadi kesalahan', customClass: { popup: 'rounded-2xl' } }); return; }
                     Swal.fire({ icon: 'success', title: 'Terhapus', text: 'Jadwal berhasil dihapus', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
                     loadTable();
                 });
             }
         })
     "
>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 sticky top-16 z-30">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Daftar Jadwal Ibadah Umum</h2>
            <button @click="modal = 'create'" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Jadwal
            </button>
        </div>

        <div class="px-6 py-3 border-b border-slate-100 flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <input x-model="search" x-on:input="clearTimeout(debounceTimer); debounceTimer = setTimeout(() => loadTable(), 300)" type="text" placeholder="Cari petugas / lokasi..."
                       class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-[13px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
            <select x-model="perPage" x-on:change="loadTable()" class="border border-slate-200 rounded-lg px-3 py-2 text-[13px] text-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div id="worship-table-container">
            @include('admin.worship.partials.table')
        </div>
    </div>

    {{-- Create Modal --}}
    <div x-show="modal === 'create'" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="modal === 'create'" x-transition class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="modal = null"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
            <div x-show="modal === 'create'" x-transition class="inline-block w-full max-w-2xl p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-800">Tambah Jadwal Ibadah Umum</h3>
                        <button @click="modal = null" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    <form id="create-worship-form" onsubmit="submitForm(event, this)" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Sesi <span class="text-red-500">*</span></label>
                                    <select name="session" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        <option value="morning">Pagi</option>
                                        <option value="afternoon">Sore</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Waktu</label>
                                    <input type="text" name="time" placeholder="08.00 WIB" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Lokasi</label>
                                <input type="text" name="location" placeholder="Gedung Gereja GBKP Bandar Lampung" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengkhotbah</label><input type="text" name="preacher" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Liturgis</label><input type="text" name="liturgist" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Koordinator</label><input type="text" name="coordinator" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengantar Doa</label><input type="text" name="prayer_leader" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Warta Jemaat</label><input type="text" name="announcement" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan</label><input type="text" name="offering" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 1</label><input type="text" name="collector_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 2</label><input type="text" name="collector_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 1</label><input type="text" name="greeter_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 2</label><input type="text" name="greeter_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 1</label><input type="text" name="organist_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 2</label><input type="text" name="organist_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 1</label><input type="text" name="song_leader_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 2</label><input type="text" name="song_leader_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Worship Leader</label><input type="text" name="worship_leader" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Multimedia</label><input type="text" name="multimedia" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan Pujian</label><input type="text" name="praise_offering" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
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
            <div x-show="modal === 'edit'" x-transition class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="modal = null"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
            <div x-show="modal === 'edit'" x-transition class="inline-block w-full max-w-2xl p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-800">Edit Jadwal Ibadah Umum</h3>
                        <button @click="modal = null" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    <form id="edit-worship-form" onsubmit="submitEditForm(event, this)" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Sesi <span class="text-red-500">*</span></label>
                                    <select name="session" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        <option value="morning">Pagi</option>
                                        <option value="afternoon">Sore</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Waktu</label>
                                    <input type="text" name="time" placeholder="08.00 WIB" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Lokasi</label>
                                <input type="text" name="location" placeholder="Gedung Gereja GBKP Bandar Lampung" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengkhotbah</label><input type="text" name="preacher" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Liturgis</label><input type="text" name="liturgist" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Koordinator</label><input type="text" name="coordinator" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengantar Doa</label><input type="text" name="prayer_leader" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Warta Jemaat</label><input type="text" name="announcement" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan</label><input type="text" name="offering" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 1</label><input type="text" name="collector_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 2</label><input type="text" name="collector_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 1</label><input type="text" name="greeter_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 2</label><input type="text" name="greeter_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 1</label><input type="text" name="organist_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 2</label><input type="text" name="organist_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 1</label><input type="text" name="song_leader_1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 2</label><input type="text" name="song_leader_2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Worship Leader</label><input type="text" name="worship_leader" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Multimedia</label><input type="text" name="multimedia" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                                <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan Pujian</label><input type="text" name="praise_offering" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
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

    {{-- View Detail Modal --}}
    <div x-show="modal === 'view'" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="modal === 'view'" x-transition class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="modal = null"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
            <div x-show="modal === 'view'" x-transition class="inline-block w-full max-w-2xl p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Detail Ibadah Umum</h3>
                            <p class="text-[12.5px] text-slate-400 mt-0.5">Seluruh petugas jadwal ibadah umum</p>
                        </div>
                        <button @click="modal = null" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    <div id="worship-detail-body" class="grid sm:grid-cols-2 gap-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function csrf() { return document.querySelector('meta[name="csrf-token"]').content; }

function getParams() {
    const data = Alpine.$data(document.getElementById('page-data'));
    return `search=${encodeURIComponent(data.search)}&per_page=${data.perPage}`;
}

function submitForm(e, form) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch('/admin/jadwal-ibadah/umum', { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() } })
    .then(r => {
        if (r.status === 422) return r.json().then(err => { throw err; });
        return r.json();
    })
    .then(() => {
        Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Jadwal ibadah umum berhasil ditambahkan', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
        form.reset(); loadTable(); Alpine.$data(document.getElementById('page-data')).modal = null;
    })
    .catch(err => {
        if (err.errors) {
            const msgs = Object.values(err.errors).flat().join('<br>');
            Swal.fire({ icon: 'error', title: 'Validasi Gagal', html: msgs, customClass: { popup: 'rounded-2xl' } });
        }
    });
}

function submitEditForm(e, form) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch(form.action, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf() } })
    .then(r => {
        if (r.status === 422) return r.json().then(err => { throw err; });
        return r.json();
    })
    .then(() => {
        Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Jadwal ibadah umum berhasil diupdate', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-2xl' } });
        Alpine.$data(document.getElementById('page-data')).modal = null; loadTable();
    })
    .catch(err => {
        if (err.errors) {
            const msgs = Object.values(err.errors).flat().join('<br>');
            Swal.fire({ icon: 'error', title: 'Validasi Gagal', html: msgs, customClass: { popup: 'rounded-2xl' } });
        }
    });
}

function loadTable(page = 1) {
    fetch(`/admin/jadwal-ibadah/umum?page=${page}&${getParams()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.text())
    .then(html => { document.getElementById('worship-table-container').innerHTML = html; });
}
</script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        const data = Alpine.$data(document.getElementById('page-data'));
        if (data.detailId && data.modal === 'view') { openDetail(data.detailId); data.detailId = null; }
        if (data.editingId && data.modal === 'edit') { openEdit(data.editingId); data.editingId = null; }
    });
});

function openDetail(id) {
    fetch(`/admin/jadwal-ibadah/umum/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
        const sessionLabel = data.session === 'morning' ? 'Pagi' : 'Sore';
        const fields = [
            ['Sesi', sessionLabel], ['Waktu', data.time], ['Lokasi', data.location],
            ['Pengkhotbah', data.preacher], ['Liturgis', data.liturgist],
            ['Koordinator', data.coordinator], ['Pengantar Doa', data.prayer_leader],
            ['Warta Jemaat', data.announcement], ['Persembahan', data.offering],
            ['Kolektan 1', data.collector_1], ['Kolektan 2', data.collector_2],
            ['Penerima 1', data.greeter_1], ['Penerima 2', data.greeter_2],
            ['Organis 1', data.organist_1], ['Organis 2', data.organist_2],
            ['Song Leader 1', data.song_leader_1], ['Song Leader 2', data.song_leader_2],
            ['Worship Leader', data.worship_leader], ['Multimedia', data.multimedia],
            ['Persembahan Pujian', data.praise_offering],
        ];
        document.getElementById('worship-detail-body').innerHTML = fields.map(([label, value]) => `
            <div class="bg-slate-50 rounded-lg px-4 py-3">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">${label}</p>
                <p class="text-[13.5px] text-slate-700 font-medium">${value || '-'}</p>
            </div>
        `).join('');
    });
}

function openEdit(id) {
    fetch(`/admin/jadwal-ibadah/umum/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
        const form = document.getElementById('edit-worship-form');
        form.action = `/admin/jadwal-ibadah/umum/${id}`;
        form.querySelector('[name="session"]').value = data.session || 'morning';
        form.querySelector('[name="time"]').value = data.time || '';
        form.querySelector('[name="location"]').value = data.location || '';
        form.querySelector('[name="preacher"]').value = data.preacher || '';
        form.querySelector('[name="liturgist"]').value = data.liturgist || '';
        form.querySelector('[name="coordinator"]').value = data.coordinator || '';
        form.querySelector('[name="prayer_leader"]').value = data.prayer_leader || '';
        form.querySelector('[name="announcement"]').value = data.announcement || '';
        form.querySelector('[name="offering"]').value = data.offering || '';
        form.querySelector('[name="collector_1"]').value = data.collector_1 || '';
        form.querySelector('[name="collector_2"]').value = data.collector_2 || '';
        form.querySelector('[name="greeter_1"]').value = data.greeter_1 || '';
        form.querySelector('[name="greeter_2"]').value = data.greeter_2 || '';
        form.querySelector('[name="organist_1"]').value = data.organist_1 || '';
        form.querySelector('[name="organist_2"]').value = data.organist_2 || '';
        form.querySelector('[name="song_leader_1"]').value = data.song_leader_1 || '';
        form.querySelector('[name="song_leader_2"]').value = data.song_leader_2 || '';
        form.querySelector('[name="worship_leader"]').value = data.worship_leader || '';
        form.querySelector('[name="multimedia"]').value = data.multimedia || '';
        form.querySelector('[name="praise_offering"]').value = data.praise_offering || '';
    });
}
</script>
@endpush
@endsection

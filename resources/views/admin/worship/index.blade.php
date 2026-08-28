@extends('layouts.admin.app', ['title' => 'Ibadah Umum'])

@section('content')
<div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 sticky top-16 z-30">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Daftar Jadwal Ibadah Umum</h2>
            <button type="button" onclick="document.getElementById('create-dialog').showModal()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Jadwal
            </button>
        </div>

        <form method="GET" action="{{ route('admin.worships.index') }}" class="px-6 py-3 border-b border-slate-100 flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari petugas / lokasi..."
                       class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-[13px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
            <select name="per_page" onchange="this.form.submit()" class="border border-slate-200 rounded-lg px-3 py-2 text-[13px] text-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="10" @selected(request('per_page', 10) == 10)>10</option>
                <option value="50" @selected(request('per_page') == 50)>50</option>
                <option value="100" @selected(request('per_page') == 100)>100</option>
            </select>
            <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                Cari
            </button>
        </form>

        <div id="worship-table-container">
            @include('admin.worship.partials.table')
        </div>
    </div>

    {{-- Create Dialog --}}
    <dialog id="create-dialog" class="modal">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Tambah Jadwal Ibadah Umum</h3>
                <button type="button" onclick="document.getElementById('create-dialog').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.worships.store') }}" class="p-6">
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
                    <button type="button" onclick="document.getElementById('create-dialog').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </dialog>
</div>

@push('scripts')
<script>
function deleteWorship(id) {
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
            document.getElementById('delete-worship-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection
@extends('layouts.admin.app', ['title' => 'Kategori Persembahan'])

@section('content')
<div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 sticky top-16 z-30">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Daftar Kategori Persembahan</h2>
            <button type="button" onclick="document.getElementById('create-dialog').showModal()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Kategori
            </button>
        </div>

        <form method="GET" action="{{ route('admin.offering-categories.index') }}" class="px-6 py-3 border-b border-slate-100 flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / bank..."
                       class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-[13px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
            <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                Cari
            </button>
        </form>

        <div id="offering-table-container">
            @include('admin.offering.partials.table')
        </div>
    </div>

    {{-- Create Dialog --}}
    <dialog id="create-dialog" class="modal">
        <div class="modal-box max-w-lg">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Tambah Kategori Persembahan</h3>
                <button type="button" onclick="document.getElementById('create-dialog').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.offering-categories.store') }}" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Persepuluhan" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Deskripsi</label>
                        <textarea name="description" rows="2" placeholder="Deskripsi kategori persembahan..." class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama Bank</label>
                            <input type="text" name="bank_name" placeholder="Contoh: BCA" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nomor Rekening</label>
                            <input type="text" name="bank_account_number" placeholder="1234567890" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Atas Nama Rekening</label>
 <input type="text" name="bank_account_name" placeholder="GBKP Bandar Lampung" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">URL QRIS (opsional)</label>
                        <input type="text" name="qris_image" placeholder="https://..." class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <p class="text-[11px] text-slate-400 mt-1">URL gambar QRIS jika tersedia</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Urutan</label>
                            <input type="number" name="sort_order" value="0" min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-[13px] text-slate-600">Aktif</span>
                            </label>
                        </div>
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
function deleteOffering(id) {
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
            document.getElementById('delete-offering-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection

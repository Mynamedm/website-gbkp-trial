@extends('layouts.admin.app', ['title' => 'Kategori'])

@section('content')
<div>
    <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-6 flex items-center gap-3">
        <div class="relative flex-1 max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                   class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-[13px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        </div>
        <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
            Cari
        </button>
    </form>

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- KATEGORI EVENT --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 sticky top-16 z-30 self-start">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700">Kategori Event</h2>
                <button type="button" onclick="openCreateCategory('event')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah
                </button>
            </div>
            <div id="event-table-container">
                @include('admin.category.partials.table', ['categories' => $eventCategories])
            </div>
        </div>

        {{-- KATEGORI JADWAL IBADAH --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 sticky top-16 z-30 self-start">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700">Kategori Jadwal Ibadah</h2>
                <button type="button" onclick="openCreateCategory('schedule')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white text-[13px] font-semibold rounded-lg hover:bg-emerald-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah
                </button>
            </div>
            <div id="schedule-table-container">
                @include('admin.category.partials.table', ['categories' => $scheduleCategories])
            </div>
        </div>
    </div>

    {{-- Create Dialog --}}
    <dialog id="create-dialog" class="modal sm">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Tambah Kategori</h3>
                <button type="button" onclick="document.getElementById('create-dialog').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Masukkan nama kategori" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Tipe <span class="text-red-500">*</span></label>
                        <input type="hidden" name="type" id="create-type" value="{{ old('type', 'event') }}">
                        <span id="create-type-label" class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium {{ old('type') === 'schedule' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }}">{{ old('type') === 'schedule' ? 'Jadwal Ibadah' : 'Event' }}</span>
                        <p class="text-[11.5px] text-slate-400 mt-1.5">Otomatis dipilih sesuai tombol "Tambah" yang Anda klik.</p>
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
function openCreateCategory(type) {
    if (type !== 'schedule') type = 'event';

    const typeInput = document.getElementById('create-type');
    const typeLabel = document.getElementById('create-type-label');
    const createDialog = document.getElementById('create-dialog');

    if (typeInput) {
        typeInput.value = type;
    }
    if (typeLabel) {
        if (type === 'schedule') {
            typeLabel.className = 'inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-emerald-50 text-emerald-600';
            typeLabel.textContent = 'Jadwal Ibadah';
        } else {
            typeLabel.className = 'inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-blue-50 text-blue-600';
            typeLabel.textContent = 'Event';
        }
    }
    if (createDialog) {
        createDialog.showModal();
    }
}

function deleteCategory(id) {
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
            document.getElementById('delete-category-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection
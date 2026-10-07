@extends('layouts.admin.app', ['title' => 'Struktur Organisasi'])

@push('styles')
<style>
    .org-chart {
        --org-node-w: 15rem;
        --org-gap: 1rem;
        --org-level-gap: 2rem;
    }
    .org-chart ul {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        justify-content: safe center;
        gap: var(--org-gap);
        max-width: calc(6 * var(--org-node-w) + 5 * var(--org-gap));
        margin-left: auto;
        margin-right: auto;
    }
    .org-chart li {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .org-chart li > ul { margin-top: var(--org-level-gap); }
    .org-chart .org-card {
        width: var(--org-node-w);
        flex-shrink: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px rgb(15 23 42 / .04);
    }
    @media (max-width: 640px) {
        .org-chart { --org-node-w: 13rem; --org-gap: .75rem; --org-level-gap: 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="space-y-6">

    {{-- Pengaturan halaman --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-slate-700">Judul &amp; Periode Halaman</h2>
                <p class="text-[11.5px] text-slate-400 mt-0.5">Teks yang tampil di bagian atas halaman struktur organisasi.</p>
            </div>
            <button type="button" onclick="document.getElementById('settings-dialog').showModal()" class="inline-flex items-center gap-1.5 px-4 py-2 border border-slate-200 text-slate-600 text-[13px] font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 14.25v4.75a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6a1.5 1.5 0 011.5-1.5H10"/></svg>
                Ubah
            </button>
        </div>
        <div class="px-6 py-5 grid sm:grid-cols-3 gap-5">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Judul</p>
                <p class="text-[13.5px] font-semibold text-slate-800 mt-1">{{ $settings->title }}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Subjudul</p>
                <p class="text-[13.5px] text-slate-700 mt-1">{{ $settings->subtitle ?: '-' }}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Periode</p>
                <p class="text-[13.5px] text-slate-700 mt-1">{{ $settings->periode ?: '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Pohon jabatan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
<div class="px-6 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-2">
            <div class="min-w-0">
                <h2 class="text-sm font-semibold text-slate-700 truncate">Susunan Jabatan</h2>
                <p class="text-[11.5px] text-slate-400 mt-0.5">Jabatan tanpa atasan akan tampil sebagai akar bagan.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('client.organization') }}" target="_blank" class="px-4 py-2 border border-slate-200 text-slate-600 text-[13px] font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                    Lihat Halaman
                </a>
                <button type="button" onclick="openMemberDialog()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah Jabatan
                </button>
            </div>
        </div>

        <div id="org-tree-container" class="px-6 py-6 overflow-x-auto">
            @include('admin.organization.partials.chart', ['roots' => $roots])
        </div>
    </div>

    {{-- Daftar jabatan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">Daftar Jabatan</h2>
            <p class="text-[11.5px] text-slate-400 mt-0.5">Kelola data jabatan, atasan langsung, dan urutan tampil pada bagan.</p>
        </div>
        @include('admin.organization.partials.member-table')
    </div>
</div>

{{-- Dialog pengaturan --}}
<dialog id="settings-dialog" class="modal">
    <div class="modal-box max-w-lg">
        <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Judul Halaman</h3>
            <button type="button" onclick="document.getElementById('settings-dialog').close()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.organization.settings') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')
            <div class="space-y-4">
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required value="{{ old('title', $settings->title) }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    @error('title')<p class="text-[11.5px] text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Subjudul</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $settings->subtitle) }}" placeholder="Contoh: Periode 2024 - 2029" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat di bawah judul..." class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('description', $settings->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Periode</label>
                    <input type="text" name="periode" value="{{ old('periode', $settings->periode) }}" placeholder="Contoh: 2024 - 2029" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Foto Latar Hero</label>
                    @if($settings->hero_image_url)
                        <img src="{{ $settings->hero_image_url }}" alt="" class="w-full h-32 object-cover rounded-lg border border-slate-200 mb-2">
                    @endif
                    <input type="file" name="hero_image" accept="image/jpeg,image/png,image/webp" class="w-full text-[12.5px] text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-100 file:text-[12.5px] file:font-semibold file:text-slate-700 hover:file:bg-slate-200">
                    <p class="text-[11px] text-slate-400 mt-1">JPG/PNG/WebP, maks. 4 MB. Biarkan kosong jika tidak diubah.</p>
                    @error('hero_image')<p class="text-[11.5px] text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('settings-dialog').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</dialog>

{{-- Dialog tambah / edit jabatan --}}
<dialog id="member-dialog" class="modal">
    <div class="modal-box max-w-lg">
        <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
            <h3 id="member-dialog-title" class="text-lg font-bold text-slate-800">Tambah Jabatan</h3>
            <button type="button" onclick="document.getElementById('member-dialog').close()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="member-form" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div id="member-method"></div>
            <div class="space-y-4">
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position" required placeholder="Contoh: Ketua'Assemblée" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <p id="err-position" class="hidden text-[11.5px] text-red-500 mt-1"></p>
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama</label>
                    <input type="text" name="name" placeholder="Contoh: Pdt. Budi Santoso" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <p id="err-name" class="hidden text-[11.5px] text-red-500 mt-1"></p>
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Atasan Langsung</label>
                    <select name="parent_id" id="member-parent" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">— Tanpa atasan (akar) —</option>
                        @foreach($members as $option)
                            <option value="{{ $option->id }}">{{ $option->position }}</option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Pilih "Tanpa atasan" untuk membuat jabatan tingkat teratas.</p>
                    <p id="err-parent_id" class="hidden text-[11.5px] text-red-500 mt-1"></p>
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Tugas / Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Ringkasan tugas jabatan ini..." class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                    <p id="err-description" class="hidden text-[11.5px] text-red-500 mt-1"></p>
                </div>
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Foto</label>
                    <div class="flex items-center gap-3">
                        <img id="member-photo-preview" alt="" class="hidden w-16 h-16 rounded-full object-cover border border-slate-200">
                        <div id="member-photo-placeholder" class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" onchange="previewPhoto(this)" class="w-full text-[12.5px] text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-100 file:text-[12.5px] file:font-semibold file:text-slate-700 hover:file:bg-slate-200">
                            <p class="text-[11px] text-slate-400 mt-1">JPG/PNG/WebP, maks. 2 MB. Disarankan foto persegi (1:1).</p>
                        </div>
                    </div>
                    <label id="remove-photo-label" class="hidden items-center gap-2 mt-2 cursor-pointer">
                        <input type="checkbox" name="remove_photo" value="1" class="w-4 h-4 rounded border-slate-300 text-red-600 focus:ring-red-500">
                        <span class="text-[12.5px] text-slate-600">Hapus foto yang sekarang</span>
                    </label>
                    <p id="err-photo" class="hidden text-[11.5px] text-red-500 mt-1"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div class="flex items-end pb-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-[13px] text-slate-600">Tampilkan</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('member-dialog').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" id="member-submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
const membersById = @json($members->keyBy('id'));

function clearErrors() {
    document.querySelectorAll('[id^="err-"]').forEach(el => el.classList.add('hidden'));
}

function showErrors(data) {
    clearErrors();
    Object.entries(data.errors || {}).forEach(([field, messages]) => {
        const el = document.getElementById('err-' + field);
        if (el) {
            el.textContent = messages[0];
            el.classList.remove('hidden');
        }
    });
    const first = document.querySelector('[id^="err-"]:not(.hidden)');
    if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function resetPhotoPreview() {
    const preview = document.getElementById('member-photo-preview');
    const placeholder = document.getElementById('member-photo-placeholder');
    const removeLabel = document.getElementById('remove-photo-label');
    preview.classList.add('hidden');
    preview.removeAttribute('src');
    placeholder.classList.remove('hidden');
    removeLabel.classList.add('hidden');
    removeLabel.classList.remove('flex');
}

function previewPhoto(input) {
    const file = input.files && input.files[0];
    if (!file) return;

    const preview = document.getElementById('member-photo-preview');
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
    document.getElementById('member-photo-placeholder').classList.add('hidden');
    document.getElementById('remove-photo-label').classList.add('hidden');
}

function fillParentOptions(selectedId) {
    const select = document.getElementById('member-parent');
    select.innerHTML = '<option value="">— Tanpa atasan (akar) —</option>';

    Object.values(membersById).forEach(member => {
        const option = document.createElement('option');
        option.value = member.id;
        option.textContent = member.position;
        select.appendChild(option);
    });

    select.value = selectedId ? String(selectedId) : '';
}

function removeParentOption(id) {
    const option = document.querySelector('#member-parent option[value="' + id + '"]');
    if (option) option.remove();
}

function openMemberDialog(memberId = null, presetParentId = null) {
    clearErrors();

    const form = document.getElementById('member-form');
    const methodWrap = document.getElementById('member-method');
    const title = document.getElementById('member-dialog-title');
    const photoInput = form.querySelector('input[name="photo"]');
    const removeLabel = document.getElementById('remove-photo-label');

    methodWrap.innerHTML = '';
    resetPhotoPreview();
    photoInput.value = '';
    removeLabel.querySelector('input').checked = false;

    form.querySelector('input[name="position"]').value = '';
    form.querySelector('input[name="name"]').value = '';
    form.querySelector('textarea[name="description"]').value = '';
    form.querySelector('input[name="sort_order"]').value = '0';
    form.querySelector('input[name="is_active"]').checked = true;

    if (memberId) {
        title.textContent = 'Edit Jabatan';
        methodWrap.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        form.action = '{{ route('admin.organization.update', ['organizationMember' => 0]) }}'.replace('/0', '/' + memberId);

        fetch('{{ route('admin.organization.edit', ['organizationMember' => 0]) }}'.replace('/0', '/' + memberId), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(r => r.json())
            .then(member => {
                form.querySelector('input[name="position"]').value = member.position ?? '';
                form.querySelector('input[name="name"]').value = member.name ?? '';
                form.querySelector('textarea[name="description"]').value = member.description ?? '';
                form.querySelector('input[name="sort_order"]').value = member.sort_order ?? 0;
                form.querySelector('input[name="is_active"]').checked = !!member.is_active;

                fillParentOptions(member.parent_id);

                if (member.photo_url) {
                    const preview = document.getElementById('member-photo-preview');
                    preview.src = member.photo_url;
                    preview.classList.remove('hidden');
                    document.getElementById('member-photo-placeholder').classList.add('hidden');
                    removeLabel.classList.remove('hidden');
                    removeLabel.classList.add('flex');
                }
            });

        removeParentOption(memberId);
    } else {
        title.textContent = presetParentId ? 'Tambah Bawahan' : 'Tambah Jabatan';
        form.action = '{{ route('admin.organization.store') }}';
        fillParentOptions(presetParentId);
    }

    document.getElementById('member-dialog').showModal();
}

document.getElementById('member-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const submit = document.getElementById('member-submit');
    const original = submit.textContent;
    submit.disabled = true;
    submit.textContent = 'Menyimpan...';

    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
    })
        .then(async response => {
            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                showErrors(data);
                return;
            }

            document.getElementById('member-dialog').close();
            reloadTree();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message ?? 'Tersimpan',
                showConfirmButton: false,
                timer: 1800,
                customClass: { popup: 'rounded-xl' },
            });
        })
        .catch(() => Swal.fire('Gagal terhubung ke server.', 'error'))
        .finally(() => {
            submit.disabled = false;
            submit.textContent = original;
        });
});

function reloadTree() {
    window.location.reload();
}

function deleteMember(id) {
    Swal.fire({
        title: 'Yakin hapus jabatan ini?',
        text: 'Data jabatan akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg', cancelButton: 'rounded-lg' },
    }).then(async (result) => {
        if (!result.isConfirmed) return;

        const response = await fetch('{{ route('admin.organization.destroy', ['organizationMember' => 0]) }}'.replace('/0', '/' + id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            Swal.fire(data.message ?? 'Gagal menghapus.', 'error');
            return;
        }

        reloadTree();
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: data.message, showConfirmButton: false, timer: 1800 });
    });
}
</script>
@endpush



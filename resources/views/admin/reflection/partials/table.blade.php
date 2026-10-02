<div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[820px]">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="sticky left-0 z-20 bg-white text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-r border-slate-100/60">Renungan</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Hari Gereja</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Tema</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Ayat</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="sticky right-0 z-20 bg-white text-right px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-l border-slate-100/60">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($reflections as $item)
                <tr class="group hover:bg-slate-50/50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 border-r border-slate-100/60 px-6 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="" class="w-10 h-10 rounded-lg object-cover shrink-0">
                            @else
                                <span class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.966 8.966 0 00-6 2.292m0-14.25v14.25"/></svg>
                                </span>
                            @endif
                            <div>
                                <p class="font-semibold text-slate-700 text-[13.5px]">{{ $item->title }}</p>
                                <a href="{{ route('client.reflections.detail', $item) }}" target="_blank" class="text-blue-500 text-[12px] hover:underline mt-0.5 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    Lihat di Site
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-slate-600 text-[13px] whitespace-nowrap">{{ $item->date->format('d M Y') }}</td>
                    <td class="px-6 py-3.5 text-slate-600 text-[13px]">{{ $item->church_day ?? '-' }}</td>
                    <td class="px-6 py-3.5 text-slate-600 text-[13px]">{{ $item->theme ?? '-' }}</td>
                    <td class="px-6 py-3.5 text-slate-500 text-[13px]">{{ $item->bible_verse ?? '-' }}</td>
                    <td class="px-6 py-3.5">
                        @if($item->status === 'active')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-emerald-50 text-emerald-600">Active</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-slate-100 text-slate-500">Inactive</span>
                        @endif
                    </td>
                    <td class="sticky right-0 z-10 bg-white group-hover:bg-slate-50 border-l border-slate-100/60 px-6 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="document.getElementById('edit-{{ $item->id }}').showModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </button>
                            <button type="button" onclick="deleteReflection({{ $item->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data renungan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@forelse($reflections as $item)
    <form id="delete-reflection-{{ $item->id }}" method="POST" action="{{ route('admin.reflections.destroy', $item->id) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <dialog id="edit-{{ $item->id }}" class="modal sm">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Edit Renungan</h3>
                <button type="button" onclick="document.getElementById('edit-{{ $item->id }}').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.reflections.update', $item->id) }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ $item->title }}" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" name="date" value="{{ $item->date->format('Y-m-d') }}" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Hari Gereja</label>
                            <input type="text" name="church_day" value="{{ $item->church_day }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Tema</label>
                            <input type="text" name="theme" value="{{ $item->theme }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="active" @selected($item->status === 'active')>Active</option>
                                <option value="inactive" @selected($item->status === 'inactive')>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Ayat Alkitab</label>
                            <input type="text" name="bible_verse" value="{{ $item->bible_verse }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Terjemahan</label>
                            <input type="text" name="bible_translation" value="{{ $item->bible_translation }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Cuplikan</label>
                        <textarea name="excerpt" rows="2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none">{{ $item->excerpt }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Isi Renungan</label>
                        <textarea name="body" rows="8" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ $item->body }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Gambar <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                        <input type="file" name="image" accept="image/*" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[12px] file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('edit-{{ $item->id }}').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Update</button>
                </div>
            </form>
        </div>
    </dialog>
@empty
@endforelse

@if($reflections->hasPages())
    <div class="px-6 py-3 border-t border-slate-100">
        {{ $reflections->links() }}
    </div>
@endif
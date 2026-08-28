<div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[760px]">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="sticky left-0 z-20 bg-white text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-r border-slate-100/60">Warta</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Tema</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Ayat</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="sticky right-0 z-20 bg-white text-right px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider border-l border-slate-100/60">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($announcements as $item)
                <tr class="group hover:bg-slate-50/50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 border-r border-slate-100/60 px-6 py-3.5">
                        <div>
                            <p class="font-semibold text-slate-700 text-[13.5px]">{{ $item->title }}</p>
                            @if($item->file_path)
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="text-blue-500 text-[12px] hover:underline mt-0.5 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    Lihat PDF
                                </a>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-slate-600 text-[13px]">{{ $item->date->format('d M Y') }}</td>
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
                        <div class="flex items-center justify-end gap-1" x-data>
                            <button x-on:click="$dispatch('edit-announcement', {{ $item->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </button>
                            <button x-on:click="$dispatch('delete-announcement', {{ $item->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data warta jemaat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($announcements->hasPages())
    <div class="px-6 py-3 border-t border-slate-100">
        {{ $announcements->links() }}
    </div>
@endif

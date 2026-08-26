<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Jadwal</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Sektor</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Tanggal & Waktu</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                <th class="text-left px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="text-right px-6 py-3 text-[11.5px] font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($schedules as $schedule)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-6 py-3.5">
                        <div>
                            <p class="font-semibold text-slate-700 text-[13.5px]">{{ $schedule->title }}</p>
                            <p class="text-slate-400 text-[12px] mt-0.5">{{ $schedule->host ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-3.5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-slate-100 text-slate-600">
                            {{ $schedule->sector ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-blue-50 text-blue-600">
                            {{ $schedule->category ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5 text-slate-600 text-[13px]">
                        <div>{{ $schedule->date->format('d M Y') }}</div>
                        <div class="text-slate-400 text-[12px]">{{ $schedule->time ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-3.5 text-slate-500 text-[13px]">{{ $schedule->location ?? '-' }}</td>
                    <td class="px-6 py-3.5">
                        @if($schedule->status === 'active')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-emerald-50 text-emerald-600">Active</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11.5px] font-medium bg-slate-100 text-slate-500">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-1" x-data>
                            <button x-on:click="$dispatch('edit-schedule', {{ $schedule->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </button>
                            <button x-on:click="$dispatch('delete-schedule', {{ $schedule->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data jadwal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($schedules->hasPages())
    <div class="px-6 py-3 border-t border-slate-100">
        {{ $schedules->links() }}
    </div>
@endif

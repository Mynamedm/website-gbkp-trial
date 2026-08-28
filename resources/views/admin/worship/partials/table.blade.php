<div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[1000px]">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="sticky left-0 z-20 bg-white text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider border-r border-slate-100/60">Sesi</th>
                <th class="text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Waktu</th>
                <th class="text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                <th class="text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Pengkhotbah</th>
                <th class="text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Liturgis</th>
                <th class="text-left px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Koordinator</th>
                <th class="sticky right-0 z-20 bg-white text-right px-3 py-3 text-[11px] font-semibold text-slate-500 uppercase tracking-wider border-l border-slate-100/60">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($worships as $worship)
                <tr class="group hover:bg-slate-50/50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 border-r border-slate-100/60 px-3 py-3">
                        @if($worship->session === 'morning')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-medium bg-yellow-50 text-yellow-700">Pagi</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-medium bg-indigo-50 text-indigo-600">Sore</span>
                        @endif
                    </td>
                    <td class="px-3 py-3 text-slate-600 text-[12.5px]">{{ $worship->time ?? '-' }}</td>
                    <td class="px-3 py-3 text-slate-600 text-[12.5px]"><span class="block max-w-[220px] truncate" title="{{ $worship->location }}">{{ $worship->location ?? '-' }}</span></td>
                    <td class="px-3 py-3 text-slate-600 text-[12.5px]"><span class="block max-w-[200px] truncate" title="{{ $worship->preacher }}">{{ $worship->preacher ?? '-' }}</span></td>
                    <td class="px-3 py-3 text-slate-600 text-[12.5px]"><span class="block max-w-[200px] truncate" title="{{ $worship->liturgist }}">{{ $worship->liturgist ?? '-' }}</span></td>
                    <td class="px-3 py-3 text-slate-600 text-[12.5px]"><span class="block max-w-[200px] truncate" title="{{ $worship->coordinator }}">{{ $worship->coordinator ?? '-' }}</span></td>
                    <td class="sticky right-0 z-10 bg-white group-hover:bg-slate-50 border-l border-slate-100/60 px-3 py-3 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="document.getElementById('detail-{{ $worship->id }}').showModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                            <button type="button" onclick="document.getElementById('edit-{{ $worship->id }}').showModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </button>
                            <button type="button" onclick="deleteWorship({{ $worship->id }})" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data jadwal ibadah umum.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@forelse($worships as $worship)
    {{-- Delete Form --}}
    <form id="delete-worship-{{ $worship->id }}" method="POST" action="{{ route('admin.worships.destroy', $worship->id) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    {{-- Detail Dialog --}}
    <dialog id="detail-{{ $worship->id }}" class="modal sm">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Detail Ibadah Umum</h3>
                    <p class="text-[12.5px] text-slate-400 mt-0.5">Seluruh petugas jadwal ibadah umum</p>
                </div>
                <button type="button" onclick="document.getElementById('detail-{{ $worship->id }}').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <div class="p-6">
                <div class="grid sm:grid-cols-2 gap-3">
                    @php
                        $detailFields = [
                            'Sesi' => $worship->session === 'morning' ? 'Pagi' : 'Sore',
                            'Waktu' => $worship->time,
                            'Lokasi' => $worship->location,
                            'Pengkhotbah' => $worship->preacher,
                            'Liturgis' => $worship->liturgist,
                            'Koordinator' => $worship->coordinator,
                            'Pengantar Doa' => $worship->prayer_leader,
                            'Warta Jemaat' => $worship->announcement,
                            'Persembahan' => $worship->offering,
                            'Kolektan 1' => $worship->collector_1,
                            'Kolektan 2' => $worship->collector_2,
                            'Penerima 1' => $worship->greeter_1,
                            'Penerima 2' => $worship->greeter_2,
                            'Organis 1' => $worship->organist_1,
                            'Organis 2' => $worship->organist_2,
                            'Song Leader 1' => $worship->song_leader_1,
                            'Song Leader 2' => $worship->song_leader_2,
                            'Worship Leader' => $worship->worship_leader,
                            'Multimedia' => $worship->multimedia,
                            'Persembahan Pujian' => $worship->praise_offering,
                        ];
                    @endphp
                    @foreach($detailFields as $label => $value)
                        <div class="bg-slate-50 rounded-lg px-4 py-3">
                            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">{{ $label }}</p>
                            <p class="text-[13.5px] text-slate-700 font-medium">{{ $value ?? '-' }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('detail-{{ $worship->id }}').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Tutup</button>
                </div>
            </div>
        </div>
    </dialog>

    {{-- Edit Dialog --}}
    <dialog id="edit-{{ $worship->id }}" class="modal">
        <div class="modal-box">
            <div class="flex items-center justify-between p-6 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Edit Jadwal Ibadah Umum</h3>
                <button type="button" onclick="document.getElementById('edit-{{ $worship->id }}').close()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.worships.update', $worship->id) }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Sesi <span class="text-red-500">*</span></label>
                            <select name="session" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="morning" @selected($worship->session === 'morning')>Pagi</option>
                                <option value="afternoon" @selected($worship->session === 'afternoon')>Sore</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Waktu</label>
                            <input type="text" name="time" value="{{ $worship->time }}" placeholder="08.00 WIB" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ $worship->location }}" placeholder="Gedung Gereja GBKP Bandar Lampung" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengkhotbah</label><input type="text" name="preacher" value="{{ $worship->preacher }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Liturgis</label><input type="text" name="liturgist" value="{{ $worship->liturgist }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Koordinator</label><input type="text" name="coordinator" value="{{ $worship->coordinator }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Pengantar Doa</label><input type="text" name="prayer_leader" value="{{ $worship->prayer_leader }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Warta Jemaat</label><input type="text" name="announcement" value="{{ $worship->announcement }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan</label><input type="text" name="offering" value="{{ $worship->offering }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 1</label><input type="text" name="collector_1" value="{{ $worship->collector_1 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Kolektan 2</label><input type="text" name="collector_2" value="{{ $worship->collector_2 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 1</label><input type="text" name="greeter_1" value="{{ $worship->greeter_1 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Penerima 2</label><input type="text" name="greeter_2" value="{{ $worship->greeter_2 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 1</label><input type="text" name="organist_1" value="{{ $worship->organist_1 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Organis 2</label><input type="text" name="organist_2" value="{{ $worship->organist_2 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 1</label><input type="text" name="song_leader_1" value="{{ $worship->song_leader_1 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Song Leader 2</label><input type="text" name="song_leader_2" value="{{ $worship->song_leader_2 }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Worship Leader</label><input type="text" name="worship_leader" value="{{ $worship->worship_leader }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Multimedia</label><input type="text" name="multimedia" value="{{ $worship->multimedia }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                        <div><label class="block text-[12.5px] font-medium text-slate-600 mb-1">Persembahan Pujian</label><input type="text" name="praise_offering" value="{{ $worship->praise_offering }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('edit-{{ $worship->id }}').close()" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Update</button>
                </div>
            </form>
        </div>
    </dialog>
@empty
@endforelse

@if($worships->hasPages())
    <div class="px-6 py-3 border-t border-slate-100">
        {{ $worships->links() }}
    </div>
@endif
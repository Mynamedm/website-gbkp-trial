<ul>
    @foreach($roots as $member)
        <li>
            <div class="org-card">
                <div class="flex flex-col items-center text-center gap-2 px-3 py-3.5">
                    @if($member->photo_url)
                        <img src="{{ $member->photo_url }}" alt="{{ $member->position }}"
                             class="w-12 h-12 rounded-full object-cover border border-slate-200">
                    @else
                        <div class="w-12 h-12 rounded-full bg-slate-50 border border-dashed border-slate-300 flex items-center justify-center" title="Belum ada foto">
                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="min-w-0">
                        <p class="text-[13px] font-semibold text-slate-800 leading-snug break-words">{{ $member->position }}</p>
                        @if(filled($member->name))
                            <p class="text-[12px] text-slate-500 mt-0.5 break-words">{{ $member->name }}</p>
                        @endif
                    </div>

                    @unless($member->is_active)
                        <span class="text-[9px] font-semibold uppercase tracking-wide text-amber-600 bg-amber-50 border border-amber-200 rounded px-1.5 py-0.5">Nonaktif</span>
                    @endunless
                </div>
            </div>

            @if($member->children->isNotEmpty())
                @include('admin.organization.partials.tree', ['roots' => $member->children])
            @endif
        </li>
    @endforeach
</ul>
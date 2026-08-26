@extends('layouts.admin.app', ['title' => 'Profile'])

@section('content')
<div class="max-w-2xl space-y-6">
    {{-- Profile Information --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="mb-5">
            <h3 class="text-lg font-bold text-slate-800">Informasi Profil</h3>
            <p class="text-[13px] text-slate-500 mt-1">Perbarui informasi profil dan alamat email akun Anda.</p>
        </div>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="space-y-4">
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name }}" required autofocus autocomplete="name"
                           class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email }}" required autocomplete="username"
                           class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 mt-6 pt-4 border-t border-slate-100">
                <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
                @if(session('status') === 'profile-updated')
                    <span class="text-[13px] text-emerald-600 font-medium">Tersimpan.</span>
                @endif
            </div>
        </form>
    </div>

    {{-- Update Password --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="mb-5">
            <h3 class="text-lg font-bold text-slate-800">Ubah Password</h3>
            <p class="text-[13px] text-slate-500 mt-1">Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="space-y-4">
                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" autocomplete="current-password"
                           class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Password Baru</label>
                    <input type="password" name="password" autocomplete="new-password"
                           class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12.5px] font-medium text-slate-600 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password"
                           class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>

            <div class="flex items-center gap-4 mt-6 pt-4 border-t border-slate-100">
                <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Ubah Password</button>
                @if(session('status') === 'password-updated')
                    <span class="text-[13px] text-emerald-600 font-medium">Tersimpan.</span>
                @endif
            </div>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="mb-5">
            <h3 class="text-lg font-bold text-slate-800">Hapus Akun</h3>
            <p class="text-[13px] text-slate-500 mt-1">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.</p>
        </div>

        <button x-data x-on:click="$dispatch('open-modal', 'confirm-user-deletion')"
                class="px-4 py-2 text-[13px] font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
            Hapus Akun
        </button>

        <div x-data="{ open: false }"
             @open-modal.window="if($event.detail === 'confirm-user-deletion') open = true"
             @keydown.escape.window="open = false"
             x-show="open" x-cloak
             class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="open = false"></div>
                <span class="hidden sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-md p-0 my-8 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:align-middle">
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h3 class="text-lg font-bold text-slate-800">Yakin hapus akun?</h3>
                        <p class="text-[13px] text-slate-500 mt-2">Masukkan password untuk konfirmasi penghapusan akun secara permanen.</p>

                        <div class="mt-4">
                            <input type="password" name="password" placeholder="Password"
                                   class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            @error('password', 'userDeletion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
                            <button type="button" @click="open = false" class="px-4 py-2 text-[13px] font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-[13px] font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">Hapus Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

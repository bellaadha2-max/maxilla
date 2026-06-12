@extends('layouts.dashboard')

@section('title', 'Tambah Admin Baru')

@section('content')
<div class="mb-6 flex items-center gap-4 relative z-10">
    <a href="/superadmin/pengguna/admin" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </a>
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Tambah Admin Baru</h1>
        <p class="text-slate-500 mt-1 text-sm">Daftarkan staf administrasi baru untuk mengelola operasional cabang.</p>
    </div>
</div>

<div class="w-full">
    <form action="{{ route('superadmin.admin.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
            <!-- LEFT COLUMN: INFORMASI PRIBADI -->
            <div class="space-y-6">
                <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Informasi Pribadi & Penempatan
                        </h3>
                    </div>
                    <div class="p-8 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border @error('nama') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="Cth: Siti Aminah" required>
                                @error('nama') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Nomor WhatsApp</label>
                                <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="w-full border @error('no_wa') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="0812xxxx" required>
                                @error('no_wa') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Cabang Penempatan</label>
                                <select name="cabang" class="w-full border @error('cabang') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all cursor-pointer" required>
                                    <option value="">Pilih Cabang</option>
                                    <option value="slawi" {{ old('cabang') == 'slawi' ? 'selected' : '' }}>Maxilla Slawi</option>
                                    <option value="tegal" {{ old('cabang') == 'tegal' ? 'selected' : '' }}>Maxilla Tegal</option>
                                    <option value="brebes" {{ old('cabang') == 'brebes' ? 'selected' : '' }}>Maxilla Brebes</option>
                                </select>
                                @error('cabang') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Email Utama</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="admin.cabang@maxilla.com" required>
                                @error('email') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: KREDENSIAL & ACTIONS -->
            <div class="space-y-6">
                <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Kredensial Akses
                        </h3>
                    </div>
                    <div class="p-8 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Password</label>
                                <input type="password" name="password" class="w-full border @error('password') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="••••••••" required>
                                @error('password') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-5 bg-amber-50/50 border-t border-amber-100">
                        <p class="text-[11px] text-amber-700 font-bold leading-relaxed flex items-start gap-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong>Penting:</strong> Password minimal 8 karakter dengan kombinasi huruf dan angka untuk keamanan staf.</span>
                        </p>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex items-center justify-between gap-4">
                    <a href="/superadmin/pengguna/admin" class="px-6 py-3 rounded-2xl text-sm font-black text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-all uppercase tracking-widest">Batal</a>
                    <button type="submit" class="flex-1 px-8 py-4 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Data Admin
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

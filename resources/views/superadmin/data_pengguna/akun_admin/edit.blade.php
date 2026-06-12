@extends('layouts.dashboard')

@section('title', 'Edit Admin')

@section('content')
<div class="mb-6 flex items-center gap-4 relative z-10">
    <a href="/superadmin/pengguna/admin" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </a>
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Edit Admin</h1>
        <p class="text-slate-500 mt-1 text-sm">Perbarui informasi akun dan penempatan cabang staf administrasi.</p>
    </div>
</div>

<div class="max-w-4xl">
    <form action="{{ route('superadmin.admin.update', $admin->id_user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- CARD: INFORMASI PRIBADI -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Pribadi & Penempatan
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $admin->nama) }}" class="w-full border @error('nama') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="Cth: Siti Aminah" required>
                    @error('nama') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Nomor WhatsApp</label>
                    <input type="text" name="no_wa" value="{{ old('no_wa', $admin->no_wa) }}" class="w-full border @error('no_wa') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="0812xxxx" required>
                    @error('no_wa') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Cabang Penempatan</label>
                    <select name="cabang" class="w-full border @error('cabang') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all cursor-pointer" required>
                        <option value="">Pilih Cabang</option>
                        <option value="slawi" {{ old('cabang', $admin->cabang) == 'slawi' ? 'selected' : '' }}>Maxilla Slawi</option>
                        <option value="tegal" {{ old('cabang', $admin->cabang) == 'tegal' ? 'selected' : '' }}>Maxilla Tegal</option>
                        <option value="brebes" {{ old('cabang', $admin->cabang) == 'brebes' ? 'selected' : '' }}>Maxilla Brebes</option>
                    </select>
                    @error('cabang') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Email Utama</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="admin.cabang@maxilla.com" required>
                    @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- CARD: KREDENSIAL AKSES -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Kredensial Akses (Opsional)
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Password Baru</label>
                    <input type="password" name="password" class="w-full border @error('password') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="Kosongkan jika tidak ingin diubah">
                    @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="Kosongkan jika tidak ingin diubah">
                </div>
            </div>
            <div class="px-6 py-4 bg-amber-50 border-t border-amber-100">
                <p class="text-xs text-amber-700 font-medium leading-relaxed">
                    <strong>Penting:</strong> Password hanya perlu diisi jika Anda ingin mengganti password lama staf tersebut.
                </p>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="/superadmin/pengguna/admin" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all">Batal</a>
            <button type="submit" class="px-8 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-[0_4px_12px_rgba(79,70,229,0.25)] active:scale-95"> Simpan Perubahan </button>
        </div>
    </form>
</div>
@endsection

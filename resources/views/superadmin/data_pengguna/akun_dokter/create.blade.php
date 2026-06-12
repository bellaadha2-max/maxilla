@extends('layouts.dashboard')

@section('title', 'Tambah Dokter Baru')

@section('content')
<div class="mb-6 flex items-center gap-4 relative z-10">
    <a href="{{ route('superadmin.dokter.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </a>
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Tambah Dokter Baru</h1>
        <p class="text-slate-500 mt-1 text-sm">Daftarkan akun dokter yang dikelola superadmin.</p>
    </div>
</div>

<div class="max-w-4xl">
    <form action="{{ route('superadmin.dokter.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Informasi Dokter</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Nama Lengkap Dokter</label>
                    <select name="nama" class="w-full border @error('nama') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm outline-none bg-white cursor-pointer" required>
                        <option value="">-- Pilih Dokter dari Jadwal --</option>
                        @foreach($availableDokters as $dokter)
                            <option value="{{ $dokter }}" {{ old('nama') == $dokter ? 'selected' : '' }}>{{ $dokter }}</option>
                        @endforeach
                    </select>
                    @if(count($availableDokters) === 0)
                        <p class="text-xs text-orange-500 font-medium mt-1">* Semua dokter pada jadwal cabang sudah memiliki akun.</p>
                    @endif
                    @error('nama') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Nomor WhatsApp</label>
                    <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="w-full border @error('no_wa') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm outline-none" required>
                    @error('no_wa') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm outline-none" required>
                    @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Password</label>
                    <input type="password" name="password" class="w-full border @error('password') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm outline-none" required>
                    @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none" required>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('superadmin.dokter.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all">Batal</a>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-all active:scale-95">Simpan Data Dokter</button>
        </div>
    </form>
</div>
@endsection

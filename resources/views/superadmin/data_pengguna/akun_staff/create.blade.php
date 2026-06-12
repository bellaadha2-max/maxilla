@extends('layouts.dashboard')

@section('title', 'Tambah Akun ' . $roleLabel)

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Tambah {{ $roleLabel }}</h1>
        <p class="text-slate-500 mt-1 text-sm">Buat akun baru untuk petugas {{ strtolower($roleLabel) }} cabang.</p>
    </div>
    <a href="{{ route('superadmin.' . $roleSlug . '.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-bold border border-slate-200 hover:bg-slate-200 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="max-w-4xl">
    <form action="{{ route('superadmin.' . $roleSlug . '.store') }}" method="POST" class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-4">
                <h3 class="text-xs font-black text-blue-600 uppercase tracking-widest border-b border-blue-50 pb-2">Informasi Pribadi</h3>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-medium transition-all" placeholder="Masukkan nama lengkap...">
                    @error('nama') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                    <input type="text" name="no_wa" value="{{ old('no_wa') }}" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-medium transition-all" placeholder="Contoh: 08123456789">
                    @error('no_wa') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Penempatan Cabang</label>
                    <select name="cabang" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-bold transition-all appearance-none bg-white">
                        <option value="">Pilih Cabang...</option>
                        <option value="slawi" {{ old('cabang') == 'slawi' ? 'selected' : '' }}>Klinik Slawi</option>
                        <option value="tegal" {{ old('cabang') == 'tegal' ? 'selected' : '' }}>Klinik Tegal</option>
                        <option value="brebes" {{ old('cabang') == 'brebes' ? 'selected' : '' }}>Klinik Brebes</option>
                    </select>
                    @error('cabang') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xs font-black text-emerald-600 uppercase tracking-widest border-b border-emerald-50 pb-2">Kredensial Login</h3>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-medium transition-all" placeholder="email@maxilla.com">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-medium transition-all" placeholder="Min. 8 karakter">
                    @error('password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm font-medium transition-all" placeholder="Ulangi password">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-slate-100">
            <button type="submit" class="inline-flex items-center gap-3 px-8 py-3.5 bg-blue-600 text-white rounded-2xl text-sm font-black uppercase tracking-widest shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                Simpan Akun {{ $roleLabel }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection

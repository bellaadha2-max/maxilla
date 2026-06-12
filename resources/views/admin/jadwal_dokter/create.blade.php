@extends('layouts.admin')

@section('title', 'Tambah Jadwal Shift Dokter')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.jadwal.index') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 hover:bg-blue-50 transition-all active:scale-95 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Tambah Jadwal Shift Dokter</h1>
            <p class="text-slate-500 mt-1 text-sm font-medium">Cabang aktif: {{ ucfirst($activeCabang ?? '-') }}.</p>
        </div>
    </div>
</div>

@if($errors->any())
<div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
    {{ $errors->first() }}
</div>
@endif

<div class="max-w-3xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.jadwal.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nama Dokter</label>
                    <input type="text" name="dokter_nama" value="{{ old('dokter_nama') }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none" placeholder="Contoh: drg. Amanda Putri" required>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Hari</label>
                    <select name="hari" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none" required>
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ old('hari') === $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none" required>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Kuota Pasien</label>
                    <input type="number" name="kuota" min="1" max="100" value="{{ old('kuota', 15) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none" required>
                </div>
            </div>

            <div class="rounded-2xl border border-indigo-100 bg-indigo-50/70 px-4 py-3 text-xs font-medium text-indigo-800">
                Sistem akan menolak jadwal yang bentrok untuk dokter yang sama di cabang lain pada hari dan rentang jam yang sama.
            </div>

            <div class="pt-1 flex items-center justify-end gap-2">
                <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition-all">Batal</a>
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition-all">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>
@endsection

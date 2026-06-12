@extends('layouts.dashboard')

@section('title', 'Detail Profil Pasien')

@section('content')
<div class="mb-6 flex items-center justify-between gap-5 relative z-10">
    <div class="flex items-center gap-4">
        <a href="{{ route('superadmin.pasien.index') }}" class="p-2 bg-white border border-slate-200 text-slate-400 rounded-xl hover:text-slate-600 hover:border-slate-300 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="font-heading text-2xl font-bold text-slate-800 tracking-tight">Detail Profil Pasien</h1>
            <p class="text-slate-500 text-sm">Informasi lengkap rekam medis dan data pribadi pasien.</p>
        </div>
    </div>
    <div class="flex gap-3">
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Kolom Kiri: Profil Singkat -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-blue-600 to-indigo-700"></div>
            <div class="relative z-10">
                <div class="inline-flex p-1 bg-white rounded-full shadow-lg mb-4">
                    <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-4xl font-black border-4 border-white overflow-hidden">
                        @if($pasien->foto)
                            <img src="{{ asset('storage/'.$pasien->foto) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($pasien->nama, 0, 1)) }}
                        @endif
                    </div>
                </div>
                <h2 class="text-xl font-black text-slate-800">{{ $pasien->nama }}</h2>
                <div class="flex items-center justify-center gap-2 mt-2">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[11px] font-black uppercase tracking-wider rounded-full border border-blue-100">
                        No. RM: {{ $pasien->no_rm ?? str_pad($pasien->id_user, 5, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="px-3 py-1 {{ $pasien->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }} text-[11px] font-black uppercase tracking-wider rounded-full border">
                        {{ $pasien->is_active ? 'Status: Aktif' : 'Status: Non-Aktif' }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-8 pt-8 border-t border-slate-100">
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terdaftar Pada</p>
                        <p class="text-sm font-bold text-slate-700">{{ $pasien->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tipe Pasien</p>
                        <p class="text-sm font-bold text-blue-600 uppercase">{{ $pasien->tipe_pasien ?? 'Umum' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h4 class="font-black text-slate-800 text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Kontak Pasien
            </h4>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Email</p>
                        <p class="text-sm font-bold text-slate-700">{{ $pasien->email }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">WhatsApp / No. Telp</p>
                        <p class="text-sm font-bold text-slate-700">{{ $pasien->no_wa }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail & Rekam -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Informasi Identitas -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    Identitas Kependudukan (NIK)
                </h3>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nomor Induk Kependudukan (NIK)</p>
                        <h4 class="text-lg font-black text-slate-800 tracking-wider">
                            {{ $pasien->nik ? substr($pasien->nik, 0, 6) . ' - ' . substr($pasien->nik, 6, 6) . ' - ' . substr($pasien->nik, 12) : '-' }}
                        </h4>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Jenis Kelamin</p>
                        <h4 class="text-base font-bold text-slate-700">
                            {{ $pasien->pasien->jenis_kelamin ?? '-' }}
                        </h4>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Tanggal Lahir</p>
                        <h4 class="text-base font-bold text-slate-700">
                            {{ $pasien->pasien && $pasien->pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->pasien->tanggal_lahir)->format('d F Y') : '-' }}
                            <span class="text-slate-400 text-sm font-medium ml-1">({{ $pasien->pasien && $pasien->pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->pasien->tanggal_lahir)->age : '-' }} Tahun)</span>
                        </h4>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Alamat Lengkap</p>
                        <h4 class="text-sm font-bold text-slate-700 leading-relaxed">
                            {{ $pasien->pasien->alamat ?? 'Alamat belum dilengkapi' }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histori Kunjungan -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Histori Kunjungan
                </h3>
            </div>
            
            <div class="divide-y divide-slate-100">
                @forelse($kunjungans as $kunjungan)
                <div class="p-6 hover:bg-slate-50/50 transition-colors">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d F Y') }} <span class="text-slate-400 font-medium text-sm ml-1">• {{ $kunjungan->jam }}</span></h4>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 mt-1">
                                    <p class="text-sm text-slate-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        Cabang {{ ucfirst($kunjungan->cabang) }}
                                    </p>
                                    <span class="hidden sm:inline text-slate-300">•</span>
                                    <p class="text-sm text-slate-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $kunjungan->dokter_nama }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right flex flex-row sm:flex-col justify-between sm:justify-center items-center sm:items-end gap-2">
                            <span class="px-3 py-1 bg-{{ $kunjungan->status == 'Selesai' ? 'emerald' : ($kunjungan->status == 'Batal' ? 'rose' : 'blue') }}-50 text-{{ $kunjungan->status == 'Selesai' ? 'emerald' : ($kunjungan->status == 'Batal' ? 'rose' : 'blue') }}-600 text-[11px] font-black uppercase tracking-wider rounded-full border border-{{ $kunjungan->status == 'Selesai' ? 'emerald' : ($kunjungan->status == 'Batal' ? 'rose' : 'blue') }}-100">
                                {{ $kunjungan->status }}
                            </span>
                            @if($kunjungan->keluhan)
                                <p class="text-xs text-slate-400 font-medium italic max-w-[200px] truncate" title="{{ $kunjungan->keluhan }}">Keluhan: {{ Str::limit($kunjungan->keluhan, 25) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <div class="p-4 bg-slate-50 inline-block rounded-full mb-4">
                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="text-slate-400 font-bold">Belum Ada Histori Kunjungan</h4>
                    <p class="text-slate-400 text-xs mt-1 max-w-sm mx-auto">Pasien ini belum pernah melakukan reservasi atau kunjungan ke klinik.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

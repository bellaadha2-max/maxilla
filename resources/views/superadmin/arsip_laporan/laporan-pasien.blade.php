@extends('layouts.dashboard')

@section('title', 'Laporan Kunjungan Pasien')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Laporan Kunjungan Pasien</h1>
        <p class="text-slate-500 mt-1 text-sm">Rekapitulasi total pasien per cabang dan layanan bedasarkan periode tanggal.</p>
    </div>
    <!-- <div class="flex gap-2 relative">
        <button class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all flex items-center gap-2 active:scale-95 shadow-sm group">
            <svg class="w-5 h-5 text-indigo-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Export PDF
        </button>
        <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-[0_4px_12px_rgba(79,70,229,0.25)] hover:shadow-[0_6px_16px_rgba(79,70,229,0.35)] flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Buat Laporan Baru
        </button>
    </div> -->
</div>

<!-- ========================================== -->
<!-- KPI STATS -->
<!-- ========================================== -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-indigo-600 rounded-xl p-5 shadow-lg text-white relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 opacity-10"><svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></div>
        <div class="relative z-10">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Total Kunjungan</p>
            <h3 class="text-4xl font-black">{{ $totalKunjungan }}</h3>
            <p class="text-[12px] font-medium text-indigo-100 mt-2">Periode {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Pasien Umum</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">{{ $pasienUmum }}</h3>
    </div>
    
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm relative overflow-hidden">
        <div class="absolute right-0 top-0 w-1.5 h-full bg-emerald-500"></div>
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Pasien BPJS</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">{{ $pasienBPJS }}</h3>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-rose-50 text-rose-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Tingkat Batal / No-Show</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">{{ $cancelRate }}<span class="text-lg text-slate-400 ml-1">%</span></h3>
    </div>
</div>

<!-- ========================================== -->
<!-- FILTER BAR -->
<!-- ========================================== -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8 p-5">
    <form method="GET" class="flex flex-col lg:flex-row lg:items-end w-full gap-4">
        <div class="w-full lg:w-1/5">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Cabang Klinik</label>
            <select name="cabang" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 outline-none font-medium cursor-pointer">
                <option value="semua" {{ $cabang === 'semua' ? 'selected' : '' }}>Semua Cabang (Kumulatif)</option>
                @foreach ($cabangList as $cab)
                    <option value="{{ $cab }}" {{ $cabang === $cab ? 'selected' : '' }}>Cabang {{ $cab }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full lg:w-1/4">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Pencarian</label>
            <input type="text" name="search" placeholder="Cari nama pasien..." value="{{ $search }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl p-2.5 outline-none placeholder-slate-400" />
        </div>
        <div class="flex-1 flex gap-2">
            <div class="flex-1">
                <label class="block text-xs font-bold text-slate-500 mb-1.5">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl p-2.5 outline-none">
            </div>
            <div class="flex-1">
                <label class="block text-xs font-bold text-slate-500 mb-1.5">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl p-2.5 outline-none">
            </div>
        </div>
        <div class="w-full lg:w-auto mt-4 lg:mt-0 flex gap-2">
            <button type="submit" class="flex-1 lg:flex-none px-5 py-2.5 bg-slate-800 text-white rounded-xl text-sm font-bold hover:bg-slate-900 transition-colors shadow-sm focus:ring-2 focus:ring-slate-300 active:scale-95">Terapkan Filter</button>
            @if ($search || $cabang !== 'semua')
                <a href="/superadmin/laporan/pasien" class="flex-1 lg:flex-none px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-300 transition-colors shadow-sm active:scale-95">Reset</a>
            @endif
        </div>
    </form>
</div>

<!-- ========================================== -->
<!-- TABLE VIEW -->
<!-- ========================================== -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
    @if ($riwayatPasien->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-6 py-4">ID Registrasi</th>
                        <th class="px-6 py-4">Data Pasien</th>
                        <th class="px-6 py-4">Waktu Kunjungan</th>
                        <th class="px-6 py-4">Keluhan / Tindakan</th>
                        <th class="px-6 py-4">Dokter Penanggung Jawab</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[13px]">
                    @foreach ($riwayatPasien as $pasien)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-bold text-indigo-600">{{ $pasien->id_reservasi }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">{{ $pasien->nama_pasien ?? $pasien->user->nama ?? '-' }}</span>
                                    <span class="text-[11px] text-slate-500">Cab. {{ $pasien->cabang ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($pasien->tanggal)->format('d M Y') }}</span>
                                    <span class="text-[11px] text-slate-500">{{ $pasien->jam ?? '-' }} WIB</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start">
                                    <span class="font-medium text-slate-700">{{ $pasien->keluhan ?? '-' }}</span>
                                    <!-- <span class="text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                        {{ $pasien->transaksi?->metode_pembayaran ?? 'Belum dibayar' }}
                                    </span> -->
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-slate-700">
                                    {{ $pasien->dokter_nama ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($pasien->status === 'Selesai')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-[11px] font-bold text-emerald-700">Selesai</span>
                                @elseif ($pasien->status === 'Batal')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 border border-rose-100 text-[11px] font-bold text-rose-700">Batal</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[11px] font-bold text-slate-600">{{ $pasien->status ?? 'Proses' }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            </div>
            <p class="text-slate-600 font-bold">Tidak ada data kunjungan untuk kriteria yang dipilih</p>
            <p class="text-slate-500 text-sm mt-1">Coba sesuaikan filter untuk melihat data</p>
        </div>
    @endif
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Laporan Pembayaran</h1>
        <p class="text-slate-500 mt-1 text-sm">Rekapitulasi transaksi pembayaran pasien berdasarkan periode tanggal, cabang, dan nama pasien.</p>
    </div>
    <div class="flex gap-2 relative">
        <!-- <button class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all flex items-center gap-2 active:scale-95 shadow-sm group">
            <svg class="w-5 h-5 text-indigo-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Export PDF
        </button> -->
    </div>
</div>

<!-- ========================================== -->
<!-- KPI STATS -->
<!-- ========================================== -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-indigo-600 rounded-xl p-5 shadow-lg text-white relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 opacity-10"><svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></div>
        <div class="relative z-10">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Total Transaksi</p>
            <h3 class="text-4xl font-black">{{ $totalTransaksi }}</h3>
            <p class="text-[12px] font-medium text-indigo-300 mt-2">{{ $cabang && $cabang !== 'semua' ? 'Cabang ' . $cabang : 'Semua Cabang' }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Nominal</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">Rp {{ number_format($totalNominal, 0, ',', '.') }}</h3>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Rata-rata Transaksi</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">Rp {{ number_format($rataRata, 0, ',', '.') }}</h3>
    </div>
</div>

<!-- ========================================== -->
<!-- FILTER BAR -->
<!-- ========================================== -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8 p-5">
    <form action="{{ route('superadmin.laporan-pembayaran') }}" method="GET" class="flex flex-col lg:flex-row lg:items-end w-full gap-4">
        <div class="w-full lg:w-1/4">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Cabang Klinik</label>
            <select name="cabang" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 outline-none font-medium cursor-pointer">
                <option value="semua" {{ $cabang === 'semua' || !$cabang ? 'selected' : '' }}>Semua Cabang</option>
                @foreach($cabangList as $cb)
                    <option value="{{ $cb }}" {{ $cabang === $cb ? 'selected' : '' }}>Cabang {{ $cb }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full lg:w-1/4">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Cari Nama/ID</label>
            <input type="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Nama pasien atau ID reservasi..." class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 outline-none font-medium">
        </div>
        <div class="w-full lg:w-1/4">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ old('start_date', $startDate ?? '') }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 outline-none font-medium">
        </div>
        <div class="w-full lg:w-1/4">
            <label class="block text-xs font-bold text-slate-500 mb-1.5">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ old('end_date', $endDate ?? '') }}" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 outline-none font-medium">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-[0_4px_12px_rgba(79,70,229,0.25)] active:scale-95">
                Filter
            </button>
            @if(($cabang && $cabang !== 'semua') || $search || $startDate || $endDate)
                <a href="{{ route('superadmin.laporan-pembayaran') }}" class="px-6 py-2.5 bg-slate-100 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-200 transition-all active:scale-95">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- ========================================== -->
<!-- TABLE PEMBAYARAN -->
<!-- ========================================== -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    @if($pembayaran->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">ID Reservasi</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">Nama Pasien</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">Cabang</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">Total Bayar</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($pembayaran as $transaksi)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800">{{ $transaksi->reservasi->id_reservasi ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-800">{{ $transaksi->reservasi->nama_pasien ?? ($transaksi->reservasi->user->nama ?? 'Pasien') }}</p>
                                <!-- <p class="text-xs text-slate-500">{{ $transaksi->reservasi->user->email ?? '-' }}</p> -->
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold">{{ $transaksi->reservasi->cabang }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-emerald-600">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg text-xs font-bold capitalize">{{ $transaksi->metode_pembayaran ?? 'Cash' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-600 font-medium">{{ $transaksi->created_at->format('d M Y H:i') }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-slate-600 font-medium">Tidak ada data pembayaran untuk kriteria yang dipilih.</p>
        </div>
    @endif
</div>
@endsection

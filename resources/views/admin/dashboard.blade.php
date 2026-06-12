@extends('layouts.admin')

@section('title', 'Dashboard Admin Cabang')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div>
            <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Dashboard Maxilla {{ ucfirst(auth()->user()->cabang ?? 'Cabang') }}</h1>
            <p class="text-slate-500 mt-1 text-sm font-medium">Selamat datang kembali! Berikut ringkasan operasional klinik hari ini.</p>
        </div>
    </div>
    <div class="flex gap-3">
        <div class="px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-2">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-xs font-black text-emerald-600 uppercase tracking-wider">Sistem Online</span>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- OPERATIONAL KPI STATS -->
<!-- ========================================== -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
        <div class="absolute -right-4 -bottom-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
            <svg class="w-32 h-32 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87"></path><path d="M16 3.13a4 4 0 010 7.75"></path></svg>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Pasien Baru</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">{{ $stats['pasien_hari_ini'] }}</h3>
        <p class="text-[11px] font-bold text-slate-400 mt-1 italic">Pendaftaran via Portal Hari Ini</p>
    </div>
    
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
        <div class="absolute -right-4 -bottom-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
            <svg class="w-32 h-32 text-orange-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-orange-50 text-orange-600 rounded-2xl group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Antrean Aktif</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $stats['antrean_aktif'] }}</h3>
        <p class="text-[11px] font-bold text-orange-500 mt-1 flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"></path></svg>
            {{ $stats['antrean_aktif'] }} Pasien Sedang Menunggu
        </p>
    </div>
    
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-all group overflow-hidden relative border-l-4 border-l-indigo-500">
        <div class="absolute -right-4 -bottom-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
            <svg class="w-32 h-32 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"></path></svg>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Jadwal Dokter</p>
        </div>
        <h3 class="text-3xl font-black text-slate-800">{{ $stats['jadwal_dokter'] }}</h3>
        <p class="text-[11px] font-bold text-slate-400 mt-1 truncate">Dokter Praktik di Sesi Ini</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <!-- Antrean Berjalan (Visual Placeholder) -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col min-h-[400px]">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Antrean Berjalan
            </h3>
            <a href="{{ route('admin.booking.index') }}" class="text-[11px] font-black text-blue-600 hover:text-blue-800 uppercase tracking-wider">Kelola Semua</a>
        </div>
        
        @if($activeQueues->count() > 0)
        <div class="flex-1 overflow-auto">
            <div class="divide-y divide-slate-100">
                @foreach($activeQueues as $queue)
                <div class="p-5 hover:bg-slate-50 transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full {{ strtolower($queue->status) == 'diproses' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }} flex items-center justify-center font-black text-xs border border-transparent shadow-sm">
                            {{ substr($queue->nama_pasien ?? ($queue->user ? $queue->user->nama : 'N/A'), 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-[15px] group-hover:text-blue-600 transition-colors">
                                {{ $queue->nama_pasien ?? ($queue->user ? $queue->user->nama : 'Pasien Tidak Diketahui') }}
                            </p>
                            <p class="text-xs font-semibold text-slate-500 mt-0.5">Dokter: {{ $queue->dokter_nama ?? 'Belum Ditentukan' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 {{ strtolower($queue->status) == 'diproses' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-orange-50 text-orange-600 border-orange-100' }} rounded-full text-[10px] font-black uppercase tracking-wider border">
                            @if(strtolower($queue->status) == 'diproses')
                                <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            @else
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                            @endif
                            {{ $queue->status }}
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 mt-2">{{ preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $queue->jam) ? \Carbon\Carbon::parse($queue->jam)->format('H:i') : ucfirst($queue->jam) }} WIB</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="flex-1 flex flex-col items-center justify-center p-12 text-center opacity-60">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center text-slate-300 mb-6 border-4 border-white shadow-sm">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h4 class="text-slate-800 font-bold text-lg">Semua Antrean Selesai</h4>
            <p class="text-slate-500 text-sm mt-2 max-w-sm">Belum ada pasien yang masuk antrean saat ini. Cek kembali nanti.</p>
        </div>
        @endif
    </div>

    <!-- Quick Access / Info -->
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
            <h4 class="font-black text-slate-800 text-xs uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Sesi Dokter Hari Ini
            </h4>
            <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2">
                @forelse($jadwalHariIni as $jadwal)
                @php
                    $themes = [
                        ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'hover_border' => 'hover:border-blue-200', 'hover_text' => 'group-hover:text-blue-700'],
                        ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'hover_border' => 'hover:border-purple-200', 'hover_text' => 'group-hover:text-purple-700'],
                        ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'hover_border' => 'hover:border-emerald-200', 'hover_text' => 'group-hover:text-emerald-700'],
                        ['bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'hover_border' => 'hover:border-orange-200', 'hover_text' => 'group-hover:text-orange-700'],
                    ];
                    $theme = $themes[$loop->index % count($themes)];
                @endphp
                <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3 {{ $theme['hover_border'] }} transition-colors group">
                    <div class="w-10 h-10 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} flex items-center justify-center font-bold text-xs shrink-0">
                        {{ strtoupper(substr(str_replace(['Drg. ', 'drg. '], '', $jadwal->dokter_nama), 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 leading-tight {{ $theme['hover_text'] }} transition-colors">{{ $jadwal->dokter_nama }}</p>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $jadwal->poli }} • {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center border border-dashed border-slate-200 rounded-2xl">
                    <p class="text-slate-400 text-xs font-bold">Tidak ada dokter jaga hari ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

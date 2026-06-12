@extends('layouts.admin')

@section('title', 'Detail Pasien - ' . $schedule['dokter'])

@section('content')
@if(session('success'))
<div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
    {{ session('success') }}
</div>
@endif

<!-- ========================================== -->
<!-- HEADER & NAVIGATION -->
<!-- ========================================== -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.jadwal.index') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 hover:bg-blue-50 transition-all active:scale-95 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="font-heading text-2xl font-bold text-slate-800 tracking-tight">Daftar Pasien Terdaftar</h1>
            <p class="text-slate-500 mt-0.5 text-sm font-medium">Monitoring pasien untuk {{ $schedule['dokter'] }} pada hari {{ $schedule['hari'] }}.</p>
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.jadwal.edit', ['id' => $schedule['id']]) }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all flex items-center gap-2 active:scale-95 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.586-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"></path></svg>
            Edit Jadwal
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- ========================================== -->
    <!-- DOCTOR INFO CARD (LEFT) -->
    <!-- ========================================== -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full opacity-50"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 rounded-3xl bg-blue-600 text-white flex items-center justify-center text-3xl font-black shadow-xl shadow-blue-200 mb-6">
                    {{ substr($schedule['dokter'], 5, 1) }}
                </div>
                
                <h2 class="text-xl font-black text-slate-800 leading-tight mb-2">{{ $schedule['dokter'] }}</h2>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-50 text-slate-400 rounded-lg flex items-center justify-center border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Hari & Sesi</p>
                            <p class="text-[13px] font-bold text-slate-700">{{ $schedule['hari'] }} (Sesi {{ $schedule['sesi'] ?? '-' }})</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-50 text-slate-400 rounded-lg flex items-center justify-center border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Jam Praktik</p>
                            <p class="text-[13px] font-bold text-slate-700">{{ $schedule['jam'] }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATS SMALL -->
        <div class="bg-slate-900 rounded-3xl p-6 text-white shadow-xl">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Ringkasan Kuota {{ $schedule['hari'] }}</h4>
            <div class="flex items-end justify-between border-b border-slate-800 pb-4 mb-4">
                <span class="text-sm font-medium text-slate-300">Total Pasien</span>
                <span class="text-2xl font-black leading-none">{{ count($patients) }}</span>
            </div>
            <div class="flex items-end justify-between border-b border-slate-800 pb-4 mb-4">
                <span class="text-sm font-medium text-slate-300">Kapasitas Maksimal</span>
                <span class="text-2xl font-black leading-none">{{ $schedule['kuota'] ?? 0 }}</span>
            </div>
            <div class="flex items-end justify-between">
                <span class="text-sm font-medium text-slate-300">Sisa Kuota</span>
                <span class="text-2xl font-black text-emerald-400 leading-none">{{ max(($schedule['kuota'] ?? 0) - count($patients), 0) }}</span>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- PATIENT TABLE (RIGHT) -->
    <!-- ========================================== -->
    <div class="lg:col-span-2">
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-white">
                <h3 class="font-bold text-slate-800">Antrean Pasien</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                            <th class="px-6 py-4">No. Antrean</th>
                            <th class="px-6 py-4">Nama Pasien</th>
                            <th class="px-6 py-4">Waktu Booking</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($patients as $patient)
                        <tr class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-6 py-5">
                                <span class="text-base font-black text-slate-800">{{ $patient['no_antrian'] }}</span>
                            </td>
                            <td class="px-6 py-5 text-slate-700 font-bold text-[14px]">
                                {{ $patient['nama'] }}
                            </td>
                            <td class="px-6 py-5 text-slate-500 font-medium text-xs font-mono">
                                {{ $patient['waktu'] }} WIB
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center">
                                    @if($patient['status'] == 'menunggu')
                                        <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-[10px] font-black uppercase border border-orange-100">
                                            Menunggu
                                        </span>
                                    @elseif($patient['status'] == 'diproses')
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase border border-blue-100 animate-pulse">
                                            Diproses
                                        </span>
                                    @else
                                        <span class="flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase border border-emerald-100">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(count($patients) == 0)
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-dashed border-slate-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <p class="text-sm font-medium text-slate-400">Belum ada pasien yang membooking untuk jadwal ini.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

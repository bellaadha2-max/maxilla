@extends('layouts.dokter')

@section('title', 'Jadwal Praktik')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Jadwal Praktik Anda</h1>
        <p class="text-slate-500 mt-1 text-sm">Berikut adalah seluruh jadwal shift Anda di Maxilla Dental Care.</p>
    </div>
    <div class="flex gap-3">
        <!-- Optional filter button placeholder -->
        <span class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            Semua Shift
        </span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @php
    $colorMap = [
        'Senin' => ['border' => 'border-blue-200/80 hover:border-blue-300', 'bg' => 'bg-blue-600', 'iconBg' => 'bg-blue-50', 'iconBorder' => 'border-blue-100', 'text' => 'text-blue-600'],
        'Selasa' => ['border' => 'border-cyan-200/80 hover:border-cyan-300', 'bg' => 'bg-cyan-600', 'iconBg' => 'bg-cyan-50', 'iconBorder' => 'border-cyan-100', 'text' => 'text-cyan-600'],
        'Rabu' => ['border' => 'border-indigo-200/80 hover:border-indigo-300', 'bg' => 'bg-indigo-600', 'iconBg' => 'bg-indigo-50', 'iconBorder' => 'border-indigo-100', 'text' => 'text-indigo-600'],
        'Kamis' => ['border' => 'border-violet-200/80 hover:border-violet-300', 'bg' => 'bg-violet-600', 'iconBg' => 'bg-violet-50', 'iconBorder' => 'border-violet-100', 'text' => 'text-violet-600'],
        'Jumat' => ['border' => 'border-emerald-200/80 hover:border-emerald-300', 'bg' => 'bg-emerald-600', 'iconBg' => 'bg-emerald-50', 'iconBorder' => 'border-emerald-100', 'text' => 'text-emerald-600'],
        'Sabtu' => ['border' => 'border-orange-200/80 hover:border-orange-300', 'bg' => 'bg-orange-600', 'iconBg' => 'bg-orange-50', 'iconBorder' => 'border-orange-100', 'text' => 'text-orange-600'],
        'Minggu' => ['border' => 'border-rose-200/80 hover:border-rose-300', 'bg' => 'bg-rose-600', 'iconBg' => 'bg-rose-50', 'iconBorder' => 'border-rose-100', 'text' => 'text-rose-600'],
    ];
    @endphp

    @forelse($jadwals as $jadwal)
        @php
            $c = $colorMap[$jadwal->hari] ?? $colorMap['Senin'];
        @endphp
        <div class="bg-white rounded-3xl border {{ $c['border'] }} p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 px-4 py-2 {{ $c['bg'] }} text-white text-[10px] font-black uppercase tracking-widest rounded-bl-2xl">
                {{ $jadwal->hari }}
            </div>
            <div class="flex items-start gap-4 mb-6 pt-2">
                <div class="w-14 h-14 rounded-2xl {{ $c['iconBg'] }} border {{ $c['iconBorder'] }} flex items-center justify-center {{ $c['text'] }} font-bold shadow-sm">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-[17px] font-black text-slate-800 leading-tight">{{ ucfirst($jadwal->sesi) }} ({{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }})</h3>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 mt-2 rounded-lg bg-indigo-50 border border-indigo-100 text-[11px] font-bold text-indigo-700">{{ $jadwal->cabang }}</span>
                </div>
            </div>
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex justify-between items-center">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kuota Pasien</p>
                    <p class="text-xl font-black text-slate-700">{{ $jadwal->kuota }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full py-8 text-center text-slate-500">
            <p>Belum ada jadwal praktik yang terdaftar untuk Anda.</p>
        </div>
    @endforelse
</div>
@endsection

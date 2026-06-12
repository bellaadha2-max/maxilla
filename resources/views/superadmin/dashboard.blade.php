@extends('layouts.dashboard')

@section('title', 'Dashboard Superadmin')

@section('content')
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-5 relative z-10">
        <div class="flex gap-2">
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Terakhir Update: <span id="last-update-time">{{ \Carbon\Carbon::now()->translatedFormat('H:i:s') }}</span>
            </span>
        </div>
    </div>

    <!-- ⚠️ Notifikasi & Peringatan (Alerts) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <!-- Alert 1 -->
        <div
            class="bg-red-50/80 border border-red-100 rounded-2xl p-4 flex gap-4 items-start shadow-sm hover:shadow-md transition-shadow">
            <div class="p-2 bg-red-100 text-red-600 rounded-xl shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-red-800">Dokter Tidak Hadir</h4>
                <p class="text-xs text-red-600/90 mt-1 font-medium leading-snug">Sistem memantau absensi dokter secara
                    otomatis setiap sesi.</p>
            </div>
        </div>
        <!-- Alert 2 -->
        <div
            class="bg-amber-50/80 border border-amber-100 rounded-2xl p-4 flex gap-4 items-start shadow-sm hover:shadow-md transition-shadow">
            <div class="p-2 bg-amber-100 text-amber-600 rounded-xl shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-amber-800">Antrian Menumpuk</h4>
                <p class="text-xs text-amber-700/90 mt-1 font-medium leading-snug">Notifikasi akan muncul jika antrian salah
                    satu cabang melebihi 10 pasien.</p>
            </div>
        </div>
        <!-- Alert 3 -->
        <div
            class="bg-blue-50/80 border border-blue-100 rounded-2xl p-4 flex gap-4 items-start shadow-sm hover:shadow-md transition-shadow">
            <div class="p-2 bg-blue-100 text-blue-600 rounded-xl shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-blue-800">Status Operasional</h4>
                <p class="text-xs text-blue-600/90 mt-1 font-medium leading-snug">Seluruh data yang ditampilkan adalah data
                    aktual dari database Maxilla.</p>
            </div>
        </div>
    </div>

    <!-- 📊 Ringkasan Hari Ini (3 Cabang Sekaligus) -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                Ringkasan Cabang Hari Ini
            </h2>
            <span
                class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(['slawi', 'tegal', 'brebes'] as $cabangName)
                @php
                    $stats = $cabangStats[$cabangName];
                    $statusColor = $stats['status'] === 'buka' ? 'emerald' : 'amber';
                @endphp
                <div id="card-{{ $cabangName }}"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300 {{ $stats['status'] === 'penuh' ? 'relative overflow-hidden' : '' }}">
                    <div id="warning-strip-{{ $cabangName }}"
                        class="absolute top-0 inset-x-0 h-1 bg-amber-400 {{ $stats['status'] === 'penuh' ? '' : 'hidden' }}">
                    </div>

                    <h3
                        class="text-base font-bold text-slate-800 mb-4 pb-4 border-b border-slate-100 flex items-center justify-between">
                        Klinik {{ ucfirst($cabangName) }}
                        <span id="status-badge-{{ $cabangName }}"
                            class="px-2.5 py-1 bg-{{ $statusColor }}-50 text-{{ $statusColor }}-600 text-[10px] font-black uppercase tracking-wider rounded-lg">{{ ucfirst($stats['status']) }}</span>
                    </h3>
                    <div class="grid grid-cols-2 gap-y-5 gap-x-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pasien</p>
                            <p id="total-pasien-{{ $cabangName }}" class="text-2xl font-black text-slate-700">
                                {{ $stats['total_pasien'] }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Dokter Aktif</p>
                            <p id="dokter-aktif-{{ $cabangName }}" class="text-2xl font-black text-slate-700">
                                {{ $stats['dokter_aktif'] }}</p>
                        </div>
                        <div class="bg-blue-50/50 p-2.5 rounded-xl border border-blue-100/50">
                            <p class="text-[11px] font-bold text-blue-500 uppercase tracking-wider mb-1">Selesai</p>
                            <p id="selesai-{{ $cabangName }}" class="text-xl font-black text-blue-700">{{ $stats['selesai'] }}
                            </p>
                        </div>
                        <div class="bg-amber-50/50 p-2.5 rounded-xl border border-amber-100/50">
                            <p class="text-[11px] font-bold text-amber-500 uppercase tracking-wider mb-1">Menunggu</p>
                            <p id="menunggu-{{ $cabangName }}" class="text-xl font-black text-amber-700">
                                {{ $stats['menunggu'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 📅 Statistik Bulan Ini & 📈 Grafik Perbandingan Kunjungan -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

        <!-- Statistik Bulan Ini -->
        <div class="xl:col-span-1 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex flex-col">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Statistik Bulan Ini
            </h2>

            <div class="space-y-4 flex-1">
                <!-- Item -->
                <div
                    class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-slate-600">Total Kunjungan Cabang</span>
                    </div>
                    <span id="monthly-total"
                        class="text-base font-black text-slate-800">{{ $monthStats['total_kunjungan'] }}</span>
                </div>
                <!-- Item -->
                <div
                    class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[13px] font-bold text-slate-600">Total Pasien Mandiri</span>
                        </div>
                    </div>
                    <span id="monthly-umum"
                        class="text-base font-black text-slate-800">{{ $monthStats['total_kunjungan'] }}</span>
                </div>
                <!-- Item -->
                <div
                    class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-slate-600">Total Batal / No-Show</span>
                    </div>
                    <div class="text-right">
                        <span id="monthly-batal"
                            class="text-base font-black text-slate-800">{{ $monthStats['total_no_show'] }}</span>
                        <span id="monthly-batal-rate"
                            class="text-[10px] font-bold text-rose-500 ml-1 bg-rose-50 px-1.5 py-0.5 rounded">({{ $monthStats['no_show_rate'] }}%)</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100">
                <div
                    class="p-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md relative overflow-hidden group">
                    <svg class="absolute -right-4 -bottom-4 w-20 h-20 text-white/10 group-hover:scale-110 transition-transform duration-500"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <p class="text-[11px] font-bold text-blue-100 uppercase tracking-widest mb-1 relative z-10">Cabang
                        Tersibuk Bulan Ini</p>
                    <p id="busiest-cabang" class="text-xl font-black relative z-10">{{ $monthStats['cabang_tersibuk'] }}</p>
                </div>
            </div>
        </div>

        <!-- Grafik Perbandingan Kunjungan -->
        <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex flex-col">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Perbandingan Kunjungan
                </h2>

                <div x-data="{ filter: 'bulan' }" class="inline-flex bg-slate-100 p-1 rounded-xl">
                    <button @click="filter = 'minggu'"
                        :class="filter === 'minggu' ? 'bg-white shadow text-blue-700' : 'text-slate-500 hover:text-slate-700'"
                        class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider rounded-lg transition-all">Minggu
                        Ini</button>
                    <button @click="filter = 'bulan'"
                        :class="filter === 'bulan' ? 'bg-white shadow text-blue-700' : 'text-slate-500 hover:text-slate-700'"
                        class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider rounded-lg transition-all">Bulan
                        Ini</button>
                    <button @click="filter = '3bulan'"
                        :class="filter === '3bulan' ? 'bg-white shadow text-blue-700' : 'text-slate-500 hover:text-slate-700'"
                        class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider rounded-lg transition-all">3 Bln
                        Terakhir</button>
                </div>
            </div>

            <div class="flex-1 w-full relative min-h-[300px]">
                <!-- Render Chart Here -->
                <div id="visitChart" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    <!-- 🦷 Dokter Aktif Hari Ini (Tabel) -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Dokter Aktif Hari Ini
            </h2>
            <a href="{{ route('superadmin.jadwal.index') }}"
                class="text-[13px] font-bold text-blue-600 hover:underline">Kelola &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                        <th class="px-6 py-4">Nama Dokter</th>
                        <th class="px-6 py-4">Cabang</th>
                        <th class="px-6 py-4">Sesi Shift</th>
                        <th class="px-6 py-4">Pasien Dilayani</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="doctor-list-body" class="divide-y divide-slate-100">
                    @forelse($schedulesToday as $jadwal)
                        @php
                            $themes = [
                                ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'bg-indigo-50 border-indigo-100', 'bar' => 'bg-blue-600'],
                                ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'border' => 'bg-rose-50 border-rose-100', 'bar' => 'bg-rose-500'],
                                ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'bg-emerald-50 border-emerald-100', 'bar' => 'bg-emerald-500'],
                                ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'border' => 'bg-amber-50 border-amber-100', 'bar' => 'bg-amber-500'],
                            ];
                            $theme = $themes[$loop->index % count($themes)];
                            $percentage = $jadwal->kuota > 0 ? min(100, ($jadwal->pasien_dilayani / $jadwal->kuota) * 100) : 0;
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} flex items-center justify-center font-bold text-xs shrink-0 uppercase">
                                        {{ strtoupper(substr(preg_replace('/^(drg\.|dr\.|drg|dr)\s+/i', '', $jadwal->dokter_nama), 0, 2)) }}
                                    </div>
                                    <span class="font-bold text-[14px] text-slate-800">{{ $jadwal->dokter_nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full {{ $theme['border'] }} text-[12px] font-bold text-slate-700 border">{{ ucfirst($jadwal->cabang) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-[13px] text-slate-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-full bg-slate-100 rounded-full h-2.5 max-w-[100px]">
                                        <div class="{{ $theme['bar'] }} h-2.5 rounded-full" style="width: {{ $percentage }}%">
                                        </div>
                                    </div>
                                    <span class="text-[13px] font-bold text-slate-700">{{ $jadwal->pasien_dilayani }} /
                                        {{ $jadwal->kuota }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('superadmin.jadwal.index', ['cabang' => $jadwal->cabang]) }}"
                                    class="inline-block p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943-9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-medium">
                                Tidak ada dokter yang bertugas hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // --- 1. REALTIME UPDATER ---
            async function fetchRealtimeStats() {
                try {
                    const response = await fetch('{{ route("api.superadmin.stats") }}');
                    const data = await response.json();

                    // Update Timestamp
                    document.getElementById('last-update-time').innerText = data.timestamp.split(', ')[1];

                    // Update Cabang Cards
                    for (let cabang in data.cabangStats) {
                        const stats = data.cabangStats[cabang];

                        document.getElementById(`total-pasien-${cabang}`).innerText = stats.total_pasien;
                        document.getElementById(`dokter-aktif-${cabang}`).innerText = stats.dokter_aktif;
                        document.getElementById(`selesai-${cabang}`).innerText = stats.selesai;
                        document.getElementById(`menunggu-${cabang}`).innerText = stats.menunggu;

                        const badge = document.getElementById(`status-badge-${cabang}`);
                        badge.innerText = stats.status.charAt(0).toUpperCase() + stats.status.slice(1);

                        const strip = document.getElementById(`warning-strip-${cabang}`);
                        const card = document.getElementById(`card-${cabang}`);

                        if (stats.status === 'penuh') {
                            strip.classList.remove('hidden');
                            card.classList.add('relative', 'overflow-hidden');
                            badge.className = 'px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-wider rounded-lg';
                        } else {
                            strip.classList.add('hidden');
                            badge.className = 'px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-wider rounded-lg';
                        }
                    }

                    // Update Monthly Stats
                    document.getElementById('monthly-total').innerText = data.monthStats.total_kunjungan;
                    document.getElementById('monthly-umum').innerText = data.monthStats.total_kunjungan;
                    document.getElementById('monthly-batal').innerText = data.monthStats.total_no_show;
                    document.getElementById('monthly-batal-rate').innerText = `(${data.monthStats.no_show_rate}%)`;
                    document.getElementById('busiest-cabang').innerText = data.monthStats.cabang_tersibuk;

                    // Update Doctor Table (Simplified for performance)
                    const tbody = document.getElementById('doctor-list-body');
                    if (data.doctorList.length > 0) {
                        let html = '';
                        const themes = [
                            { bg: 'bg-blue-100', text: 'text-blue-700', border: 'bg-indigo-50 border-indigo-100', bar: 'bg-blue-600' },
                            { bg: 'bg-rose-100', text: 'text-rose-700', border: 'bg-rose-50 border-rose-100', bar: 'bg-rose-500' },
                            { bg: 'bg-emerald-100', text: 'text-emerald-700', border: 'bg-emerald-50 border-emerald-100', bar: 'bg-emerald-500' },
                            { bg: 'bg-amber-100', text: 'text-amber-700', border: 'bg-amber-50 border-amber-100', bar: 'bg-amber-500' },
                        ];

                        data.doctorList.forEach((doc, idx) => {
                            const theme = themes[idx % themes.length];
                            const initials = doc.dokter_nama.replace(/^(drg\.|dr\.|drg|dr)\s+/i, '').substring(0, 2).toUpperCase();
                            html += `
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full ${theme.bg} ${theme.text} flex items-center justify-center font-bold text-xs shrink-0 uppercase">${initials}</div>
                                            <span class="font-bold text-[14px] text-slate-800">${doc.dokter_nama}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full ${theme.border} text-[12px] font-bold text-slate-700 border">${doc.cabang.charAt(0).toUpperCase() + doc.cabang.slice(1)}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-medium text-[13px] text-slate-600 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            ${doc.jam}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-full bg-slate-100 rounded-full h-2.5 max-w-[100px]">
                                                <div class="${theme.bar} h-2.5 rounded-full" style="width: ${doc.percentage}%"></div>
                                            </div>
                                            <span class="text-[13px] font-bold text-slate-700">${doc.pasien_dilayani} / ${doc.kuota}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="/superadmin/jadwal-dokter?cabang=${doc.cabang}" class="inline-block p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943-9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });
                        tbody.innerHTML = html;
                    }
                } catch (error) {
                    console.error("Realtime update error:", error);
                }
            }

            // Jalankan polling setiap 5 detik
            setInterval(fetchRealtimeStats, 5000);


            // --- 2. APEX CHARTS ---
            var options = {
                series: [{
                    name: 'Cabang Slawi',
                    data: [31, 40, 28, 51, 42]
                }, {
                    name: 'Cabang Tegal',
                    data: [11, 32, 45, 32, 34]
                }, {
                    name: 'Cabang Brebes',
                    data: [4, 15, 20, 25, 22]
                }],
                chart: {
                    height: 300,
                    type: 'area', // Mixed area/line looks great
                    parentHeightOffset: 0,
                    toolbar: { show: false },
                    fontFamily: 'Arial, Helvetica, sans-serif'
                },
                colors: ['#2563eb', '#f59e0b', '#10b981'], // Primary, Amber, Emerald
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.25,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'],
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '12px', fontWeight: 600 }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '12px', fontWeight: 600 }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    markers: { radius: 12 },
                    itemMargin: { horizontal: 10, vertical: 0 }
                },
                tooltip: { theme: 'light' }
            };

            var chart = new ApexCharts(document.querySelector("#visitChart"), options);
            chart.render();
        });
    </script>
@endsection
@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Hai, {{ auth()->user()->nama ?? 'Dokter' }}!</h1>
        <p class="text-slate-500 mt-1 text-sm">Ringkasan praktik dan antrian pasien Anda hari ini di klinik.</p>
    </div>
    <div class="flex gap-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-100 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            Terakhir Update: <span id="update-time">{{ \Carbon\Carbon::now()->translatedFormat('H:i:s') }}</span>
        </span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 pointer-events-none">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Antrian Hari Ini</p>
            <p class="text-2xl font-black text-slate-700"><span id="stat-total">{{ $stats['total'] }}</span> <span class="text-xs text-slate-400 font-medium ml-1">Pasien</span></p>
        </div>
    </div>
    <!-- Stat 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 pointer-events-none">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Selesai Diperiksa</p>
            <p class="text-2xl font-black text-emerald-600"><span id="stat-selesai">{{ $stats['selesai'] }}</span> <span class="text-xs text-emerald-500/70 font-medium ml-1">Pasien</span></p>
        </div>
    </div>
    <!-- Stat 3 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 pointer-events-none">
        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Menunggu</p>
            <p class="text-2xl font-black text-amber-600"><span id="stat-menunggu">{{ $stats['menunggu'] }}</span> <span class="text-xs text-amber-500/70 font-medium ml-1">Pasien</span></p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 relative z-10">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 overflow-hidden relative group hover:shadow-md transition-all">
        <div class="absolute top-0 right-0 p-8 text-blue-50 opacity-50 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
            <svg class="w-32 h-32 transform rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-slate-800 mb-2">Jadwal Praktik Saya</h2>
            <p class="text-sm text-slate-500 mb-6 max-w-sm">Kelola jadwal shift Anda, periksa ketersediaan waktu dan detail sesi secara lengkap.</p>
            <a href="{{ route('dokter.jadwal') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 active:scale-95 transition-all">
                Kelola Jadwal
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 overflow-hidden relative group hover:shadow-md transition-all">
        <div class="absolute top-0 right-0 p-8 text-emerald-50 opacity-50 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
            <svg class="w-32 h-32 transform rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-slate-800 mb-2">Antrian & Rekam Medis</h2>
            <p class="text-sm text-slate-500 mb-6 max-w-sm">Lihat daftar antrian pasien hari ini dan berikan diagnosa pada e-Rekam Medis pasien Anda.</p>
            <a href="{{ route('dokter.antrian') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 active:scale-95 transition-all">
                Mulai Pelayanan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>

<script>
    async function updateDoctorStats() {
        try {
            const response = await fetch('{{ route("api.dokter.stats") }}');
            const data = await response.json();
            
            // Update Stats
            document.getElementById('stat-total').innerText = data.stats.total;
            document.getElementById('stat-selesai').innerText = data.stats.selesai;
            document.getElementById('stat-menunggu').innerText = data.stats.menunggu;
            
            // Update Time
            document.getElementById('update-time').innerText = data.timestamp;
        } catch (error) {
            console.error('Error updating doctor stats:', error);
        }
    }

    // Update every 5 seconds
    setInterval(updateDoctorStats, 5000);
</script>
@endsection

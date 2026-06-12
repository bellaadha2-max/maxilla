@extends('layouts.admin')

@section('title', 'Jadwal Shift Dokter')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">

        <div class="flex gap-3">
            <a href="{{ route('admin.jadwal.create') }}"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Shift
            </a>
        </div>
    </div>

    <div>
        @if(session('success'))
            <div
                class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div x-data="{ activeDay: '{{ $schedules[0]['hari'] ?? 'Senin' }}' }">
            <!-- ========================================== -->
            <!-- SCHEDULE GRID TABS -->
            <!-- ========================================== -->
            <div class="grid grid-cols-2 sm:grid-cols-4 xl:grid-cols-7 gap-4 mb-10 text-center">
                @foreach($days as $day)
                    <button @click="activeDay = '{{ $day }}'"
                        :class="activeDay === '{{ $day }}' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100 border-blue-600' : 'bg-white text-slate-400 border-slate-200 hover:bg-slate-50'"
                        class="px-4 py-3 rounded-2xl border text-[11px] font-black uppercase tracking-widest transition-all duration-300 active:scale-95">
                        {{ $day }}
                    </button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schedules as $schedule)
                    <div x-show="activeDay === '{{ $schedule['hari'] }}'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl border border-blue-200/80 p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition-all group relative overflow-hidden">
                        <!-- Floating Day Badge -->
                        <div
                            class="absolute top-0 right-0 px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-bl-2xl">
                            {{ $schedule['hari'] }}
                        </div>

                        <div class="flex items-start gap-4 mb-6 pt-2">
                            <div
                                class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-lg shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                {{ substr($schedule['dokter'], 5, 1) }}
                            </div>
                            <div>
                                <h3 class="text-[17px] font-black text-slate-800 leading-tight">{{ $schedule['dokter'] }}</h3>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="flex items-center gap-2">
                                    <div class="p-1.5 bg-white rounded-lg text-slate-400 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-[13px] font-bold text-slate-600">Jam Praktik</span>
                                </div>
                                <span class="text-[13px] font-black text-slate-800">{{ $schedule['jam'] }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="flex items-center gap-2">
                                    <div class="p-1.5 bg-white rounded-lg text-slate-400 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-[13px] font-bold text-slate-600">Sesi/Kuota</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded text-[10px] font-black uppercase">{{ $schedule['sesi'] }}</span>
                                    <span class="text-[13px] font-black text-slate-800">{{ $schedule['kuota'] }} Pasien</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('admin.jadwal.show', ['id' => $schedule['id']]) }}"
                                class="flex-1 py-2.5 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-slate-900 transition-all active:scale-[0.98] flex items-center justify-center">Lihat</a>
                            <!-- <button class="w-11 h-11 flex items-center justify-center bg-white border border-slate-200 text-red-500 rounded-xl hover:bg-red-50 hover:border-red-100 transition-all active:scale-[0.98]">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button> -->
                        </div>
                    </div>
                @endforeach

                <!-- Empty/Dashed Placeholder Card -->
                <a href="{{ route('admin.jadwal.create') }}"
                    class="bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 p-8 flex flex-col items-center justify-center text-center opacity-70 group hover:opacity-100 transition-all cursor-pointer">
                    <div
                        class="w-12 h-12 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                    </div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest leading-tight">Klik untuk
                        Tambah<br>Jadwal Baru</p>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-indigo-50/50 border border-indigo-100 p-5 rounded-3xl flex items-center gap-4">
        <div class="p-3 bg-indigo-100 text-indigo-600 rounded-2xl shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-sm font-black text-indigo-900 uppercase tracking-tight">Catatan Operasional</h4>
            <p class="text-xs font-medium text-indigo-700/80 mt-1 leading-relaxed">Seluruh perubahan jadwal shift dokter di
                level cabang akan otomatis tersinkronisasi ke Portal Pasien dan Dashboard Superadmin Pusat untuk keperluan
                monitoring performa klinik.</p>
        </div>
    </div>
@endsection
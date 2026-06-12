@extends('layouts.dashboard')

@section('title', 'Jadwal Semua Dokter')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 relative z-10">
        <div>
            <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Jadwal Praktik Dokter</h1>
            <p class="text-slate-500 mt-1 text-sm font-medium">Pantau kelengkapan jadwal praktik dari seluruh Cabang Maxilla.</p>
        </div>
        <div class="flex gap-3 items-center">
            <span class="text-sm font-bold text-slate-500 mr-2">Filter Cabang:</span>
            <form action="{{ route('superadmin.jadwal.index') }}" method="GET" class="flex items-center">
                <select name="cabang" onchange="this.form.submit()" class="bg-white border text-sm font-bold border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/20 active:scale-[0.98] transition-all cursor-pointer">
                    <option value="all" {{ $cabang === 'all' ? 'selected' : '' }}>Semua Cabang</option>
                    <option value="slawi" {{ $cabang === 'slawi' ? 'selected' : '' }}>Klinik Slawi</option>
                    <option value="tegal" {{ $cabang === 'tegal' ? 'selected' : '' }}>Klinik Tegal</option>
                    <option value="brebes" {{ $cabang === 'brebes' ? 'selected' : '' }}>Klinik Brebes</option>
                </select>
            </form>
        </div>
    </div>

    <div>
        <div x-data="{ activeDay: '{{ count($schedules) > 0 ? $schedules[0]['hari'] : 'Senin' }}' }">
            <!-- SCHEDULE GRID TABS -->
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
                @forelse($schedules as $schedule)
                    <div x-show="activeDay === '{{ $schedule['hari'] }}'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl border border-blue-200/80 p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition-all group relative overflow-hidden">
                        
                        <!-- Floating Day and Branch Badges -->
                        <div class="absolute top-0 right-0 flex">
                            <div class="px-3 py-1.5 bg-blue-100 text-blue-700 text-[10px] font-black uppercase tracking-widest border-l border-b border-blue-200">
                                CABANG {{ strtoupper($schedule['cabang']) }}
                            </div>
                            <div class="px-3 py-1.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-bl-2xl">
                                {{ $schedule['hari'] }}
                            </div>
                        </div>

                        <div class="flex items-start gap-4 mb-6 pt-6">
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
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 py-12 text-center text-slate-500 font-medium bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                        Belum ada jadwal dokter yang terdaftar.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@extends('layouts.dokter')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-5 relative z-10">
    <div>
        <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Detail Rekam Medis</h1>
        <p class="text-slate-500 mt-1 text-sm">Melihat data rekam medis dan resep obat yang telah diinput.</p>
    </div>
    <a href="{{ route('dokter.antrian') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-bold border border-slate-200 hover:bg-slate-200 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Antrian
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Informasi Pasien -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3">Data Pasien</h3>
            <div class="space-y-4 relative z-10">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Nama Pasien</p>
                    <p class="font-medium text-slate-700">
                        {{ $reservasi->nama_pasien ?? ($reservasi->user->nama ?? '-') }}
                        @if($reservasi->hubungan && $reservasi->hubungan !== 'Diri Sendiri')
                            <span class="text-[10px] font-bold text-primary bg-blue-50 px-2 py-0.5 rounded-full ml-1">{{ $reservasi->hubungan }}</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Nomor RM</p>
                    <p class="font-medium text-slate-700">{{ $reservasi->user->no_rm ?? 'Belum ada' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Usia / Jenis Kelamin</p>
                    <p class="font-medium text-slate-700">
                        @php
                            $tanggalLahir = $reservasi->tanggal_lahir_pasien ?? ($reservasi->user->pasien->tanggal_lahir ?? null);
                            $gender = $reservasi->jenis_kelamin_pasien ?? ($reservasi->user->pasien->jenis_kelamin ?? '-');
                            $usia = $tanggalLahir ? \Carbon\Carbon::parse($tanggalLahir)->age . ' Tahun' : '-';
                        @endphp
                        {{ $usia }} / {{ $gender }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Keluhan Saat Reservasi</p>
                    <div class="mt-1 p-3 bg-red-50 rounded-lg border border-red-100 text-red-700 text-sm">
                        {{ $reservasi->keluhan ?? 'Tidak ada keluhan yang dicatat saat reservasi.' }}
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Status Perawatan</p>
                    <p class="mt-1 font-bold px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-sm inline-block">
                        {{ $reservasi->status }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Rekam Medis & Resep -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Data SOAP (E-RM)
            </h3>
            
            <div class="space-y-5 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[11px] font-black text-slate-400 uppercase mb-2">Subjective (Keluhan Utama)</p>
                        <p class="text-sm text-slate-700">{{ $reservasi->rekamMedis->subjective }}</p>
                    </div>
                    
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[11px] font-black text-slate-400 uppercase mb-2">Objective (Pemeriksaan Fisik)</p>
                        <p class="text-sm text-slate-700">{{ $reservasi->rekamMedis->objective }}</p>
                    </div>
                    
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[11px] font-black text-slate-400 uppercase mb-2">Assesment (Diagnosa)</p>
                        <p class="text-sm font-bold text-slate-800">{{ $reservasi->rekamMedis->assesment }}</p>
                    </div>
                    
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[11px] font-black text-slate-400 uppercase mb-2">Planning (Tindakan/Perawatan)</p>
                        <p class="text-sm text-slate-800">{{ $reservasi->rekamMedis->planning }}</p>
                    </div>
                </div>

                @if($reservasi->rekamMedis->keterangan)
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <p class="text-[11px] font-black text-blue-400 uppercase mb-2">Keterangan Tambahan</p>
                    <p class="text-sm text-blue-800">{{ $reservasi->rekamMedis->keterangan }}</p>
                </div>
                @endif

                <!-- Odontogram (Read Only) -->
                <div class="mt-8 border border-slate-200 rounded-xl p-5 bg-slate-50">
                    <div class="flex items-center justify-between mb-4">
                        <label class="block text-sm font-bold text-slate-700">Visualisasi Odontogram</label>
                        <div class="flex gap-3 text-[10px] font-bold text-slate-500 uppercase">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-white border border-slate-300"></span> Normal</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500"></span> Karies</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-blue-500"></span> Tambalan</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-slate-400"></span> Hilang</span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto pb-4">
                        <div class="min-w-[600px] flex flex-col items-center gap-4 select-none">
                            <!-- Top Adult (18-11 | 21-28) -->
                            <div class="flex gap-8">
                                <div class="flex gap-1">
                                    @foreach([18,17,16,15,14,13,12,11] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                            <div class="tooth-box w-8 h-8 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex gap-1">
                                    @foreach([21,22,23,24,25,26,27,28] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                            <div class="tooth-box w-8 h-8 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Top Child (55-51 | 61-65) -->
                            <div class="flex gap-8">
                                <div class="flex gap-1">
                                    @foreach([55,54,53,52,51] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                            <div class="tooth-box w-7 h-7 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex gap-1">
                                    @foreach([61,62,63,64,65] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                            <div class="tooth-box w-7 h-7 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="w-full border-t-2 border-slate-300 my-2"></div>

                            <!-- Bottom Child (85-81 | 71-75) -->
                            <div class="flex gap-8">
                                <div class="flex gap-1">
                                    @foreach([85,84,83,82,81] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="tooth-box w-7 h-7 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex gap-1">
                                    @foreach([71,72,73,74,75] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="tooth-box w-7 h-7 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Bottom Adult (48-41 | 31-38) -->
                            <div class="flex gap-8">
                                <div class="flex gap-1">
                                    @foreach([48,47,46,45,44,43,42,41] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="tooth-box w-8 h-8 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex gap-1">
                                    @foreach([31,32,33,34,35,36,37,38] as $tooth)
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="tooth-box w-8 h-8 bg-white border-2 border-slate-300 rounded flex items-center justify-center text-xs font-bold" data-tooth="{{ $tooth }}"></div>
                                            <span class="text-[10px] font-bold text-slate-400">{{ $tooth }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Resep Obat Diberikan
            </h3>

            <div class="space-y-3">
                @if($reservasi->rekamMedis->resepObats && $reservasi->rekamMedis->resepObats->count() > 0)
                    @foreach($reservasi->rekamMedis->resepObats as $resep)
                    <div class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ $resep->obat->nama_obat ?? 'Obat' }}</h4>
                                <p class="text-xs text-slate-500 font-medium">Aturan: {{ $resep->aturan_pakai ?? 'Sesuai petunjuk dokter' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-sm font-black border border-slate-200">
                                {{ $resep->jumlah }} Pcs
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="p-6 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                        <p class="text-sm text-slate-500 font-medium italic">Tidak ada resep obat untuk pasien ini.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const odontogramData = @json($reservasi->rekamMedis->odontogram ?? []);
        
        const states = {
            0: { class: 'bg-white', text: '', border: 'border-slate-300', textClass: 'text-transparent' },
            1: { class: 'bg-red-500', text: '', border: 'border-red-600', textClass: 'text-white' },
            2: { class: 'bg-blue-500', text: '', border: 'border-blue-600', textClass: 'text-white' },
            3: { class: 'bg-slate-300', text: 'X', border: 'border-slate-400', textClass: 'text-slate-600' }
        };

        const updateToothUI = (toothBox, state) => {
            const stateConfig = states[state] || states[0];
            toothBox.classList.remove('bg-white', 'bg-red-500', 'bg-blue-500', 'bg-slate-300', 'border-slate-300', 'border-red-600', 'border-blue-600', 'border-slate-400', 'text-transparent', 'text-white', 'text-slate-600');
            toothBox.classList.add(stateConfig.class, stateConfig.border, stateConfig.textClass);
            toothBox.textContent = stateConfig.text;
        };

        // Render existing data
        document.querySelectorAll('.tooth-box').forEach(box => {
            const tooth = box.getAttribute('data-tooth');
            if (odontogramData[tooth]) {
                updateToothUI(box, odontogramData[tooth]);
            }
        });
    });
</script>
@endpush

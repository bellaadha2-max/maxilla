@extends('layouts.apoteker')

@section('title', 'Riwayat Resep Obat')

@section('content')
<div class="min-h-screen bg-white p-8">
    <div class="grid gap-6 lg:grid-cols-[1.4fr_0.6fr]">
        <div class="bg-white rounded-[2rem] border border-emerald-200 shadow-[0_20px_50px_rgba(15,23,42,0.08)] p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] font-bold text-emerald-600">Riwayat Apoteker</p>
                    <h1 class="mt-3 text-3xl font-black text-slate-900">Resep & Obat Pasien</h1>
                    <p class="mt-2 text-sm text-slate-500">Menampilkan pasien dan daftar obat yang sesuai dengan cabang apoteker saat ini.</p>
                </div>
                <a href="{{ route('apoteker.dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-700 border border-emerald-200 shadow-sm hover:bg-emerald-100 transition">
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="mt-8 rounded-[1.8rem] border border-emerald-200 bg-slate-50 p-6">
                <form action="{{ route('apoteker.riwayat-obat') }}" method="GET" class="grid gap-4 lg:grid-cols-[1.8fr_1fr_1fr_0.8fr] items-end">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-[0.24em] text-slate-500 mb-2">Cari Nama</label>
                        <input type="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Cari nama pasien..."
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-800 placeholder-slate-400 outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-[0.24em] text-slate-500 mb-2">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $startDate ?? '') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-800 outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-[0.24em] text-slate-500 mb-2">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $endDate ?? '') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-800 outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200">
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-500/10 hover:bg-emerald-700 transition">Terapkan</button>
                        @if(($search ?? false) || ($startDate ?? false) || ($endDate ?? false))
                            <a href="{{ route('apoteker.riwayat-obat') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-100 transition">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-emerald-100 bg-emerald-50/60 p-5">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-emerald-700">Total Pasien</p>
                    <p class="mt-4 text-3xl font-black text-slate-900">{{ $riwayatObat->count() }}</p>
                </div>
                <div class="rounded-3xl border border-emerald-200 bg-white p-5">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-slate-500">Cabang</p>
                    <p class="mt-4 text-2xl font-black text-slate-900">{{ auth()->user()->cabang ?? '-' }}</p>
                </div>
                <div class="rounded-3xl border border-emerald-200 bg-slate-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-slate-500">Data terakhir</p>
                    <p class="mt-4 text-2xl font-black text-slate-900">{{ $riwayatObat->first() ? $riwayatObat->first()->updated_at->format('d M Y') : '-' }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-8 shadow-[0_20px_40px_rgba(16,185,129,0.12)]">
            <p class="text-sm uppercase tracking-[0.24em] font-bold text-emerald-700">Panduan Singkat</p>
            <h2 class="mt-4 text-2xl font-black text-slate-900">Telusuri resep dengan mudah</h2>
            <p class="mt-4 text-sm leading-relaxed text-slate-600">Klik salah satu pasien untuk melihat obat detailnya. Data ditampilkan berdasarkan cabang apoteker, sehingga resep yang tampil relevan.</p>
            <div class="mt-6 space-y-4">
                <div class="rounded-3xl bg-white border border-emerald-100 p-4">
                    <p class="text-sm font-bold text-slate-900">Filter Cabang</p>
                    <p class="text-sm text-slate-600">Hanya pasien di cabang Anda ditampilkan.</p>
                </div>
                <div class="rounded-3xl bg-white border border-emerald-100 p-4">
                    <p class="text-sm font-bold text-slate-900">Resep Lengkap</p>
                    <p class="text-sm text-slate-600">Setiap pasien menampilkan daftar obat dan jumlahnya dalam tampilan ringkas.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($riwayatObat as $reservasi)
            <section class="h-full rounded-[2rem] border border-emerald-200 bg-white shadow-[0_20px_40px_rgba(15,23,42,0.06)] overflow-hidden flex flex-col">
                <div class="flex flex-col gap-4 p-6 bg-slate-50 border-b border-emerald-200">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-500">Pasien</p>
                        <h3 class="mt-2 text-xl font-black text-slate-900">{{ $reservasi->nama_pasien ?? ($reservasi->user->nama ?? 'Pasien') }}</h3>
                        <p class="mt-1 text-sm text-slate-500">Status: <span class="font-bold text-slate-700">{{ $reservasi->status }}</span></p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full bg-emerald-100 px-4 py-2 text-xs font-bold text-emerald-700">Cabang {{ $reservasi->cabang }}</span>
                        <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-bold text-slate-600">{{ $reservasi->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="grid gap-6 p-6">
                    <div class="rounded-[1.5rem] border border-emerald-200 bg-slate-50 p-5">
                        <p class="text-xs uppercase tracking-[0.24em] font-bold text-slate-500">Obat</p>
                        <div class="mt-4 space-y-3">
                            @foreach($reservasi->rekamMedis->resepObats as $resep)
                                <div class="rounded-2xl bg-white border border-emerald-200 p-4 flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $resep->obat->nama_obat ?? 'Obat Tidak Diketahui' }}</p>
                                        <p class="text-sm text-slate-500">{{ $resep->jumlah }} pcs</p>
                                    </div>
                                    <span class="text-sm font-black text-slate-900">Rp {{ number_format($resep->obat->harga ?? 0, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="rounded-[1.5rem] border border-emerald-200 bg-slate-50 p-5">
                        <p class="text-xs uppercase tracking-[0.24em] font-bold text-slate-500">Detail Ringkas</p>
                        <div class="mt-6 space-y-4 text-sm text-slate-600">
                            <div class="flex justify-between">
                                <span class="font-bold text-slate-800">Jumlah item</span>
                                <span>{{ $reservasi->rekamMedis->resepObats->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold text-slate-800">Total obat</span>
                                <span>Rp {{ number_format($reservasi->rekamMedis->resepObats->sum(fn($r) => ($r->obat->harga ?? 0) * $r->jumlah), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold text-slate-800">Tindakan</span>
                                <span>{{ $reservasi->rekamMedis->planning ?? 'Tidak ada' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @empty
            <div class="rounded-[2rem] border border-emerald-200 bg-white p-12 text-center shadow-[0_20px_40px_rgba(15,23,42,0.06)]">
                <p class="text-sm font-bold text-slate-400">Belum ada data resep obat untuk cabang ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

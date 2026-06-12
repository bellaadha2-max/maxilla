@extends('layouts.pos')

@section('title', 'Riwayat Pembayaran Kasir')

@section('content')
<div class="flex-1 flex h-full overflow-hidden relative">
    <div class="w-full p-8 overflow-y-auto custom-scrollbar bg-white">
        <div class="grid gap-6">
            <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
                <div class="rounded-[2rem] bg-white border border-emerald-200 shadow-[0_20px_40px_rgba(15,23,42,0.08)] p-10">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.24em] font-bold text-slate-500">Riwayat Pembayaran</p>
                            <h1 class="mt-3 text-3xl font-black text-slate-900">Transaksi Kasir Cabang {{ auth()->user()->cabang ?? '-' }}</h1>
                            <p class="mt-2 text-sm text-slate-500">Lihat seluruh pembayaran pasien yang sudah diproses oleh cabang Anda.</p>
                        </div>
                        <a href="{{ route('kasir.dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-100 transition">
                            Kembali ke POS
                        </a>
                    </div>

                    <div class="mt-8 rounded-[1.8rem] border border-emerald-200 bg-slate-50 p-5">
                        <form action="{{ route('kasir.riwayat-pembayaran') }}" method="GET" class="grid gap-3 lg:grid-cols-[1.5fr_1fr_1fr_0.9fr] items-end">
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
                            <div class="flex flex-col gap-3">
                                <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-500/10 hover:bg-emerald-700 transition">Terapkan</button>
                                @if(($search ?? false) || ($startDate ?? false) || ($endDate ?? false))
                                    <a href="{{ route('kasir.riwayat-pembayaran') }}" class="inline-flex items-center justify-center w-full rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-100 transition">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[1.8rem] border border-emerald-200 bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.28em] font-bold text-slate-500">Total Transaksi</p>
                            <p class="mt-4 text-3xl font-black text-slate-900">{{ $riwayatPembayaran->count() }}</p>
                        </div>
                        <div class="rounded-[1.8rem] border border-emerald-200 bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.28em] font-bold text-slate-500">Transaksi Terakhir</p>
                            <p class="mt-4 text-2xl font-black text-slate-900">{{ $riwayatPembayaran->first() ? $riwayatPembayaran->first()->transaksi->created_at->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="rounded-[1.8rem] border border-emerald-200 bg-white p-5">
                            <p class="text-xs uppercase tracking-[0.28em] font-bold text-slate-500">Status Paling Banyak</p>
                            <p class="mt-4 text-2xl font-black text-slate-900">Selesai</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-emerald-200 bg-emerald-50 p-8 shadow-[0_20px_40px_rgba(16,185,129,0.12)]">
                    <p class="text-sm uppercase tracking-[0.24em] font-bold text-emerald-700">Ringkasan Cepat</p>
                    <h2 class="mt-4 text-2xl font-black text-slate-900">Informasi pembayaran</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-600">Data ditampilkan berdasarkan cabang kasir Anda. Gunakan halaman ini untuk melihat pasien, total bayar, dan status transaksi.</p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl bg-white border border-emerald-100 p-4">
                            <p class="text-sm font-bold text-slate-900">Transaksi Cabang</p>
                            <p class="text-sm text-slate-600">Hanya menampilkan riwayat untuk cabang Anda.</p>
                        </div>
                        <div class="rounded-3xl bg-white border border-emerald-100 p-4">
                            <p class="text-sm font-bold text-slate-900">Desain Baru</p>
                            <p class="text-sm text-slate-600">Tampilan lebih modern dengan detail kartu ringkas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @forelse($riwayatPembayaran as $reservasi)
                    @php $transaksi = $reservasi->transaksi; @endphp
                    <div class="h-full rounded-[2rem] border border-emerald-200 bg-white shadow-[0_20px_40px_rgba(15,23,42,0.06)] overflow-hidden">
                        <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between bg-slate-50 border-b border-emerald-200">
                            <div>
                                <p class="text-xs uppercase tracking-[0.28em] font-bold text-slate-500">{{ $reservasi->nama_pasien ?? ($reservasi->user->nama ?? 'Pasien') }}</p>
                                <h3 class="mt-2 text-xl font-black text-slate-900">Rp {{ number_format(optional($transaksi)->total_bayar ?? 0, 0, ',', '.') }}</h3>
                                <p class="mt-2 text-sm text-slate-500">{{ optional($transaksi)->created_at ? $transaksi->created_at->format('d M Y H:i') : $reservasi->updated_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="rounded-full bg-emerald-100 px-4 py-2 text-xs font-bold text-emerald-700">{{ $reservasi->status }}</span>
                                <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-bold text-slate-600">Cabang {{ $reservasi->cabang }}</span>
                            </div>
                        </div>
                        <div class="grid gap-4 md:grid-cols-3 p-6">
                            <div class="rounded-[1.5rem] border border-emerald-200 bg-slate-50 p-5">
                                <p class="text-xs uppercase tracking-[0.24em] font-bold text-slate-500">ID Reservasi</p>
                                <p class="mt-3 text-lg font-black text-slate-900">{{ $reservasi->id_reservasi }}</p>
                            </div>
                            <div class="rounded-[1.5rem] border border-emerald-200 bg-white p-5">
                                <p class="text-xs uppercase tracking-[0.24em] font-bold text-slate-500">Kasir</p>
                                <p class="mt-3 text-lg font-black text-slate-900">{{ auth()->user()->nama ?? '-' }}</p>
                            </div>
                            <div class="rounded-[1.5rem] border border-emerald-200 bg-white p-5">
                                <p class="text-xs uppercase tracking-[0.24em] font-bold text-slate-500">Jumlah Obat</p>
                                <p class="mt-3 text-lg font-black text-slate-900">{{ $reservasi->rekamMedis->resepObats->count() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[2rem] border border-emerald-200 bg-white p-12 text-center shadow-[0_20px_40px_rgba(15,23,42,0.06)]">
                        <p class="text-sm font-bold text-slate-400">Belum ada riwayat pembayaran di cabang ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.apoteker')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="font-heading text-3xl font-bold text-slate-800 tracking-tight">Selamat Datang, {{ auth()->user()->nama ?? 'Apoteker' }}!</h1>
    <p class="text-slate-500 mt-1">Anda masuk sebagai Apoteker untuk Cabang <strong class="text-emerald-600">{{ auth()->user()->cabang ?? 'Belum Ditentukan' }}</strong>.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="{{ route('apoteker.obat.index') }}" class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all group">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-1 group-hover:text-emerald-600 transition-colors">Manajemen Obat</h3>
        <p class="text-sm text-slate-500">Kelola stok, tambah obat baru, dan atur harga jual obat khusus untuk cabang Anda.</p>
    </a>
</div>
@endsection

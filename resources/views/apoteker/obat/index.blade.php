@extends('layouts.apoteker')

@section('title', 'Manajemen Obat')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');

        .obat-page * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page-hero {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 40%, #3b82f6 70%, #60a5fa 100%);
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 30%;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e0e7ff;
            padding: 18px 22px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(37, 99, 235, 0.06);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.12);
            border-color: #bfdbfe;
        }

        .obat-row {
            transition: all 0.15s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .obat-row:hover {
            background: linear-gradient(90deg, #eff6ff 0%, #f8faff 100%);
        }

        .obat-row:hover .row-index {
            background: #2563eb;
            color: white;
        }

        .badge-ok {
            background: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .badge-warn {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-empty {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
            transition: all 0.15s;
        }

        .btn-edit:hover {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-del {
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            transition: all 0.15s;
        }

        .btn-del:hover {
            background: #e11d48;
            color: white;
            border-color: #e11d48;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);
        }

        .search-input {
            background: #f8faff;
            border: 1.5px solid #dbeafe;
            border-radius: 12px;
            padding: 10px 16px 10px 42px;
            font-size: 13.5px;
            font-weight: 500;
            color: #1e293b;
            transition: all 0.2s;
            outline: none;
        }

        .search-input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-add {
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 700;
            font-size: 13.5px;
            letter-spacing: 0.01em;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.45);
        }

        .btn-add:active {
            transform: scale(0.98);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-row {
            animation: fadeInUp 0.3s ease both;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>

    <div class="obat-page space-y-5">

        {{-- ===== PAGE HERO (info only, no button) ===== --}}
        <!-- <div class="page-hero rounded-2xl p-6 text-white shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <span class="text-blue-200 text-xs font-bold uppercase tracking-widest">Inventaris Farmasi</span>
                        </div>
                        <h1 class="text-2xl font-black tracking-tight">Manajemen Obat & Stok</h1>
                        <p class="text-blue-100 text-sm mt-1">
                            Data master obat khusus Cabang
                            <span
                                class="bg-white/20 px-2 py-0.5 rounded-md font-bold text-white">{{ auth()->user()->cabang }}</span>
                        </p>
                    </div>
                </div> -->

        {{-- ===== FLASH MESSAGES ===== --}}
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 rounded-xl border animate-row"
                style="background:#eff6ff; border-color:#bfdbfe;">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-semibold text-sm text-blue-800">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 p-4 rounded-xl border" style="background:#fff1f2; border-color:#fecdd3;">
                <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <span class="font-semibold text-sm text-red-700">{{ session('error') }}</span>
            </div>
        @endif

        {{-- ===== STATS + TOMBOL TAMBAH (x-data wrapper) ===== --}}
        <div x-data="{ openAdd: false }">

            {{-- 3 Stat Cards --}}
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#dbeafe,#eff6ff);">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Obat</p>
                            <p class="text-xl font-black text-slate-800">{{ $obats->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#fef3c7,#fffbeb);">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stok Menipis</p>
                            <p class="text-xl font-black text-slate-800">
                                {{ $obats->filter(fn($o) => $o->stok > 0 && $o->stok <= 10)->count() }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#fee2e2,#fff1f2);">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stok Habis</p>
                            <p class="text-xl font-black text-slate-800">
                                {{ $obats->filter(fn($o) => $o->stok == 0)->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Tambah Obat — rata kanan, di bawah 3 card --}}
            <div class="flex justify-end">
                <button @click="openAdd = true" class="btn-add">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Obat Baru
                </button>
            </div>

            {{-- Modal Tambah --}}
            <template x-teleport="body">
                <div x-show="openAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                    style="display:none;">
                    <div x-show="openAdd" x-transition.opacity class="fixed inset-0 bg-slate-900/60 modal-backdrop"
                        @click="openAdd = false"></div>
                    <div x-show="openAdd" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                        class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

                        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between"
                            style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">Tambah Obat Baru</h3>
                            </div>
                            <button @click="openAdd = false"
                                class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-white/80 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('apoteker.obat.store') }}" method="POST" class="p-6">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama
                                        Obat <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_obat" required placeholder="Masukkan nama obat..."
                                        class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Harga
                                            Beli (Rp)</label>
                                        <input type="number" name="harga_beli" value="0" min="0" required
                                            class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-1.5">Harga
                                            Jual (Rp) <span class="text-red-500">*</span></label>
                                        <input type="number" name="harga" value="0" min="0" required
                                            class="w-full rounded-xl border-2 border-blue-300 bg-blue-50 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 text-sm font-bold p-3 outline-none transition-all">
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Stok
                                        Awal <span class="text-red-500">*</span></label>
                                    <input type="number" name="stok" value="0" min="0" required
                                        class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-slate-100">
                                <button type="button" @click="openAdd = false"
                                    class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-6 py-2.5 text-sm font-bold text-white rounded-xl transition-all shadow-md"
                                    style="background:linear-gradient(135deg,#1d4ed8,#3b82f6); box-shadow:0 4px 14px rgba(37,99,235,0.35);">
                                    Simpan Obat
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>

        </div>{{-- end x-data openAdd --}}

        {{-- ===== TABLE CARD ===== --}}
        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden" style="border-color:#e0e7ff;">

            {{-- Search bar --}}
            <div class="px-5 py-4 border-b flex flex-col sm:flex-row gap-3 justify-between items-center"
                style="background:#f8faff; border-color:#e0e7ff;">
                <form action="{{ route('apoteker.obat.index') }}" method="GET" class="w-full sm:w-80 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama obat..."
                        class="search-input w-full">
                </form>
                <p class="text-xs font-semibold text-slate-400 whitespace-nowrap">
                    {{ $obats->total() }} obat ditemukan
                </p>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr style="background:linear-gradient(90deg,#eff6ff,#f0f9ff); border-bottom:2px solid #dbeafe;">
                            <th class="px-5 py-3.5 text-xs font-black text-blue-700 uppercase tracking-wider w-10">#</th>
                            <th class="px-5 py-3.5 text-xs font-black text-blue-700 uppercase tracking-wider">Nama Obat</th>
                            <th class="px-5 py-3.5 text-xs font-black text-slate-500 uppercase tracking-wider">Harga Beli
                            </th>
                            <th class="px-5 py-3.5 text-xs font-black text-blue-700 uppercase tracking-wider">Harga Jual
                            </th>
                            <th class="px-5 py-3.5 text-xs font-black text-slate-500 uppercase tracking-wider text-center">
                                Sisa Stok</th>
                            <th class="px-5 py-3.5 text-xs font-black text-slate-500 uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($obats as $i => $obat)
                            <tr class="obat-row animate-row" style="animation-delay:{{ $i * 0.04 }}s"
                                x-data="{ openEdit: false, openDelete: false }">

                                <td class="px-5 py-4">
                                    <span
                                        class="row-index w-6 h-6 rounded-lg text-xs font-black text-blue-400 bg-blue-50 flex items-center justify-center transition-all">
                                        {{ $obats->firstItem() + $i }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                                            style="background:linear-gradient(135deg,#dbeafe,#eff6ff);">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                            </svg>
                                        </div>
                                        <span class="font-bold text-slate-800">{{ $obat->nama_obat }}</span>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-slate-500 font-medium">
                                    Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4">
                                    <span class="font-black text-blue-600">
                                        Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    @if($obat->stok > 10)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black badge-ok">
                                            {{ $obat->stok }} unit
                                        </span>
                                    @elseif($obat->stok > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black badge-warn">
                                            ⚠ {{ $obat->stok }} unit
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black badge-empty">
                                            ✕ Habis
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="openEdit = true" class="btn-edit p-2 rounded-lg transition-all"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button @click="openDelete = true" class="btn-del p-2 rounded-lg transition-all"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Modal Edit --}}
                                    <template x-teleport="body">
                                        <div x-show="openEdit"
                                            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                                            style="display:none;">
                                            <div x-show="openEdit" x-transition.opacity
                                                class="fixed inset-0 bg-slate-900/60 modal-backdrop" @click="openEdit = false">
                                            </div>
                                            <div x-show="openEdit" x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                                x-transition:leave="transition ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden text-left">

                                                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center"
                                                    style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </div>
                                                        <h3 class="text-base font-bold text-slate-800">Edit Data Obat</h3>
                                                    </div>
                                                    <button @click="openEdit = false"
                                                        class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-white/80 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <form action="{{ route('apoteker.obat.update', $obat->id_obat) }}" method="POST"
                                                    class="p-6">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="space-y-4">
                                                        <div>
                                                            <label
                                                                class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama
                                                                Obat</label>
                                                            <input type="text" name="nama_obat" value="{{ $obat->nama_obat }}"
                                                                required
                                                                class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <div>
                                                                <label
                                                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Harga
                                                                    Beli</label>
                                                                <input type="number" name="harga_beli"
                                                                    value="{{ $obat->harga_beli }}" min="0" required
                                                                    class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-1.5">Harga
                                                                    Jual</label>
                                                                <input type="number" name="harga" value="{{ $obat->harga }}"
                                                                    min="0" required
                                                                    class="w-full rounded-xl border-2 border-blue-300 bg-blue-50 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 text-sm font-bold p-3 outline-none transition-all">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">
                                                                Stok
                                                                <span class="normal-case font-normal text-slate-400 ml-1">(Sisa:
                                                                    {{ $obat->stok }})</span>
                                                            </label>
                                                            <input type="number" name="stok" value="{{ $obat->stok }}" min="0"
                                                                required
                                                                class="w-full rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm p-3 outline-none transition-all">
                                                            <p
                                                                class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                Ubah angka ini jika ada penyesuaian stok manual.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-slate-100">
                                                        <button type="button" @click="openEdit = false"
                                                            class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                            class="px-6 py-2.5 text-sm font-bold text-white rounded-xl transition-all shadow-md"
                                                            style="background:linear-gradient(135deg,#1d4ed8,#3b82f6); box-shadow:0 4px 14px rgba(37,99,235,0.35);">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </template>

                                    {{-- Modal Delete --}}
                                    <template x-teleport="body">
                                        <div x-show="openDelete"
                                            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                                            style="display:none;">
                                            <div x-show="openDelete" x-transition.opacity
                                                class="fixed inset-0 bg-slate-900/60 modal-backdrop"
                                                @click="openDelete = false"></div>
                                            <div x-show="openDelete" x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-200"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-95"
                                                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden text-center p-8">

                                                <div
                                                    class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center mx-auto mb-4">
                                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-black text-slate-800 mb-2">Hapus Obat?</h3>
                                                <p class="text-sm text-slate-500 mb-6">
                                                    Yakin ingin menghapus <strong
                                                        class="text-slate-700">{{ $obat->nama_obat }}</strong>?
                                                    <br><span class="text-red-400 text-xs">Aksi ini tidak dapat
                                                        dibatalkan.</span>
                                                </p>
                                                <form action="{{ route('apoteker.obat.destroy', $obat->id_obat) }}"
                                                    method="POST" class="flex justify-center gap-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" @click="openDelete = false"
                                                        class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                                        Batal
                                                    </button>
                                                    <button type="submit"
                                                        class="px-5 py-2.5 text-sm font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl shadow-md transition-all">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </template>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center"
                                        style="background:linear-gradient(135deg,#dbeafe,#eff6ff);">
                                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-600">Belum ada data obat di cabang ini.</p>
                                    <p class="text-sm text-slate-400 mt-1">Mulai tambahkan obat baru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($obats->hasPages())
                <div class="px-5 py-4 border-t flex justify-between items-center"
                    style="background:#f8faff; border-color:#e0e7ff;">
                    <p class="text-xs font-semibold text-slate-400">
                        Menampilkan {{ $obats->firstItem() }}–{{ $obats->lastItem() }} dari {{ $obats->total() }} obat
                    </p>
                    {{ $obats->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
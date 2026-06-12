<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Kasir') | Maxilla Dental Care</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Arial', 'Helvetica', 'sans-serif'], heading: ['Arial', 'Helvetica', 'sans-serif'] },
                    colors: { primary: '#2563eb', secondary: '#1e293b', surface: '#f8fafc' }
                }
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased h-screen overflow-hidden flex flex-col">

    <!-- POS Header -->
    <header class="bg-white border-b border-slate-200 h-[70px] shrink-0 flex items-center justify-between px-6 z-20 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="p-1.5 bg-slate-50 rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.03)] border border-slate-100">
                <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo" class="h-7 w-auto">
            </div>
            <div>
                @if(auth()->user()->role === 'apoteker')
                    <h1 class="font-heading font-black text-xl text-slate-800 tracking-tight leading-none">Maxilla<span class="text-emerald-600">Pharmacy</span></h1>
                    <p class="text-xs font-bold text-slate-400 mt-0.5">Sistem Farmasi Terpadu</p>
                @else
                    <h1 class="font-heading font-black text-xl text-slate-800 tracking-tight leading-none">Maxilla<span class="text-blue-600">POS</span></h1>
                    <p class="text-xs font-bold text-slate-400 mt-0.5">Sistem Kasir Terpadu</p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-6">
            @if(auth()->user()->role === 'apoteker')
                <div class="hidden md:flex items-center gap-2 mr-4">
                    <a href="{{ route('apoteker.obat.index') }}" class="text-sm font-bold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-4 py-2 rounded-xl border border-emerald-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Manajemen Stok
                    </a>
                    <a href="{{ route('apoteker.riwayat-obat') }}" class="text-sm font-bold text-slate-500 hover:text-emerald-600 px-4 py-2 rounded-xl transition-colors">
                        Riwayat Obat
                    </a>
                </div>
            @endif

            @include('components.notification-bell')

            @if(auth()->user()->role === 'kasir')
                <a href="{{ route('kasir.riwayat-pembayaran') }}" class="hidden md:inline-flex items-center gap-2 text-sm font-bold text-slate-600 bg-slate-50 border border-slate-200 px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                    Riwayat Pembayaran
                </a>
            @endif

            <div class="text-right hidden md:block ml-4">
                <p class="text-sm font-bold text-slate-800">{{ auth()->user()->nama ?? 'Kasir' }}</p>
                <p class="text-[11px] font-bold {{ auth()->user()->role === 'apoteker' ? 'text-emerald-500' : 'text-blue-500' }} uppercase">Cabang {{ auth()->user()->cabang ?? '-' }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr {{ auth()->user()->role === 'apoteker' ? 'from-emerald-600 to-teal-500 shadow-emerald-500/20' : 'from-blue-600 to-indigo-500 shadow-blue-500/20' }} flex items-center justify-center text-white font-bold shadow-md">
                {{ substr(auth()->user()->nama ?? 'K', 0, 1) }}
            </div>
            <div class="h-8 w-px bg-slate-200"></div>
            <form action="{{ route('logout') }}" method="POST" x-data="{ showLogoutConfirm: false }" x-ref="logoutForm">
                @csrf
                <button type="button" @click="showLogoutConfirm = true" class="flex items-center gap-2 text-sm font-bold text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            
<!-- Modal Konfirmasi Logout -->
<template x-teleport="body">
    <div x-show="showLogoutConfirm" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
        style="display: none;">

        <div @click.away="showLogoutConfirm = false" x-show="showLogoutConfirm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl border border-slate-100 text-center relative overflow-hidden">

            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </div>

            <h3 class="font-bold text-xl text-slate-800 mb-3">Konfirmasi Logout</h3>
            <p class="text-slate-500 text-sm mb-8 leading-relaxed">Apakah Anda yakin ingin keluar dari aplikasi?</p>

            <div class="grid grid-cols-2 gap-4">
                <button @click="showLogoutConfirm = false" type="button" class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition-colors">
                    Batal
                </button>
                <button type="button" @click="$refs.logoutForm.submit()" class="px-6 py-3 rounded-2xl text-sm font-bold text-white bg-red-500 hover:bg-red-600 transition-all shadow-lg shadow-red-100">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>
</template>
</form>
        </div>
    </header>

    <!-- Main POS Content -->
    <main class="flex-1 overflow-hidden flex">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>

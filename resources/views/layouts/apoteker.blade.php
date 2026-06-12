<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Apoteker Dashboard') | Maxilla Dental Care</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Arial', 'Helvetica', 'sans-serif'], heading: ['Arial', 'Helvetica', 'sans-serif'] },
                    colors: { primary: '#10b981', secondary: '#1e293b', surface: '#f8fafc' }
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
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left: Logo & Nav -->
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center gap-3">
                        <div class="p-1.5 bg-emerald-50 rounded-xl border border-emerald-100">
                            <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo" class="h-6 w-auto">
                        </div>
                        <span class="font-heading font-black text-lg text-slate-800 tracking-tight">Maxilla<span
                                class="text-emerald-600">Apoteker</span></span>
                    </div>

                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex space-x-1">
                        <a href="{{ route('apoteker.dashboard') }}"
                            class="{{ request()->routeIs('apoteker.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} px-3 py-2 rounded-lg text-sm font-bold transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('apoteker.obat.index') }}"
                            class="{{ request()->routeIs('apoteker.obat.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} px-3 py-2 rounded-lg text-sm font-bold transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                            Manajemen Obat & Stok
                        </a>
                        <a href="{{ route('apoteker.riwayat-obat') }}"
                            class="{{ request()->routeIs('apoteker.riwayat-obat') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} px-3 py-2 rounded-lg text-sm font-bold transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h10M4 18h10"></path>
                            </svg>
                            Riwayat Obat
                        </a>
                    </nav>
                </div>

                <!-- Right: Profile & Logout -->
                <div class="flex items-center gap-4">
                    @include('components.notification-bell')

                    <div class="hidden md:block text-right">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->nama ?? 'Apoteker' }}</p>
                        <p class="text-[11px] font-bold text-emerald-500 uppercase">Cabang
                            {{ auth()->user()->cabang ?? '-' }}</p>
                    </div>

                    <!-- Profile Dropdown (Alpine) -->
                    <div x-data="{ open: false }" class="relative ml-3">
                        <div>
                            <button @click="open = !open" @click.away="open = false" type="button"
                                class="flex items-center max-w-xs rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                <div
                                    class="h-9 w-9 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white font-bold shadow-md">
                                    {{ substr(auth()->user()->nama ?? 'A', 0, 1) }}
                                </div>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" style="display: none;">
                            <div class="px-4 py-3 border-b border-slate-100 md:hidden">
                                <p class="text-sm font-bold text-slate-800">{{ auth()->user()->nama ?? 'Apoteker' }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="button" @click="showLogoutConfirm = true"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors"
                                    role="menuitem">Keluar Aplikasi</button>
                            
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
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
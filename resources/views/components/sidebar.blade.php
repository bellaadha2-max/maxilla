<!-- Mobile Sidebar Overlay -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-40 bg-slate-900/80 backdrop-blur-md lg:hidden"
     @click="sidebarOpen = false" x-cloak></div>

<!-- Sidebar Container -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-[280px] bg-[#0b1424] text-slate-300 transition-all duration-500 ease-in-out lg:static lg:translate-x-0 flex flex-col border-r border-white/5 shadow-[20px_0_40px_rgba(0,0,0,0.4)] overflow-hidden">
    
    <!-- Premium Backdrop Glow -->
    <div class="absolute top-0 left-0 w-full h-[400px] bg-gradient-to-b from-blue-600/10 via-transparent to-transparent pointer-events-none"></div>

    <!-- Sidebar Header / Logo -->
    <div class="h-[76px] flex items-center px-7 relative z-20">
        <div class="flex items-center gap-3.5 w-full relative z-10">
            <div class="p-1.5 bg-white/95 rounded-xl shadow-lg border border-white/10 shrink-0">
                <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo" class="h-6 w-auto">
            </div>
            <div class="flex flex-col">
                <span class="font-heading font-black text-[18px] text-white tracking-tight leading-none uppercase">Maxilla<span class="text-blue-400">Admin</span></span>
            </div>

            <!-- Close button mobile -->
            <button @click="sidebarOpen = false"
                class="ml-auto lg:hidden text-slate-400 hover:text-white bg-white/5 p-1.5 rounded-lg border border-white/5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Sidebar Scrollable Menu -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-6 custom-scrollbar relative z-10">

        @php
            $role = auth()->user()->role;
            $isSuper = $role === 'superadmin';
            
            $dashboardRoute = match($role) {
                'superadmin' => '/superadmin/dashboard',
                'dokter' => '/dokter/dashboard',
                'apoteker' => '/apoteker/dashboard',
                'kasir' => '/kasir/dashboard',
                default => '/admin/dashboard',
            };
            
            $dashboardLabel = match($role) {
                'superadmin' => 'Pusat',
                'dokter' => 'Dokter',
                'apoteker' => 'Apoteker',
                'kasir' => 'Kasir',
                default => 'Utama',
            };
        @endphp

        <!-- UTAMA -->
        <div>
            <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Utama</p>
            <a href="{{ $dashboardRoute }}"
                class="group flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is(ltrim($dashboardRoute, '/')) ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is(ltrim($dashboardRoute, '/')) ? 'bg-white/20' : 'bg-slate-800/50 group-hover:bg-blue-500/20' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <span class="text-[13.5px]">Dashboard {{ $dashboardLabel }}</span>
            </a>
        </div>

        @if($isSuper)
            <!-- MANAJEMEN -->
            <div>
                <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Manajemen Data</p>
                <div class="space-y-1">
                    <!-- Dropdown Performa -->
                    <div x-data="{ open: {{ request()->is('superadmin/cabang*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full group flex items-center justify-between px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is('superadmin/cabang*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is('superadmin/cabang*') ? 'bg-blue-500/20 text-blue-400' : 'bg-slate-800/50 group-hover:bg-blue-500/20' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <span class="text-[13.5px]">Performa Cabang</span>
                            </div>
                            <svg :class="open ? 'rotate-180 text-blue-400' : 'text-slate-600'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-collapse x-cloak>
                            <div class="ml-8 mt-1 space-y-1 pl-4 border-l border-white/5">
                                @foreach(['slawi' => 'Slawi', 'tegal' => 'Tegal', 'brebes' => 'Brebes'] as $key => $name)
                                <a href="/superadmin/cabang/{{ $key }}" class="block px-4 py-2 text-[13px] font-bold transition-all {{ request()->is('superadmin/cabang/'.$key) ? 'text-blue-400' : 'text-slate-500 hover:text-slate-200' }}">Klinik {{ $name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Pengguna -->
                    <div x-data="{ open: {{ request()->is('superadmin/pengguna*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full group flex items-center justify-between px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is('superadmin/pengguna*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is('superadmin/pengguna*') ? 'bg-blue-500/20 text-blue-400' : 'bg-slate-800/50 group-hover:bg-blue-500/20' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="text-[13.5px]">Data Pengguna</span>
                            </div>
                            <svg :class="open ? 'rotate-180 text-blue-400' : 'text-slate-600'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-collapse x-cloak>
                            <div class="ml-8 mt-1 space-y-1 pl-4 border-l border-white/5">
                                @foreach(['dokter' => 'Dokter', 'admin' => 'Admin Cabang', 'apoteker' => 'Apoteker', 'kasir' => 'Kasir', 'pasien' => 'Pasien'] as $key => $label)
                                <a href="/superadmin/pengguna/{{ $key }}" class="block px-4 py-2 text-[13px] font-bold transition-all {{ request()->is('superadmin/pengguna/'.$key) ? 'text-blue-400' : 'text-slate-500 hover:text-slate-200' }}">Akun {{ $label }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Dokter -->
                    <a href="/superadmin/jadwal-dokter" class="group flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is('superadmin/jadwal-dokter*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is('superadmin/jadwal-dokter*') ? 'bg-orange-500/20 text-orange-400' : 'bg-slate-800/50 group-hover:bg-orange-500/20' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[13.5px]">Jadwal Dokter</span>
                    </a>

                    <!-- Dropdown Laporan -->
                    <div x-data="{ open: {{ request()->is('superadmin/laporan*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full group flex items-center justify-between px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is('superadmin/laporan*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is('superadmin/laporan*') ? 'bg-purple-500/20 text-purple-400' : 'bg-slate-800/50 group-hover:bg-purple-500/20' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                                <span class="text-[13.5px]">Laporan</span>
                            </div>
                            <svg :class="open ? 'rotate-180 text-purple-400' : 'text-slate-600'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-collapse x-cloak>
                            <div class="ml-8 mt-1 space-y-1 pl-4 border-l border-white/5">
                                <a href="/superadmin/laporan/pembayaran" class="block px-4 py-2 text-[13px] font-bold transition-all {{ request()->is('superadmin/laporan/pembayaran') ? 'text-purple-400' : 'text-slate-500 hover:text-slate-200' }}">Laporan Pembayaran</a>
                                <a href="/superadmin/laporan/pasien" class="block px-4 py-2 text-[13px] font-bold transition-all {{ request()->is('superadmin/laporan/pasien') ? 'text-purple-400' : 'text-slate-500 hover:text-slate-200' }}">Laporan Pasien</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KONFIGURASI -->
            <div>
                <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Konfigurasi</p>
                <a href="/superadmin/pengaturan/website" class="group flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-300 {{ request()->is('superadmin/pengaturan/website') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-300 {{ request()->is('superadmin/pengaturan/website') ? 'bg-emerald-500/20 text-emerald-400' : 'bg-slate-800/50 group-hover:bg-emerald-500/20' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                    </div>
                    <span class="text-[13.5px]">Pengaturan Web</span>
                </a>
            </div>
        @endif
    </nav>

    <!-- Sidebar Footer -->
    <div class="px-6 py-6 border-t border-white/5 bg-[#0a1424] relative z-20">
        <div class="flex items-center gap-3.5 p-3 bg-white/5 rounded-2xl border border-white/5 mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black text-sm shrink-0 shadow-lg">
                {{ substr(auth()->user()->nama ?? 'S', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-[13px] font-black text-white truncate leading-tight">{{ auth()->user()->nama ?? 'Admin' }}</p>
                <p class="text-[9px] font-black text-blue-500 uppercase tracking-widest mt-1">{{ auth()->user()->role }}</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" x-data="{ showLogoutConfirm: false }" x-ref="logoutForm">
            @csrf
            <button type="button" @click="showLogoutConfirm = true" 
                class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-[12px] bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition-all font-black uppercase tracking-widest">
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
</aside>
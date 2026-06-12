<header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6 lg:px-8 shrink-0 z-30 shadow-sm">
    <!-- Left side -->
    <div class="flex items-center gap-4">
        <!-- Mobile Menu Toggle -->
        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        @if(auth()->check() && auth()->user()->role !== 'superadmin')
        <div class="hidden md:flex items-center px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg max-w-md focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all">
            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Cari data pasien, cabang, dokter..." class="bg-transparent border-none outline-none ml-2 text-sm w-48 lg:w-64 placeholder-slate-400 text-slate-700 focus:ring-0 p-0">
        </div>
        @endif
    </div>

    <!-- Right side -->
    <div class="flex items-center gap-4 md:gap-6">
        <!-- Divider -->
        <div class="hidden md:block w-px h-8 bg-slate-200"></div>

        <!-- Profile Dropdown (Alpine) -->
        <div class="relative" x-data="{ userMenuOpen: false }">
            <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="flex items-center gap-3 hover:opacity-80 transition-opacity focus:outline-none">
                <div class="hidden md:block text-right">
                    <p class="text-sm font-bold text-slate-800">{{ auth()->user()->nama ?? 'Admin' }}</p>
                    <p class="text-xs text-primary font-medium capitalize">{{ auth()->user()->role ?? 'Superadmin' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-primary font-heading font-bold overflow-hidden shadow-sm">
                    {{ substr(auth()->user()->nama ?? 'A', 0, 1) }}
                </div>
                <svg class="hidden md:block w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="userMenuOpen" x-transition.origin.top.right class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-50">
                <div class="px-4 py-2 border-b border-slate-100 md:hidden">
                    <p class="text-sm font-bold text-slate-800">{{ auth()->user()->nama ?? 'Admin' }}</p>
                    <p class="text-xs text-primary font-medium capitalize">{{ auth()->user()->role ?? 'Superadmin' }}</p>
                </div>

            </div>
        </div>
    </div>
</header>

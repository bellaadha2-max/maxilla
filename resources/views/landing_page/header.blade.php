    <!-- Navbar -->
    <header class="fixed w-full z-50 transition-all duration-300" :class="{ 'bg-white/90 backdrop-blur-md shadow-sm py-3': scrolled, 'bg-transparent py-5': !scrolled }" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    @if(isset($setting) && $setting->logo_navbar)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($setting->logo_navbar) }}" alt="Logo Clinic" class="h-10 w-auto">
                    @else
                    <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo Maxilla Dental Care" class="h-10 w-auto">
                    <span class="font-heading font-bold text-xl tracking-tight text-secondary">Maxilla <span class="text-primary">Dental Care</span></span>
                    @endif
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#solusi" :class="activeSection === 'solusi' ? 'text-primary font-bold after:w-full' : 'text-slate-600 font-medium after:w-0'" class="text-sm hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:bg-primary after:transition-all after:duration-300">Solusi</a>
                    <a href="#estimasi" :class="activeSection === 'estimasi' ? 'text-primary font-bold after:w-full' : 'text-slate-600 font-medium after:w-0'" class="text-sm hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:bg-primary after:transition-all after:duration-300">Cara Kerja Estimasi</a>
                    <a href="#alur" :class="activeSection === 'alur' ? 'text-primary font-bold after:w-full' : 'text-slate-600 font-medium after:w-0'" class="text-sm hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:bg-primary after:transition-all after:duration-300">Alur Pasien</a>
                    <a href="#cabang" :class="activeSection === 'cabang' ? 'text-primary font-bold after:w-full' : 'text-slate-600 font-medium after:w-0'" class="text-sm hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:bg-primary after:transition-all after:duration-300">Cabang</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">Login</a>
                    <a href="/register" class="px-5 py-2.5 rounded-full bg-primary hover:bg-primaryDark text-white text-sm font-medium tracking-wide transition-all shadow-md shadow-primary/30 transform hover:-translate-y-0.5">Daftar Pasien</a>
                </div>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden rounded-md p-2 text-slate-600 hover:text-primary hover:bg-slate-100 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-slate-100 flex flex-col py-4 px-4 space-y-4">
            <a href="#solusi" @click="mobileMenuOpen = false" class="text-base font-medium text-slate-600">Solusi</a>
            <a href="#estimasi" @click="mobileMenuOpen = false" class="text-base font-medium text-slate-600">Estimasi Waktu</a>
            <a href="#alur" @click="mobileMenuOpen = false" class="text-base font-medium text-slate-600">Alur Pasien</a>
            <a href="#cabang" @click="mobileMenuOpen = false" class="text-base font-medium text-slate-600">Cabang</a>
            <div class="h-px bg-slate-200 w-full my-2"></div>
            <a href="/login" class="text-base font-medium text-slate-600 text-center">Login</a>
            <a href="/register" class="px-5 py-2.5 rounded-full bg-primary text-white text-base font-medium text-center">Daftar Pasien</a>
        </div>
    </header>

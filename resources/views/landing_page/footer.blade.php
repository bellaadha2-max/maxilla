<!-- CTAs & Footer -->
<footer class="bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div
            class="bg-primary rounded-3xl p-8 md:p-12 mb-16 flex flex-col md:flex-row items-center justify-between text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-white/10 blur-2xl"></div>
            <div class="max-w-2xl relative z-10 mb-8 md:mb-0">
                <h3 class="font-heading text-3xl font-bold mb-4">Bebas dari Antrian yang Melelahkan</h3>
                <p class="text-white/80 text-lg">Buat janji temu sekarang dan nikmati layanan profesional Maxilla dengan
                    kepastian jadwal.</p>
            </div>
            <div class="relative z-10 flex gap-4 w-full md:w-auto">
                <a href="#"
                    class="px-8 py-3.5 bg-white text-primary hover:bg-slate-50 font-bold rounded-full w-full sm:w-auto text-center transition-transform transform hover:-translate-y-0.5 shadow-lg">Mulai
                    Booking</a>
            </div>
        </div>

        <div class="grid grid-cols-1 select-none md:grid-cols-4 gap-12 text-slate-400 text-sm">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    @if(isset($setting) && $setting->logo_navbar)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($setting->logo_navbar) }}" alt="Logo Clinic"
                            class="h-10 w-auto">
                    @else
                        <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo Maxilla Dental Care" class="h-10 w-auto">
                        <span class="font-heading font-bold text-xl tracking-tight text-white">Maxilla <span
                                class="text-primary">Dental Care</span></span>
                    @endif
                </div>
                <p class="text-slate-400 mb-6 max-w-md">
                    {{ $setting->footer_deskripsi ?? 'Informasi Pemesanan dan Manajemen Antrian Maxilla Dental Care. Hubungi kami untuk bantuan lebih lanjut.' }}
                </p>
            </div>

            <div>
                <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Akses Langsung</h5>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-primary transition-colors">Booking Jadwal</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Cek Status Antrian</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Portal Dokter</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Admin Dashboard</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Bantuan</h5>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-primary transition-colors">Cara Penggunaan Aplikasi</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Bantuan WhatsApp</a></li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between text-slate-500 text-xs text-center md:text-left shadow-md">
            <p>{{ $setting['teks_copyright'] ?? '© 2026 Klinik Maxilla. All Rights Reserved.' }} |
                <strong>{{ $setting['kontak_telepon'] ?? '' }}</strong> - {{ $setting['kontak_email'] ?? '' }}</p>
            <p class="mt-2 md:mt-0">Sistem Manajemen Antrian Pintar Tingkat Lanjut</p>
        </div>
    </div>
</footer>
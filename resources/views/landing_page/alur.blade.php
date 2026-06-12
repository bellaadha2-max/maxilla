    <!-- Alur Kerja -->
    <section id="alur" class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 relative z-10">
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-secondary mb-6">{{ $setting->alur_judul ?? 'Langkah Mudah Menggunakan Maxilla' }}</h3>
                <p class="text-slate-600 text-lg">{{ $setting->alur_deskripsi ?? 'Hanya butuh 3 langkah untuk memastikan kursi gigi Anda telah terjadwal dengan pasti.' }}</p>
            </div>

            <div class="relative">
                <!-- Line connect (Desktop) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-slate-200"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    @if(isset($setting) && is_array($setting->alur_pasien) && count($setting->alur_pasien) > 0)
                        @foreach($setting->alur_pasien as $index => $alur)
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto {{ $index == 1 ? 'bg-primary border-4 border-sky-200 text-white shadow-lg shadow-primary/30' : 'bg-white border-4 border-slate-200 text-secondary shadow-sm' }} rounded-full flex items-center justify-center font-heading text-3xl font-bold mb-6 z-10 relative">
                                {{ $index + 1 }}
                            </div>
                            <h4 class="font-bold text-xl mb-3 text-secondary">{{ is_array($alur) ? ($alur['title'] ?? 'Langkah '.($index + 1)) : ('Langkah '.($index + 1)) }}</h4>
                            <p class="text-slate-600">{{ is_array($alur) ? ($alur['desc'] ?? '') : $alur }}</p>
                        </div>
                        @endforeach
                    @else
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-200 text-secondary rounded-full flex items-center justify-center font-heading text-3xl font-bold mb-6 shadow-sm z-10 relative">1</div>
                        <h4 class="font-bold text-xl mb-3 text-secondary">Registrasi & Login</h4>
                        <p class="text-slate-600">Buat akun untuk merekam riwayat medis dasar Anda. Pasien baru dapat mendaftar dalam waktu kurang dari dua menit.</p>
                    </div>
                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-primary border-4 border-sky-200 text-white rounded-full flex items-center justify-center mb-6 shadow-lg shadow-primary/30 z-10 relative">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="font-bold text-xl mb-3 text-secondary">Pilih & Booking Jadwal</h4>
                        <p class="text-slate-600">Tentukan Cabang (Slawi, Tegal, Brebes), pilih dokter, lalu booking sesi pengobatan Anda kapan saja maksimal h-14.</p>
                    </div>
                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-slate-200 text-secondary rounded-full flex items-center justify-center mb-6 shadow-sm z-10 relative">
                            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="font-bold text-xl mb-3 text-secondary">Pantau & Datang (H-Hari)</h4>
                        <p class="text-slate-600">Lihat nomor antrean aktual dan datang ke klinik sesuai Estimasi Waktu Tunggu yang diberikan notifikasi.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Maxilla? (Solusi) -->
    <section id="solusi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary font-bold tracking-wider text-sm uppercase mb-4 block">{{ $setting->solusi_badge ?? 'MENGAPA MAXILLA DENTAL CARE?' }}</span>
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-secondary mb-6">{{ $setting->solusi_judul ?? 'Selamat Tinggal Antrian Manual' }}</h3>
                <p class="text-slate-600 text-lg leading-relaxed">{{ $setting->solusi_deskripsi ?? 'Solusi Cerdas Operasional Klinik. Sebelumnya pasien tidak mengetahui jam pasti dilayani sehingga terjadi penumpukan di ruang tunggu.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if(isset($setting) && is_array($setting->layanan_medis) && count($setting->layanan_medis) > 0)
                    @php
                        $icons = [
                            '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                            '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                            '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>',
                            '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                            '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                        ];
                        $colors = [
                            'bg-sky-100 text-primary',
                            'bg-indigo-100 text-indigo-600',
                            'bg-emerald-100 text-emerald-600',
                            'bg-amber-100 text-amber-600',
                            'bg-rose-100 text-rose-600'
                        ];
                    @endphp
                    @foreach($setting->layanan_medis as $index => $layanan)
                    <div class="bg-surface rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:border-primary/30 transition-all duration-300 group">
                        <div class="w-14 h-14 {{ $colors[$index % count($colors)] }} rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            {!! $icons[$index % count($icons)] !!}
                        </div>
                        <h4 class="font-heading text-xl font-bold text-secondary mb-3">{{ $layanan['title'] ?? '' }}</h4>
                        <p class="text-slate-600 leading-relaxed">{{ $layanan['desc'] ?? '' }}</p>
                    </div>
                    @endforeach
                @else
                <!-- Card 1 -->
                <div class="bg-surface rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:border-primary/30 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-sky-100 text-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-heading text-xl font-bold text-secondary mb-3">Booking Online 24/7</h4>
                    <p class="text-slate-600 leading-relaxed">Pilih jadwal, cabang, dan dokter langganan Anda secara mandiri langsung dari smartphone tanpa perlu repot chat admin.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-surface rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:border-primary/30 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-heading text-xl font-bold text-secondary mb-3">Jam Transparan</h4>
                    <p class="text-slate-600 leading-relaxed">Setiap nomor antrian secara otomatis mendapatkan estimasi jam dilayani, menjaga kedisiplinan jadwal dan mengurangi penumpukan.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-surface rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:border-primary/30 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <h4 class="font-heading text-xl font-bold text-secondary mb-3">Live Notification</h4>
                    <p class="text-slate-600 leading-relaxed">Anda akan menerima notifikasi status jadwal, update estimasi jam, serta pengingat saat giliran hampir tiba.</p>
                </div>
                @endif
            </div>
        </div>
    </section>

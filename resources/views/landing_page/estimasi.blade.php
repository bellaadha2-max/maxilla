    <!-- Fitur & Novelty -->
    <section id="estimasi" class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 rounded-full bg-primary/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto">
                <!-- Deskripsi Waktu Tunggu -->
                <div class="text-white">
                    <span class="text-blue-300 font-bold tracking-wider text-sm uppercase mb-4 block">{{ $setting->estimasi_badge ?? 'SMART QUEUE SYSTEM' }}</span>
                    <h3 class="font-heading text-3xl md:text-4xl font-bold mb-6 leading-tight">{{ $setting->estimasi_judul ?? 'Estimasi Waktu Tunggu Otomatis & Presisi' }}</h3>
                    <p class="text-blue-100 text-lg mb-8 leading-relaxed">{{ $setting->estimasi_deskripsi ?? 'Sistem kami tidak sekadar membagi jam buka. Algoritma kami secara cerdas menghitung durasi historis setiap jenis tindakan dari masing-masing dokter bedah mulut.' }}</p>
                    
                    <ul class="space-y-6">
                        @if(isset($setting) && is_array($setting->estimasi_steps) && count($setting->estimasi_steps) > 0)
                            @foreach($setting->estimasi_steps as $index => $step)
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-white shrink-0">{{ $index + 1 }}</div>
                                <div>
                                    <h5 class="font-bold text-lg text-white">{{ $step['title'] ?? '' }}</h5>
                                    <p class="text-slate-400 mt-1">{{ $step['desc'] ?? '' }}</p>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-white shrink-0">1</div>
                                <div>
                                    <h5 class="font-bold text-lg text-white">Dokter Mencatat Waktu Praktek</h5>
                                    <p class="text-slate-400 mt-1">Saat melayani pasien, dokter menggunakan timer kami untuk mencatat durasi pelayanan secara riil.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-white shrink-0">2</div>
                                <div>
                                    <h5 class="font-bold text-lg text-white">Sistem Memperbarui Rata-rata</h5>
                                    <p class="text-slate-400 mt-1">Rata-rata kecepatan pelayanan dokter tersebut diupdate otomatis tiap kali ada pasien yang selesai.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-white shrink-0">3</div>
                                <div>
                                    <h5 class="font-bold text-lg text-white">Jam Antrian Menyesuaikan</h5>
                                    <p class="text-slate-400 mt-1">Pasien yang sedang menunggu akan menerima pembaruan jadwalnya secara dinamis. Anda tahu persis kapan harus berangkat!</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabel Estimasi Harga (Dari CMS) -->
        @if(isset($setting) && is_array($setting->estimasi_harga) && count($setting->estimasi_harga) > 0)
        <div class="max-w-4xl mx-auto mt-20 relative z-10 bg-slate-800/50 rounded-2xl p-8 border border-slate-700 backdrop-blur-sm">
            <h4 class="font-heading text-2xl font-bold mb-6 text-center text-white">Estimasi Biaya Tindakan Medis</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-slate-300">
                    <thead>
                        <tr class="border-b border-slate-700">
                            <th class="py-3 px-4 text-slate-400 font-medium">Jenis Perawatan</th>
                            <th class="py-3 px-4 text-slate-400 font-medium text-right">Harga Mulai Dari</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setting->estimasi_harga as $harga)
                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30 transition-colors">
                            <td class="py-4 px-4 font-medium">{{ $harga['name'] ?? '' }}</td>
                            <td class="py-4 px-4 text-emerald-400 font-bold text-right">{{ $harga['price'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-center text-xs text-slate-500 mt-4">*Harga dapat berubah sesuai dengan tingkat keparahan kasus masing-masing pasien.</p>
        </div>
        @endif
    </section>

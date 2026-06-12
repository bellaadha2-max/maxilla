<!-- 4: ALUR -->
<div x-show="tab === 'alur'" x-transition.opacity.duration.300ms class="space-y-6" style="display: none;">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
        <h3 class="font-bold text-lg text-slate-800 mb-1">Modul: alur.blade.php</h3>
        <div class="flex justify-between items-start mb-4 pb-4 border-b border-slate-100">
            <p class="text-xs font-medium text-slate-500">Langkah-langkah pendaftaran / Flow periksa yang tayang di infografis.</p>
            <button type="button" onclick="addAlur()" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100">+ Tambah Langkah</button>
        </div>
        
        <div class="space-y-4" id="alur-container">
            @if(is_array($setting->alur_pasien) && count($setting->alur_pasien) > 0)
                @foreach($setting->alur_pasien as $index => $alur)
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center shrink-0">{{ $index + 1 }}</div>
                    <div class="flex-1 space-y-2">
                        <input type="text" name="alur_titles[]" value="{{ is_array($alur) ? ($alur['title'] ?? '') : ('Langkah '.($index + 1)) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm font-bold" placeholder="Judul Alur">
                        <textarea name="alur_descs[]" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-600" rows="2" placeholder="Deskripsi Alur...">{{ is_array($alur) ? ($alur['desc'] ?? '') : $alur }}</textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs mt-2">X</button>
                </div>
                @endforeach
            @else
                <!-- Default Alur -->
                @php
                    $def_alurs = [
                        ['title' => 'Registrasi & Login', 'desc' => 'Buat akun untuk merekam riwayat medis dasar Anda. Pasien baru dapat mendaftar dalam waktu kurang dari dua menit.'],
                        ['title' => 'Pilih & Booking Jadwal', 'desc' => 'Tentukan Cabang (Slawi, Tegal, Brebes), pilih dokter, lalu booking sesi pengobatan Anda kapan saja maksimal h-14.'],
                        ['title' => 'Pantau & Datang (H-Hari)', 'desc' => 'Lihat nomor antrean aktual dan datang ke klinik sesuai Estimasi Waktu Tunggu yang diberikan notifikasi.'],
                    ];
                @endphp
                @foreach($def_alurs as $index => $alur)
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center shrink-0">{{ $index + 1 }}</div>
                    <div class="flex-1 space-y-2">
                        <input type="text" name="alur_titles[]" value="{{ $alur['title'] }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm font-bold" placeholder="Judul Alur">
                        <textarea name="alur_descs[]" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-600" rows="2" placeholder="Deskripsi Alur...">{{ $alur['desc'] }}</textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs mt-2">X</button>
                </div>
                @endforeach
            @endif
        </div>
        <script>
            function addAlur() {
                const html = `
                <div class="flex gap-4 items-center mt-4">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center shrink-0">#</div>
                    <div class="flex-1 space-y-2">
                        <input type="text" name="alur_titles[]" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm font-bold" placeholder="Judul Alur Baru">
                        <textarea name="alur_descs[]" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-600" rows="2" placeholder="Deskripsi Alur..."></textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs mt-2">X</button>
                </div>`;
                document.getElementById('alur-container').insertAdjacentHTML('beforeend', html);
            }
        </script>
    </div>
</div>

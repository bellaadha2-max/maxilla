<!-- 2: SOLUSI -->
<div x-show="tab === 'solusi'" x-transition.opacity.duration.300ms class="space-y-6" style="display: none;">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
        <div class="flex justify-between items-start mb-4 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Modul: solusi.blade.php</h2>
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Badge Sesi Solusi</label>
                        <input type="text" name="solusi_badge" value="{{ $setting->solusi_badge ?? 'MENGAPA MAXILLA DENTAL CARE?' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Judul Utama Solusi</label>
                        <input type="text" name="solusi_judul" value="{{ $setting->solusi_judul ?? 'Selamat Tinggal Antrian Manual' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div class="w-full md:col-span-2 mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Deskripsi Paragraf Solusi</label>
                        <textarea name="solusi_deskripsi" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Maksud dari bagian layanan solutif ini...">{{ $setting->solusi_deskripsi ?? 'Solusi Cerdas Operasional Klinik. Sebelumnya pasien tidak mengetahui jam pasti dilayani sehingga terjadi penumpukan di ruang tunggu.' }}</textarea>
                    </div>
                </div>

                <div class="mb-4 bg-slate-50 p-4 border border-slate-100 rounded-xl flex justify-between items-center group">
                    <p class="text-xs text-slate-500 font-medium">Sesi di bawah ini berisi daftar layanan atau keunggulan klinik (Card Grid).</p>
                    <button type="button" onclick="addLayanan()" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100">+ Tambah Layanan</button>
                </div>
            </div>
        </div>
        
        <div class="space-y-3" id="layanan-container">
            @if(is_array($setting->layanan_medis))
                @foreach($setting->layanan_medis as $index => $layanan)
                <div class="flex flex-col sm:flex-row gap-4 border border-slate-200 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="flex-1">
                        <input type="text" name="layanan_titles[]" value="{{ $layanan['title'] ?? '' }}" class="w-full font-bold text-sm text-slate-800 bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1 mb-2" placeholder="Judul Layanan (Misal: Ortodonti)">
                        <input type="text" name="layanan_descs[]" value="{{ $layanan['desc'] ?? '' }}" class="w-full text-xs text-slate-500 bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1" placeholder="Deskripsi Singkat Layanan">
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 px-2 flex items-center shrink-0 text-xs font-bold bg-red-50 rounded-lg">Hapus</button>
                </div>
                @endforeach
            @endif
        </div>
        <script>
            function addLayanan() {
                const html = `
                <div class="flex flex-col sm:flex-row gap-4 border border-slate-200 p-3 rounded-xl hover:bg-slate-50 transition-colors mt-3">
                    <div class="flex-1">
                        <input type="text" name="layanan_titles[]" class="w-full font-bold text-sm text-slate-800 bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1 mb-2" placeholder="Judul Layanan">
                        <input type="text" name="layanan_descs[]" class="w-full text-xs text-slate-500 bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1" placeholder="Deskripsi Singkat">
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 px-2 flex items-center shrink-0 text-xs font-bold bg-red-50 rounded-lg">Hapus</button>
                </div>`;
                document.getElementById('layanan-container').insertAdjacentHTML('beforeend', html);
            }
        </script>
    </div>
</div>

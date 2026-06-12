<!-- 3: ESTIMASI -->
<div x-show="tab === 'estimasi'" x-transition.opacity.duration.300ms class="space-y-6" style="display: none;">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
        <div class="flex flex-col mb-4 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Modul: estimasi.blade.php</h2>
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Badge (SMART QUEUE)</label>
                        <input type="text" name="estimasi_badge" value="{{ $setting->estimasi_badge ?? 'SMART QUEUE SYSTEM' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Judul Sesi Estimasi</label>
                        <input type="text" name="estimasi_judul" value="{{ $setting->estimasi_judul ?? 'Estimasi Waktu Tunggu Otomatis & Presisi' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div class="w-full md:col-span-2 mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Paragraf Penjelasan Sistem Reservasi</label>
                        <textarea name="estimasi_deskripsi" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Penjelasan mengenai estimasi...">{{ $setting->estimasi_deskripsi ?? 'Sistem kami tidak sekadar membagi jam buka. Algoritma kami secara cerdas menghitung durasi historis setiap jenis tindakan dari masing-masing dokter bedah mulut.' }}</textarea>
                    </div>
                </div>

                <div class="mb-4 bg-slate-50 p-4 border border-slate-100 rounded-xl flex justify-between items-center">
                    <p class="text-xs text-slate-500 font-medium">Sesi di bawah ini berisi tabel harga standar / promo (Price list).</p>
                    <button type="button" onclick="addEstimasi()" class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold hover:bg-emerald-100">+ Tambah Harga</button>
                </div>
            </div>
            
            <table class="w-full text-left text-sm mt-3" id="tabel-estimasi">
                <thead><tr class="text-slate-500 border-b"><th class="py-2">Nama Tindakan</th><th>Harga (Mulai dari)</th><th>Aksi</th></tr></thead>
                <tbody>
                    @if(is_array($setting->estimasi_harga))
                        @foreach($setting->estimasi_harga as $estimasi)
                        <tr class="border-b border-slate-100">
                            <td class="py-3 font-bold text-slate-700">
                                <input type="text" name="estimasi_names[]" value="{{ $estimasi['name'] ?? '' }}" class="w-full text-sm bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1" placeholder="Nama Tindakan">
                            </td>
                            <td class="text-emerald-600 font-bold">
                                <input type="text" name="estimasi_prices[]" value="{{ $estimasi['price'] ?? '' }}" class="w-full text-sm bg-transparent border-b border-dashed border-emerald-300 focus:border-emerald-500 outline-none pb-1" placeholder="Rp ...">
                            </td>
                            <td><button type="button" onclick="this.closest('tr').remove()" class="text-red-500 text-xs font-bold hover:underline">Hapus</button></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <script>
                function addEstimasi() {
                    const html = `
                        <tr class="border-b border-slate-100">
                            <td class="py-3 font-bold text-slate-700">
                                <input type="text" name="estimasi_names[]" class="w-full text-sm bg-transparent border-b border-dashed border-slate-300 focus:border-blue-500 outline-none pb-1" placeholder="Nama Tindakan">
                            </td>
                            <td class="text-emerald-600 font-bold">
                                <input type="text" name="estimasi_prices[]" class="w-full text-sm bg-transparent border-b border-dashed border-emerald-300 focus:border-emerald-500 outline-none pb-1" placeholder="Rp ...">
                            </td>
                            <td><button type="button" onclick="this.closest('tr').remove()" class="text-red-500 text-xs font-bold hover:underline">Hapus</button></td>
                        </tr>`;
                    document.querySelector('#tabel-estimasi tbody').insertAdjacentHTML('beforeend', html);
                }
            </script>
        </div>

        <h4 class="font-bold text-slate-800 mt-8 mb-4 border-b border-slate-100 pb-2">Daftar Langkah Waktu Tunggu (Estimasi Steps)</h4>
        <div class="space-y-3 mt-4" id="estimasi-step-container">
            @if(is_array($setting->estimasi_steps) && count($setting->estimasi_steps) > 0)
                @foreach($setting->estimasi_steps as $step)
                <div class="flex gap-4 items-center bg-slate-50 p-3 rounded-xl border border-slate-200">
                    <div class="flex-1 space-y-2">
                        <input type="text" name="estimasi_step_titles[]" value="{{ $step['title'] ?? '' }}" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-bold" placeholder="Judul Langkah">
                        <textarea name="estimasi_step_descs[]" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-600" rows="2" placeholder="Deskripsi Langkah">{{ $step['desc'] ?? '' }}</textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs hover:bg-red-50 px-2 py-6 rounded-md">X</button>
                </div>
                @endforeach
            @else
                <!-- Defaults -->
                @php
                    $def_est_steps = [
                        ['title' => 'Dokter Mencatat Waktu Praktek', 'desc' => 'Saat melayani pasien, dokter menggunakan timer kami untuk mencatat durasi pelayanan secara riil.'],
                        ['title' => 'Sistem Memperbarui Rata-rata', 'desc' => 'Rata-rata kecepatan pelayanan dokter tersebut diupdate otomatis tiap kali ada pasien yang selesai.'],
                        ['title' => 'Jam Antrian Menyesuaikan', 'desc' => 'Pasien yang sedang menunggu akan menerima pembaruan jadwalnya secara dinamis. Anda tahu persis kapan harus berangkat!'],
                    ];
                @endphp
                @foreach($def_est_steps as $step)
                <div class="flex gap-4 items-center bg-slate-50 p-3 rounded-xl border border-slate-200">
                    <div class="flex-1 space-y-2">
                        <input type="text" name="estimasi_step_titles[]" value="{{ $step['title'] }}" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-bold" placeholder="Judul Langkah">
                        <textarea name="estimasi_step_descs[]" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-600" rows="2" placeholder="Deskripsi Langkah">{{ $step['desc'] }}</textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs hover:bg-red-50 px-2 py-6 rounded-md">X</button>
                </div>
                @endforeach
            @endif
        </div>
        <button type="button" onclick="addEstimasiStep()" class="mt-4 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100">+ Tambah Langkah Estimasi</button>

        <script>
            function addEstimasiStep() {
                const html = `
                <div class="flex gap-4 items-center bg-slate-50 p-3 rounded-xl border border-slate-200 mt-3">
                    <div class="flex-1 space-y-2">
                        <input type="text" name="estimasi_step_titles[]" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-bold" placeholder="Judul Langkah">
                        <textarea name="estimasi_step_descs[]" class="w-full border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-600" rows="2" placeholder="Deskripsi Langkah"></textarea>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold text-xs hover:bg-red-50 px-2 py-6 rounded-md">X</button>
                </div>`;
                document.getElementById('estimasi-step-container').insertAdjacentHTML('beforeend', html);
            }
        </script>
    </div>
</div>

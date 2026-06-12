<!-- 1: HEADER & LANDING -->
<div x-show="tab === 'header'" x-transition.opacity.duration.300ms class="space-y-6" x-cloak>
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
        <h3 class="font-bold text-lg text-slate-800 mb-2">Modul: header.blade.php & landing.blade.php</h3>
        <p class="text-xs font-medium text-slate-500 mb-4 pb-4 border-b border-slate-100">Panel navigasi atas dan elemen Hero utama (Gambar Latar, Tagline, dan Selamat Datang).</p>
        
        <div class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Badge (Label Kecil)</label>
                    <input type="text" name="hero_badge" value="{{ $setting->hero_badge ?? 'Sistem Manajemen Antrian Real-Time' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Sistem Manajemen Antrian Real-Time">
                </div>
                <div class="w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Judul Utama (Hero Headline)</label>
                    <input type="text" name="hero_headline" value="{{ $setting->hero_headline ?? 'Perawatan Gigi Terbaik & Modern' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Perawatan Gigi Terbaik & Modern">
                </div>
                <div class="w-full md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Deskripsi Singkat (Hero Sub-Headline)</label>
                    <textarea name="hero_subheadline" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Nikmati kemudahan layanan rawat gigi di Maxilla Dental Care...">{{ $setting->hero_subheadline ?? 'Nikmati kemudahan layanan rawat gigi di Maxilla Dental Care. Sistem cerdas kami memberikan Anda jadwal pasti dan estimasi waktu tunggu real-time tanpa perlu antre berlama-lama di klinik.' }}</textarea>
                </div>
                <div class="w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Logo Navbar</label>
                    <input type="file" name="logo_navbar" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                    @if($setting->logo_navbar)
                    <div class="mt-2 text-xs text-emerald-600 font-medium font-mono flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 
                        Logo Aktif (Tersimpan)
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="pt-4 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Tombol Aksi 1 (Gelap)</label>
                    <input type="text" name="hero_button1_text" value="{{ $setting->hero_button1_text ?? 'Booking Sekarang' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Booking Sekarang">
                </div>
                <div class="w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Teks Tombol Aksi 2 (Terang)</label>
                    <input type="text" name="hero_button2_text" value="{{ $setting->hero_button2_text ?? 'Lihat Panduan' }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-blue-500 focus:ring-1 outline-none" placeholder="Lihat Panduan">
                </div>
            </div>
            
            <div class="pt-4 border-t border-slate-100">
                <div class="flex justify-between items-center mb-3">
                    <label class="block text-sm font-bold text-slate-700">Daftar Poin Ceklis Hijau (Bawah Tombol)</label>
                    <button type="button" onclick="addHeroCheckmark()" class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold hover:bg-green-100">+ Tambah Ceklis</button>
                </div>
                <div class="space-y-3" id="hero-checkmark-container">
                    @if(is_array($setting->hero_checkmarks) && count($setting->hero_checkmarks) > 0)
                        @foreach($setting->hero_checkmarks as $check)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <input type="text" name="hero_checkmarks[]" value="{{ $check }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-green-500 focus:ring-1 outline-none">
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 font-bold text-xl px-2">&times;</button>
                        </div>
                        @endforeach
                    @else
                        <!-- Default checks if empty -->
                        @foreach(['Slawi', 'Tegal', 'Brebes'] as $defCheck)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <input type="text" name="hero_checkmarks[]" value="{{ $defCheck }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-green-500 focus:ring-1 outline-none">
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 font-bold text-xl px-2">&times;</button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <script>
                    function addHeroCheckmark() {
                        const html = `
                        <div class="flex items-center gap-3 mt-3">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <input type="text" name="hero_checkmarks[]" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:border-green-500 focus:ring-1 outline-none" placeholder="Nama Lokasi / Fitur">
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 font-bold text-xl px-2">&times;</button>
                        </div>`;
                        document.getElementById('hero-checkmark-container').insertAdjacentHTML('beforeend', html);
                    }
                </script>
            </div>
        </div>
    </div>
</div>

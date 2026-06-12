<!-- Modal Overlay -->
<div x-show="showModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <!-- Background overlay -->
        <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-secondary/80 backdrop-blur-sm transition-opacity" @click="showModal = false" aria-hidden="true"></div>

        <!-- Tricker to center modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal Panel -->
        <div x-show="showModal" 
            x-transition:enter="ease-out duration-300" 
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave="ease-in duration-200" 
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full border border-slate-100">
            
            <!-- Header -->
            <div class="bg-surface px-6 py-4 flex justify-between items-center border-b border-slate-100">
                <h3 class="text-lg leading-6 font-heading font-bold text-secondary flex items-center gap-2" id="modal-title">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informasi Detail Cabang
                </h3>
                <button type="button" @click="showModal = false" class="bg-white rounded-full p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none transition-colors">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content Slawi -->
            <div x-show="activeBranch === 'slawi'" class="p-6 sm:p-8">
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=400" alt="Klinik Slawi" class="w-full h-40 object-cover rounded-xl shadow-sm border border-slate-200">
                    </div>
                    <div class="w-full md:w-2/3">
                        <h4 class="font-heading font-bold text-2xl text-secondary mb-1">Maxilla Dental Care Slawi</h4>
                        <p class="text-primary font-medium mb-4 text-sm">Pusat Layanan Utama</p>
                        
                        <div class="flex items-start gap-3 mb-3 shrink-0">
                            <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-primary shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <div class="text-sm">
                                <span class="block font-bold text-slate-700">Alamat Lengkap</span>
                                <span class="text-slate-600 leading-relaxed">Jl. Letjen Suprapto, Slawi, Kab. Tegal, Jawa Tengah, Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Google Maps Embed -->
                <div class="w-full h-72 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-inner">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.1265691079366!2d109.13600615!3d-6.9859068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fbeef5a20af9b%3A0x6bbaace66b0337ad!2sSlawi%2C%20Tegal%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Content Tegal -->
            <div x-show="activeBranch === 'tegal'" class="p-6 sm:p-8" style="display: none;">
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=400" alt="Klinik Tegal" class="w-full h-40 object-cover rounded-xl shadow-sm border border-slate-200">
                    </div>
                    <div class="w-full md:w-2/3">
                        <h4 class="font-heading font-bold text-2xl text-secondary mb-1">Maxilla Dental Care Tegal</h4>
                        <p class="text-primary font-medium mb-4 text-sm">Cabang Kota Tegal</p>
                        
                        <div class="flex items-start gap-3 mb-3 shrink-0">
                            <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-primary shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <div class="text-sm">
                                <span class="block font-bold text-slate-700">Alamat Lengkap</span>
                                <span class="text-slate-600 leading-relaxed">Jl. Kapten Sudibyo, Randugunting, Kec. Tegal Sel., Kota Tegal, Jawa Tengah 52131</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Google Maps Embed -->
                <div class="w-full h-72 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-inner">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.205216654769!2d109.11718015000001!3d-6.8845787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9e2b100e479%3A0xa14cba4ced1b272f!2sTegal%2C%20Tegal%20City%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Content Brebes -->
            <div x-show="activeBranch === 'brebes'" class="p-6 sm:p-8" style="display: none;">
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="w-full md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&q=80&w=400" alt="Klinik Brebes" class="w-full h-40 object-cover rounded-xl shadow-sm border border-slate-200">
                    </div>
                    <div class="w-full md:w-2/3">
                        <h4 class="font-heading font-bold text-2xl text-secondary mb-1">Maxilla Dental Care Brebes</h4>
                        <p class="text-primary font-medium mb-4 text-sm">Cabang Brebes</p>
                        
                        <div class="flex items-start gap-3 mb-3 shrink-0">
                            <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-primary shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <div class="text-sm">
                                <span class="block font-bold text-slate-700">Alamat Lengkap</span>
                                <span class="text-slate-600 leading-relaxed">Jl. Jend. Sudirman, Brebes, Kec. Brebes, Kabupaten Brebes, Jawa Tengah 52212</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Google Maps Embed -->
                <div class="w-full h-72 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-inner">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31688.16911634567!2d109.0210747!3d-6.8833959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb76920fec7e1%3A0xc3f982987a0b5a34!2sBrebes%2C%20Brebes%20Sub-District%2C%20Brebes%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center rounded-b-2xl border-t border-slate-100">
                <!-- <a href="#estimasi" @click="showModal = false" class="text-sm font-bold text-primary hover:text-blue-600 hover:underline">Lihat Cara Reservasi &rarr;</a>
                <button type="button" @click="showModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent shadow-[0_4px_10px_rgb(14,165,233,0.3)] px-6 py-2.5 bg-primary text-base font-bold text-white hover:bg-blue-600 focus:outline-none transition-colors">
                    Tutup Popup
                </button> -->
            </div>
        </div>
    </div>
</div>

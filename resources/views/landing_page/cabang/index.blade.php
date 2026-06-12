    <!-- Cabang & Dokter -->
    <section id="cabang" class="py-20 bg-white" x-data="{ showModal: false, activeBranch: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-xl">
                    <h3 class="font-heading text-3xl font-bold text-secondary mb-4">{{ $setting->cabang_judul ?? 'Tersebar di 3 Kota Besar' }}</h3>
                    <p class="text-slate-600">{{ $setting->cabang_subjudul ?? 'Kami siap memberikan pelayanan terbaik dengan tenaga medis profesional di berbagai wilayah.' }}</p>
                </div>
                <!-- <a href="#" class="px-6 py-2.5 rounded-full border border-slate-300 hover:border-primary text-secondary hover:text-primary transition-colors font-medium text-sm">Lihat Semua Cabang</a> -->
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if(isset($setting) && is_array($setting->cabang_list) && count($setting->cabang_list) > 0)
                    @php
                        $cabang_images = [
                            'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&q=80&w=800'
                        ];
                    @endphp
                    @foreach($setting->cabang_list as $index => $cabang)
                    <div class="rounded-2xl overflow-hidden border border-slate-200 group flex flex-col">
                        <div class="h-48 bg-slate-200 relative overflow-hidden">
                            <img src="{{ $cabang_images[$index % 3] }}" alt="Klinik {{ $cabang['name'] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <h4 class="absolute bottom-4 left-5 text-white font-heading font-bold text-xl">{{ $cabang['name'] ?? '' }}</h4>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start gap-3 mb-4">
                                <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-slate-600 text-sm">{{ $cabang['address'] ?? '' }}</p>
                            </div>
                            <div class="mt-auto pt-2">
                                <button @click.prevent="showModal = true; activeBranch = '{{ Str::slug(Str::remove('Maxilla Dental Care', $cabang['name'] ?? '')) }}'" class="block w-full text-center px-4 py-2 bg-sky-50 hover:bg-sky-100 text-primary font-bold rounded-lg transition-colors">
                                    Detail Cabang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Cabang Slawi -->
                    <div class="rounded-2xl overflow-hidden border border-slate-200 group flex flex-col">
                        <div class="h-48 bg-slate-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=800" alt="Klinik Slawi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <h4 class="absolute bottom-4 left-5 text-white font-heading font-bold text-xl">Maxilla Dental Care Slawi</h4>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start gap-3 mb-4">
                                <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-slate-600 text-sm">Jl. Letjen Suprapto, Slawi, Kab. Tegal</p>
                            </div>
                            <div class="mt-auto pt-2">
                                <button @click.prevent="showModal = true; activeBranch = 'slawi'" class="block w-full text-center px-4 py-2 bg-sky-50 hover:bg-sky-100 text-primary font-bold rounded-lg transition-colors">
                                    Detail Cabang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Cabang Tegal -->
                    <div class="rounded-2xl overflow-hidden border border-slate-200 group flex flex-col">
                        <div class="h-48 bg-slate-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=800" alt="Klinik Tegal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <h4 class="absolute bottom-4 left-5 text-white font-heading font-bold text-xl">Maxilla Dental Care Tegal</h4>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start gap-3 mb-4">
                                <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-slate-600 text-sm">Jl. Kapten Sudibyo, Randugunting, Kec. Tegal Sel., Kota Tegal, Jawa Tengah</p>
                            </div>
                            <div class="mt-auto pt-2">
                                <button @click.prevent="showModal = true; activeBranch = 'tegal'" class="block w-full text-center px-4 py-2 bg-sky-50 hover:bg-sky-100 text-primary font-bold rounded-lg transition-colors">
                                    Detail Cabang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Cabang Brebes -->
                    <div class="rounded-2xl overflow-hidden border border-slate-200 group flex flex-col">
                        <div class="h-48 bg-slate-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&q=80&w=800" alt="Klinik Brebes" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <h4 class="absolute bottom-4 left-5 text-white font-heading font-bold text-xl">Maxilla Dental Care Brebes</h4>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start gap-3 mb-4">
                                <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-slate-600 text-sm">Jl. Jend. Sudirman, Brebes, Kec. Brebes, Kabupaten Brebes, Jawa Tengah</p>
                            </div>
                            <div class="mt-auto pt-2">
                                <button @click.prevent="showModal = true; activeBranch = 'brebes'" class="block w-full text-center px-4 py-2 bg-sky-50 hover:bg-sky-100 text-primary font-bold rounded-lg transition-colors">
                                    Detail Cabang
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Render Komponen Modal Detail -->
        @include('landing_page.cabang.detail')

    </section>

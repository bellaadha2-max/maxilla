<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien | Maxilla Dental Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['Poppins', 'sans-serif'] },
                    colors: { primary: '#0ea5e9', secondary: '#0f172a', surface: '#f8fafc' }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-slate-800 bg-white">

<div class="min-h-screen flex">
    <!-- Left Section: Branding/Illustration -->
    <div class="hidden lg:flex lg:w-5/12 relative bg-primary items-center justify-center overflow-hidden flex-col p-12">
        <!-- Decoration -->
        <div class="absolute top-[10%] right-[-20%] w-[30rem] h-[30rem] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[25rem] h-[25rem] rounded-full bg-blue-800/30 blur-3xl"></div>
        
        <div class="relative z-10 w-full max-w-md text-white">
            <div class="flex items-center gap-2 mb-12">
                <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo Maxilla Dental Care" class="h-10 w-auto">
                <span class="font-heading font-bold text-xl tracking-tight">Maxilla Dental Care</span>
            </div>

            <h1 class="font-heading text-4xl font-bold leading-snug mb-6">Mulai Perjalanan Senyum Sehat Anda.</h1>
            <p class="text-blue-100 text-lg leading-relaxed mb-10 font-light">
                Pendaftaran hanya membutuhkan waktu satu menit. Setelah itu Anda memegang kendali penuh atas reservasi dan jadwal antrean di seluruh cabang kami.
            </p>

            <ul class="space-y-4 text-sm font-medium">
                <li class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-blue-400/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    Booking Cabang Terdekat Lebih Mudah
                </li>
                <li class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-blue-400/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    Notifikasi Estimasi Panggilan Real-Time
                </li>
                <li class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-blue-400/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    Riwayat Medis & Perawatan Terekam Aman
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Section: Form -->
    <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-16 relative bg-slate-50/50">
        <!-- Back Button -->
        <a href="/" class="absolute top-8 right-8 hidden sm:flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors">
            Halaman Utama
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        <a href="/" class="absolute top-6 left-6 block sm:hidden flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="w-full max-w-xl bg-white p-8 sm:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 mt-8 sm:mt-0">
            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center gap-2 mb-8">
                <img src="{{ asset('image/logo-maxilla.png') }}" alt="Logo Maxilla Dental Care" class="h-10 w-auto">
                <span class="font-heading font-bold text-xl tracking-tight text-secondary">Maxilla <span class="text-primary">Dental Care</span></span>
            </div>

            <div class="mb-10 lg:text-left">
                <h2 class="font-heading text-3xl font-bold text-secondary mb-2">Buat Akun Pasien</h2>
                <p class="text-slate-500 font-light">Lengkapi data diri Anda sesuai dengan identitas (KTP) berobat yang berlaku.</p>
            </div>

            <form action="/register" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="block w-full px-4 py-3 border @error('name') border-red-500 @else border-slate-200 @enderror rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="Sesuai KTP" required>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-[11px] font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor KTP (NIK)</label>
                        <div class="relative">
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="block w-full px-4 py-3 border @error('nik') border-red-500 @else border-slate-200 @enderror rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="16 Digit NIK" required minlength="16" maxlength="16" pattern="[0-9]{16}" title="NIK harus terdiri dari 16 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        @error('nik')
                            <p class="text-red-500 text-[11px] font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="block w-full px-4 py-3 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="email@contoh.com" required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-[11px] font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Handphone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp Aktif</label>
                        <div class="relative">
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="block w-full px-4 py-3 border @error('phone') border-red-500 @else border-slate-200 @enderror rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="081234567890" required>
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-[11px] font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="block w-full px-4 py-3 border @error('password') border-red-500 @else border-slate-200 @enderror rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="Minimal 8 karakter" required>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-[11px] font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Ulangi Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-primary focus:border-primary bg-slate-50 focus:bg-white transition-colors sm:text-sm" placeholder="Ketik ulang password" required>
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start mt-4 pt-2">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary cursor-pointer">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-medium text-slate-600 cursor-pointer">Saya menyetujui <a href="#" class="text-primary hover:underline hover:text-blue-700">Syarat & Ketentuan</a> serta <a href="#" class="text-primary hover:underline hover:text-blue-700">Kebijakan Privasi</a> Maxilla Dental Care.</label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-primary/30 text-sm font-bold text-white bg-primary hover:bg-blue-600 transform hover:-translate-y-0.5 transition-all outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Daftar Menjadi Pasien
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center bg-slate-50 py-4 rounded-xl border border-slate-100">
                <p class="text-sm text-slate-600">
                    Sudah punya akun? 
                    <a href="/login" class="font-bold text-primary hover:text-blue-700 transition-colors ml-1">Masuk Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php $setting = \App\Models\Setting::first() ?? new \App\Models\Setting(); ?>
<?php $setting = \App\Models\Setting::first() ?? new \App\Models\Setting(); ?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxilla Dental Care | Pemesanan & Manajemen Antrian Pintar</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0ea5e9', // Sky 500
                        primaryDark: '#0284c7', // Sky 600
                        secondary: '#0f172a', // Slate 900
                        accent: '#f59e0b', // Amber 500
                        surface: '#f8fafc', // Slate 50
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #0ea5e9, #2563eb);
        }
        .blob-bg {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23E0F2FE' d='M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.1,-46.5C90.4,-33.9,96.1,-16.9,94.9,-0.7C93.7,15.6,85.6,31.2,76.5,45.8C67.4,60.4,57.3,74.1,43.3,81.3C29.3,88.5,14.6,89.3,0.3,88.8C-14,88.3,-28,86.5,-41.7,80.1C-55.4,73.7,-68.8,62.8,-79.6,49.5C-90.4,36.2,-98.6,20.5,-99.7,4.3C-100.8,-11.9,-94.8,-28.7,-84.5,-42.6C-74.2,-56.5,-59.6,-67.5,-44.8,-74.5C-30,-81.5,-15,-84.5,-0.1,-84.3C14.8,-84.1,29.6,-80.7,44.7,-76.4Z' transform='translate(100 100)' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center right;
            background-size: contain;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-surface" 
    x-data="{ 
        scrolled: false, 
        activeSection: '' 
    }" 
    @scroll.window="
        scrolled = (window.pageYOffset > 20);
        let sections = ['solusi', 'estimasi', 'alur', 'cabang'];
        let current = '';
        for (let s of sections) {
            let el = document.getElementById(s);
            if (el && window.pageYOffset >= (el.offsetTop - 200)) {
                current = s;
            }
        }
        activeSection = current;
    ">

    @include('landing_page.landing')

    @include('landing_page.solusi')

    @include('landing_page.estimasi')

    @include('landing_page.alur')

    @include('landing_page.cabang.index')

    @include('landing_page.footer')

</body>
</html>

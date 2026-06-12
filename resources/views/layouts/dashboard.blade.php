<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Maxilla Dental Care</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Arial', 'Helvetica', 'sans-serif'], heading: ['Arial', 'Helvetica', 'sans-serif'] },
                    colors: { primary: '#2563eb', secondary: '#1e293b', surface: '#f8fafc' }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 1);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(51, 65, 85, 1);
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-surface text-slate-800 font-sans antialiased overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen w-full">
        <!-- Sidebar Component -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <!-- Topbar Component -->
            @include('components.topbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-4 md:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
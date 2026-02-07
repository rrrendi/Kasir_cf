{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin CF</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

<nav class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="/assets/images/logo.png" class="h-10" alt="Logo" onerror="this.style.display='none'">
            <span class="text-xl font-bold text-gray-800">Kantin CF</span>
        </div>
        <div class="space-x-6">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                @elseif(Auth::user()->role === 'kasir')
                    <a href="{{ route('kasir.dashboard') }}" class="text-gray-600 hover:text-blue-600">Kasir</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<div class="pt-24 pb-12 max-w-7xl mx-auto px-6">
    
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r">
            <p class="font-bold">Terjadi Kesalahan!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <main>
        @yield('content')
    </main>
</div>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kantin CF') }} @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#6b7280',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="menuToggle" class="p-2 bg-white rounded-lg shadow-md">
            <i class="fas fa-bars text-gray-700"></i>
        </button>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed lg:relative w-64 bg-white border-r border-gray-200 min-h-screen z-40">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 mr-3">
                    <h1 class="text-xl font-bold text-gray-900">Kantin CF</h1>
                </div>
                <p class="text-sm text-gray-500 mt-1">Sistem Kasir</p>
            </div>

            <div class="p-4">
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-600">Selamat datang,</p>
                    <p class="font-bold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            {{ Auth::user()->role }}
                        </span>
                    </p>
                </div>

                <nav class="mt-6">
                    <div class="space-y-1">
                        @if(Auth::user()->role === 'kasir')
                            <!-- Menu Kasir -->
                            <a href="{{ route('kasir.dashboard') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('kasir.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="fas fa-home w-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('kasir.transactions.create') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('kasir.transactions.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="fas fa-cash-register w-5 mr-3"></i>
                                <span>Transaksi</span>
                            </a>

                            <a href="{{ route('kasir.categories.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('kasir.categories.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <i class="fas fa-tags w-5 mr-3"></i>
                                <span>Kategori Produk</span>
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <!-- Menu Admin -->
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                                <i class="fas fa-chart-line w-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('products.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                                <i class="fas fa-boxes w-5 mr-3"></i>
                                <span>Produk</span>
                            </a>

                            <a href="{{ route('admin.reports.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                                <i class="fas fa-file-alt w-5 mr-3"></i>
                                <span>Laporan</span>
                            </a>
                        @endif

                        <!-- Profile (umum) -->
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-user w-5 mr-3"></i>
                            <span>Profile</span>
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors duration-200">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
                <p class="text-xs text-center text-gray-500">
                    &copy; {{ date('Y') }} Kantin CF<br>
                    v1.0.0
                </p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 lg:p-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
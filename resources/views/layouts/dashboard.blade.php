{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kantin CF - Sistem POS</title>
    
    <meta property="og:site_name" content="Kantin CF" />
    <meta property="og:title" content="Kantin CF - Dashboard POS" />
    <meta property="og:description" content="Sistem Point of Sales untuk manajemen stok dan transaksi harian." />
    <meta property="og:image" content="{{ asset('images/logo.png') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 transform md:relative md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="h-16 flex items-center justify-between px-6 border-b border-gray-100">
                <div class="flex items-center gap-2 font-bold text-xl text-gray-900">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-lg">K</div>
                    <span>Kantin<span class="text-blue-600">CF</span></span>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-8rem)]">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                       Produk
                    </a>
                    <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                       Laporan
                    </a>
                @else
                    <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('kasir.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                       Kasir Area
                    </a>
                    <a href="{{ route('transactions.create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transactions.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                       Transaksi Baru
                    </a>
                    {{-- Tambahkan ini di menu navigasi kasir --}}
                {{-- <a href="{{ route('kasir.categories.index') }}" 
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>Kategori Produk</span>
                </a>
                @endif
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shadow-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
            
            <header class="bg-white border-b border-gray-200 h-16 flex items-center px-4 md:hidden sticky top-0 z-40 gap-3 shadow-sm">
                
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 rounded-md hover:bg-gray-100 focus:outline-none -ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <span class="font-bold text-lg text-gray-800">KantinCF</span>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 md:p-8">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 shadow-sm">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                        <button @click="show = false" class="text-green-500 hover:text-green-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 shadow-sm">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-40 md:hidden" style="display: none;"></div>
    </div>
</body>
</html> --}} --}}
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kantin CF - POS System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Scrollbar Halus & Oren */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #fed7aa; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #fdba74; }
        
        .active-nav {
            background: linear-gradient(90deg, #fff7ed 0%, #ffffff 100%);
            border-right: 4px solid #f97316;
            color: #c2410c;
        }
    </style>
</head>
<body class="bg-orange-50/50 text-slate-800 antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="min-h-screen relative flex">
        
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white/95 backdrop-blur-xl border-r border-orange-100 h-screen transition-transform duration-300 transform md:translate-x-0 flex flex-col shadow-2xl shadow-orange-100/50"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="h-20 flex items-center justify-between px-8 border-b border-orange-50 flex-shrink-0">
                <div class="flex items-center gap-3 font-bold text-2xl tracking-tight text-gray-900">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-orange-600 rounded-lg flex items-center justify-center text-white text-lg shadow-lg shadow-orange-200">K</div>
                    <span>Kantin<span class="text-primary-600">CF</span></span>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-primary-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Menu Utama</p>
                
                @php
                    $navClass = "flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 group";
                    $navInactive = "text-gray-500 hover:bg-orange-50 hover:text-primary-600";
                    $navActive = "bg-gradient-to-r from-primary-50 to-white text-primary-700 shadow-sm border border-orange-100";
                @endphp

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="{{ $navClass }} {{ request()->routeIs('admin.dashboard') ? $navActive : $navInactive }}">
                       <svg class="w-5 h-5 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-primary-500' : 'text-gray-400 group-hover:text-primary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="{{ $navClass }} {{ request()->routeIs('admin.products.*') ? $navActive : $navInactive }}">
                       <svg class="w-5 h-5 transition-colors {{ request()->routeIs('admin.products.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-primary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                       Produk
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="{{ $navClass }} {{ request()->routeIs('admin.reports.*') ? $navActive : $navInactive }}">
                       <svg class="w-5 h-5 transition-colors {{ request()->routeIs('admin.reports.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-primary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                       Laporan
                    </a>
                @else
                    <a href="{{ route('kasir.dashboard') }}" class="{{ $navClass }} {{ request()->routeIs('kasir.dashboard') ? $navActive : $navInactive }}">
                       <svg class="w-5 h-5 transition-colors {{ request()->routeIs('kasir.dashboard') ? 'text-primary-500' : 'text-gray-400 group-hover:text-primary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                       Kasir Area
                    </a>
                    <a href="{{ route('kasir.transactions.create') }}" class="{{ $navClass }} {{ request()->routeIs('kasir.transactions.*') ? $navActive : $navInactive }}">
                       <svg class="w-5 h-5 transition-colors {{ request()->routeIs('kasir.transactions.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-primary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                       Transaksi Baru
                    </a>
                @endif
            </nav>

            <div class="p-4 border-t border-orange-50 bg-white/50 flex-shrink-0 mt-auto">
                <div class="bg-orange-50 p-3 rounded-2xl flex items-center gap-3 border border-orange-100">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary-400 to-orange-500 flex items-center justify-center text-white font-bold shadow-md">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-primary-600 font-medium truncate capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1.5 hover:bg-red-50 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="md:ml-64 w-full min-h-screen flex flex-col transition-all duration-300">
            <header class="bg-white/80 backdrop-blur-md border-b border-orange-100 h-16 flex items-center px-4 md:hidden flex-shrink-0 gap-3 shadow-sm sticky top-0 z-40">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 rounded-md hover:bg-orange-50 focus:outline-none -ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <span class="font-bold text-lg text-gray-800">Kantin<span class="text-primary-600">CF</span></span>
            </header>

            <main class="flex-1 p-6 md:p-8">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center p-4 bg-green-50 border border-green-100 rounded-xl text-green-800 shadow-sm">
                        <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="flex-1 font-medium">{{ session('success') }}</span>
                        <button @click="show = false" class="text-green-400 hover:text-green-600">&times;</button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center p-4 bg-red-50 border border-red-100 rounded-xl text-red-800 shadow-sm">
                         <div class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="flex-1 font-medium">{{ session('error') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>
    </div>
</body>
</html>
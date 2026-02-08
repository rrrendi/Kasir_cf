<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kantin CF - Sistem POS</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar Sidebar */
        aside nav::-webkit-scrollbar { width: 4px; }
        aside nav::-webkit-scrollbar-track { background: transparent; }
        aside nav::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
        aside nav::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="min-h-screen relative">
        
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 h-screen transition-transform duration-300 transform md:translate-x-0 flex flex-col"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                    
                    <span class="font-bold text-lg text-gray-900 tracking-tight">Kantin<span class="text-orange-600">CF</span></span>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 mt-2">Menu Utama</p>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                       Produk
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                       Laporan
                    </a>
                @else
                    <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('kasir.dashboard') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                       Kasir Area
                    </a>
                    <a href="{{ route('kasir.transactions.create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('kasir.transactions.*') ? 'bg-orange-50 text-orange-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                       Transaksi Baru
                    </a>
                @endif
            </nav>

            <div class="p-4 border-t border-gray-100 bg-gray-50 flex-shrink-0 mt-auto">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold shadow-sm border border-orange-200">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1.5 hover:bg-red-50 rounded-lg" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="md:ml-64 min-h-screen flex flex-col transition-all duration-300">
            
            <header class="bg-white border-b border-gray-200 h-16 flex items-center px-4 md:hidden flex-shrink-0 gap-3 shadow-sm sticky top-0 z-40">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 rounded-md hover:bg-gray-100 focus:outline-none -ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    <span class="font-bold text-lg text-gray-800">KantinCF</span>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 shadow-sm">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                        <button @click="show = false" class="text-green-500 hover:text-green-700 ml-3">&times;</button>
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
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-50 md:hidden" style="display: none;"></div>
    </div>
</body>
</html>
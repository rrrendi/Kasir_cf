<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kantin CF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

<div class="flex min-h-screen">

    <aside class="w-64 bg-white shadow-lg hidden md:flex flex-col fixed h-full z-20">
        <div class="h-16 flex items-center justify-center border-b border-gray-100 bg-blue-600">
            <h1 class="text-xl font-bold text-white tracking-wider">KANTIN CF</h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <span>📊</span> Dashboard
                </a>
                <a href="{{ route('products.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <span>📦</span> Data Produk
                </a>
                <a href="{{ route('reports.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <span>📄</span> Laporan
                </a>
            @else
                <a href="{{ route('kasir.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('kasir.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <span>🖥️</span> Kasir Area
                </a>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-700">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 flex flex-col min-h-screen">
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 md:hidden">
            <span class="font-bold text-lg text-blue-600">Kantin CF</span>
            <button class="text-gray-500">☰</button>
        </header>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
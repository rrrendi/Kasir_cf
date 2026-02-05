<!DOCTYPE html>
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
</html>
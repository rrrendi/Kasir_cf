<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kantin CF</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

<!-- NAVBAR -->
<nav class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="/assets/images/logo.png" class="h-10">
            <span class="text-xl font-bold">Kantin CF</span>
        </div>
        <div class="space-x-6">
            <a href="#about" class="hover:text-blue-600">Tentang</a>
            <a href="#gallery" class="hover:text-blue-600">Galeri</a>
            <a href="#contact" class="hover:text-blue-600">Kontak</a>
            <a href="{{ route('login') }}"
               class="relative z-10 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Login
            </a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="pt-24">
    @yield('content')
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kantin CF') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased text-gray-900 bg-gray-50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-blue-100 rounded-full blur-[100px] opacity-60"></div>
            <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] bg-indigo-100 rounded-full blur-[100px] opacity-60"></div>
        </div>

        <div class="mb-8 z-10 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Kantin<span class="text-blue-600">CF</span></h1>
            <p class="text-gray-500 mt-2 text-sm font-medium">Sistem Kasir Terpadu</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white border border-gray-100 shadow-xl rounded-2xl z-10 relative">
            {{ $slot }}
        </div>
        
        <div class="mt-8 text-gray-400 text-xs z-10">
            &copy; {{ date('Y') }} Kantin CF. All rights reserved.
        </div>
    </div>
</body>
</html>
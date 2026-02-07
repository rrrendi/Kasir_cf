<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kantin CF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-tr from-primary-500 to-orange-400 rounded-2xl flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg shadow-orange-200">
                        K
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Selamat Datang</h2>
                    <p class="mt-2 text-sm text-gray-600">Masuk untuk mengelola Kantin CF</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" required class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="admin@gmail.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" name="password" type="password" required class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-primary-500 to-orange-600 hover:from-primary-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-0.5">
                        MASUK SEKARANG
                    </button>
                </form>
            </div>
        </div>

        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-primary-400 via-primary-500 to-orange-600 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10 text-center px-10">
                <h1 class="text-5xl font-bold text-white mb-6">Sistem Kasir Modern</h1>
                <p class="text-orange-100 text-xl max-w-lg mx-auto leading-relaxed">Kelola transaksi, stok, dan laporan dengan cepat, mudah, dan menyenangkan.</p>
            </div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-orange-300 opacity-20 rounded-full blur-3xl"></div>
        </div>
    </div>
</body>
</html>
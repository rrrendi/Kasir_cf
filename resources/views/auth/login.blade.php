<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kantin CF</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

        <div class="px-8 pt-10 pb-6 text-center flex flex-col items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Kantin CF" class="w-20 h-20 mb-4 object-contain">

            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mt-1">Masuk ke sistem Point of Sales</p>
        </div>

        <div class="px-8 pb-10">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                @if(session('error'))
                    <div
                        class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm text-center shadow-sm">
                        <p class="font-bold">Login Gagal</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if(session('status'))
                    <div
                        class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm text-center shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm shadow-sm"
                        placeholder="admin@example.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm shadow-sm"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                        <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-orange-600 hover:text-orange-700 hover:underline font-medium"
                            href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    MASUK SEKARANG
                </button>
            </form>
        </div>

        <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400 font-medium">
                &copy; {{ date('Y') }} Kantin CF. All rights reserved.
            </p>
        </div>
    </div>

</body>

</html>
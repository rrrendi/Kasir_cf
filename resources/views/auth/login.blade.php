<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md border border-gray-200">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Login Sistem Kasir
        </h2>

        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input id="email"
                       class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                       type="email"
                       name="email"
                       required
                       autofocus
                       placeholder="masukkan email">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input id="password"
                       class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                       type="password"
                       name="password"
                       required
                       placeholder="masukkan password">
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition font-medium">
                    Login
                </button>
            </div>
        </form>

    </div>
</div>
</x-guest-layout>

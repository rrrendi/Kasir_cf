<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md border border-gray-200">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Login Sistem Kasir
        </h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" 
                       class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="masukkan email">
                
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" 
                       class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror" 
                       type="password" 
                       name="password" 
                       required 
                       placeholder="masukkan password">

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
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
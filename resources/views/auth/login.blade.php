<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if ($errors->any() || session('error'))
        <div class="mb-6 bg-red-50 border border-red-100 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="text-sm text-red-600">
                @if(session('error'))
                    <p class="font-medium">{{ session('error') }}</p>
                @endif
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm shadow-sm" 
                   type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@kasir.com" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
            <input id="password" class="block w-full px-4 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm shadow-sm"
                   type="password" name="password" required placeholder="••••••••" />
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 text-sm tracking-wide mt-2">
            MASUK KE DASHBOARD
        </button>
    </form>
</x-guest-layout>
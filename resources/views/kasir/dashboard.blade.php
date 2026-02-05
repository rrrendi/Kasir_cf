@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-10">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
            <h1 class="text-3xl font-extrabold">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="mt-2 text-blue-100 opacity-90">Siap melayani pelanggan hari ini?</p>
        </div>
        
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mulai Transaksi Baru</h3>
                <p class="text-gray-500 mb-6">Klik tombol di bawah untuk masuk ke halaman kasir dan memproses pesanan.</p>
                
                <a href="{{ route('transactions.create') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white text-lg font-bold rounded-xl shadow-lg hover:bg-blue-700 transform hover:-translate-y-1 transition duration-200 w-full md:w-auto">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Buka Mesin Kasir
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 text-center">
                    <span class="block text-3xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</span>
                    <span class="text-sm text-gray-600 font-medium">Menu Tersedia</span>
                </div>
                <div class="bg-green-50 p-5 rounded-xl border border-green-100 text-center">
                    <span class="block text-3xl font-bold text-green-600">{{ \App\Models\Transaction::whereDate('created_at', today())->count() }}</span>
                    <span class="text-sm text-gray-600 font-medium">Transaksi Hari Ini</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
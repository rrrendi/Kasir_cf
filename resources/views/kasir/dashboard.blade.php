@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-8 mb-8 text-white shadow-xl relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-blue-100 text-lg opacity-90">Siap mencatat transaksi hari ini?</p>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 skew-x-12 transform translate-x-12"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('transactions.create') }}" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-200 transition-all duration-300 flex flex-col items-center justify-center text-center cursor-pointer md:col-span-2">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">Buat Transaksi Baru</h3>
            <p class="text-gray-500 text-sm">Masuk ke mesin kasir untuk memproses pesanan pelanggan.</p>
        </a>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-gray-500 text-sm font-semibold uppercase">Total Produk</h4>
                    <span class="p-2 bg-green-50 text-green-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</p>
                <p class="text-xs text-gray-400 mt-1">Item tersedia di database</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-gray-500 text-sm font-semibold uppercase">Transaksi Hari Ini</h4>
                    <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Transaction::whereDate('created_at', today())->count() }}</p>
                <p class="text-xs text-gray-400 mt-1">Penjualan tercatat sejak pagi</p>
            </div>
        </div>
    </div>
</div>
@endsection
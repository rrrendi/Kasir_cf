@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-sm text-gray-500">Ringkasan performa bisnis Anda hari ini.</p>
        </div>
        <span class="px-4 py-2 bg-orange-50 text-orange-700 rounded-xl text-xs font-bold border border-orange-100">
            {{ now()->isoFormat('dddd, D MMMM Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 hover:shadow-md hover:border-orange-300 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pendapatan</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format(\App\Models\Transaction::sum('total'), 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 hover:shadow-md hover:border-orange-300 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Transaksi</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Transaction::count() }} <span class="text-sm font-normal text-gray-400">Nota</span></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 hover:shadow-md hover:border-orange-300 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Produk</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Product::count() }} <span class="text-sm font-normal text-gray-400">Item</span></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 hover:shadow-md hover:border-orange-300 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span class="text-sm font-bold text-gray-800">Online</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.products.create') }}" class="bg-white p-6 rounded-2xl border border-orange-100 hover:border-orange-400 hover:shadow-md transition-all group flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-orange-50 text-orange-600 rounded-xl group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Tambah Produk</h3>
                    <p class="text-xs text-gray-500">Input stok barang baru</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="bg-white p-6 rounded-2xl border border-orange-100 hover:border-orange-400 hover:shadow-md transition-all group flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-orange-50 text-orange-600 rounded-xl group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Laporan Keuangan</h3>
                    <p class="text-xs text-gray-500">Cek keuntungan penjualan</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
</div>
@endsection
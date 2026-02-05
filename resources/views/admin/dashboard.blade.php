@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-500 text-sm mt-1">Ringkasan aktiviti perniagaan hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format(\App\Models\Transaction::sum('total'), 0, ',', '.') }}</h3>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span>Terkini</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-2">Produk Aktif</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::count() }} <span class="text-base font-normal text-gray-400">Unit</span></h3>
            </div>
            <a href="{{ route('products.index') }}" class="mt-4 text-xs font-medium text-purple-600 hover:text-purple-800 flex items-center">
                Lihat Inventori &rarr;
            </a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-orange-600 uppercase tracking-wider mb-2">Total Transaksi</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Transaction::count() }}</h3>
            </div>
            <p class="mt-4 text-xs text-gray-500">Direkodkan sistem</p>
        </div>

        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-lg text-white flex flex-col justify-between">
            <div>
                <p class="text-xs font-bold text-blue-200 uppercase tracking-wider mb-2">Status Sistem</p>
                <h3 class="text-xl font-bold">Operasional</h3>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span class="text-xs font-medium text-blue-100">Live</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('products.create') }}" class="group block bg-white p-6 rounded-2xl border border-gray-200 hover:border-blue-300 hover:ring-2 hover:ring-blue-100 transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Tambah Produk Baru</h3>
                    <p class="text-sm text-gray-500">Masukkan stok barang baru ke dalam sistem.</p>
                </div>
            </div>
        </a>

        <a href="{{ route('reports.index') }}" class="group block bg-white p-6 rounded-2xl border border-gray-200 hover:border-purple-300 hover:ring-2 hover:ring-purple-100 transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Lihat Laporan Kewangan</h3>
                    <p class="text-sm text-gray-500">Analisa keuntungan dan jualan harian.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
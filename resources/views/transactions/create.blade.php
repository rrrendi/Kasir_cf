@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto h-[calc(100vh-8rem)]">
    <form method="POST" action="{{ route('transactions.store') }}" class="h-full flex flex-col md:flex-row gap-6">
        @csrf

        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Katalog Produk
                </h2>
                <span class="text-xs font-medium px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                    {{ $products->count() }} Item
                </span>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50/50">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                    <div x-data="{ qty: 0, max: {{ $product->stock }} }" class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200 group relative overflow-hidden">
                        
                        <div class="absolute top-3 right-3 z-10">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                Stok: {{ $product->stock }}
                            </span>
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 mb-1 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <p class="text-blue-600 font-mono font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <label class="text-xs text-gray-500 font-semibold uppercase mb-1 block">Jumlah Beli:</label>
                                <div class="flex items-center gap-2">
                                    <button type="button" 
                                            @click="if(qty > 0) qty--"
                                            class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                            :disabled="qty <= 0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>

                                    <input type="number" 
                                           name="qty[{{ $product->id }}]" 
                                           x-model="qty"
                                           min="0" 
                                           :max="max"
                                           @input="if(qty > max) qty = max; if(qty < 0) qty = 0;"
                                           class="w-full text-center border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-900 py-1.5"
                                           :class="max == 0 ? 'bg-gray-100 cursor-not-allowed text-gray-400' : ''"
                                           :disabled="max == 0">

                                    <button type="button" 
                                            @click="if(qty < max) qty++"
                                            class="w-9 h-9 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600 font-bold flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                            :disabled="qty >= max || max == 0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        @if($product->stock == 0)
                        <div class="absolute inset-0 bg-white/60 flex items-center justify-center backdrop-blur-[1px] z-20">
                            <span class="font-bold text-red-500 -rotate-12 border-2 border-red-500 px-4 py-1 rounded-lg shadow-sm bg-white">HABIS</span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full md:w-80 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-4">Tindakan</h3>
                
                <div class="space-y-4 mb-6">
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                        <div class="flex gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <p class="text-sm font-bold text-blue-700 mb-1">Cara Guna:</p>
                                <p class="text-xs text-blue-600 leading-relaxed">Gunakan tombol <b>(+)</b> dan <b>(-)</b> untuk mengatur jumlah barang. Tombol (+) akan mati otomatis jika stok habis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    PROSES BAYARAN
                </button>

                <a href="{{ route('kasir.dashboard') }}" class="block text-center mt-4 text-sm text-gray-500 hover:text-gray-800 font-medium">
                    Batal & Kembali
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
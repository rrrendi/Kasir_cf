@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto h-auto md:h-[calc(100vh-8rem)] pb-24 md:pb-0">
    
    <form method="POST" action="{{ route('kasir.transactions.store') }}" class="h-full flex flex-col md:flex-row gap-6" autocomplete="off">
        @csrf

        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col min-h-[60vh] md:min-h-0" 
             x-data="{ search: '' }">
            
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex flex-col gap-3 sticky top-0 z-20 shadow-sm">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Katalog
                    </h2>
                    <span class="text-xs font-medium px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                        {{ $products->count() }} Item
                    </span>
                </div>

                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="search" placeholder="Ketik nama barang..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-orange-500 text-sm bg-white" autocomplete="off">
                    <button type="button" x-show="search.length > 0" @click="search = ''" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500 cursor-pointer" style="display: none;">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50/50">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                    <div x-data="{ qty: 0, max: {{ $product->stock }} }" 
                         x-show="$el.dataset.name.toLowerCase().includes(search.toLowerCase())"
                         data-name="{{ $product->name }}"
                         class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group relative overflow-hidden">
                        
                        <div class="absolute top-3 right-3 z-10">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">Stok: {{ $product->stock }}</span>
                        </div>

                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-orange-600 font-mono font-semibold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-2">
                                <button type="button" @click="if(qty > 0) qty--" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold" :disabled="qty <= 0">-</button>
                                <input type="number" name="qty[{{ $product->id }}]" x-model="qty" class="w-full text-center border-gray-300 rounded-lg font-bold py-1 text-sm h-8" readonly>
                                <button type="button" @click="if(qty < max) qty++" class="w-8 h-8 rounded-lg bg-orange-100 hover:bg-orange-200 text-orange-600 font-bold" :disabled="qty >= max || max == 0">+</button>
                            </div>
                        </div>
                        @if($product->stock == 0)
                            <div class="absolute inset-0 bg-white/60 flex items-center justify-center z-20"><span class="font-bold text-red-500 border border-red-500 px-2 py-1 rounded bg-white text-xs">HABIS</span></div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <div x-show="$el.parentElement.querySelectorAll('[data-name]:not([style*=\'display: none\'])').length === 0" class="flex flex-col items-center justify-center h-48 text-gray-500" style="display: none;">
                    <p class="text-sm">Produk tidak ditemukan.</p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 left-0 w-full bg-white border-t p-4 z-50 md:static md:w-80 md:bg-transparent md:border-0 md:p-0 md:z-auto">
            <div class="md:bg-white md:rounded-2xl md:shadow-lg md:border md:p-6 md:sticky md:top-6">
                <h3 class="hidden md:block text-lg font-bold text-gray-800 mb-4 border-b pb-4">Total Bayar</h3>
                <div class="flex items-center justify-between gap-4 md:block">
                    <div class="md:hidden">
                        <p class="text-xs text-gray-500 font-semibold uppercase">Aksi</p>
                        <p class="text-sm font-bold text-gray-800">Proses Bayar</p>
                    </div>
                    <button type="submit" class="flex-1 w-full py-3 md:py-4 bg-gradient-to-r from-orange-500 to-orange-500 text-white font-bold rounded-xl shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="md:hidden">BAYAR</span><span class="hidden md:inline">BAYAR SEKARANG</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
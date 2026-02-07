@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('kasir.categories.index') }}" 
                   class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Kategori
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Produk: {{ $category->name }}</h1>
                <p class="text-gray-600">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                {{ $products->total() }} produk
            </span>
        </div>
    </div>

    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                    @if($product->description)
                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $product->description }}</p>
                    @endif
                </div>
                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                    {{ $product->stock }} stok
                </span>
            </div>
            
            <div class="flex items-center justify-between mt-4">
                <div>
                    <p class="text-lg font-bold text-blue-600">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                
                <div class="flex items-center space-x-2">
                    <a href="{{ route('kasir.transactions.create') . '?search=' . urlencode($product->name) }}"
                       class="px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Beli
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        @if($products->isEmpty())
        <div class="col-span-4 text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada produk</h3>
            <p class="mt-1 text-gray-500">Belum ada produk dalam kategori ini</p>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Kategori Produk</h1>
        <p class="text-gray-600">Kelompokkan produk Anda untuk memudahkan pencarian</p>
    </div>

    <!-- Grid Kategori -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-900">{{ $category->name }}</h3>
                    @if($category->description)
                    <p class="text-gray-500 text-sm mt-1">{{ Str::limit($category->description, 100) }}</p>
                    @endif
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $category->products_count }} produk
                </span>
            </div>
            
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('kasir.products.by_category', $category->id) }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Produk
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach

        @if($categories->isEmpty())
        <div class="col-span-3 text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada kategori</h3>
            <p class="mt-1 text-gray-500">Kategori akan muncul di sini setelah ditambahkan oleh admin</p>
        </div>
        @endif
    </div>
</div>
@endsection
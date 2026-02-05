@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    
    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-600 flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-yellow-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Edit Produk</h2>
            <p class="text-yellow-100 text-sm">Perbarui informasi produk: {{ $product->name }}</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $product->name) }}"
                           class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm">
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="price" id="price" required min="0" value="{{ old('price', $product->price) }}"
                                   class="w-full pl-10 rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Saat Ini</label>
                        <input type="number" name="stock" id="stock" required min="0" value="{{ old('stock', $product->stock) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 shadow-md transition font-medium">
                        Update Produk
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
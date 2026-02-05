@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    
    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-600 flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Tambah Produk Baru</h2>
            <p class="text-blue-100 text-sm">Masukkan informasi detail produk.</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" id="name" required 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm"
                           placeholder="Contoh: Nasi Goreng Spesial">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="price" id="price" required min="0"
                                   class="w-full pl-10 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm"
                                   placeholder="15000">
                        </div>
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Awal</label>
                        <input type="number" name="stock" id="stock" required min="0"
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm"
                               placeholder="100">
                        @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="reset" class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition font-medium">
                        Reset
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-md transition font-medium">
                        Simpan Produk
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
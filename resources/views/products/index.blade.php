@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk</h2>
        <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="py-4 px-6 font-bold text-gray-600">Nama Produk</th>
                    <th class="py-4 px-6 font-bold text-gray-600">Harga</th>
                    <th class="py-4 px-6 font-bold text-gray-600 text-center">Stok</th>
                    <th class="py-4 px-6 font-bold text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                <tr class="hover:bg-blue-50 transition">
                    <td class="py-4 px-6">{{ $product->name }}</td>
                    <td class="py-4 px-6">Rp {{ number_format($product->price) }}</td>
                    <td class="py-4 px-6 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-center space-x-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-400">Data kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
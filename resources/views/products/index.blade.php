<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
</head>
<body>
<div class="p-8">
    <div class="app-card">
<h1>Data Produk</h1>

<a href="{{ route('products.create') }}">Tambah Produk</a>

<table border="1" cellpadding="5">
    <tr class="hover:bg-gray-100 transition">
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <span class="px-3 py-1 rounded text-white
                {{ $product->stock > 0 ? 'bg-green-600' : 'bg-red-600' }}">
                {{ $product->stock }}
                </span>
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Yakin hapus produk?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</div>
</div>
</body>
</html>

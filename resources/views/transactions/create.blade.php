<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Kasir</title>
</head>
<body>

<h1>Transaksi Kasir</h1>

<form method="POST" action="{{ route('transactions.store') }}">
    @csrf

    <table border="1" cellpadding="5">
    <table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="p-3 text-left">Produk</th>
            <th class="p-3 text-left">Harga</th>
            <th class="p-3 text-left">Stok</th>
            <th class="p-3 text-left">Jumlah</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
        <tr class="hover:bg-gray-100 transition">
            <td class="p-3">{{ $product->name }}</td>
            <td class="p-3">Rp {{ number_format($product->price) }}</td>
            <td class="p-3">
                <span class="px-2 py-1 rounded text-white
                    {{ $product->stock > 0 ? 'bg-green-600' : 'bg-red-600' }}">
                    {{ $product->stock }}
                </span>
            </td>
            <td class="p-3">
                <input type="number"
                       name="qty[{{ $product->id }}]"
                       min="0"
                       max="{{ $product->stock }}"
                       class="border rounded w-20 px-2 py-1">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    <button type="submit">Simpan Transaksi</button>
</form>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<h1>Tambah Produk</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <p>
        <input type="text" name="name" placeholder="Nama Produk" required>
    </p>

    <p>
        <input type="number" name="price" placeholder="Harga" required>
    </p>

    <p>
        <input type="number" name="stock" placeholder="Stok" required>
    </p>

    <button type="submit">Simpan</button>
</form>

</body>
</html>

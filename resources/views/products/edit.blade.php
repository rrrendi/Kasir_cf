<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')

    <p>
        <input type="text" name="name" value="{{ $product->name }}" required>
    </p>

    <p>
        <input type="number" name="price" value="{{ $product->price }}" required>
    </p>

    <p>
        <input type="number" name="stock" value="{{ $product->stock }}" required>
    </p>

    <button type="submit">Update</button>
</form>

</body>
</html>

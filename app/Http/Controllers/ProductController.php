<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Tampilkan produk terbaru dengan pagination
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required',
            'category_id' => 'nullable', // Boleh kosong jika kategori dihapus
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        // Simpan Data
        $data = $request->all();
        // Cek checkbox is_active (jika dicentang = 1, jika tidak = 0)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($data);

        // Redirect ke route ADMIN (PENTING!)
        return redirect()->route('admin.products.index')
                        ->with('success','Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($data);

        // Redirect ke route ADMIN
        return redirect()->route('admin.products.index')
                        ->with('success','Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        // Redirect ke route ADMIN
        return redirect()->route('admin.products.index')
                        ->with('success','Produk berhasil dihapus.');
    }
}
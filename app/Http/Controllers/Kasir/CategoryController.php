<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil semua kategori aktif
        $categories = Category::where('is_active', true)
            ->withCount('products') // hitung jumlah produk per kategori
            ->get();
        
        return view('kasir.categories.index', compact('categories'));
    }
    public function productsByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('stock', '>', 0)
            ->paginate(12);
        
        return view('kasir.categories.products', compact('category', 'products'));
    }
}
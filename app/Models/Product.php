<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id', 
        'image',
        'is_active'// tambahkan ini
        // ... kolom lain yang sudah ada
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean'
    ];

    // Tambahkan relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     // Relasi ke detail transaksi
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

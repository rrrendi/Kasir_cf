<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_date',
        'total',
        'cash_amount',    // tambah
        'change_amount',  // tambah
        'payment_method', // tambah
        'user_id',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'cash_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    // relasi ke detail transaksi
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // relasi ke user (kasir)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

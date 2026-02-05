<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create()
    {
        // Hanya ambil produk yang stoknya ada
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required|array',
            'qty.*' => 'integer|min:0',
        ]);

        // Filter barang yang dibeli saja (qty > 0)
        $itemsToBuy = array_filter($request->qty, fn($val) => $val > 0);

        if (empty($itemsToBuy)) {
            return back()->with('error', 'Pilih minimal satu produk!');
        }

        try {
            DB::beginTransaction(); // Mulai Transaksi Database

            // 1. Buat Invoice
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'invoice_code' => 'INV-' . time(),
                'total' => 0, // Nanti diupdate
            ]);

            $total = 0;

            // 2. Loop Barang
            foreach ($itemsToBuy as $productId => $qty) {
                // KUNCI stok produk agar aman dari bentrok (Penting!)
                $product = Product::lockForUpdate()->find($productId);

                if (!$product) continue;

                if ($qty > $product->stock) {
                    throw new \Exception("Stok {$product->name} kurang! Sisa: {$product->stock}");
                }

                $subtotal = $product->price * $qty;
                $total += $subtotal;

                // Simpan Detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi Stok
                $product->decrement('stock', $qty);
            }

            // 3. Update Total & Simpan
            $transaction->update(['total' => $total]);
            
            DB::commit(); // Simpan Permanen

            return back()->with('success', "Transaksi Berhasil! Total: Rp " . number_format($total));

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika error
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}
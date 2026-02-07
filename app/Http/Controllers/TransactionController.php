<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::where('is_active', true)
            ->orderBy('stock', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        // PERBAIKAN 1: Arahkan ke folder 'kasir.'
        return view('kasir.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required|array',
            'qty.*' => 'integer|min:0',
        ]);

        $items = array_filter($request->qty, fn($q) => $q > 0);

        if (empty($items)) {
            return back()->with('error', 'Pilih minimal satu produk!');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            $details = [];

            foreach ($items as $id => $qty) {
                $product = Product::lockForUpdate()->find($id);

                if (!$product) throw new \Exception("Produk tidak ditemukan.");
                if ($product->stock < $qty) throw new \Exception("Stok {$product->name} tidak cukup.");

                $subtotal = $product->price * $qty;
                $total += $subtotal;

                $product->decrement('stock', $qty);

                $details[] = [
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ];
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'invoice_code' => 'INV-' . time(),
                'total' => $total,
                'status' => 'completed',
            ]);

            foreach ($details as $detail) {
                $transaction->details()->create($detail);
            }

            DB::commit();

            // Redirect ke halaman print
            return redirect()->route('kasir.transactions.print', $transaction->id)
                             ->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function print(Transaction $transaction)
    {
        // PERBAIKAN 2: Arahkan ke folder 'kasir.'
        return view('kasir.transactions.print', compact('transaction'));
    }
}
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
    public function create(Request $request)
    {
        // Pastikan ada bagian ->when(...) ini
        $products = Product::where('stock', '>', 0)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required|array',
            'qty.*' => 'integer|min:0',
        ]);

        $itemsToBuy = array_filter($request->qty, fn($val) => $val > 0);

        if (empty($itemsToBuy)) {
            return back()->with('error', 'Pilih minimal satu produk!');
        }

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'invoice_code' => 'INV-' . time(),
                'total' => 0,
            ]);

            $total = 0;

            foreach ($itemsToBuy as $productId => $qty) {
                $product = Product::lockForUpdate()->find($productId);

                if (!$product)
                    continue;

                if ($qty > $product->stock) {
                    throw new \Exception("Stok {$product->name} kurang! Sisa: {$product->stock}");
                }

                $subtotal = $product->price * $qty;
                $total += $subtotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $qty);
            }

            $transaction->update(['total' => $total]);

            DB::commit();

            return redirect()->route('transactions.print', $transaction->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }

    }

    public function print(Transaction $transaction)
    {
        // Pastikan kasir hanya bisa print transaksi miliknya sendiri (opsional)
        // if ($transaction->user_id !== auth()->id()) abort(403);

        return view('transactions.print', compact('transaction'));
    }
}
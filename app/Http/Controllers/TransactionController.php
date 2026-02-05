<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $total = 0;

            $transaction = Transaction::create([
                'transaction_date' => now(),
                'total' => 0,
                'user_id' => auth()->id(),
            ]);

            foreach ($request->qty as $productId => $qty) {

                if ($qty > 0) {
                    $product = Product::find($productId);

                    if ($qty > $product->stock) {
                    abort(400, 'Jumlah melebihi stok');
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

                    // kurangi stok
                    $product->decrement('stock', $qty);
                }
            }

            $transaction->update(['total' => $total]);
        });

        return redirect()->back();
    }
}


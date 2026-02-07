<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        // Halaman Web: Tetap tampilkan detail per transaksi (opsional)
        // PERBAIKAN: Gunakan 'created_at'
        $transactions = Transaction::with('details.product', 'user')
            ->whereDate('created_at', $date)
            ->latest()
            ->get();

        $totalIncome = $transactions->sum('total');
        $totalQty = $transactions->flatMap->details->sum('qty');
        $totalConsignment = $totalIncome * 0.8;
        $totalProfit = $totalIncome * 0.2;

        return view('reports.index', compact(
            'transactions',
            'totalIncome',
            'totalQty',
            'totalConsignment',
            'totalProfit',
            'date'
        ));
    }

    public function exportPdf(Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        // PERBAIKAN: Ambil Detail Transaksi & Kelompokkan per Produk
        $details = TransactionDetail::with('product')
            ->whereHas('transaction', function($q) use ($date) {
                $q->whereDate('created_at', $date);
            })
            ->select(
                'product_id', 
                DB::raw('SUM(qty) as total_qty'), 
                DB::raw('SUM(subtotal) as total_subtotal')
            )
            ->groupBy('product_id')
            ->get();

        $totalIncome = $details->sum('total_subtotal');

        $pdf = app('dompdf.wrapper')->loadView(
            'reports.pdf',
            compact('details', 'totalIncome', 'date')
        );

        return $pdf->download('laporan-penjualan-' . $date . '.pdf');
    }
}
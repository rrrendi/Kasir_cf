<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    
    public function index(Request $request)
{
    $date = $request->date ?? now()->toDateString();

    $transactions = Transaction::with('details.product', 'user')
        ->whereDate('transaction_date', $date)
        ->get();

    $totalIncome = $transactions->sum('total');

    // total produk terjual
    $totalQty = $transactions->flatMap->details->sum('qty');

    // konsinyasi & keuntungan
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

    public function exportPdf()
    {
        $transactions = Transaction::with('user')
            ->orderBy('transaction_date', 'desc')
            ->get();

        $totalIncome = $transactions->sum('total');

        $pdf = app('dompdf.wrapper')->loadView(
            'reports.pdf',
            compact('transactions', 'totalIncome')
        );


        return $pdf->download('laporan-penjualan.pdf');
    }
}

  

